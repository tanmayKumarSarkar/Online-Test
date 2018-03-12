<?php
include("session-info.php");
include("db.php");
if(empty($_SESSION['login_user']))
{
	header('location: index.php');	
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

.test_paper{  
	border:1px solid #c4c4c4; text-align:center; margin-top:6px; margin-bottom:9px;
	width:320px; height:40px;
	font-size:15px; padding:4px 4px 4px 4px; border-radius:4px;
	-moz-border-radius:4px; -webkit-border-radius:4px; box-shadow:0px 0px 8px #d9d9d9;
	-moz-box-shadow:0px 0px 8px #d9d9d9; -webkit-box-shadow:0px 0px 8px #d9d9d9;}
.test_paper:focus{ 
	outline:none; border:1px solid #7bc1f7;box-shadow:0px 0px 8px #7bc1f7;
	-moz-box-shadow:0px 0px 8px #7bc1f7; -webkit-box-shadow:0px 0px 8px #7bc1f7;}
.button_start{
	outline:none; width:114px; cursor:pointer;
	font-family:Tahoma, Geneva, sans-serif;
	height:34px;
	font-size:16px; padding:4px 4px 4px 4px; border-radius:4px;
	background-color:#F60; color:#FFF; border:2px double #fff;}
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
var test_ID=0;
$(document).ready(function() {   

  $(document).on("change", "#test_paper", function() {
	  var selectedValue = $(this).val();
	  var m=$(this).find("option:selected").attr("value");
	  get_duration(m);
  });

var list;
function getQueryVariable(variable)
{
       var vars = list.split("&");
       for (var i=0;i<vars.length;i++) {
          var pair = vars[i].split("=");
          if(pair[0] == variable){return pair[1];}
       }
       return(false);
}


function get_duration(id)
	{ 
		var dataq="Test_Id_local="+id;
		test_ID=id;
		$.ajax({	
				   type: "POST",
				   url: "get_duration.php",
				   data: dataq,
				   success: function(result){
					   if(parseInt(result)!=0)
							{
						list=result;
						var p=getQueryVariable("tym");
						var q=getQueryVariable("qstn");
						$("#duration_o").val("Duration : "+p+" Minutes");
						$("#qstn_no").val("No of Questions : "+q+" ");}
						else{ alert('Please Try again');}
						    }
			   });   			   
	}
}); 


function start_xam()
{	
	if(test_ID==0)//nothing is selected
	{
		alert('Plase Select a Exam First');
	}
	else//all good
	{
		 window.location.assign("start_exam.php");
		 
	}	
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
    	<p class="box_header" id="box_header">Select Test</p>
        <hr  style=" background-color:rgba(0,204,255,1); width:95%; height:3px; border:0; margin-bottom:30px; margin-top:10px;"/>
        <div class="xam_panel" id="xam_panel">
        		<?php
				
				$query = "SELECT Test_Name,Test_Id FROM testpaper ";
				$result = mysql_query($query) or die(mysql_error()."[".$query."]");
				?>
				
				<select id="test_paper" class="test_paper" name="test_paper">
                <option selected="selected" disabled="disabled" value="">Please select a TEST Paper</option>
				<?php 
				while ($row = mysql_fetch_array($result))
				{
					echo "<option value='".$row['Test_Id']."'>".$row['Test_Name']."</option>";
				}
				?>        
				</select>
                 
				
                <br />
                <input type="text" value="Duration : " disabled="disabled" name="duration_o" class="test_paper" id="duration_o"/>
                <br />
               <input type="text" value="No of Questions : " disabled="disabled" name="qstn_no" class="test_paper" id="qstn_no"/>
                <br /><br />
                <input type="button" value="Start Exam" name="button_start" onclick="start_xam();" class="button_start" id="button_start" />
        </div>
    </div>
    
	<footer><h5>2015-16 | powered by JGEC-IT | All Rights Reserved</h5></footer>
</body>
</html>