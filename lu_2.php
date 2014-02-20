<?
session_save_path("../xytmp");
session_start();
$user_id=$_SESSION["user_id"];
include "../inc/attest_lu.inc.php";

include "../inc/config.inc.php";
include "../inc/style.inc.php";
/*
==============
=小路1 1/5/2002
==============
*/
include "../include/area_now.inc.php";
$way = array("ereng/lu_3.php","ereng/lu_1.php","ereng/lu_2.php");
//echo "测试way".$way;
area_now($way,$user_id);

include "../include/location_lu.inc.php";
up_location("驿道","ereng/lu_2.php","$user_id");
?>
<?
	echo "<br>==============驿道==============<br>";
	echo ("这是一条通往【侠域城】西南方的驿道，这里离【侠域城】还有一段路，要想今天晚上进城
	你可要快一点了。<br>
	");
	
	include "../include/tianqi.inc.php";
	
	$damage = weather_info(10);
	include "../include/xiaohao.inc.php";
	xiaohao($damage,$user_id);
	
	$npc_org = "西南小路2";
    	include "../include/list_npc.inc.php";  
    	
	echo ("
	<br>
	这里可以通往==><br>	
	<a href=./lu_1.php>【东北驿道】<a/>
	<a href=./lu_3.php>【西南驿道】<a/>
	");
?>