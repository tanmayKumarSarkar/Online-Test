<?php
include("db.php");
include("session-info.php");
if(empty($_SESSION['admin_username']))
{
	header('location: Admin.php');	
}

$query_q  = mysql_query('SELECT * FROM question ',$con);

    $num_rows_q  = mysql_num_rows($query_q); // Get the number of rows
    if($num_rows_q <= 0){ // If no users exist with posted credentials print 0 like below.
        
    } else {
	
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
	width:1040px; height:560px; 
	position:absolute; top:50%; left:50%;
	margin-left:-500px; margin-top:-274px;
	text-align:center; border:1px dotted blue;
	}	
.log_container{ 
	position:absolute; top:10px; right:10px;
	width:300px; height:50px; 
	color:#fff; text-align:center;}
		
.box_header{color:rgba(102,0,153,1); 
	margin-top:10px; font-size:16px;}
	
#main_box{ width:1000px; height:475px;
	margin-left:-502px;
	margin-top:-215px;
    overflow-y:auto;
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
	
#qstn_box_h{
	background-color:rgba(120,112,218,1);
	margin-top:-23px;
	margin-left:-19px;
	width:104%;
	}		
.qstn_box{
	 margin-top:5px;
	 background-color:rgba(0,255,153,1);
	 padding-top: 5px;
	 padding-bottom:5px;
	 font-family:"Comic Sans MS", cursive;
	}	
.qstn_box_txt{
	margin-top:7px;
	margin-bottom:-15px;
	height:45px;
	width:940px;
	}	
.test_btn_edit{
	border:1px solid #c4c4c4; text-align:center;
	width:80px; height:35px;
	background-color:rgba(183,224,247,1);
	cursor:pointer;
	margin-left:10px;
	font-family:"Comic Sans MS", cursive;
	background-color:#FFF;
	letter-spacing:1px;
	text-shadow:0px 1px 1px rgba(250,106,99,1);
	font-size:16px; padding:4px 4px 4px 4px; border-radius:4px;
	-moz-border-radius:4px; -webkit-border-radius:4px; box-shadow:0px 0px 8px #d9d9d9;
	-moz-box-shadow:0px 0px 8px #d9d9d9; -webkit-box-shadow:0px 0px 8px #d9d9d9;}	
.test_btn_edit:hover{ 
	background-color:#F60; color:#FFF; border:2px solid #fff;
	text-shadow:2px 1px #6666CC;
	outline:none; border:1px solid #7bc1f7;box-shadow:0px 0px 8px #7bc1f7;
	-moz-box-shadow:0px 0px 8px #7bc1f7; -webkit-box-shadow:0px 0px 8px #7bc1f7;}
.test_btn_back{
	border:1px solid #c4c4c4; text-align:center;
	width:200px; height:26px;
	margin-top:-15px;
	margin-left:39%;
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
	
  #button {  /* Box in the button */
        display: block;
		float:right;		
        width: 190px;
      }

      #button a {
        text-decoration: none;
		color:#036;
		 
      }

      #button ul {
        list-style-type: none;  
      }

      #button .top {
        background-color: #ddd;  
      }

      #button ul li.item {
        display: none;  
      }  

      #button ul:hover .item {  
        display: block;
		margin:5px;
		height:25px;
		color:#036;
        border-top: 1px dashed #00F; border-bottom: 1px dashed #00F;
        background-color: rgba(204,204,204,0.5);;
      }
.actions{ position:absolute; top:0px; right:0px;}	

</style>

<script type="text/javascript" src="js/jquery.1.11.1.min.js"></script>

