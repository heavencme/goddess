<!DOCTYPE html>
<html lang="zh">
    <head>
    </head>
    <body>
<?php
    $data=array();//存"pic0","pic0name","pic0dscr"...
    $val=array();//存"pic0","pic0name","pic0dscr"等对应的值
    
    for($num=0;$num<1;$num++)
    {
        
        if(is_uploaded_file($_FILES["pic0"]['tmp_name']))
        {
                $img_tmp=$_FILES["pic0"]['tmp_name'];
                $dir=$_SERVER['DOCUMENT_ROOT']."/ds_test/";//存贮图片地址20130701/u123456789
                if(!is_dir($dir))//目录是否存在
                    mkdir($dir,0777,true);
                $org_name=$_FILES["pic0"]['name'];
                
                //解决不同浏览器对文件类型识别问题，用正则匹配
                $pregstr="/.\w{0,}$/u";//".jpg"
                $arr=preg_split($pregstr,$org_name);
                $type=preg_replace("/^$arr[0]/u","",$org_name);
                
                $img_name="test".$type;//GMT时间加随机数，如果同时上传多个文件，time（）相同
                $img=$dir."/".$img_name;
                if(move_uploaded_file($img_tmp,$img))
                {
                }
                else
		{
                    echo "move_uploaded_file error!!";
		}
        echo "uploading ok.";
        }
    }
?>
    </body>
</html>
    
