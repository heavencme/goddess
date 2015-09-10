<!DOCTYPE html>
<html lang="zh">
<?php
include_once('../config.php');
include_once('../zsdb.php');
$home=array();
$nu=$_GET['nu'];
$db=new zsdb($dbuser,$dbpassword,$dbname,$dbhost);
if($db->ready)
{
    /*获取数据库中首页图片地址*/
    $home=$db->picget();
    
    /*当前图片增加一次阅读记录*/
    $db->addpicview($nu,$home['num']);
    
    $db->db_discon();
    //echo"godown!";
}



?>
    <head>
	<title><?= $home["pic$nu"."name"]; ?>--吱声四格</title>
	<meta name="keywords" content="吱声 <?= $home["pic$nu"."name"]; ?>" />
	<meta name="description" content="吱声 <?= $home["pic$nu"."name"]; ?>" />
	<link rel="shortcut icon" href="../Favicon.ico" mce_href="../Favicon.ico" type="image/x-icon">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta chaset="uft-8" />
        <meta name="viewport" content="width=device-width,initial-scale=1.0" />
        <script src="../js/jquery.js" ></script>
        <script src="js/pic.js" ></script>
        <link href="css/style.css" rel="stylesheet" />
        <link href="../css/headerstyle.css" rel="stylesheet" />
    </head>
    <body>
        <header>
            <?php include_once"../header-navi.php"; ?>
        </header>
        <div class="mainwrapper" >
            <div id="content">
                <section>
                    <div class="sec-header">
                        <h1><?= $home["pic$nu"."name"]; ?></h1>
                    </div>
                    <div class="sec-content">
                        <img id="pageheader" src="../images/pageheader.png" title="喜欢？点我！" alt="喜欢？点我！" />
                        <div id="pic" picnum="<?=$nu;?>" num="<?=$home['num'];?>">
                            <img src="<?= $home["pic$nu"]; ?>" alt="<?= $home["pic$nu"."name"]; ?>" title="<?= $home["pic$nu"."name"]; ?>" />
                        </div>
                        <div id="dscr">
                            <p><?= $home["pic$nu"."dscr"]; ?></p>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </body>