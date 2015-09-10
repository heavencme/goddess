<?php
include_once('../config.php');
include_once('../zsdb.php');
$picnum=$_POST['picnum'];
$num=$_POST['num'];
$db=new zsdb($dbuser,$dbpassword,$dbname,$dbhost);
if($db->ready)
{
    
    /*当前图片增加一次like记录*/
    $db->addpiclike($picnum,$num);
    $db->db_discon();
}

?>
