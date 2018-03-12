<?php
include("session-info.php");	
include("db.php");	
if(!empty($_SESSION['admin_username']))
{
	header('location: home_admin.php');	
}

// If The Admin Yet Not Registered......
	$query_chk = mysql_result(mysql_query("SELECT COUNT(*) FROM admin",$con),0);   
    if($query_chk==0){ 
        
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Admin</title>
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
	width:800px; height:500px; 
	position:absolute; top:50%; left:50%;
	margin-left:-400px; margin-top:-250px;
	text-align:center;
	}	
.login_panel{ 
	width:600px; height:280px; padding-top:40px;
	border:1px solid rgba(153,153,153,0.7); background-color:rgba(153,153,153,0.4);
	box-shadow:0 0 10px rgba(153,153,153,0.3);
	margin:0 auto;}	
.login_hdr{ 
	color:rgba(0,204,255,1); 
	margin-top:30px;
	font-family:Tahoma, Geneva, sans-serif; font-size:18px;}	
.form_box{  
	border:1px solid #c4c4c4; text-align:center; margin-top:6px; margin-bottom:25px;
	width:320px; height:20px;
	font-size:15px; padding:4px 4px 4px 4px; border-radius:4px;
	-moz-border-radius:4px; -webkit-border-radius:4px; box-shadow:0px 0px 8px #d9d9d9;
	-moz-box-shadow:0px 0px 8px #d9d9d9; -webkit-box-shadow:0px 0px 8px #d9d9d9;}
.form_box:focus{ 
	outline:none; border:1px solid #7bc1f7;box-shadow:0px 0px 8px #7bc1f7;
	-moz-box-shadow:0px 0px 8px #7bc1f7; -webkit-box-shadow:0px 0px 8px #7bc1f7;}
.Button{
	outline:none; width:114px; cursor:pointer;
	font-family:Tahoma, Geneva, sans-serif;
	height:32px;
	font-size:16px; padding:4px 4px 4px 4px; border-radius:4px;
	background-color:#F60; color:#FFF;}
#btn_login{ 
	width:210px; margin-right:4px;
	background-color:#0C6; color:#FFF;}
.frgt_pwd{ color:#F63; position:absolute; bottom:20%; left:65%;}
</style>

<script type="text/javascript" src="js/jquery.1.11.1.min.js"></script>
<script type="text/javascript">
	function load_signup()
	{
		$("body").load("signup.php").hide().fadeIn(1500).delay(6000);
	}
	function logmein()
	{
		var usrname = $("#form_uname").val();
		var pwd = $("#form_pword").val();
		var dataString='new_username='+usrname+'&new_password='+pwd;
		if($.trim(usrname).length>0 && $.trim(pwd).length>0){
		  $.ajax({
						type: "POST",
						url: "log_admin.php",
						dataType: "html",
						data: dataString,//"html",
						beforeSend: function(){$('#btn_login').val('Connecting..');},
						cache: false,
						success:function(msg){
							if(parseInt(msg)!=0)
							{	
								//$("body").load("home.php").hide().fadeIn(1500).delay(6000);
								window.location.href="home_admin.php";
							}
							else if(msg==0)
							{
								$('#btn_login').val('Login');						
								$('#invalid').css('display','block');	
							}
						},
						error:function(){
							$('#btn_login').val('Login');
							alert('Sorry Try Again!');
					}
		});//end of the ajax function
	  }//end of the trim if
	  else{ alert('enter your userame and password');}
	}
</script>
</head>
<body>
	<header><txt style=" font-size:24px;">Jalpaiguri Govt. Engg. College</txt></header>
    
    <div class="login_box" id="login_box">
    	<p class="login_hdr">Welcome Admin!! Register Here</p>
    	<hr  style=" background-color:rgba(0,204,255,1); width:95%; height:3px; border:0; margin-bottom:30px; margin-top:10px;"/>
    	<div class="login_panel" id="login_panel">
        <form class="login_form" id="login_form">
        	Admin Username
            <br />
            <input type="text" name="form_uname" class="form_box" id="form_uname" 
            placeholder="Enter Username" />
            <br />
            Password
            <br />
            <input type="password" name="form_pword" class="form_box" id="form_pword" 
            placeholder="Enter Password" />
            <br />
            <input type="button" value="Register" class="Button" onclick="logmein();" id="btn_login" name="btn_login" />
            <br />
            <span id="invalid" style="color:#C00; display:none;">Invalid Username or Password</span>
        </form>
        </div>
    </div>
    
	<footer><h5>2015-16 | powered by JGEC-IT | All Rights Reserved</h5></footer>
</body>
</html>
<?php
	}else{
		header('location: index.php');
		}
?>