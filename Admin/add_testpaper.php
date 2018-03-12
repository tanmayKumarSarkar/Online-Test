<?php
include("session-info.php");
$con = mysql_connect("localhost","root","");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("online_test_demo", $con);


if(isset($_POST['set_test_paper_submit']))
{
	$_no_qstn=$_POST['qstnno'];
	$_papername=$_POST['testpapername'];
	$_duration=$_POST['duration'];
	$_SESSION['no_qstn']=$_no_qstn;
	$q_type=$_POST['qstn_type'];
	
	$sql="insert into testpaper (Test_Name , Test_Time , Test_Qno , type) values ('$_papername','$_duration','$_no_qstn','$q_type')";
		if (!mysql_query($sql,$con)){ echo "error";}
		else{
			echo "success";
			header('location: home_admin.php');
			}
}

if(isset($_POST['edit_test_paper_submit']))
{
	$_no_qstn=$_POST['qstnno'];
	$q_type=$_POST['qstn_type'];
	$_papername=$_POST['testpapername'];
	$_duration=$_POST['duration'];
	$_tid = $_POST['t_id'];
	
	$sql="update testpaper set Test_Name='$_papername', Test_Time='$_duration', Test_Qno='$_no_qstn',
	 type='$q_type' where Test_Id='$_tid' ";
		if (!mysql_query($sql,$con)){ echo "error";}
		else{
			echo "success";
			header('location: home_admin.php');
			}
}

if(isset($_REQUEST['button_tst_del'])){
	
		$tpid=$_REQUEST['t_paper_id'];
		$sql_tst_delete="delete from testpaper where Test_Id='$tpid'";
		if (!mysql_query($sql_tst_delete,$con)){
		echo "error"; }
		else{//success
		echo " success";
		header('location: home_admin.php');
		}	
}
?>