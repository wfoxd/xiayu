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
$way = array("bhc/lu_6.php","bhc/lu_7.php","bhc/beimen.php","org_zt/sbls_1.php");
area_now($way,$user_id);
//记录位置
include "../include/location_lu.inc.php";
up_location("南驿道7","bhc/lu_7.php","$user_id");
?>
<?
	echo "<br>=============南驿道7===============<br>";
	echo ("从这里向北走是【侠域城】向南走就是最大的城市【百花城】，你可
	以看到这条路是又宽又平。<br>
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
	<a href=./lu_6.php>【南驿道6】<a/>
	<a href=../org_zt/sbls_1.php>【水泊梁山】<a/>
	<a href=./beimen.php>【北城门】<a/>
	");
?>