<?php
include("session-info.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; "/>
<meta charset="UTF-8" />
<style type="text/css">
#main_box{position:absolute; width:400px; height:300px; left:50%; top:50%; margin-left:-200px; margin-top:-150px;
 border:2px solid black;}
</style>
<script type="text/javascript">

</script>
</head>
<body>
<div id="main_box">
<form id="set_test_paper" action="add_question.php" method="post" style="margin:20px;">
set test paper name :<input name="testpapername" type="text" required="required"/><br /><br />
set number of questions:<input name="qstnno" type="text" required="required"/><br /><br />
set test paper durarion:<input name="duration" type="text" required="required"/><br /><br />
<input type="button" value="back" onclick="location.href='admin_home.php'"/>
<input type="submit" name="set_test_paper_submit" value="next" />
</form>
</div>
</body>
</html>