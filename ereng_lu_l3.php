<?
session_save_path("../xytmp");
session_start();
$user_id=$_SESSION["user_id"];
$lu=$_SESSION['lu'];
include "../inc/attest_lu.inc.php";

include "../inc/config.inc.php";
include "../inc/style.inc.php";
/*
==============
=恶人谷右路 1/8/2002
==============
*/
include "../include/area_now.inc.php";
$way = array("ereng/ereng_lu_l3.php","ereng/ereng_dong1.php","ereng/ereng_lu_l2.php");
area_now($way,$user_id);
include "../include/location_lu.inc.php";
up_location("恶人谷左路3","ereng/ereng_lu_l3.php","$user_id");
?>
<?
	echo "<br>==============恶人谷左路3==============<br>";
	echo ("这是一条崎岖的山路，你差不多可以看到恶人谷山洞的洞口了。<br>
	");
	
	include "../include/tianqi.inc.php";
	
	$damage = weather_info(20);
	include "../include/xiaohao.inc.php";
	xiaohao($damage,$user_id);
	
	include "../inc/db.inc.php";
	
	
	
	$npc_info = mysql_query("SELECT hpnow FROM npc_member WHERE id='ereng_lq'");
	$npc_hpnow= mysql_result($npc_info,0,"hpnow");
	if($npc_hpnow > 80 && $lu == "kill"){
		echo "<p><font color=#6DA2B6>林七突然跳出来挡在了你的面前.....\n";
		echo "<br>林七对你说道:要想走这里过必须先赢了我。\n";
		echo "<br>看来林七不会放你过去的了。</font>\n";
		echo "<br><br><a href=./ereng_lu_l2.php>【回恶人谷左路2】<a/>\n";
		mysql_close();
		exit();
    	}    	
  
	echo ("
	<br>
	这里可以通往==><br>	
	<a href=./ereng_lu_l2.php>【恶人谷左路2】<a/>
	<a href=./ereng_dong1.php>【恶人谷山洞】<a/>
	");
?>