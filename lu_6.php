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
$way = array("bhc/lu_5.php","bhc/lu_6.php","bhc/lu_7.php","org_zt/fydqm_1.php");
area_now($way,$user_id);
//记录位置
include "../include/location_lu.inc.php";
up_location("南驿道6","bhc/lu_6.php","$user_id");
?>
<?
	echo "<br>=============南驿道6===============<br>";
	echo ("这是一条笔直的驿道，你可以看到远处连绵的山峦。<br>
	");
	
	include "../include/tianqi.inc.php";
	
	$damage = weather_info(10);
	include "../include/xiaohao.inc.php";
	xiaohao($damage,$user_id);
	
	$npc_org = "南驿道6";
    	include "../include/list_npc.inc.php";  
    	
	echo ("
	<br>
	这里可以通往==><br>	
	<a href=./lu_5.php>【南驿道5】<a/>
	<a href=../org_zt/fydqm_1.php>【风云大旗盟】<a/>
	<a href=./lu_7.php>【南驿道7】<a/>
	");
?>