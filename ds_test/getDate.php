<?php

include_once('config.php');
include_once('zsdb.php');

$db=new zsdb($dbuser,$dbpassword,$dbname,$dbhost);

if ( $db->ready )
{
    if($_REQUEST['type']=='sent')
    {
        if( isset($_REQUEST['name']) && isset($_REQUEST['time']) && isset($_REQUEST['place']) )
        {
                $name=$_REQUEST['name'];
                $time=$_REQUEST['time'];
                $place=$_REQUEST['place'];
        }
        $arr = array ('ret'=>'ok');
        header('Content-Type: application/json');
        print json_encode($arr);
    }
    
    $db->add_one($name,$place,$time);

}



    
        
    

?>