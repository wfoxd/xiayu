<?
session_save_path("../xytmp");
session_start();
$user_id=$_SESSION["user_id"];
include "../inc/attest_lu.inc.php";

include "../inc/config.inc.php";
include "../inc/style.inc.php";
/*
==============
=
=公元 2002年月日
==============
*/
//判断瞬移
include "../include/area_now.inc.php";
$way = array("bhc/lu_7.php","bhc/beimen.php","bhc/bhc.php","org_zt/wd_1.php");
area_now($way,$user_id);
//记录位置
include "../include/location_lu.inc.php";
up_location("北门","bhc/beimen.php","$user_id");
?>
<?
	echo "<br>=============北门===============<br>";
	echo ("这里就是【百花城】北门了，你可以看见城里繁华的景象。<br>
	");
	
	include "../include/tianqi.inc.php";
	
	$damage = weather_info(10);
	include "../include/xiaohao.inc.php";
	xiaohao($damage,$user_id);
	
/*
	$npc_org = "";
    	include "../include/list_npc.inc.php";  
*/
	echo ("
	<br>
	这里可以通往==><br>	
	<a href=./lu_7.php>【驿道】<a/>
	<a href=./bhc.php>【进城】<a/>
	<a href=../org_zt/wd_1.php>【◆§武当§◆】<a/>
	");
?>