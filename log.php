<?php
include("session-info.php");
include("db.php");


if(isset($_POST['username']) && isset($_POST['password']))
{	
	//mycode
	
	$username       = htmlentities($_POST['username']); // Get the username
    $password       = htmlentities(($_POST['password'])); // Get the password and decrypt it
	$password		= md5($password);
    $query          = mysql_query('SELECT * FROM student WHERE Stud_Roll = "'.$username.'" AND Stud_Pwd = "'.$password.'" '); 
    $num_rows       = mysql_num_rows($query); // Get the number of rows
    if($num_rows <= 0){ // If no users exist with posted credentials print 0 like below.
        echo 0;
    } else {
        $fetch = mysql_fetch_array($query);
        // NOTE : We have already started the session in the library.php		
		$_SESSION['login_user']=$fetch['Stud_Roll'];
		$_SESSION['User_name']=$fetch['Stud_Name'];
        echo 1;
    }

}//end of the if block

?>