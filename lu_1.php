<?
session_save_path("../xytmp");
session_start();
$user_id=$_SESSION["user_id"];
include "../inc/attest_lu.inc.php";

include "../inc/config.inc.php";
include "../inc/style.inc.php";
/*
==============
=小路1 1/5/2002
==============
*/
include "../include/area_now.inc.php";
$way = array("explorer.php","ereng/lu_2.php","ereng/lu_1.php","org_zt/srg_1.php","org_zt/ssjp_1.php","org_zt/xlm_1.php");
area_now($way,$user_id);

include "../include/location_lu.inc.php";
up_location("驿道","ereng/lu_1.php","$user_id");
?>
<?
	echo "<br>==============驿道==============<br>";
	echo ("这是一条通往【侠域城】西南方的驿道，这里离【侠域城】很近了，你可以远远的看到
	城里的炊烟。<br>
	");
	
	include "../include/tianqi.inc.php";
	
	$damage = weather_info(10);
	include "../include/xiaohao.inc.php";
	xiaohao($damage,$user_id);
	
	echo ("
	<br>
	这里可以通往==><br>	
	<a href=../explorer.php>【大路口】<a/>
	<a href=./lu_2.php>【西南驿道】<a/>
	<a href=../org_zt/srg_1.php>【圣人宫】<a/>
	<a href=../org_zt/ssjp_1.php>【蜀山剑派】<a/>
	<a href=../org_zt/xlm_1.php>【修罗门】<a/>
	");
?>