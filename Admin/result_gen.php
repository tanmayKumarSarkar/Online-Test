<?php
include("db.php");
include("session-info.php");
if(empty($_SESSION['admin_username']))
{
	header('location: Admin.php');	
}
//html
?>
<style type="text/css">
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
  text-align:center;
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
	
</style>
<?php
if(isset($_GET['dept']) && isset($_GET['paper']))
{
	$d=$_GET['dept'];
	$p=$_GET['paper'];
	
	if($d=='alldept')
	{
		if($p=='allpaper')//show all students
		{
			$sql_1="select * from student order by 'Stud_Roll' asc";
			$res=mysql_query($sql_1,$con); 
			$nrow=mysql_num_rows($res);
			if($nrow>0)
			{
			?>
			            <table width="100%">
                        <tr>
                            <th>Student</th>
                            <th>Rollno</th>
                            <th>Dept</th>
                            <th>View</th>
                        </tr>
             <?php           
			while($row = mysql_fetch_array($res))
			{
				$sname=$row['Stud_Name'];
				$sroll=$row['Stud_Roll'];
				$sdept=$row['Stud_Dept'];
				$link="view_result_stud.php?selected_stud=".$sroll;	
				//html
				?>	

                	    <tr>
                            <td><?php echo $sname;?></td>
                            <td><?php echo $sroll;?></td>
                            <td><?php echo $sdept;?></td>
                            <td><input type="button" onclick="window.location.href='<?php echo $link?>';" class="view_btn" name="view_btn" value="view result"/></td>
                        </tr>
                
                <?php
			}  ?> </table> <?php
		  }
		  else
		  {
				?><div style="width:300px; text-align:center; border:2px dashed #00cccc; height:100px; padding-top:50px; position:absolute; 
            left:50%; top:50%; margin-left:-150px; margin-top:-75px;"> No Students yet Registered </div><?php  
		  }
		}	
		else//paper changed
		{
			$sql3="select PR_Stud_Id from primary_result where PR_Test_Id = '$p'";
			$res=mysql_query($sql3,$con);
			$nrow=mysql_num_rows($res);
			if($nrow>0)
			{
				//html
				?>
                <table  width="100%">
								<tr>
									<th>Student</th>
									<th>Rollno</th>
									<th>Dept</th>
									<th>View</th>
								</tr>
                <?php
				//html
				while($row = mysql_fetch_array($res))
				{
					$sroll=$row['PR_Stud_Id'];
					//now searching from student database
					$sql_1="select * from student where Stud_Roll = '$sroll'";
					$res=mysql_query($sql_1,$con);
					while($row = mysql_fetch_array($res))
					{
						$sname=$row['Stud_Name'];
						$sdept=$row['Stud_Dept'];	
						$link="view_result_stud.php?selected_stud=".$sroll;
						//html
						?>	
								<tr>
									<td><?php echo $sname;?></td>
									<td><?php echo $sroll;?></td>
									<td><?php echo $sdept;?></td>
									<td><input type="button" onclick="window.location.href='<?php echo $link?>';" class="view_btn" name="view_btn" value="view result"/></td>
								</tr>
						<?php
					}
				}//end of while
			}//end of if row>0
			else
			{
				?><div style="width:300px; text-align:center; border:2px dashed #00cccc; height:100px; padding-top:50px; position:absolute; 
            left:50%; top:50%; margin-left:-150px; margin-top:-75px;"> "no result found" </div><?php
			}//end of else row<=0
			//html
			?> </table> <?php
			//html
		}
	}
	else
	{
		if($p=='allpaper')//department changed
		{
			$sql_2="select * from student where Stud_Dept = '$d'";
			$res=mysql_query($sql_2,$con);
			$nrow=mysql_num_rows($res);
			if($nrow>0){
				//html
				?>
                <table  width="100%">
								<tr>
									<th>Student</th>
									<th>Rollno</th>
									<th>Dept</th>
									<th>View</th>
								</tr>
                <?php
				//html
				while($row = mysql_fetch_array($res))
				{
					$sname=$row['Stud_Name'];
					$sroll=$row['Stud_Roll'];
					$sdept=$row['Stud_Dept'];
					$link="view_result_stud.php?selected_stud=".$sroll;	
					//html
					?>
							<tr>
								<td><?php echo $sname;?></td>
								<td><?php echo $sroll;?></td>
								<td><?php echo $sdept;?></td>
								<td><input type="button" onclick="window.location.href='<?php echo $link?>';" class="view_btn" name="view_btn" value="view result"/></td>
							</tr>
					<?php
				}
			}
			else
			{
				?><div style="width:300px; text-align:center; border:2px dashed #00cccc; height:100px; padding-top:50px; position:absolute; 
            left:50%; top:50%; margin-left:-150px; margin-top:-75px;"> no result found for this Department</div><?php
			
			}
		}
		else //department and paper both changed
		{
			$sql3="select PR_Stud_Id from primary_result where PR_Test_Id = '$p'";
			$res=mysql_query($sql3,$con);
			$nrow=mysql_num_rows($res);
			if($nrow>0)
			{
				//html
				?>
                <table width="100%">
								<tr>
									<th>Student</th>
									<th>Rollno</th>
									<th>Dept</th>
									<th>View</th>
								</tr>
                <?php
				//html
				while($row = mysql_fetch_array($res))
				{
					$sroll=$row['PR_Stud_Id'];
					//now searching from student database
					$sql_1="select * from student where Stud_Roll = '$sroll' and Stud_Dept = '$d'";
					$res=mysql_query($sql_1,$con);
					$nrow=mysql_num_rows($res);
					if($nrow>0)
					{
					while($row = mysql_fetch_array($res))
					{
						$sname=$row['Stud_Name'];
						$sdept=$row['Stud_Dept'];	
						$link="view_result_stud.php?selected_stud=".$sroll;
						//html
						?>	
								<tr>
									<td><?php echo $sname;?></td>
									<td><?php echo $sroll;?></td>
									<td><?php echo $sdept;?></td>
									<td><input type="button" onclick="window.location.href='<?php echo $link?>';" class="view_btn" name="view_btn" value="view result"/></td>
								</tr>
						<?php
					}//end of 1st while
					}
					else
					{
						?><div style="width:300px; text-align:center; border:2px dashed #00cccc; height:100px; padding-top:50px; position:absolute; 
            left:50%; top:50%; margin-left:-150px; margin-top:-75px;"> Sorry no result found</div><?php
					}
				}//end of while
			}//end of if row>0
			else
			{
				?><div style="width:300px; text-align:center; border:2px dashed #00cccc; height:100px; padding-top:50px; position:absolute; 
            left:50%; top:50%; margin-left:-150px; margin-top:-75px;"> Sorry no result found</div><?php
			
			}//end of else row<=0
			//html
			?> </table> <?php
			//html
		}
	}
}
else
{
			$sql_1="select * from student order by 'Stud_Roll' asc";
			$res=mysql_query($sql_1,$con);
			
			$nrow=mysql_num_rows($res);
			if($nrow>0){
			//html
				?>
                <table  width="100%">
								<tr>
									<th>Student</th>
									<th>Rollno</th>
									<th>Dept</th>
									<th>View</th>
								</tr>
                <?php
				//html
			
			while($row = mysql_fetch_array($res))
			{
				$sname=$row['Stud_Name'];
				$sroll=$row['Stud_Roll'];
				$sdept=$row['Stud_Dept'];	
				$link="view_result_stud.php?selected_stud=".$sroll;
				//html
				?>
                	    <tr>
                            <td><?php echo $sname;?></td>
                            <td><?php echo $sroll;?></td>
                            <td><?php echo $sdept;?></td>
                            <td><input type="button" onclick="window.location.href='<?php echo $link?>';" class="view_btn" name="view_btn" value="view result"/></td>
                        </tr>
                <?php
			}
		}
		else
		{
			?><div style="width:300px; text-align:center; border:2px dashed #00cccc; height:100px; padding-top:50px; position:absolute; 
            left:50%; top:50%; margin-left:-150px; margin-top:-75px;"> "No Students yet not registered!</div><?php	
	}
}

?>
