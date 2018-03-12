<?php
//error_reporting(0);
include("session-info.php");
include("db.php");
if(empty($_SESSION['login_user']))
{
	header('location: index.php');	
}
else
{
	$userid = $_SESSION['login_user'];	
}
if(isset($_GET['pwd']))
{
	$pwd=md5($_GET['pwd']);
}
$sql="select Stud_Pwd from student where Stud_Roll = '$userid'";
$res=mysql_query($sql,$con);
$nrow=mysql_num_rows($res);
if($nrow>0)
{
	$row = mysql_fetch_array($res);
	$c_old_pwd=$row['Stud_Pwd'];
	$old_pwd=$_GET['curr_pwd'];
	$old_md5=md5($old_pwd);
	if($old_md5==$c_old_pwd)
	{
		$sql_up= "UPDATE student SET Stud_Pwd = '$pwd' WHERE Stud_Roll = '$userid'" ;
		$res=mysql_query($sql_up,$con);
		if(! $res )
		{
		  echo "Faild to Update Password Try Again";
		}
		else
		{
			echo "Password Updated successfully";
		}
	}
	else
	{
		echo "Current Password Does not Match";	
	}
}
else
{
	echo "Faild to change new Password !";	
}