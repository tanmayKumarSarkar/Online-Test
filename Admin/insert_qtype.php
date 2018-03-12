<?php
include("db.php");
include("session-info.php");
if(empty($_SESSION['admin_username']))
{
	header('location: Admin.php');	
}

if(isset($_REQUEST['add_type']))
{
	$type_name=$_REQUEST['add_type_txt'];
	$type_name = ucwords( strtolower($type_name));
	$sql_ins="insert into question_type (type_name) values ('$type_name')";
		if (!mysql_query($sql_ins,$con)){
		echo "error"; }
		else{//success
		echo " success";
		header('location: insert_qtype.php');
		}	
}

if(isset($_REQUEST['update_type']))
{
	$type_id=$_REQUEST['type_id'];
	$type_name=$_REQUEST['add_type_txt'];
	$type_name = ucwords( strtolower($type_name));
	$sql_update="update question_type set type_name='$type_name' where type_Id='$type_id'";
		if (!mysql_query($sql_update,$con)){
		echo "error"; }
		else{//success
		echo " success";
		header('location: insert_qtype.php');
		}	
}

if(isset($_REQUEST['delete_type']))
{
	$type_id=$_REQUEST['type_id'];
	$sql_delete="delete from question_type where type_Id='$type_id'";
		if (!mysql_query($sql_delete,$con)){
		echo "error"; }
		else{//success
		echo " success";
		header('location: insert_qtype.php');
		}	
}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Set Test</title>
<meta http-equiv="Content-Type" content="text/html; "/>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width,initial-scale=1.0" />
<link href="style/reset.css" rel="stylesheet" type="text/css" />
<style type="text/css">
body{width:90%; margin:auto;min-width:600px; max-width:2000px; font-family:Tahoma, Geneva, sans-serif;}
a{  text-decoration:none; color:#F8F8FF;}
#main_box{
	position:absolute; width:400px;
	height:300px; left:50%; top:50%;
	margin-left:-200px; margin-top:-150px;
 	border:2px solid black;}
header{ 
	color:#fff; text-align:center; font-family:Tahoma, Geneva, sans-serif;
	background-color:rgba(0,51,102,1);
	width:100%;
	height:40px;
	position:absolute;
	top:0px;
	left:0px;
	padding-top:10px;
	border-bottom:1px solid #006;
	}
footer{
	color:#fff; text-align:center; font-family:Tahoma, Geneva, sans-serif;
	background-color:rgba(0,51,102,1);
	width:100%;
	height:30px;
	position:absolute;
	bottom:0px; border-top:1px solid #006;
	left:0px; padding-top:5px;}
.login_box{ 
	width:800px; height:520px; 
	position:absolute; top:50%; left:50%;
	margin-left:-400px; margin-top:-255px;
	text-align:center; border:1px dotted blue;
	}	
