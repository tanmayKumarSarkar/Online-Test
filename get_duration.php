<?php
error_reporting(0);
include("session-info.php");
include("db.php");
$data=($_POST['Test_Id_local']);
$sql_show="select * from testpaper where Test_Id  = '$data'";
$res = mysql_query($sql_show);
$row = mysql_fetch_array($res);
$newtym=$row['Test_Time'];
$newq=$row['Test_Qno'];
$tname=$row['Test_Name'];
$type=$row['type'];
$_SESSION['test_id']=$data;
$_SESSION['test_duration']=$newtym;
$_SESSION['test_qstn']=$newq;
$_SESSION['test_name']=$tname;
$_SESSION['test_type']=$type;
$datas=	'tym='.$newtym.'&qstn='.$newq;
echo $datas;
?>