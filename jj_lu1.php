<?
session_save_path("../xytmp");
session_start();
$user_id=$_SESSION["user_id"];
include "../inc/attest_lu.inc.php";

include "../inc/config.inc.php";
include "../inc/style.inc.php";
//判断瞬移
include "../include/area_now.inc.php";
$way = array("bhc/lu_4.php","dl/jj_lu1.php","dl/jj_lu2.php");
area_now($way,$user_id);
//记录位置
include "../include/location_lu.inc.php";
up_location("荆棘路","dl/jj_lu1.php","$user_id");
?>
<?
	echo "<br>=============荆棘路===============<br>";
	echo ("这是一条布满了荆棘的小路，一直延伸到了森林里。<br>
	");
	
	include "../include/tianqi.inc.php";
	
	$damage = weather_info(20);
	include "../include/xiaohao.inc.php";
	xiaohao($damage,$user_id);
	
/*
	$npc_org = "";
    	include "../include/list_npc.inc.php";  
*/
	echo ("
	<br>
	这里可以通往==><br>	
	<a href=../bhc/lu_4.php>【南驿道】<a/>
	<a href=./jj_lu2.php>【荆棘路】<a/>
	");
?>