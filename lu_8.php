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
$way = array("bhc/bhc.php","bhc/lu_8.php","bhc/ks_1.php","bhc/nh_1.php","bhc/nt_1.php");
area_now($way,$user_id);
//记录位置
include "../include/location_lu.inc.php";
up_location("南路","bhc/lu_8.php","$user_id");
?>
<?
	echo "<br>=============南路===============<br>";
	echo ("从这里向南就是通往南海的一条大道，你可以看到这里还有一条路可以通往矿山。<br>
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
	<a href=./ks_1.php>【矿山道路】<a/>
	<a href=./bhc.php>【百花城】<a/>
	<a href=./nt_1.php>【农田道路】<a/>
	<a href=./nh_1.php>【南海】<a/>
	");
?>