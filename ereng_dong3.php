<?
session_save_path("../xytmp");
session_start();
$user_id=$_SESSION["user_id"];
include "../inc/attest_lu.inc.php";

include "../inc/config.inc.php";
include "../inc/style.inc.php";
/*
==============
=恶人谷山洞 1/8/2002
==============
*/
include "../include/area_now.inc.php";
$way = array("ereng/ereng_dong3.php","ereng/ereng_dong4.php","ereng/ereng_dong2.php");
area_now($way,$user_id);

include "../include/location_lu.inc.php";
up_location("洞内","ereng/ereng_dong3.php","$user_id");
?>
<?
	echo "<br>==============洞内岔路1==============<br>";
	echo ("
	山洞内阴深恐怖，充满了邪恶之气，正气不够的人到这里一定受不了的。<br>
	");
	
	include "./inc/ereng_xiaohao.inc.php";
	$lu = "lu";
    	session_register("killls");
    	$npc_org = "洞内3";
    	include "../include/list_npc.inc.php";
	echo ("
	<br>
	这里可以通往==><br>	
	<a href=./ereng_dong2.php>【洞内】<a/>
	<a href=./ereng_dong4.php>【洞内岔路2】<a/>
	");
?>