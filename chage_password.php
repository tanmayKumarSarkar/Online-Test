<?php
include("session-info.php");
include("db.php");
if(empty($_SESSION['login_user']))
{
	header('location: index.php');	
}
else
{
	$userid=$_SESSION['login_user'];	
}
if(!empty($_SESSION['test_id']))
{
	unset($_SESSION['test_id']);
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
	text-align:center; border:1px dotted blue;
	}	
.log_container{ 
	position:absolute; top:10px; right:10px;
	width:300px; height:50px; 
	color:#fff; text-align:center;}
	

.xam_panel{ 
	width:600px; height:280px; padding-top:40px;
	border:1px solid rgba(153,153,153,0.7); background-color:rgba(153,153,153,0.4);
	box-shadow:0 0 10px rgba(153,153,153,0.3);
	margin:0 auto;}
.box_header{color:rgba(0,204,255,1); 
	margin-top:30px; font-size:18px;}
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
.form_box{  
	border:1px solid #c4c4c4; text-align:center; margin-top:6px; margin-bottom:15px;
	width:320px; height:20px;
	font-size:15px; padding:4px 4px 4px 4px; border-radius:4px;
	-moz-border-radius:4px; -webkit-border-radius:4px; box-shadow:0px 0px 8px #d9d9d9;
	-moz-box-shadow:0px 0px 8px #d9d9d9; -webkit-box-shadow:0px 0px 8px #d9d9d9;}
.form_box:focus{ 
	outline:none; border:1px solid #7bc1f7;box-shadow:0px 0px 8px #7bc1f7;
	-moz-box-shadow:0px 0px 8px #7bc1f7; -webkit-box-shadow:0px 0px 8px #7bc1f7;}	
.Button_change{
	outline:none; width:180px; cursor:pointer;
	font-family:Tahoma, Geneva, sans-serif;
	height:32px;
	font-size:16px; padding:4px 4px 4px 4px; border-radius:4px;
	background-color:#F60; color:#FFF;}  
</style>
<script type="text/javascript" src="js/jquery.1.11.1.min.js"></script>
<script type="text/javascript">

		
$(document).ready(function() {
	//alert();
  $('#form_pwd_c').keyup(check_pwd);  
});	

function check_pwd()
	{		var pwd = $("#form_pwd").val();
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
	
	
	function change_pass()
	{
		
		var pwd = $("#form_pwd").val();
		var current_pass = $("#current_pass").val();
		var cpwd = $("#form_pwd_c").val();
		if($.trim(cpwd).length>0 && $.trim(pwd).length>0 && $.trim(current_pass).length>0){
		
		if(pwd!=cpwd)
		{
			$('#form_pwd').css('border-color','#C00');
			$('#form_pwd_c').css('border-color','#C00');
		}else{
				
				var dataString="pwd="+cpwd+"&curr_pwd="+current_pass;
				$.ajax({
						type: "GET",
						url: "change_pass_function.php",
						dataType: "html",
						data: dataString,//"html",
						beforeSend: function(){$('#Button_change').val('Connecting..');},
						cache: false,
						success:function(msg){
							if(parseInt(msg)!=0)
							{	
								alert('Password Changed Successfully');
								$('#Button_change').val('Change');
							}
							else
							{	
								alert(msg);	
								$('#Button_change').val('Change');	
							}
						},
						error:function(){
							$('#btn_login').val('Signup');
							alert('Sorry Try Again!');
					}
		});//end of the ajax function
	
	   }
	}else{ alert("Fillup The Form Correctly");}
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
   <!--drop down menu-->
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
       <p class="box_header" id="box_header">Change Password</p>
       <hr  style=" background-color:rgba(0,204,255,1); width:95%; height:3px; border:0; margin-bottom:30px; margin-top:10px;"/>
       <div class="xam_panel" id="xam_panel">
       	<form>
         Current Password : <input style="margin-left:18px;" type="password" name="curr_pwd" id="current_pass" class="form_box" placeholder="Current Password" /><br />
         Typw New Password : <input type="password" name="form_pwd" id="form_pwd" class="form_box" placeholder="Typw New Password" /><br />
         Confirm Password : <input style="margin-left:18px;" type="password" name="form_pwd_c" id="form_pwd_c" class="form_box" placeholder="Confirm Password" /><br />
         <input type="button" value="Change" onclick="change_pass();" name="Button_change" class="Button_change" id="Button_change" />
         <br />
        <div id="pwd_match" name="pwd_match" style="text-align:center; display:block; margin-top:15px;"></div>
        </form>   
       </div>
    </div>
    
	<footer><h5>2015-16 | powered by JGEC-IT | All Rights Reserved</h5></footer>
</body>
</html>