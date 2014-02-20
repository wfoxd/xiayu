<?
session_save_path("../xytmp");
session_start();
$user_id=$_SESSION["user_id"];
include "../inc/attest_lu.inc.php";

include "../inc/config.inc.php";
include "../inc/style.inc.php";
/*
==============
=恶人谷山洞 1/9/2002
==============
*/
include "../include/area_now.inc.php";
$way = array("ereng/ereng_dong7.php","ereng/ereng_dong12.php","ereng/ereng_dong11.php");
area_now($way,$user_id);

include "../include/location_lu.inc.php";
up_location("洞内","ereng/ereng_dong11.php","$user_id");
?>
<?
	echo "<br>==============洞内岔路9==============<br>";
	echo ("
	山洞内阴深恐怖，充满了邪恶之气，正气不够的人到这里一定受不了的。<br>
	");
	
	include "./inc/ereng_xiaohao.inc.php";
	include "../inc/db.inc.php";
	
	$time_resume = time();
	
	$renwu_state = mysql_query("SELECT hp,hpnow,en,ennow,po,ponow,time,con,po,zhi FROM npc_member WHERE id='erc_lld'");
	
	$renwu_state_hp = mysql_result($renwu_state,0,"hp");
	$renwu_state_hpnow = mysql_result($renwu_state,0,"hpnow");
	$renwu_state_en = mysql_result($renwu_state,0,"en");
	$renwu_state_ennow = mysql_result($renwu_state,0,"ennow");
	$renwu_state_po = mysql_result($renwu_state,0,"po");
	$renwu_state_ponow = mysql_result($renwu_state,0,"ponow");
	$renwu_state_time = mysql_result($renwu_state,0,"time");
	
	$renwu_state_con = mysql_result($renwu_state,0,"con");
	$renwu_state_po = mysql_result($renwu_state,0,"po");
	$renwu_state_zhi = mysql_result($renwu_state,0,"zhi");
	
	$distance_time = $time_resume - $renwu_state_time;
	$distance_time = $distance_time/10;
	intval($distance_time);
		
	if($renwu_state_hpnow < $renwu_state_hp){
		$add_hp = (($renwu_state_con/10)+3) * $distance_time;
		$renwu_state_hpnow = intval($add_hp) + $renwu_state_hpnow;
		if($renwu_state_hpnow > $renwu_state_hp) $renwu_state_hpnow = $renwu_state_hp;
	}
	if($renwu_state_ennow < $renwu_state_en){
		$add_en = (($renwu_state_con-5)/10) * $distance_time;
		$renwu_state_ennow = intval($add_en) + $renwu_state_ennow;
		if($renwu_state_ennow > $renwu_state_en) $renwu_state_ennow = $renwu_state_en;
	}
	if($renwu_state_ponow < $renwu_state_po){
		$add_po = $renwu_state_zhi/10 * $distance_time;
		$renwu_state_ponow = intval($add_po) + $renwu_state_ponow;
		if($renwu_state_ponow > $renwu_state_po) $renwu_state_ponow = $renwu_state_po;
	}
	
	mysql_query("UPDATE npc_member SET time='$time_resume',hpnow='$renwu_state_hpnow',ennow='$renwu_state_ennow',ponow='$renwu_state_ponow' WHERE id='erc_lld'");
	
	mysql_close();
	$lu = "killld";
    	//session_register("lu");
    	$_SESSION['lu']=$lu;
    	$npc_org = "洞内11";
    	include "../include/list_npc.inc.php";
	echo ("
	<br>
	这里可以通往==><br>	
	<a href=./ereng_dong7.php>【洞内岔路5】<a/>
	<a href=./ereng_dong12.php>【洞内岔路10】<a/>
	");
?>