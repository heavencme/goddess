KISSY.use("waterfall,node,ajax,overlay,button", function (S, Waterfall, Node,IO,O,B) {
    var $kissy = S.all;
    DOM=S.DOM;
        
    function retweet(wb) {
        //console.log('re,'+wb['user']['id']+'--');
        if (wb['retweeted_status']!=undefined)
            return wb['retweeted_status'];
        else
            return wb;
            
    }
    
    var access;//通过getuaccess.php获取access_token值
    /**获取access_token**/
    IO({
        type:"GET",
        url:"getuaccess.php",
        data:{'myk':'da2f632dc97b861b101c58f4ac0dd8c2'},
        async:false,
        success:function (d) {
            access=d['accs'];
            if (!access) {
                alert('先回首页登录吧←_←');
                window.location="index.php";
            }
        }
        
    });
    /**微博墙**/
    var target = ($kissy('#target').html()),
        page = 1,
        waterfall = new Waterfall.Loader({
            container:"#theWall",
            // 窗口大小变化时的调整特效
            adjustEffect:{
                duration:0.5,
                easing:"easeInStrong"
            },
            load:function (success, end) {
                $kissy('#loadingPins').show();
                IO({
                    type:"GET",
                    data:{
                        'access_token':access,
                        'page':page //不更新页面用户就会看到重复内容
                    },
                    url:"https://api.weibo.com/2/statuses/home_timeline.json", 
                    dataType:"jsonp",
                    success:function (d) {
                        // 如果数据错误, 则立即结束
                        if (d['code'] !==1) {
                            alert('load data error!');
                            end();
                            return;
                        }
                        // 如果到最后一页了, 也结束加载
                        
                        page++;
                        //console.log("!!!!!!"+page);
                        if (page>20) {
                            end();
                            return;
                        }
                        // 拼装每页数据
                        var items = [],weibo=[];
                        S.each(d['data']['statuses'], function (per){
                            //把二维变成一维，否则substitute方法不好用
                            var x=[];
                            x['created_at']=(per['created_at'].split("+"))[0];
                            x['text']=per['text'];
                            x['id']=per['id'];
                            x['uid']=per['user']['id'];
                            x['screen_name']=per['user']['screen_name'];
                            x['profile_image_url']=per['user']['profile_image_url'];
                            x['thumbnail_pic']=per['thumbnail_pic'];
                            x['original_pic']=per['original_pic'];
                            if (retweet(per)!=per) 
                            {       //console.log('!!!!!'); 
                                    x['retext']=retweet(per)['text'];
                                    x['rethumbnail_pic']=retweet(per)['thumbnail_pic'];
                                    x['reoriginal_pic']=retweet(per)['original_pic'];
                                    if (retweet(per)['user']!=undefined)
                                        {
                                            x['reuid']=retweet(per)['user']['id'];
                                            x['rename']="//"+retweet(per)['user']['screen_name']+":";
                                        }
                                    else
                                        {
                                            x['reuid']="";
                                            x['rename']="";
                                        }
                                    
                                    x['br']="</br>";
                            }
                            else
                            {
                                x['retext']="";
                                x['rethumbnail_pic']="";
                                x['reoriginal_pic']="";
                                x['reuid']="";
                                x['rename']="";
                                x['br']="";
                            }
                            
                            weibo.push(x);    
                        });
                        S.each(weibo, function (item) {
                            newone=S.substitute(target,item);
                            items.push(new S.Node(newone));
                            
                        });
                        success(items);
                    },
                    complete:function () {
                        $kissy('#loadingPins').hide();
                        DOM.css('#theWall', { position: 'relative', top:'65px',left:'8em' });//kissy缺陷，必须先完成后设置
                    }
                });
            },
            minColCount:2,
            colWidth:228
        });
    
    
    /**返回顶部缓动**/
    $kissy('#backToTop').on('click', function (e) {
        e.halt();
        e.preventDefault();
        $kissy(window).stop();
        $kissy(window).animate({
            scrollTop:0
        }, 1, "easeOut");
    });
    
    $kissy("#theWall").delegate("click", ".like", function (event) {
        //console.log("!!!!!!!!!!!!!"+DOM.attr($kissy(event.currentTarget).parent().parent(),"uid"));
        var likeuid=DOM.attr($kissy(event.currentTarget).parent().parent(),"uid");//用来发给like.php的，统计用户喜欢哪个微博
        var id=DOM.attr($kissy(event.currentTarget).parent().parent(),"id");//微博id可以唯一标识微博
        IO({
            type:"GET",
            url:"like.php",
            data:{'likeuid':likeuid}
            
        });
        DOM.css('#'+id, { background:'#CAE3F2'});
        DOM.val($kissy(event.currentTarget),"c");
    });
    
    
    var ziDialog = new O.Dialog({
        width:320,//指定宽度
        height:200,//指定高度
        headerContent:'评论并转发',
        bodyContent:'<iframe scrolling="no" height="200" width="320" style="position: inherit;"frameborder="0" name="popupIframe" src="repost.php"></iframe>',
        mask:{
            effect:'fade'
        },
        align:{
            points:['cc', 'cc']
        }
        
    });
    
    $kissy("#theWall").delegate("click", ".repost", function (event) {
        var sid=DOM.attr($kissy(event.currentTarget).parent().parent(),"id");//微博id可以唯一标识微博
        var ziDialog = new O.Dialog({
            width:320,//指定宽度
            height:200,//指定高度
            headerContent:'评论并转发',
            bodyContent:'<iframe scrolling="no" height="200" width="320" style="position: inherit;"frameborder="0" name="popupIframe" src="repost.php?sid='+sid+'"></iframe>',//咱这也是ajax方法啊,haha
            mask:{
                effect:'fade'
            },
            align:{
                points:['cc', 'cc']
            }
            
        });
        
        ziDialog.show();
        
    });
    
    
    
    /**删除一个元素进行重排**/
    $kissy("#theWall").delegate("click", ".del", function (event) {
        var w = $kissy(event.currentTarget).parent(".ks-waterfall");
        waterfall.removeItem(w, {
            effect:{
                easing:"easeInStrong",
                duration:0.1
            },
            /**
            callback:function () {
                alert("删除完毕");
            }
            **/
        });
    });

    
});