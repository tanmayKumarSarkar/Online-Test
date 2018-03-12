<?php
include("session-info.php");
if(!empty($_SESSION['login_user']))
{
	header('location: home.php');	
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
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
.signup_box{ 
	width:800px; height:500px; 
	position:absolute; top:50%; left:50%;
	margin-left:-400px; margin-top:-250px;
	text-align:center;
	}	
.signup_panel{ 
	width:600px; height:380px; padding-top:0px;
	border:1px solid rgba(153,153,153,0.7); background-color:rgba(153,153,153,0.4);
	box-shadow:0 0 10px rgba(153,153,153,0.3);
	margin:0 auto;}	
.signup_hdr{ 
	color:rgba(0,204,255,1); 
	margin-top:30px;
	font-family:Tahoma, Geneva, sans-serif; font-size:18px;}	
.form_box{  
	border:1px solid #c4c4c4; text-align:center; margin-top:6px; margin-bottom:15px;
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
#btn_signup{ 
	width:210px; margin-right:4px;
	background-color:#0C6; color:#FFF;}
.signup_form_box{ text-align:left; margin-left:20px;}
#form_year,#form_dept{ height:30px; width:333px;}
</style>

<script type="text/javascript" src="js/jquery.1.11.1.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
  $('#form_pwd_c').keyup(check_pwd);  
});

	function check_pwd()
	{
		var pwd = $("#form_pwd").val();
		var cpwd = $("#form_pwd_c").val();
				
		if(pwd!=cpwd)
		{
			$("#pwd_match").html("Password do not match");
			$("#pwd_match").css('color','#F00');
		}else{
			$("#pwd_match").html("Password Matched");
			$("#pwd_match").css('color','#3C0');
		}
		
		if($.trim(cpwd).length<1){$("#pwd_match").html(" ");}
	}

	function do_signup()
	{
		var name = $("#form_uname").val();
		var pwd = $("#form_pwd").val();
		var cpwd = $("#form_pwd_c").val();
		var roll = $("#form_roll").val();
		var dept = $("#form_dept").val();
		var year = $("#form_year").val()
		
		if(pwd!=cpwd)
		{
			$('#form_pwd').css('border-color','#C00');
			$('#form_pwd_c').css('border-color','#C00');
		}else{
		
		var dataString='sname='+name+'&spwd='+pwd+'&sroll='+roll+'&sdept='+dept+'&syear='+year;
		
if($.trim(name).length>0 && $.trim(pwd).length>0 && $.trim(roll).length>0 && $.trim(dept).length>0 && $.trim(year).length>0){
			
		  $.ajax({
						type: "POST",
						url: "signup_stud.php",
						dataType: "html",
						data: dataString,//"html",
						beforeSend: function(){$('#btn_signup').val('Connecting..');},
						cache: false,
						success:function(msg){
							if(parseInt(msg)!=0)
							{	
								//$("body").load("home.php").hide().fadeIn(1500).delay(6000);
								window.location.href="home.php";
							}
							else
							{	
								alert(msg);	
								$('#btn_login').val('Signup');						
								$('#frgt_pwd').css('display','block');	
							}
						},
						error:function(){
							$('#btn_login').val('Signup');
							alert('Sorry Try Again!');
					}
		});//end of the ajax function
	  }//end of the trim if
	  else{ alert('Fillup The Form Correctly');}	
	}
}
</script>
</head>
<body>
	<header><txt style=" font-size:24px;">Jalpaiguri Govt. Engg. College</txt></header>
        <div style="position:absolute; top:3px; left:3px;">
    	<img src="image/jgec_logo.png" width="90" height="auto" />
    </div>
    <div class="signup_box" id="signup_box">
    	<p class="signup_hdr">signup</p>
    	<hr  style=" background-color:rgba(0,204,255,1); width:95%; height:3px; border:0; margin-bottom:30px; margin-top:10px;"/>
    	<div class="signup_panel" id="signup_panel">
        <form class="signup_form" id="signup_form">
        <div class="signup_form_box">
        	<br /> Name : 
            <input type="text" name="form_uname" class="form_box" id="form_uname" style="margin-left:88px;"
            placeholder="Student Name" required="required" />
            <br />
            Roll Number : 
            <input type="text" name="form_roll" class="form_box" id="form_roll" style="margin-left:40px;"
            placeholder="University Roll Number" required="required" />
            <br />
            <mm style="margin-right:45px;">Department : </mm>
            
            <select id="form_dept" class="form_box" name="form_dept">
            <option selected="selected" disabled="disabled" value="">Please select your Department</option>
            <option value="IT">Information Technology</option>
            <option value="CSE">Computer Science Engg.</option>
            <option value="CE">Civil Engineering</option>
            <option value="ECE">Electronics & Communication Engg.</option>
            <option value="ME">Mechanical Engineering</option>
            <option value="EE">Electrical Engineering</option>
            </select>
            
            
            <br />
            Password : 
            <input type="password" name="form_pwd" class="form_box" id="form_pwd" style="margin-left:60px;"
            placeholder="Create Password" required="required" />
            <br />
            Confirm Password : 
            <input type="password" name="form_pwd_c" class="form_box" id="form_pwd_c" 
            placeholder="Confirm Password" required="required" />
            <br />
            <mm style="margin-right:95px;">Year :</mm> 
            <select id="form_year" class="form_box" name="year">
            <option selected="selected" disabled="disabled" value="">Please select your year &nbsp;&nbsp;&nbsp;&nbsp;</option>
            <option value="Undergraduate_1st_year">Undergraduate 1st year</option>
            <option value="Undergraduate_2nd_year">Undergraduate 2nd year</option>
            <option value="Undergraduate_3rd_year">Undergraduate 3rd year</option>
            <option value="Undergraduate_4th_year">Undergraduate 4th year</option>
            </select>
            </div>
            <input type="button" value="signup" class="Button" id="btn_signup" onclick="do_signup();" name="btn_signup" />
            <br />
            <div id="pwd_match" style="margin-top:30px;" class="pwd_match"></div>
        </form>
        </div>
    </div>
    
	<footer><h5>2015-16 | powered by JGEC-IT | All Rights Reserved</h5></footer>
</body>
</html>