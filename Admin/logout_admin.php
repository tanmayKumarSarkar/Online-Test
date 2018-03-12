<?php
include("session-info.php");
if(session_destroy())
{
header("Location: Admin.php");
}
?>