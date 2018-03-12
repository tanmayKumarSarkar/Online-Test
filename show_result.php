<?php
//error_reporting(0);
include("session-info.php");
include("db.php");
if(empty($_SESSION['login_user']))
{
	header('location: index.php');	
}
if(empty($_SESSION['test_id']))
{
	header('location: home.php');	
}
if(!isset($_POST['hiditem_1']))
{
	header('location: home.php');	
}

$_SESSION['submitted']='set';
$userid=$_SESSION['login_user'];
$cnt=$_SESSION['counter'];
$no_q=$_SESSION['test_qstn'];
$no=1;
$right=0;
$wrong=0;
$unanswered=0;
$test_id=$_SESSION['test_id'];
$stud_roll=$_SESSION['login_user'];
$arr[$no_q][3];
while($no<=$cnt)
{
	$q_id=$_POST['hiditem_'.$no];
	if(!empty($_POST['radio_option_'.$no])){$q_ans=$_POST['radio_option_'.$no];}
	else{$q_ans=false;}
	if($q_ans!=false)
	{
		$sql_2="select Qstn_Ans from question where Qstn_Id='$q_id'";
		$res = mysql_query($sql_2);
		$row = mysql_fetch_array($res);
		if($row['Qstn_Ans']==$q_ans){$right++;}
		else{$wrong++;}
		
	}else
	{
		$unanswered++;
	}
			//storing ans in array	
			$arr[$no-1][0]=$_SESSION['test_id'];
			$arr[$no-1][1]=$q_id;
			$arr[$no-1][2]=$q_ans;
			$no++;//incrimenting counter
		}
		
		$newstring=serialize($arr); //serializing array to a string
		$score=($right/$cnt)*100; //generating code

	if(empty($_SESSION['data_stored']) || $_SESSION['data_stored']=='false')
	{//for one time use only
			$sql_3="INSERT INTO `serialize_result`( `data`) VALUES ('$newstring')";
			if (!mysql_query($sql_3,$con)){$_SESSION['data_stored']='false';}
			else
			{		
				$mx_res=mysql_query('SELECT id FROM serialize_result ORDER BY id DESC LIMIT 1;',$con);						
				$row = mysql_fetch_array($mx_res);
				$mx=$row['id'];
					//after getting the maximum id from primary_result table					
				$sql_1="INSERT INTO `primary_result`( `PR_Stud_Id`, `PR_Test_Id`, `PR_Time`, `PR_Right`, `PR_Wrong` , `serial_id`) VALUES ('$stud_roll','$test_id',now(),'$right','$wrong','$mx')";
				if (!mysql_query($sql_1,$con))
				{$_SESSION['data_stored']='false';}
				else{ $_SESSION['data_stored']='true';	 }//success		
				
			}
	}
	
	$mx_res=mysql_query("SELECT PR_Id FROM primary_result where PR_Stud_Id = '$userid' ORDER BY PR_Id DESC LIMIT 1;",$con);						
	$row = mysql_fetch_array($mx_res);
	$_SESSION['last_test']=$row['PR_Id'];
	echo $_SESSION['last_test'];		
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo $_SESSION['test_name'];?></title>
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
	width:600px; height:300px;
	border:1px solid #00cccc; background-color:rgba(153,153,153,0.1);
	box-shadow:0 0 10px rgba(0,0,0,0.3);
	margin:0 auto; text-align:center;
	padding-bottom:20px;}
.button_review{ 
	width:250px; height:30px;
 	border:2px solid #00cccc; background-color:#fff;
	cursor:pointer;
	margin-top:35px;}
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
    	
    	<mmm class="box_header" id="box_header">
			<?php echo $_SESSION['test_name'];?>
        </mmm>
        <hr  style=" background-color:rgba(0,204,255,1); width:95%; height:3px; border:0; margin-bottom:30px; margin-top:10px;"/>
        <div class="xam_panel" id="xam_panel">
        <div style="width:100%; height:30px; background-color:rgba(0,204,255,0.5); padding-top:8px; margin-top:4px;
         border-top:1px dashed rgba(0,153,255,1); color:#fff;
         border-bottom:1px dashed rgba(0,153,255,1);">
        Marks : <?php echo $right;?>/<?php echo $cnt;?></div>
			<div style=" margin:10px; text-align:left; line-height:25px; margin-left:25%; margin-top:40px;">
            Total number of Questions : <?php echo $cnt;?><br />
            Number of Right Answer : <?php echo $right;?><br />
            Number of Wrong Answer : <?php echo $wrong;?><br />
            Number of Unanswered Questions : <?php echo $unanswered;?><br />
            Total Score in Percentile : <?php echo $score;?> %<br />

            </div>
            <input type="button" id="button_review" class="button_review" name="button_review" onclick="window.location.href='review.php';" value="Review Question and Answered" />
            
        </div>
    </div>
    
	<footer><h5>2015-16 | powered by JGEC-IT | All Rights Reserved</h5></footer>
</body>
</html>