.log_container{ 
	position:absolute; top:10px; right:10px;
	width:300px; height:50px; 
	color:#fff; text-align:center;}
	

.xam_panel{ 
	width:600px; height:325px; padding-top:20px;
	border:1px solid rgba(153,153,153,0.7); background-color:rgba(153,153,153,0.4);
	box-shadow:0 0 10px rgba(153,153,153,0.3);
	margin:0 auto;
	overflow-y:auto;
}
.box_header{color:rgba(0,204,255,1); 
	margin-top:7px; font-size:18px;
	margin-bottom:8px;
	font-family:"Comic Sans MS", cursive;
	color:rgba(0,255,51,1);
	text-shadow:1px 1px #181B7A;
	}

.test_paper{  
	border:1px solid #c4c4c4; text-align:center; margin-top:6px;
	margin-left:70px; margin-bottom:9px;
	width:400px; height:30px;
	cursor:pointer;
	font-family:"Comic Sans MS", cursive;
	background-color:#FFF;
	letter-spacing:1px;
	text-shadow:0px 1px 1px rgba(250,106,99,1);
	font-size:16px; padding:4px 4px 4px 4px; border-radius:4px;
	-moz-border-radius:4px; -webkit-border-radius:4px; box-shadow:0px 0px 8px #d9d9d9;
	-moz-box-shadow:0px 0px 8px #d9d9d9; -webkit-box-shadow:0px 0px 8px #d9d9d9;}
.test_paper:hover{ 
	background-color:rgba(165,237,241,1); color:rgba(255,0,0,1); border:2px solid #fff;
	text-shadow:1px 1px #000000;
	outline:none; border:1px solid #7bc1f7;box-shadow:0px 0px 8px #7bc1f7;
	-moz-box-shadow:0px 0px 8px #7bc1f7; -webkit-box-shadow:0px 0px 8px #7bc1f7;}
.btn_add{
	border:1px solid #c4c4c4; text-align:center; margin-top:0px; margin-bottom:-5px;
	margin-left:100px;
	margin-right:20px;
	width:200px; height:31px;
	cursor:pointer;
	font-family:"Comic Sans MS", cursive;
	background-color:#F60;
	text-shadow:2px 1px #CCCCCC;
	letter-spacing:1px;
	text-shadow:0px 1px 1px rgba(250,106,99,1);
	font-size:15px; padding:4px 4px 4px 4px; border-radius:4px;
	-moz-border-radius:4px; -webkit-border-radius:4px; box-shadow:0px 0px 8px #d9d9d9;
	-moz-box-shadow:0px 0px 8px #d9d9d9; -webkit-box-shadow:0px 0px 8px #d9d9d9;}
.btn_add:hover{ 
	background-color:#72E43A; color:#FFF; border:2px solid #fff;
	text-shadow:2px 1px #333333;
	outline:none; border:1px solid #7bc1f7;box-shadow:0px 0px 8px #7bc1f7;
	-moz-box-shadow:0px 0px 8px #7bc1f7; -webkit-box-shadow:0px 0px 8px #7bc1f7;}
#add_type_txt{
	margin-left:20px;
	}	
		
.btn{
	border:1px solid #c4c4c4; text-align:center; margin-top:6px; margin-bottom:9px;
	margin-left:-5px;
	margin-right:5px;
	width:202px; height:40px;
	cursor:pointer;
	font-family:"Comic Sans MS", cursive;
	background-color:#F60;
	text-shadow:2px 1px #CCCCCC;
	letter-spacing:1px;
	text-shadow:0px 1px 1px rgba(250,106,99,1);
	font-size:16px; padding:4px 4px 4px 4px; border-radius:4px;
	-moz-border-radius:4px; -webkit-border-radius:4px; box-shadow:0px 0px 8px #d9d9d9;
	-moz-box-shadow:0px 0px 8px #d9d9d9; -webkit-box-shadow:0px 0px 8px #d9d9d9;}
.btn:hover{ 
	background-color:#72E43A; color:#FFF; border:2px solid #fff;
	text-shadow:2px 1px #333333;
	outline:none; border:1px solid #7bc1f7;box-shadow:0px 0px 8px #7bc1f7;
	-moz-box-shadow:0px 0px 8px #7bc1f7; -webkit-box-shadow:0px 0px 8px #7bc1f7;}
.test_btn_back{
	border:1px solid #c4c4c4; text-align:center;
	width:200px; height:26px;
	margin-top:-15px;
	margin-left:31%;
	margin-bottom:5px;
	cursor:pointer;
	font-family:"Comic Sans MS", cursive;	
	size:17px;
	letter-spacing:1px;
	background-color:#F60;
	color:#FFF;
	text-shadow:2px 1px #6666CC;
	font-size:16px; padding:4px 4px 4px 4px; border-radius:4px;
	-moz-border-radius:4px; -webkit-border-radius:4px; box-shadow:0px 0px 8px #d9d9d9;
	-moz-box-shadow:0px 0px 8px #d9d9d9; -webkit-box-shadow:0px 0px 8px #d9d9d9;}	
.test_btn_back:hover{ 
	background-color:#72E43A;
	border:2px solid #fff;
	color:rgba(249,253,102,1);
	text-shadow:1px 1px 1px #000000;
	outline:none; border:1px solid #7bc1f7;box-shadow:0px 0px 8px #7bc1f7;
	-moz-box-shadow:0px 0px 8px #7bc1f7; -webkit-box-shadow:0px 0px 8px #7bc1f7;}	
</style>

<script type="text/javascript" src="js/jquery.1.11.1.min.js"></script>

</head>
<body>
	<header><txt style=" font-size:24px;">Jalpaiguri Govt. Engg. College</txt></header>
    <div id="log_container" class="log_container">
    <img src="image/user.png" width="30px" height="auto" style="margin-right:10px; float:left;" />
	<mno style="float:left; margin-top:4px;"><?php echo $_SESSION['admin_username'];?></mno>
    <!--
        <ul class="menu">
            <li><a style="float:right;" class="logout" href="#">
                <img src="image/gear.png" width="30px" height="auto"  /></a></li>
            
               
                <ul>
                    <li><a href="#">Change Password</a></li>
                    <li><a href="#">My Result</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
        </ul>
        
        -->
    <a style="float:right;" class="logout" href="logout_admin.php">
                <img src="image/gear.png" width="30px" height="auto"  /></a>
    </div>
    <div class="login_box" id="login_box">
    	<p class="box_header" id="box_header">Add New Questions Types </p>
        <div class="test_paper" style="margin-left:100px; width:584px;">
        <form id="add_type" action="insert_qtype.php" method="post">
        <input type="text" name="add_type_txt" id="add_type_txt" required="required" />
        <input type="submit" class="btn_add" name="add_type" value="Add" />
        </form>
        </div>
        <hr  style=" background-color:rgba(0,204,255,1); width:97%; height:1px; border:0; margin-bottom:20px; margin-top:17px;"/>
        <p class="box_header" id="box_header" style="margin-top:-18px;"> Questions Types </p>
        <div class="xam_panel" id="xam_panel">
        
<?php
	$query_test_type  = mysql_query("SELECT * FROM question_type"); 
    $num_rows_test_type  = mysql_num_rows($query_test_type); // Get the number of rows
    if($num_rows_test_type <= 0){ // If no users exist with posted credentials print 0 like below.
    ?>	  
		<div style="color:rgba(255,0,0,1);margin-bottom:30px;">No Types Found !! Insert New Type....</div>
     <?php
    } else {
        while($list_q = mysql_fetch_assoc($query_test_type)){
?>        
        
        <form id="set_test_paper" action="insert_qtype.php" method="post" style="margin:20px; margin-top:-10px;">
        
        <div class="test_paper" style="margin-left:-10px; width:565px;">Type :
        <input type="text" name="add_type_txt" id="add_type_txt" value="<?php echo $list_q['type_Name'] ?>" required="required"/>
		<input type="hidden" name="type_id" value="<?php echo $list_q['type_Id'] ?>" />
	<input type="submit" class="btn_add" name="update_type" value="Update" style="width:90px;margin-left:30px;margin-right:0px;"/>
	<input type="submit" class="btn_add" name="delete_type" value="Delete" style="width:90px;margin-left:30px;margin-right:0px;"/>
        </div>
		</form>
<?php
	}
		}
?>        
		<a href="home_admin.php"><div class="test_btn_back" align="center">BACK</div></a>
        </div>
    </div>
    
	<footer><h5>2015-16 | powered by JGEC-IT | All Rights Reserved</h5></footer>
</body>
</html>
<?php 

?>
