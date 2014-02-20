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
$way = array("ereng/lu_3.php","ereng/lu_2.php","ereng/lu_4.php","ereng/xiaodian_1.php");
area_now($way,$user_id);

include "../include/location_lu.inc.php";
up_location("驿道","ereng/lu_3.php","$user_id");
?>
<?
	echo "<br>==============驿道==============<br>";
	echo ("这是一条通往【侠域城】西南方的驿道黄土漫漫，一直通向远方。<br>
	");
	
	include "../include/tianqi.inc.php";
	
	$damage = weather_info(10);
	include "../include/xiaohao.inc.php";
	xiaohao($damage,$user_id);
	
	echo ("
	<br>
	这里可以通往==><br>	
	<a href=./lu_2.php>【东北驿道】<a/>	
	<a href=./xiaodian_1.php>【小店】<a/>
	<a href=./lu_4.php>【西南驿道】<a/>
	");
?>