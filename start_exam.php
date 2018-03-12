<?php
include("session-info.php");
include("db.php");
if(empty($_SESSION['login_user']))
{
	header('location: index.php');	
}
if(!empty($_SESSION['exam_started']))
{
  unset($_SESSION['exam_started']);	
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Online Exam</title>
<meta http-equiv="Content-Type" content="text/html; "/>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width,initial-scale=1.0" />
<link href="style/reset.css" rel="stylesheet" type="text/css" />
<style type="text/css">
body{
	width: 90%;
	margin: auto;
	min-width: 600px;
	max-width: 2000px;
	font-family: Tahoma, Geneva, sans-serif;
}
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
	width:800px; height:500px; 
	position:absolute; top:50%; left:50%;
	margin-left:-400px; margin-top:-250px;
	text-align:center; border:1px dotted blue;
	}	
.log_container{ 
	position:absolute; top:10px; right:10px;
	width:300px; height:50px; 
	color:#fff; text-align:center;}
	

.xam_panel{ 
	width:600px; height:280px; padding-top:40px;
	border:2px solid #58FA82; background-color:rgba(153,153,153,0.1);
	box-shadow:0 0 10px rgba(153,153,153,0.3);
	margin:0 auto;}
.box_header{color:rgba(0,204,255,1); 
	margin-top:30px; font-size:18px;}
.instruction{ 
	float:left; 
	margin:10px; text-align:left;}
.button_start{
	outline:none; width:114px; cursor:pointer;
	font-family:Tahoma, Geneva, sans-serif;
	height:34px; margin-left:60px;
	font-size:16px; padding:4px 4px 4px 4px; border-radius:4px;
	background-color:#F60; color:#FFF; border:2px double #fff;}
div.vertical-line{
  width: 1px;
  background-color: inherit;
  height: 100%;
  float: left;
  border-left: 1px dashed black ;
  margin:0px;
  margin-left:20px;
}
.note{ width:300px; float:right; margin-left:20px; font-size:15px; text-align:left;}
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
</style>

<script type="text/javascript" src="js/jquery.1.11.1.min.js"></script>
<script type="text/javascript">
function start_xam()
{
	window.location.href="show_question.php";	
}

</script>
</head>
<body>
	<header><txt style=" font-size:24px;">Jalpaiguri Govt. Engg. College</txt></header>
        <div style="position:absolute; top:3px; left:3px;">
    	<img src="image/jgec_logo.png" width="90" height="auto" />
    </div>
    <div  style="position:absolute; width:50px; height:50px; right:320px; top:4px; " >
    	   <a title="home"id="TakeAction" class="gohome" href="home.php" >
       <img src="image/home.png" width="43" height="auto"  />
    </a>
    </div>
    <div id="log_container" class="log_container">
    <img src="image/user.png" width="30px" height="auto" style="margin-right:10px; float:left;" />
	<mno style="float:left; margin-top:4px;"><?php echo $_SESSION['User_name'];?></mno>
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
        <li class="item"><a href="stud_result.php">View Result</a></li>
        <li class="item"><a href="logout.php">Logout</a></li>
      </ul>
    </div>
    </div>
        
        
    </div>
    <div class="login_box" id="login_box">
    	<p class="box_header" id="box_header"><?php echo $_SESSION['test_name'];?></p>
        <hr  style=" background-color:rgba(0,204,255,1); width:95%; height:3px; border:0; margin-bottom:30px; margin-top:10px;"/>
        <div class="xam_panel" id="xam_panel">
			
            
            <div id="instruction" class="instruction">
            	<mla style=" color:#FE2E64; font-size:19px;">Instruction</mla><br><br>
                i) Total number of questions : <?php echo $_SESSION['test_qstn'];?><br /><br />
                ii)Time alloted : <?php echo $_SESSION['test_duration'];?> minutes<br /><br />
                <input type="button" value="Start Exam" name="button_start" onclick="start_xam();" class="button_start" id="button_start" />
            </div>
            <div class="vertical-line" style="height: 245px;" ></div>
            <div id="note" class="note">
            	<mla style=" color:#FE2E64; margin-bottom:10px; font-size:18.3px;">Note :</mla><br><br />
                <li>Test will be submitted automatically if the time expires.</li><br />
                <li>Click the 'Submit test' button to submit your answer.</li><br />
                <li>Do not refresh the page.</li>
            </div>
            
            
        </div>
    </div>

    
	<footer><h5>2015-16 | powered by JGEC-IT | All Rights Reserved</h5></footer>
</body>
</html>