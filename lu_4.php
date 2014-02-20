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
$way = array("bhc/lu_3.php","bhc/lu_4.php","bhc/lu_5.php","dl/jj_lu1.php","org_zt/xyp_1.php");
area_now($way,$user_id);
//记录位置
include "../include/location_lu.inc.php";
up_location("南驿道4","bhc/lu_4.php","$user_id");
?>
<?
	echo "<br>=============南驿道4===============<br>";
	echo ("这是一条笔直的驿道，你可以看到远处连绵的山峦。路旁边好像有一条<a href=../dl/jj_lu1.php>【荆棘小路】<a/>，
	不知道可以通向那里。<br>
	");
	
	include "../include/tianqi.inc.php";
	
	$damage = weather_info(10);
	include "../include/xiaohao.inc.php";
	xiaohao($damage,$user_id);
	

	$npc_org = "南驿道4";
    	include "../include/list_npc.inc.php";  

	echo ("
	<br>
	这里可以通往==><br>
	<a href=./lu_3.php>【南驿道3】<a/>	
	<a href=../org_zt/xyp_1.php>【逍遥派】<a/>
	<a href=./lu_5.php>【南驿道5】<a/>
	");
?>