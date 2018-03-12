<?php
/*define('db_server','localhost');
define('db_username','root');
define('db_password','');
define('db_name','online_test_demo');
$db=mysqli_connect(db_server,db_username,db_password,db_name);*/

$con = mysql_connect("localhost","root","");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
mysql_select_db("online_test_demo", $con);

?>