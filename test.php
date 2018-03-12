<?php
	include("session-info.php");
	include("db.php");
	$userid= $_SESSION['login_user'];
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


</style>

<script type="text/javascript" src="js/jquery.1.11.1.min.js"></script>
<script type="text/javascript">
	var ans;
	var cnt=0;
</script>
</head>
<?php
	
	
	$mx_res=mysql_query("SELECT PR_Id FROM primary_result where PR_Stud_Id = '$userid' ORDER BY PR_Id DESC LIMIT 1;",$con);						
	$row = mysql_fetch_array($mx_res);
	$_SESSION['last_test']=$row['PR_Id'];
	echo $_SESSION['last_test']."<br><br>";
	
	
	
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
    <div id="log_container" class="log_container">
    <img src="image/user.png" width="30px" height="auto" style="margin-right:10px; float:left;" />
	<mno style="float:left; margin-top:4px;"><?php echo $_SESSION['User_name'];?></mno>
    <!--
        <ul class="menu">
            <li><a style="float:right;" class="logout" href="#">
                <img src="image/gear.png" width="30px" height="auto"  /></a></li>
            
               
                <ul>
                    <li><a href="#">Change Password</a></li>
                    <li><a href="#">My Result</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
        </ul>
        
        -->
    <a style="float:right;" class="logout" href="logout.php">
        <img src="image/gear.png" width="30px" height="auto"  />
    </a>
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
			var op1 = document.getElementById('text_option_a').value;
			var op2 = document.getElementById('text_option_b').value;
			var op3 = document.getElementById('text_option_c').value;
			var op4 = document.getElementById('text_option_d').value;
			
			if(ans == op1)
			{
				document.getElementById('text_option_a_'+cnt).style.backgroundColor="green";
			}
			if(ans == op2)
			{
				document.getElementById('text_option_a_'+cnt).style.backgroundColor="green";
			}
			
			if(ans == op3)
			{
				document.getElementById('text_option_a_'+cnt).style.backgroundColor="green";
			}
			
			if(ans == op4)
			{
				document.getElementById('text_option_a_'+cnt).style.backgroundColor="green";
			}
			
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
             <td id="text_option_a_<?php echo $i;?>">
                <input type="text" name="text_option_<?php echo $i;?>" hidden="hidden" id="text_option_a"
                 value="A" />
                a)&nbsp <?php echo $op1; ?>
             </td>
             <td id="text_option_b_<?php echo $i;?>"> 
				<input type="text" name="text_option_<?php echo $i;?>" hidden="hidden" id="text_option_b"
                 value="B" />
                b)&nbsp <?php echo $op2; ?> 
             </td>
           </tr>
           <tr>
             <td id="text_option_c_<?php echo $i;?>">
				<input type="text" name="text_option_<?php echo $i;?>" hidden="hidden" id="text_option_c"
                 value="C" />
                c)&nbsp <?php echo $op3; ?>
             </td>
             <td id="text_option_d_<?php echo $i;?>">
				<input type="text" name="text_option_<?php echo $i;?>" hidden="hidden" id="text_option_d"
                 value="D" />
                d)&nbsp <?php echo $op4; ?> 
             </td>
             </tr>             
          </table>
	
		<?php
		$i++;
	}	
?>
</div>
    </div>    
	<footer><h5>2015-16 | powered by JGEC-IT | All Rights Reserved</h5></footer>
</body>
</html>