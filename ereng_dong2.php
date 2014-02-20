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
$way = array("ereng/ereng_dong3.php","ereng/ereng_dong1.php","ereng/ereng_dong2.php");
area_now($way,$user_id);
?>
<?
	echo "<br>==============洞内==============<br>";
	echo ("
	山洞内阴深恐怖，充满了邪恶之气，正气不够的人到这里一定受不了的。<br>
	");
	
	include "./inc/ereng_xiaohao.inc.php";
	
	include "../inc/db.inc.php";
	
	$npc_info = mysql_query("SELECT hpnow FROM npc_member WHERE id='ereng_ls'");
	$npc_hpnow= mysql_result($npc_info,0,"hpnow");
	if($npc_hpnow > 80 && $lu == "killls"){
		echo "<p><font color=#6DA2B6>林四突然跳出来挡在了你的面前.....\n";
		echo "<br>林四对你说道:这里已经被我们林家庄的人占了，你还是快滚吧！\n";
		echo "<br>看来林四不会放你过去的了。</font>\n";
		echo "<br><br><a href=./ereng_dong1.php>【回恶人山洞口】<a/>\n";
		mysql_close();
		exit();
    	}    	
    	include "../include/location_lu.inc.php";
	up_location("洞内","ereng/ereng_dong2.php","$user_id");
	echo ("
	<br>
	这里可以通往==><br>	
	<a href=./ereng_dong1.php>【洞口】<a/>
	<a href=./ereng_dong3.php>【洞内岔路1】<a/>
	");
?>