<?
session_save_path("../xytmp");
session_start();
$user_id=$_SESSION["user_id"];
include "../inc/attest_lu.inc.php";

include "../inc/config.inc.php";
include "../inc/style.inc.php";
/*
==============
=恶人谷右路 1/8/2002
==============
*/
include "../include/area_now.inc.php";
$way = array("ereng/ereng_lu_r1.php","ereng/ereng_lu_r2.php","ereng/ereng_lu_r3.php");
area_now($way,$user_id);

include "../include/location_lu.inc.php";
up_location("恶人谷右路2","ereng/ereng_lu_r2.php","$user_id");
?>
<?
	echo "<br>==============恶人谷右路2==============<br>";
	echo ("这是一条比较平坦的山路，向前走可以通向恶人谷山洞。<br>
	");
	
	include "../include/tianqi.inc.php";
	
	$damage = weather_info(10);
	include "../include/xiaohao.inc.php";
	xiaohao($damage,$user_id);
	
	echo ("
	<br>
	这里可以通往==><br>	
	<a href=./ereng_lu_r1.php>【恶人谷右路1】<a/>
	<a href=./ereng_lu_r3.php>【恶人谷右路3】<a/>
	");
?>