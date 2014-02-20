<?
session_save_path("../xytmp");
session_start();
$user_id=$_SESSION["user_id"];
include "../inc/attest_lu.inc.php";

include "../inc/config.inc.php";
include "../inc/style.inc.php";
/*
==============
=恶人谷 1/9/2002
==============
*/
include "../include/area_now.inc.php";
$way = array("ereng/ereng_dong6.php","ereng/ereng_dong10.php","ereng/ereng_dong9.php");
area_now($way,$user_id);

include "../include/location_lu.inc.php";
up_location("洞内","ereng/ereng_dong9.php","$user_id");
?>
<?
	echo "<br>==============洞内岔路7==============<br>";
	echo ("
	山洞内阴深恐怖，充满了邪恶之气，正气不够的人到这里一定受不了的。<br>
	");
	
	include "./inc/ereng_xiaohao.inc.php";	
    	
	echo ("
	<br>
	这里可以通往==><br>	
	<a href=./ereng_dong6.php>【洞内岔路4】<a/>
	<a href=./ereng_dong10.php>【洞内岔路8】<a/>
	");
?>