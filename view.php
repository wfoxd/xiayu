<?php
session_save_path("../xytmp");
session_start();
?>
<html>
<style type="text/css">
a:link{color: green;text-decoration:none;font-size:12px}
a:visited{color: green;text-decoration:none;font-size; font-size} 
a:active{color: red;text-decoration:none;underline; font-size}
a:hover{color: #00FF00;text-decoration:inderline;font-size; font-size}
</style>
<meta http-equiv="Refresh" content="20; url=view.php">
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<body background=../images/img1/bg.gif text="#FFFFFF">
<script language='JavaScript'>
  	function loadto(page) {
     	parent.right.location.href=page;
     	parent.left.location.href='view.php';
	}	
</script>
<?
include "../inc/db.inc.php";
//$user_name=$_SESSION['user_name'];
//$people = $user_name;
$chat_info = mysql_query("SELECT people,channel,content,to_people FROM chat ORDER BY time DESC LIMIT 0,25");
$num = mysql_num_rows($chat_info);
for($i=0;$i<$num;$i++){
$people = mysql_result($chat_info,$i,"people");
$channel = mysql_result($chat_info,$i,"channel");
$content = mysql_result($chat_info,$i,"content");
$to_people = mysql_result($chat_info,$i,"to_people");
switch($channel){
	case "〖闲聊〗":$color = "#759DB0";break;
	case "〖谣言〗":$color = "#8BA372";break;
	case "〖无聊〗":$color = "#92b1a3";break;
	case "〖挑战〗":$color = "#E16DF1";break;
	case "〖交易〗":$color = "#DBE243";break;
	case "〖情感〗":$color = "#E97E5A";break;
	case "〖对话〗":$color = "#72B066";break;
	case "〖系统〗":$color = "#82699E";break;
	}
if($channel == "〖谣言〗")	echo "<small><font color=".$color.">".$channel."某某某：".$content."</font></small><br>";
else if($to_people != "all")	echo "<small><font color=".$color.">".$channel."<a href=\"javascript:loadto('input.php?to=$people')\"><font color=$color>".$people."</a>对".$to_people."：".$content."</font></small><br>";
else if($channel == "〖系统〗")	echo "<small><font color=".$color.">".$channel.$content."</font></small><br>";
else	echo "<small><font color=".$color.">".$channel."<a href=\"javascript:loadto('input.php?to=".$people."')\"><font color=$color>".$people."</a>：".$content."</font></small><br>";
}
mysql_close();
?>
</body>
</html>