<?
session_save_path("../xytmp");
session_start();
$user_id=$_SESSION["user_id"];
include "../inc/attest_lu.inc.php";

include "../inc/config.inc.php";
include "../inc/style.inc.php";
/*
==============
=小屋 1/7/2002
==============
*/
include "../include/area_now.inc.php";
$way = array("ereng/erenc.php","ereng/erenc_xiaowu.php");
area_now($way,$user_id);

include "../include/location_lu.inc.php";
up_location("恶人村小屋","ereng/erenc_xiaowu.php","$user_id");
?>
<?
	echo "<br>==============恶人村小屋==============<br>";
	echo ("这是一间十分平常的小屋，但似乎它的主人不那么平常。
	<br>
	");
	
	$npc_org = "恶人村小屋";
    	include "../include/list_npc.inc.php";
    	
	echo ("
	<br>
	这里可以返回==><br>	
	<a href=./erenc.php>【恶人村】<a/><br>
	");
?>