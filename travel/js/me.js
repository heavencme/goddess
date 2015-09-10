$(document).ready(function(){
    var doc = document;
    $("#date-picker").datepicker();
    
    maxNum=6;
    
    $(document).scroll(function(){
        for (var i=0;i<maxNum;i++) {
            if ($(this).scrollTop()>=($("#link"+i).offset().top-$(document).height()/15)) {
               //console.log("link"+i);
               $("#ank"+i).css({
                    "background":"#0088cc"
                });
               $(".anklist").children().not("#ank"+i).css({
                    "background":"#fff"
               })
               
            }    
        }
        
    });
    
    for (var i=0;i<6;i++) {
        
        $("#ank"+i).bind('click',(function(num){
            return function(){
                //var count=event.currentTarget.hash.substr(5);//.hash="#linkN"
                event.preventDefault();
                $('body,html').animate(
                    {scrollTop:($("#link"+num).offset().top)},
                    500
                );
            }
            })(i)
        );         
    }
    
    var cBody = doc.getElementById("cld-body");
    var day = 1;
    for ( var i = 1; i <= 6; i ++ ){
        var tr = doc.createElement("tr");
        
        for ( var j = 1; j <= 7; j++){
            var td = doc.createElement("td");
            
            if ( i == 1 && j == 1 ) {
                day = 1;
            }
            else{
                td.innerHTML = day % 30;
                if (0 == day % 30) {
                    td.innerHTML = 30;
                }
                day ++;
            }
            
            td.setAttribute("day", day);
            tr.appendChild(td);
        }
        
        cBody.appendChild(tr);
    }
    
    var arrDate = [];
    var dateIndex = 0;
    $("td").click(function(){
        $(this).attr('style', ' background: #0088cc;');
        arrDate[dateIndex++] = parseInt( $(this).attr('day') );
        arrDate.sort(function(a,b){
            return (a - b);    
        });
        console.log(arrDate);
    });
    
    $("#subbutton").click(function(){
        
        var place = ( $("#qinghai_lake").attr("checked") ) ? 0 : 1;
        place = ( $("#zhoushan_isle").attr("checked") ) ? 1 : 0;
        var name = $("#myname").val();
        
        $.ajax({
            type:"POST",
            url:"http://zisheng.org/ds_test/getDate.php",
            data:{
                'type':'sent',
                'name':name,
                'time':arrDate.toString(),
                'place':place
            },
            success:function (d) {
                if (d['ret'] == 'ok') {
                    alert('好了，我已经记下啦。')
                }
            }
        });
    });
    
});
