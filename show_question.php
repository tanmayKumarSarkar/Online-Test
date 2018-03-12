<?php
error_reporting(0);
include("session-info.php");
include("db.php");
if(!empty($_SESSION['exam_started']))
{
  header('location: start_exam.php');	
}

if(empty($_SESSION['test_id']) || empty($_SESSION['test_qstn']) )
{
	header('location: home.php');	
}

$data=$_SESSION['test_type'];
$no_q = $_SESSION['test_qstn'];

$sql_show="select * from question where Qstn_Type  = '$data' ORDER BY RAND() LIMIT $no_q";

/*SELECT column FROM table
ORDER BY RAND()
LIMIT 1*/

$res = mysql_query($sql_show);
$nrow=mysql_num_rows($res);

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
body,html{width:90%; margin:auto;min-width:600px; max-width:2000px; height:100%; overflow:auto; font-family:Tahoma, Geneva, sans-serif;}
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
	bottom:0px; left:0px;
	border-top:1px solid #006;	
	padding-top:5px;}
.login_box{ 
	width:900px; height:500px; 
	position:absolute; top:50%; left:50%;
	margin-left:-450px; margin-top:-250px;
	text-align:center;
	margin-bottom:150px;
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
	padding-bottom:20px;}
.qustns{ margin-top:10px; width:98%; height:auto; padding:5px; text-align:left;
	
	}
.options{margin-top:10px; text-align:left;}


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

input[type="radio"] {
  margin-right: 5px;
  margin-left: -9px;
  width:13px;
}
.button_finish{
    height:30px; 
    width:120px; 
    margin: -15px -60px; 
    position:relative;
    top:50%; 
    left:50%;
	cursor:pointer;
	font-family:Tahoma, Geneva, sans-serif; font-size:15px;
	border:1px solid #00cccc;
	background-color:#fff;
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

</style>

<script type="text/javascript" src="js/jquery.1.11.1.min.js"></script>
<script type="text/javascript">

    window.onbeforeunload = function() {
        return "page reloaded";	
    }

var timer=00;
$(document).ready(function (e) {
    var $worked = $("#worked");
	
    function update() {
        
        var myTime = $worked.html();
        var ss = myTime.split(":");
        var dt = new Date();
        dt.setHours(0);
        dt.setMinutes(ss[0]);
        dt.setSeconds(ss[1]);
        
        var dt2 = new Date(dt.valueOf() - 1000);
        var temp = dt2.toTimeString().split(" ");
        var ts = temp[0].split(":");
        
        $worked.html(ts[1]+":"+ts[2]);
		var mno=ts[1]+":"+ts[2];
		$('#worked_box').val(mno);
        var z = $('#worked_box').val();
		if(ts[1]==0 && ts[2]==0){
            timeup();}
        setTimeout(update, 1000);
    }

    setTimeout(update, 1000);
});

function timeup()
{
	timer=00;
	alert('Your Time is Up! Lets see the result.');
	document.getElementById('all_qstn').submit();
}
function submit_test()
{
	var r =confirm('Are you sure want to submit?');
		if (r == true) {
			 // form.submit();
			 document.getElementById('all_qstn').submit();
		}else {
			
		}
}

function ResetAns (No){
	
	alert(No);
	document.getElementById("radio_option").checked = false;	
	//document.getElementsByName("radio_option_"+No).reset();
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
            <div id="worked"><?php echo $_SESSION['test_duration'].":00";?></div>
        </mmm>
        <hr  style=" background-color:rgba(0,204,255,1); width:95%; height:3px; border:0; margin-bottom:30px; margin-top:10px;"/>
        <div class="xam_panel" id="xam_panel">
        	<form id="all_qstn" action="show_result.php" method="post">
        	<?php 	
			
				if($nrow>0)
				{
					$tm=0;
					unset($_SESSION['data_stored']);
					$_SESSION['exam_started']='yes';
					$count=0;
					while($row = mysql_fetch_array($res))
					{	$count++;
						$_SESSION['counter']=$count;
					?>
                    <input type="text" hidden="hidden" name="hiditem_<?php echo $count;?>" id="hiditem_<?php echo $count;?>" value="<?php echo $row['Qstn_Id']; ?>" />
                    
                    <input type="text" hidden="hidden" value="" name="worked_box" id="worked_box" />
			<table width="100%">
              <tr>
                <th>
                	<?php 
					echo "<b>".$count.". </b>";
					echo $row['Qstn_Qstn']; ?>
                </th>
              </tr>     
            </table>
            <table width="100%" >
            <fieldset>
              <tr ondblclick="ResetAns(<?php echo $count?>)">
                <td>
                <input type="radio" name="radio_option_<?php echo $count;?>" id="radio_option" value="A" />a)&nbsp <?php echo $row['Qstn_Op1']; ?> </td>
                <td>
				<input type="radio" name="radio_option_<?php echo $count;?>" id="radio_option" value="B" />b)&nbsp <?php echo $row['Qstn_Op2']; ?> </td>
              </tr>
              <tr ondblclick="ResetAns(<?php echo $count?>)">
                <td>
				 <input type="radio" name="radio_option_<?php echo $count;?>" id="radio_option" value="C" />c)&nbsp <?php echo $row['Qstn_Op3']; ?></td>
                <td>
				<input type="radio" name="radio_option_<?php echo $count;?>" id="radio_option" value="D" />d)&nbsp <?php echo $row['Qstn_Op4']; ?> </td>
              </tr>
             </fieldset>
            </table>
            
            <?php 
				}	
				
				?>
				<br /><br />
                <input type="button" onclick="submit_test();" id="button_finish" class="button_finish" value="Submit Test" />
                <br /><br />
              </form>
          
				
				<?php
				if($count==0)
				{
					?>
					<script> 
						alert('No questions Found');
                    	window.location.href='home.php';
                    </script>
                    <?php	
				
				}
			}else
			{
				//html
				?>            
            <div style="width:300px; text-align:center; border:2px dashed #00cccc; height:100px;
             padding-top:50px; position:absolute; 
             left:50%; top:50%; margin-left:-150px; margin-top:-75px;"> Sorry No Questions Found" </div>
                <?php
				//html	
			}
			?>
          </div>
        <div style="width:100px; height:100px;"></div>
        
    </div>

	<footer><h5>2015-16 | powered by JGEC-IT | All Rights Reserved</h5></footer>
</body>
</html>