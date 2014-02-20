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
$way = array("ereng/ereng_dong3.php","ereng/ereng_dong4.php","ereng/ereng_dong5.php",
"ereng/ereng_dong6.php","ereng/ereng_dong7.php");
area_now($way,$user_id);

include "../include/location_lu.inc.php";
up_location("洞内","ereng/ereng_dong4.php","$user_id");
?>
<?
	echo "<br>==============洞内岔路2==============<br>";
	echo ("
	这里似乎是一个洞内的岔路，向前有三条路可以走。<br>
	");
	
	include "./inc/ereng_xiaohao.inc.php";
	
	echo ("
	<br>
	这里可以通往==><br>	
	<a href=./ereng_dong3.php>【洞内岔路1】<a/>
	<a href=./ereng_dong7.php>【洞内岔路5】<a/>
	<a href=./ereng_dong6.php>【洞内岔路4】<a/>
	<a href=./ereng_dong5.php>【洞内岔路3】<a/>
	");
?>