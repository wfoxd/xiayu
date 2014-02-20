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
$way = array("bhc/lu_4.php","bhc/lu_5.php","bhc/lu_6.php","org_zt/bhg_1.php");
area_now($way,$user_id);
//记录位置
include "../include/location_lu.inc.php";
up_location("南驿道5","bhc/lu_5.php","$user_id");
?>
<?
	echo "<br>=============南驿道5===============<br>";
	echo ("这是一条笔直的驿道，你可以看到远处连绵的山峦。<br>
	");
	
	include "../include/tianqi.inc.php";
	
	$damage = weather_info(10);
	include "../include/xiaohao.inc.php";
	xiaohao($damage,$user_id);
	
	$npc_org = "南驿道5";
    	include "../include/list_npc.inc.php"; 
    	 
	echo ("
	<br>
	这里可以通往==><br>	
	<a href=./lu_4.php>【南驿道4】<a/>
	<a href=../org_zt/bhg_1.php>【百花宫】<a/>
	<a href=./lu_6.php>【南驿道6】<a/>
	");
?>