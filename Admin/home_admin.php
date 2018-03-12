<?php
include("db.php");
include("session-info.php");
if(empty($_SESSION['admin_username']))
{
	header('location: Admin.php');	
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
	width:760px; height:500px; 
	position:absolute; top:50%; left:49%;
	margin-left:-400px; margin-top:-250px;
	text-align:center; border:1px dotted blue;
	}	
.log_container{ 
	position:absolute; top:10px; right:10px;
	width:300px; height:50px; 
	color:#fff; text-align:center;}
.xam_panel{ 
	width:600px; height:310px; padding-top:34px;
	border:1px solid rgba(153,153,153,0.7); background-color:rgba(153,153,153,0.4);
	box-shadow:0 0 10px rgba(153,153,153,0.3);
	margin:0 auto;}
		
.right_box{
	width:308px; height:380px; 
	position:absolute; top:50%; left:48%;
	font-family:"Comic Sans MS", cursive;
	font-size:16px;
	margin-left:387px; margin-top:-180px;
	text-align:center; border:1px dotted blue;
	}	
.rbx_panel{ 
	width:285px; height:225px; padding-top:10px;
	
	border:1px solid rgba(153,153,153,0.7); background-color:rgba(153,153,153,0.4);
	box-shadow:0 0 10px rgba(153,153,153,0.3);
	margin:0 auto;}

.box_header{color:rgba(0,204,255,1); 
	margin-top:30px; font-size:18px;}

.test_paper{  
	border:1px solid #c4c4c4; text-align:center; margin-top:6px; margin-bottom:9px;
	width:320px; height:40px;
	cursor:pointer;
	font-family:"Comic Sans MS", cursive;
	background-color:#FFF;
	letter-spacing:1px;
	text-shadow:0px 1px 1px rgba(250,106,99,1);
	font-size:16px; padding:4px 4px 4px 4px; border-radius:4px;
	-moz-border-radius:4px; -webkit-border-radius:4px; box-shadow:0px 0px 8px #d9d9d9;
	-moz-box-shadow:0px 0px 8px #d9d9d9; -webkit-box-shadow:0px 0px 8px #d9d9d9;}
.test_paper:hover{ 
	background-color:#F60; color:#FFF; border:2px solid #fff;
	text-shadow:2px 1px #6666CC;
	outline:none; border:1px solid #7bc1f7;box-shadow:0px 0px 8px #7bc1f7;
	-moz-box-shadow:0px 0px 8px #7bc1f7; -webkit-box-shadow:0px 0px 8px #7bc1f7;}
.button_start{
	outline:none; width:114px; 
	font-family:Tahoma, Geneva, sans-serif;
	height:32px;
	font-size:16px; padding:4px 4px 4px 4px; border-radius:4px;
	background-color:#F60; color:#FFF; border:2px solid #fff;}
	
.test_btn_edit{
	border:1px solid #c4c4c4; text-align:center; margin-top:6px; margin-bottom:9px;
	width:100px; height:35px;
	cursor:pointer;
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
<script type="text/javascript">

$(document).ready(function() {   

  $(document).on("change", "#test_paper", function() {
	
     alert('ok'); // this.value is enough for you
	  var selectedValue = $(this).val();
	  var m=$(this).find("option:selected").attr("value");
	  alert(m);
	  get_duration(m);
	  

  });
  
  
  
   // for pre-selection trigger
/*$("#test_paper").change(function () {
    var selectedValue = $(this).val();
    //$("#duration_o").val($(this).find("option:selected").attr("value"))
	var m=$(this).find("option:selected").attr("value");
	
});*/
var list;
function getQueryVariable(variable)
{
       var query = list;
	   alert("m:"+query);
       var vars = query.split("&");
       for (var i=0;i<vars.length;i++) {
               var pair = vars[i].split("=");
               if(pair[0] == variable){return pair[1];}
       }
       return(false);
}


function get_duration(id){ 
	var dataq="test_Id ="+id
	alert(dataq);
	
	$.ajax({	
               type: "GET",
               url: "get_duration.php",
               data: dataq,
               success: function(result){
				   //if(parseInt(result)!=0)
					//		{
					list="tym=10&qstn=90";
					alert(list);
					var p=getQueryVariable("tym");

					var q=getQueryVariable("qstn");
				    $("#duration_o").html("Duration : "+p);}
					
                // }
               });
			   
			   }
}); 

function Entr_No_Of_Qstn(){
	
	var no_Qstn = prompt("Enter No Of Questions","10");
	if(no_Qstn==null || !isInt(no_Qstn)){
		alert("You Must Enter A Integer Number");
	}else{
		location.href='add_question.php?qno='+no_Qstn;
	}
}

function isInt(val){
	
	var x;
	if(isNaN(val)){
		return false;
	}
	x = parseFloat(val);
	return (x | 0) === x;	
}

</script>
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
    	<div class="container">
    <div class="login_box" id="login_box">
    	<p class="box_header" id="box_header">Administrator Pannel</p>
        <hr  style=" background-color:rgba(0,204,255,1); width:95%; height:2px; border:0; margin-bottom:40px; margin-top:20px;"/>
        <div class="xam_panel" id="xam_panel">
        
        <input type="button" value="Insert New Questions" name="button_start" class="test_paper" id=""
        			onclick="Entr_No_Of_Qstn()" />
        </br>
        <input type="button" value="Add/Update Test Paper" name="button_start" class="test_paper" id=""
        			onclick="location.href='make_testpaper.php'" />
        </br>
        <input type="button" value="Show Questions" name="button_start" class="test_paper" id=""
        			onclick="location.href='see_qstns.php'" />
        </br>
        <input type="button" value="Add/Update Question Type" name="button_start" class="test_paper" id=""
        			onclick="location.href='insert_qtype.php'" />            
        </br>
        <input type="button" value="Show Results" name="button_start" class="test_paper" id="" />
        </div>
    </div>
    <div class="right_box">
    <p class="box_header" id="box_header">Recent Test Paper</p>
        <hr  style=" background-color:rgba(0,204,255,1); width:95%; height:2px; border:0; margin-bottom:35px; margin-top:20px;"/>
        <div class="rbx_panel" id="rbx_panel">
<?php
	$query_test  = mysql_query('SELECT * FROM testpaper WHERE Test_Id = (select MAX(Test_Id) from testpaper) '); 
    $num_rows_test  = mysql_num_rows($query_test); // Get the number of rows
    if($num_rows_test <= 0){ // If no users exist with posted credentials print 0 like below.
        
    } else {
        $fetch_test = mysql_fetch_array($query_test);
       
    }	
?>
        
        <table width="286" border="0" cellspacing="1" cellpadding="1">
  <tr>
    <td width="154" height="40" align="left">&nbsp;Test paper name</td>
    <td width="119" style="color:green;"><?php echo $fetch_test['Test_Name'] ?></td>
  </tr>
  <tr>
    <td width="154" height="40" align="left">&nbsp;Test paper type</td>
    <td width="119" style="color:green"><?php echo $fetch_test['type'] ?></td>
  </tr>
  <tr>
    <td height="40" align="left">&nbsp;Number of questions</td>
    <td style="color:green"><?php echo $fetch_test['Test_Qno'] ?></td>
  </tr>
  <tr>
    <td height="40" align="left">&nbsp;Test paper durarion</td>
    <td style="color:green"><?php echo $fetch_test['Test_Time']." " ?>min</td>
  </tr>
  <tr>
    <td height="40" align="center" colspan="2">
    	<input type="button" value="EDIT" name="button_start" class="test_btn_edit"
         onclick="location.href='edit_testpaper.php?tpid=<?php echo $fetch_test['Test_Id'] ?>'" /></td>
  </tr>
</table>

        </div>
    </div>
    
    	</div>
    
	<footer><h5>2015-16 | powered by JGEC-IT | All Rights Reserved</h5></footer>
</body>
</html>