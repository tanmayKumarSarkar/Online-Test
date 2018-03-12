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
<title>Admin-Result</title>
<meta http-equiv="Content-Type" content="text/html; "/>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width,initial-scale=1.0" />
<link href="style/reset.css" rel="stylesheet" type="text/css" />
<link href="style/loader.css" rel="stylesheet" type="text/css" />
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
	position:fixed;
	bottom:0px; border-top:1px solid #006;
	left:0px; padding-top:5px;}
.login_box{ 
	width:900px; height:500px; 
	position:absolute; top:50%; left:50%;
	margin-left:-450px; margin-top:-250px;
	text-align:center;
	margin-bottom:100px;
	}	
.log_container{ 
	position:absolute; top:10px; right:10px;
	width:300px; height:50px; 
	color:#fff; text-align:center;}
	

.xam_panel{ 
	width:890px; height:auto;
	border:1px solid rgba(153,153,153,0.7); background-color:rgba(153,153,153,0.4);
	box-shadow:0 0 10px rgba(153,153,153,0.3);
	margin:0 auto; text-align:left;
	padding-bottom:20px;
	}
table {
  border-collapse: collapse;
  border: 1px solid #eee;
  border-bottom: 2px solid #00cccc;  
  height:auto;	 
}
table td{color:#fff; font-size:13px;}
table td:hover {
  background: #f4f4f7;
  color:#000;
}
table tr:hover td {
  color: #555;
  
}
table th, table td {
  color: #333;
  border: 1px solid #eee;
  padding: 12px 30px;
  border-collapse: collapse;
}
table th {
  background: #00cccc;
  color: #fff;
  font-size: 14.5px;
}
table th.last {
  border-right: none;
}

.back_button{
	height:30px; color:#fff;
	background-color:#0CF; border:1px solid #FF9; 
	cursor:pointer; font-size:16px;
	margin-top:10px; margin-left:10px;
}

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

.side{
	border:1px dashed #0066CC;
	padding-top:30px;
	position:absolute;
	width:215px;
	height:170px;
	top:230px; left:10px;
	background-color:rgba(204,204,204,0.3);
	text-align:center;}
.form_dept{ width:210px; height:30px;
	border:1px solid #c4c4c4; text-align:center; 
	margin-top:6px; margin-bottom:15px;
	font-size:15px; padding:4px 4px 4px 4px; border-radius:4px;
	-moz-border-radius:4px; -webkit-border-radius:4px; box-shadow:0px 0px 8px #d9d9d9;
	-moz-box-shadow:0px 0px 8px #d9d9d9; -webkit-box-shadow:0px 0px 8px #d9d9d9;}
.form_dept:focus{ 
	outline:none; border:1px solid #7bc1f7;box-shadow:0px 0px 8px #7bc1f7;
	-moz-box-shadow:0px 0px 8px #7bc1f7; -webkit-box-shadow:0px 0px 8px #7bc1f7;}

 
</style>

<script type="text/javascript" src="js/jquery.1.11.1.min.js"></script>
<script type="text/javascript">
var dept='alldept';
var paper='allpaper';
call_ajax();
	function getIPL(id)
	{
		paper=id;	
		call_ajax();	
	}
	function getdept(id)
	{
		dept=id;
		call_ajax();
	}
	function call_ajax()
	{
		datastring = "dept="+dept+"&paper="+paper;
		$.ajax({
			type:'GET',
			dataType: "html",
			url:"result_gen.php",
			cache: false,
			data:datastring,
			beforeSend: function(){$('#spinner').show();},
			success: function(msg)
				{
				if(parseInt(msg)!=0)
							{	//success
								$('#xam_panel').html(msg);
							}
							else if(msg==0)
							{
								$('#error_msg').css('display','block');	
							}
						},
						error:function(){
							$('#error_msg').css('display','block');
					}
			})	
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
    <div class="login_box" id="login_box">
    	
    	<mmm class="box_header" id="box_header">
			Showing Result
        </mmm>
        <hr style=" background-color:rgba(0,204,255,1); width:95%; height:3px; border:0; margin-bottom:30px; margin-top:10px;"/>
        <div class="xam_panel" id="xam_panel">
        
        <div id="spinner" style=" width:400px; height:150px; position:absolute; 
            left:50%; top:50%; margin-left:-10px; margin-top:-75px; ">
				<div id="floatingBarsG">
                    <div class="blockG" id="rotateG_01">
                    </div>
                    <div class="blockG" id="rotateG_02">
                    </div>
                    <div class="blockG" id="rotateG_03">
                    </div>
                    <div class="blockG" id="rotateG_04">
                    </div>
                    <div class="blockG" id="rotateG_05">
                    </div>
                    <div class="blockG" id="rotateG_06">
                    </div>
                    <div class="blockG" id="rotateG_07">
                    </div>
                    <div class="blockG" id="rotateG_08">
                    </div>
                </div> 
        </div>

			<div id="error_msg" style=" display:none; text-align:center;width:300px; height:150px; position:absolute; 
            left:50%; top:50%; margin-left:-150px; margin-top:-75px; border:2px dashed #039;">
                <br /><br /><br />Faided to load content <br />Please try again !!
            </div>	
        
        </div>
<div style="width:100px; height:100px;"></div>
</div>



 <div class="side">

		<?php
			$qery_testpaper  = mysql_query("SELECT * FROM testpaper"); 
			$num_rows_testpaper  = mysql_num_rows($qery_testpaper); // Get the number of rows
		?>
        <div class="test_paper">Question Type:<br />
        			<?php
                      if($num_rows_testpaper <= 0){
					  ?>	  
						<a href='insert_qtype.php' style="color:rgba(255,0,0,1)">No TestPaper Created.</a>
                   <?php
					  }else {
					  ?>
        			  <select class="form_dept" name="testpapers" onchange="getIPL(this.value)">
                      <option selected="selected" value="allpaper">Show for all Test Paper</option>
					  <?php
					  while($list_q = mysql_fetch_assoc($qery_testpaper)){
					  ?>
                      <option name="<?php echo $list_q['Test_Name'] ?>"  value="<?php echo $list_q['Test_Id'] ?>" >
                         <?php echo $list_q['Test_Name'] ?>
                      </option>
                      <?php } ?>
                       </select>
                   <?php } //end of the else block ?>
        </div>
        
        <div>Department : <br />
        	<select id="deptartment" onchange="getdept(this.value)" class="form_dept" name="form_dept">
            <option selected="selected" value="alldept">Search by Department</option>
            <option value="IT">Information Technology</option>
            <option value="CSE">Computer Science Engg.</option>
            <option value="CE">Civil Engineering</option>
            <option value="ECE">Electronics & Communication Engg.</option>
            <option value="ME">Mechanical Engineering</option>
            <option value="EE">Electrical Engineering</option>
            </select>
        </div>
        
        
</div>


 <input type="button" value="Back" onclick="window.location.href='home.php';" id="back_button" class="back_button" /> 
    <footer><h5>2015-16 | powered by JGEC-IT | All Rights Reserved</h5></footer>
</body>
</html>