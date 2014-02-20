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
$way = array("ereng/ereng_lu_l3.php","ereng/ereng_lu_l1.php","ereng/ereng_lu_l2.php");
area_now($way,$user_id);

include "../include/location_lu.inc.php";
up_location("恶人谷左路2","ereng/ereng_lu_l2.php","$user_id");
?>
<?
	echo "<br>==============恶人谷左路2==============<br>";
	echo ("这是一条崎岖的山路，向前走可以通向恶人谷山洞。<br>
	");
	
	include "../inc/db.inc.php";
	
	$time_resume = time();
	
	$renwu_state = mysql_query("SELECT hp,hpnow,en,ennow,po,ponow,time,con,po,zhi FROM npc_member WHERE id='ereng_lq'");
	
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
	
	mysql_query("UPDATE npc_member SET time='$time_resume',hpnow='$renwu_state_hpnow',ennow='$renwu_state_ennow',ponow='$renwu_state_ponow' WHERE id='ereng_lq'");
	
	mysql_close();
	include "../include/tianqi.inc.php";
	
	$damage = weather_info(20);
	include "../include/xiaohao.inc.php";
	xiaohao($damage,$user_id);
	
	$npc_org = "恶人谷左路2";
    	include "../include/list_npc.inc.php";
    	
    	$lu = "kill";
    	//session_register("lu");
    	$_SESSION['lu']=$lu;
    	
	echo ("
	<br>
	这里可以通往==><br>	
	<a href=./ereng_lu_l1.php>【恶人谷左路1】<a/>
	<a href=./ereng_lu_l3.php>【恶人谷左路3】<a/>
	");
?>