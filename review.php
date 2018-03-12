<?php
	include("session-info.php");
	include("db.php");
	if(empty($_SESSION['login_user']))
{
	header('location: index.php');	
}
	$userid= $_SESSION['login_user'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Review Question Answer</title>
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

.side{
	border:1px dashed #0066CC;
	position:absolute;
	width:215px;
	height:250px;
	top:230px; left:10px;
	background-color:rgba(204,204,204,0.3);}


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
<?php
	
	if(isset($_GET['test_id']))
	{
		$prid=$_GET['id'];
		$_SESSION['last_test']=$prid;
		$_SESSION['test_id']=$_GET['test_id'];
		$_SESSION['test_duration']=$_GET['tduration'];
		$_SESSION['test_name']=$_GET['tname'];
		$_SESSION['test_qstn']=$_GET['tno'];

	}
	else{
	$mx_res=mysql_query("SELECT PR_Id FROM primary_result where PR_Stud_Id = '$userid' ORDER BY PR_Id DESC LIMIT 1;",$con);						
	$row = mysql_fetch_array($mx_res);
	$_SESSION['last_test']=$row['PR_Id'];
	//echo $_SESSION['last_test']."<br><br>";
	}
	
	
	$test_id=$_SESSION['test_id'];
	$userid=$_SESSION['login_user'];
	if(!empty($_SESSION['last_test']))
	{		
		$last_test=$_SESSION['last_test'];
		unset($_SESSION['last_test']);
	}
	
	//sql for selecting only those question that are appered to the student
	$sql_review="select * from primary_result where PR_Test_Id = '$test_id' and PR_Stud_Id = '$userid' and PR_Id = '$last_test'";
	$res_1=mysql_query($sql_review,$con);
	$row = mysql_fetch_array($res_1);
	$right=$row['PR_Right'];
	$wrong=$row['PR_Wrong'];
	$serialize_id=$row['serial_id'];
	$date=$row['PR_Time'];

	//echo $right." ".$wrong." ".$date." ".$serialize_id." <br><br>";
	
	
	$sql_serial="select data from serialize_result where id = '$serialize_id'";
	$res_2=mysql_query($sql_serial,$con);
	$row = mysql_fetch_array($res_2);
	$data = $row['data'];
	//echo $data." <br>";
	
	
	$ch=unserialize($data);
	$no_q=$_SESSION['test_qstn'];
	//echo $no_q."<br>" ;
	?>
    
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
    
    <?php
	$i=0;
	while($i<$no_q)
	{
		if(array_key_exists($i,$ch))
		{
				$a=$ch[$i][0]; //test id
				$b=$ch[$i][1]; //question id
				$c=$ch[$i][2]; //answer given	
	
		}//end of the if block
		
		//echo "<br>".$a." ".$b." ".$c." <br><br><br>";
		
		$sql_show="select * from question where Qstn_Id = '$b'";
		$res_3= mysql_query($sql_show,$con);
		$row = mysql_fetch_array($res_3);
		$qstn=$row['Qstn_Qstn'];
		$op1=$row['Qstn_Op1'];
		$op2=$row['Qstn_Op2'];
		$op3=$row['Qstn_Op3'];
		$op4=$row['Qstn_Op4'];
		$op_ans=$row['Qstn_Ans'];		
		//echo $qstn."<br>".$op1."<br>".$op2."<br>".$op3."<br>".$op4."<br>".$op_ans=$row['Qstn_Ans'];
		?>
		<script type="text/javascript">
        	ans=<?php echo $op_ans;?>
			cnt++:
        </script>
		<table width="100%">
              <tr>
                <th>
                	<?php 	echo "<b>".($i+1).". </b> : ".$qstn ?>
                </th>
              </tr>     
         </table>
         <table width="100%">
           <tr>
             <td id="text_option_A_<?php echo $i;?>">
                <input type="text" name="text_option_<?php echo $i;?>" hidden="hidden" id="text_option_a"
                 value="A" />
                a)&nbsp <?php echo $op1; ?>
             </td>
             <td id="text_option_B_<?php echo $i;?>"> 
				<input type="text" name="text_option_<?php echo $i;?>" hidden="hidden" id="text_option_b"
                 value="B" />
                b)&nbsp <?php echo $op2; ?> 
             </td>
           </tr>
           <tr>
             <td id="text_option_C_<?php echo $i;?>">
				<input type="text" name="text_option_<?php echo $i;?>" hidden="hidden" id="text_option_c"
                 value="C" />
                c)&nbsp <?php echo $op3; ?>
             </td>
             <td id="text_option_D_<?php echo $i;?>">
				<input type="text" name="text_option_<?php echo $i;?>" hidden="hidden" id="text_option_d"
                 value="D" />
                d)&nbsp <?php echo $op4; ?> 
             </td>
             </tr>             
          </table>
		<script type="text/javascript">
			document.getElementById('text_option_<?php echo $op_ans."_".$i;?>').style.backgroundColor="rgba(46,233,138,0.6)";
			document.getElementById('text_option_<?php echo $c."_".$i;?>').style.border="2px solid rgba(199,27,34,0.6)";
        </script>
		<?php
		$i++;	
	   }	
	?>
		</div>
<div style="width:100px; height:100px;"></div>
</div>


    <div class="side">
    	<p style="margin:5px;">All the green boxes are the right answers of their respective questions.</p>
        <p style="margin:5px;">Red bordered boxes are the given answers.The unanswered question have no border.</p>
        <div style="width:98%; height:100px; margin:5px; border-top:1px dashed #06C; ">
        	<p style="margin-top:10px;">
            Right Answer : <?php echo $right;?><br>
            wrong Answer : <?php echo $wrong;?><br>
            Unanswered Question : <?php echo $no_q-($wrong+$right);?><br>
            Duration : <?php echo $_SESSION['test_duration']." mins";?></p>
        </div>
 <input type="button" value="Back" onclick="window.location.href='stud_result.php';" id="back_button" class="back_button" /> 
</div><br><br><br><br>
    <footer><h5>2015-16 | powered by JGEC-IT | All Rights Reserved</h5></footer>
</body>
</html>