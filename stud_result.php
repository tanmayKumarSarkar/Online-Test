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
	text-align:center;
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

.view_btn{
	height:30px; color:#fff;
	background-color:#0CF; border:1px solid #FF9; 
	cursor:pointer; font-size:16px;
}

.view_btn:hover{ 
	background-color:#0CF; outline:none;
 	border:1px solid #009;}
	
	
	

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
	//document.getElementById('#actions').onclick
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
			My Result
        </mmm>
       <hr  style=" background-color:rgba(0,204,255,1); width:95%; height:3px; border:0; margin-bottom:30px; margin-top:10px;"/>
       <div class="xam_panel" id="xam_panel">
        
   	<table width="100%;">
    	<tr>
        	<th>Test Name</th>
            <th>Test Type</th>
        	<th>Date</th>
            <th>Marks</th>
            <th>view</th>
        </tr>
  
	<?php
	$testcnt=0;
	$sql="select * from primary_result where PR_Stud_Id = '$userid'";
	$res = mysql_query($sql);
	while($row = mysql_fetch_array($res))
	{
		$prid = $row['PR_Id'];
		$testid = $row['PR_Test_Id'];
		$testdate = $row['PR_Time'];
		$testright = $row['PR_Right'];
		$testwrong = $row['PR_Wrong'];
		$testserialid = $row['serial_id'];		
		
		$sql2="select * from testpaper where Test_Id = '$testid'";
		$res2 = mysql_query($sql2);
		$row2 = mysql_fetch_array($res2);
		
		$testduration = $row2['Test_Time'];
		$testtotalqstn = $row2['Test_Qno'];
		$testtype = $row2['type'];
		$testname = $row2['Test_Name'];
		
		?>
		
			<tr>          
            <?php
            	$link="review.php?id=".$prid."&test_id=".$testid."&tname=".$testname."&tduration=".$testduration."&tno=".$testtotalqstn;
			?>
        	<td><?php echo $testname;?></td>
            <td><?php echo $testtype;?></td>
            <td><?php echo $testdate;?></td>
            <td><?php echo $testright."/".$testtotalqstn;?></td>
            <td><input type="button" value="view" class="view_btn" onclick="window.location.href='<?php echo $link?>';"
             id="view_btn" namae="view_btn"/></td>
        	
        </tr>
   
        
    	<?php
		
		$testcnt++;
    }	
?>
 </table>
		</div>
<div style="width:100px; height:100px;"></div>
</div>
    <footer><h5>2015-16 | powered by JGEC-IT | All Rights Reserved</h5></footer>
</body>
</html>

    	