<?php
include("db.php");
include("session-info.php");
if(empty($_SESSION['admin_username']))
{
	header('location: Admin.php');	
}

if(isset($_POST['del_qstn_next'])){
		
		$qstnid=$_REQUEST['qstnid'];
		$sql_qstn_delete="delete from question where Qstn_Id='$qstnid'";
		if (!mysql_query($sql_qstn_delete,$con)){
		//echo "error";
		}else{//success
		header('location: see_qstns.php');
		}		
}

if(isset($_POST['edit_qstn_next']) && isset($_REQUEST['qstnid'])){
	$qstnid=$_REQUEST['qstnid'];
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
	width:650px; height:360px; padding-top:20px;
	border:1px solid rgba(153,153,153,0.7); background-color:rgba(153,153,153,0.4);
	box-shadow:0 0 10px rgba(153,153,153,0.3);
	margin:0 auto;}
.box_header{color:rgba(0,204,255,1); 
	margin-top:10px; font-size:18px;}

.test_paper{  
	border:1px solid #c4c4c4; text-align:center; margin-top:6px;
	margin-left:16px; margin-bottom:9px;
	width:570px; height:25px;
	cursor:pointer;
	font-family:"Comic Sans MS", cursive;
	background-color:#FFF;
	letter-spacing:1px;
	text-shadow:0px 1px 1px rgba(250,106,99,1);
	font-size:16px; padding:4px 4px 4px 4px; border-radius:4px;
	-moz-border-radius:4px; -webkit-border-radius:4px; box-shadow:0px 0px 8px #d9d9d9;
	-moz-box-shadow:0px 0px 8px #d9d9d9; -webkit-box-shadow:0px 0px 8px #d9d9d9;}
.test_paper_txt{  
	border:1px solid #c4c4c4; text-align:center; margin-top:6px;
	margin-left:16px; margin-bottom:9px;
	width:570px; height:60px;
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
.test_paper_txt:hover{ 
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
.qstn_box_txt{
	padding-left:5px;
	height:45px;
	width:565px;
	}	
#qstn_NM{
	margin-top:-8px;
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
    
<?php
	$query_qstn_edit  = mysql_query("SELECT * FROM question WHERE Qstn_Id = '$qstnid'  "); 
    $num_rows_qstn_edit  = mysql_num_rows($query_qstn_edit); // Get the number of rows
    if($num_rows_qstn_edit <= 0){ // If no users exist with posted credentials print 0 like below.
        echo 1;
    } else {
        $fetch_test_edit = mysql_fetch_array($query_qstn_edit);
    }	
?>    
    	<p class="box_header" id="box_header">Edit Question No.<?php echo $fetch_test_edit['Qstn_Id']; ?> </p>
        <hr  style=" background-color:rgba(0,204,255,1); width:95%; height:2px; border:0; margin-bottom:20px; margin-top:10px;"/>
        <div class="xam_panel" id="xam_panel">        
        
        <form id="set_test_paper" action="add_question.php" method="post" style="margin:20px;">
        
        <input name="qsn_id" type="hidden" value="<?php echo $fetch_test_edit['Qstn_Id']; ?>" />
        <?php
		$query_test_type  = mysql_query("SELECT * FROM question_type"); 
		$num_rows_test_type  = mysql_num_rows($query_test_type); // Get the number of rows
		?>
        <div class="test_paper">Question Type:
        			<?php
                      if($num_rows_test_type <= 0){
					 ?>	  
						<a href='insert_qtype.php' style="color:rgba(255,0,0,1)">No Types Found !! Insert New Type....</a>
                      <?php
					  }else {
					  ?>
        			  <select name="qstn_type" >
                      <option  value='-1'  disabled="disabled" >--select type--</option>
					  <?php
					  while($list_q = mysql_fetch_assoc($query_test_type)){
					  ?>
                      <option name="<?php echo $list_q['type_Name'] ?>"  value="<?php echo $list_q['type_Name'] ?>"
								   <?php if($list_q['type_Name']==$fetch_test_edit['Qstn_Type']){ ?>selected="selected"<?php } ?>>
                                   <?php echo $list_q['type_Name'] ?></option>
                      <?php } ?>
                       </select>
                      <?php } ?>
        </div>
		<div class="test_paper_txt"><div id="qstn_NM">Question:</div><textarea class="qstn_box_txt"
         name="qstn_qstn" rows="3" cols="79" 
         placeholder="Enter The Question" style="resize:none" required="required"><?php echo $fetch_test_edit['Qstn_Qstn']; ?></textarea></div>
		<div class="test_paper">
        Option A:<input name="optn_1" type="text" 
        	value="<?php echo $fetch_test_edit['Qstn_Op1']; ?>" required="required"/>
        Option B:<input name="optn_2" type="text"
        	value="<?php echo $fetch_test_edit['Qstn_Op2']; ?>" required="required"/></div>
        <div class="test_paper">
        Option C:<input name="optn_3" type="text" 
        	value="<?php echo $fetch_test_edit['Qstn_Op3']; ?>" required="required"/>
        Option D:<input name="optn_4" type="text" 
        	value="<?php echo $fetch_test_edit['Qstn_Op4']; ?>" required="required"/></div>
        <div class="test_paper">
        right answer: <select name="right_ans" >
                 <option  value='-1' disabled="disabled" >--select answer--</option>
                 <option name="right_A_<?php echo $qstnid?>"  value="A" <?php if($fetch_test_edit['Qstn_Ans']=='A')
					  { ?>selected="selected"<?php }?>>A</option>
                 <option name="right_B_<?php echo $qstnid?>"  value="B" <?php if($fetch_test_edit['Qstn_Ans']=='B')
					  { ?>selected="selected"<?php }?>>B</option>
                 <option name="right_C_<?php echo $qstnid?>"  value="C" <?php if($fetch_test_edit['Qstn_Ans']=='C')
					  { ?>selected="selected"<?php }?>>C</option>
                 <option name="right_D_<?php echo $qstnid?>"  value="D" <?php if($fetch_test_edit['Qstn_Ans']=='D')
					  { ?>selected="selected"<?php }?>>D</option>
                      </select>
        </div>   
		<input type="button" class="btn" value="BACK" onclick="location.href='see_qstns.php'"/>
		<input type="submit" class="btn" name="edit_qstn_submit"
        	<?php if($num_rows_test_type <= 0){?> disabled="disabled"<?php } ?> value="OK" />
		</form>
        
        </div>
    </div>
    
	<footer><h5>2015-16 | powered by JGEC-IT | All Rights Reserved</h5></footer>
</body>
</html>
<?php 
}
?>
