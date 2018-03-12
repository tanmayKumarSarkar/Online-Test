<?php
include("session-info.php");
$con = mysql_connect("localhost","root","");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
mysql_select_db("online_test_demo", $con);

if(isset($_POST['sname']) && isset($_POST['spwd']) && isset($_POST['sroll']) && isset($_POST['sdept']) && isset($_POST['syear']))
{
	$sname=$_POST['sname'];
	$sroll=$_POST['sroll'];
	$sdept=$_POST['sdept'];
	$spwd=md5($_POST['spwd']);
	$syear=$_POST['syear'];	
	
	$sql2="INSERT INTO `student`( `Stud_Name`, `Stud_Roll`, `Stud_Dept`, `Stud_Year`, `Stud_Pwd`) VALUES ('$sname','$sroll','$sdept','$syear','$spwd')";
	
	if (!mysql_query($sql2,$con))
	{
		echo "Registration Unsuccessful Please Try again !";
	}
	else
	{//success
		$_SESSION['login_user']=$sroll;
		$_SESSION['User_name']=$sname;
		echo 'success';	
	}
	
}

?>