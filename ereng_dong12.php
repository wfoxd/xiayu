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
=恶人谷 1/9/2002
==============
*/
include "../include/area_now.inc.php";
$way = array("ereng/ereng_dong13.php","ereng/ereng_dong14.php","ereng/ereng_dong12.php","ereng/ereng_dong11.php");
area_now($way,$user_id);
?>
<?
	echo "<br>==============洞内岔路10==============<br>";
	echo ("
	山洞内阴深恐怖，充满了邪恶之气，正气不够的人到这里一定受不了的。<br>
	");
	
	include "./inc/ereng_xiaohao.inc.php";
	
	include "../inc/db.inc.php";
	
	$npc_info = mysql_query("SELECT hpnow FROM npc_member WHERE id='erc_lld'");
	$npc_hpnow= mysql_result($npc_info,0,"hpnow");
	if($npc_hpnow > 80 && $lu == "killld"){
		echo "<p><font color=#6DA2B6>林老大突然跳出来挡在了你的面前.....\n";
		echo "<br>林老大对你说道:还想和我抢宝藏吗！去你的吧！\n";
		echo "<br>看来林老大不会放你过去的了。</font>\n";
		echo "<br><br><a href=./ereng_dong11.php>【回洞内岔路9】<a/>\n";
		mysql_close();
		exit();
    	}    	
    	include "../include/location_lu.inc.php";
	up_location("洞内","ereng/ereng_dong12.php","$user_id");
	echo ("
	<br>
	这里可以通往==><br>	
	<a href=./ereng_dong11.php>【洞内岔路9】<a/>
	<a href=./ereng_dong14.php>【洞内岔路12】<a/>
	<a href=./ereng_dong13.php>【洞内岔路11】<a/>
	");
?>