</head>
<body>
	<header><txt style=" font-size:24px;">Jalpaiguri Govt. Engg. College</txt></header>
        <div style="position:absolute; top:3px; left:3px;">
    	<img src="image/jgec_logo.png" width="90" height="auto" />
    </div>
    <div id="log_container" class="log_container">
        <a title="home" style="float:left; margin-top:-5px;
     margin-right:10px;" id="TakeAction" class="gohome" href="home_admin.php" >
       <img src="image/home.png" width="43" height="auto"  />
    </a>
    <img src="image/user.png" width="30px" height="auto" style="margin-right:10px; float:left;" />
	<mno style="float:left; margin-top:4px;"><?php echo $_SESSION['admin_username'];?></mno>
    <div class="actions">
    <div id="button">
      <ul>
        <li class="top">
        	<a style="float:right;" id="TakeAction" class="logout" href="#" >
                <img src="image/gear.png" width="30px" height="auto"  />
            </a></li>
            <br>
            <br>
        <li class="item"><a href="chage_password.php">Change Password</a></li>
        <li class="item"><a href="view_result.php">View Result</a></li>
        <li class="item"><a href="logout_admin.php">Logout</a></li>
      </ul>
    </div>
    </div>
        
    </div>
    <div class="login_box" id="login_box">
    	<p class="box_header" id="box_header">Test Paper Questions</p>
        
        <br /><br />
        <hr  style=" background-color:rgba(0,204,255,1); width:95%; height:1px; border:0; margin-bottom:0px; margin-top:-20px;"/>
        
        <div id="main_box">
        
<?php
while($list_q = mysql_fetch_assoc($query_q)){
?>
	<div class="qstn_box">
    	<form id="set_test_paper_qstn" action="edit_question.php" method="post" style="margin:20px;">
       	<div id="qstn_box_h">Question no : <?php echo $list_q['Qstn_Id'] ?></div>
        <input name="qstnid" type="hidden" value="<?php echo $list_q['Qstn_Id'] ?>" />
    	<textarea class="qstn_box_txt" name="qstn_<?php echo $list_q['Qstn_Qstn']?>" rows="3" cols="134" readonly="readonly"
         placeholder="<?php echo " ".$list_q['Qstn_Qstn']?>" style="resize:none" required="required"><?php echo $list_q['Qstn_Qstn']?></textarea><br /><br />
        <div style="margin-left:5px; text-align:left">
        A :&nbsp;<input name="optn_1_<?php echo $list_q['Qstn_Op1']?>" type="text" required="required"
        			value="<?php echo $list_q['Qstn_Op1']?>" readonly="readonly"/>
        &nbsp;B :&nbsp;<input name="optn_2_<?php echo $list_q['Qstn_Op2']?>" type="text" required="required"
        			value="<?php echo $list_q['Qstn_Op2']?>" readonly="readonly"/>
        &nbsp;C :&nbsp;<input name="optn_3_<?php echo $list_q['Qstn_Op3']?>" type="text" required="required"
        			value="<?php echo $list_q['Qstn_Op3']?>" readonly="readonly"/>
        <input type="submit" value="Edit" name="edit_qstn_next" class="test_btn_edit"
         onclick="location.href='edit_question.php?qstnid=<?php echo $list_q['Qstn_Id'] ?>'" />
         <input type="submit" value="Delete" name="del_qstn_next" class="test_btn_edit" />                    
        </div>
        <div style="margin-top:5px; margin-left:5px; text-align:left">
        D :&nbsp;<input name="optn_4_<?php echo $list_q['Qstn_Op4']?>" type="text" required="required"
        			value="<?php echo $list_q['Qstn_Op4']?>" readonly="readonly"/>
        &nbsp;Question Type :&nbsp;<input name="optn_qstn_type_<?php echo $list_q['Qstn_Type']?>" type="text" required="required"
        			value="<?php echo $list_q['Qstn_Type']?>" readonly="readonly" />
        &nbsp;right answer :&nbsp; <input name="optn_ans_<?php echo $list_q['Qstn_Ans']?>" type="text" required="required"
        			value="<?php echo $list_q['Qstn_Ans']?>" readonly="readonly"/>
        </form>           
        </div>
    </div>	
<?php 
}
	}
?>
		</br>
    	
        <a href="home_admin.php"><div class="test_btn_back" align="center">BACK</div></a>
        
        </div>
        
    </div>
    
    
	<footer><h5>2015-16 | powered by JGEC-IT | All Rights Reserved</h5></footer>
</body>
</html>


