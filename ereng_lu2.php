<?
session_save_path("../xytmp");
session_start();
$user_id=$_SESSION["user_id"];
include "../inc/attest_lu.inc.php";

include "../inc/config.inc.php";
include "../inc/style.inc.php";
/*
==============
=恶人谷谷口 1/8/2002
==============
*/
include "../include/area_now.inc.php";
$way = array("ereng/ereng_lu1.php","ereng/ereng_lu2.php","ereng/ereng_lu_l1.php","ereng/ereng_lu_r1.php");
area_now($way,$user_id);

include "../include/location_lu.inc.php";
up_location("恶人谷岔路","ereng/ereng_lu2.php","$user_id");
?>
<?
	echo "<br>==============恶人谷岔路==============<br>";
	echo ("这里是一个岔路口，看样子向右边走路途比较平坦，但好像也远了不少。向左边走可以节省很多时间，但十分危险。<br>
	");
	
	include "../include/tianqi.inc.php";
	
	$damage = weather_info(10);
	include "../include/xiaohao.inc.php";
	xiaohao($damage,$user_id);
	$npc_org = "恶人谷岔路";
    	include "../include/list_npc.inc.php";
	echo ("
	<br>
	这里可以通往==><br>	
	<a href=./ereng_lu_l1.php>【左路】<a/>
	<a href=./ereng_lu1.php>【恶人谷口】<a/>
	<a href=./ereng_lu_r1.php>【右路】<a/>
	");
?>