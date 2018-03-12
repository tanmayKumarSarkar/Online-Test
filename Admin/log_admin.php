<?php
include("session-info.php");
include("db.php");


if(isset($_POST['username']) && isset($_POST['password']))
{

	
	//mycode
	
	$username       = htmlentities($_POST['username']); // Get the username
    $password       = htmlentities(($_POST['password'])); // Get the password and decrypt it
	$password		= md5($password);
    $query          = mysql_query('SELECT * FROM admin WHERE Admin_Username = "'.$username.'" AND Admin_Pwd = "'.$password.'" '); 
    $num_rows       = mysql_num_rows($query); // Get the number of rows
    if($num_rows <= 0){ // If no users exist with posted credentials print 0 like below.
        echo 0;
    } else {
        $fetch = mysql_fetch_array($query);
        // NOTE : We have already started the session in the library.php		
		$_SESSION['admin_username']=$fetch['Admin_Username'];
        echo 1;
    }
		
	//mycode

}//end of the if block


if(isset($_POST['new_username']) && isset($_POST['new_password']))
{

	
	//mycode
	
	$username       = htmlentities($_POST['new_username']); // Get the username
    $password       = htmlentities(($_POST['new_password'])); // Get the password and decrypt it
	$password		= md5($password);
    $sql_reg          = "INSERT INTO admin (`Admin_Username`, `Admin_Pwd`) VALUES ('$username','$password')"; 
		
	if (!mysql_query($sql_reg,$con))
	{
		echo "Registration Unsuccessful Please Try again !";
	}
	else
	{//success
		$_SESSION['admin_username']=$username;
		echo 'success';	
	}

}
?>