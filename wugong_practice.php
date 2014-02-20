<?
session_save_path("xytmp");
session_start();
$user_id=$_SESSION["user_id"];
$practice=$_GET['practice'];
$T1=$_POST['T1'];
$T2=$_POST['T2'];
$practice_jingli=$_GET['practice_jingli'];
$practice_neili=$_GET['practice_neili'];

include "./inc/attest.inc.php";

include "./inc/config.inc.php";
include "./inc/style.inc.php";
?>
<?
if($practice == 1){
	if(!empty($D1)) $wugongid = $D1;
	if(!empty($D2)) $wugongid = $D2;
	if(!empty($D3)) $wugongid = $D3;
	if(!empty($D4)) $wugongid = $D4;
	if(!empty($D5)) $wugongid = $D5;
	if(!empty($D6)) $wugongid = $D6;
	if(!empty($D7)) $wugongid = $D7;
	if(!empty($D8)) $wugongid = $D8;
	if(empty($wugongid)){
		echo "你没有选择武功\n";
		echo "<meta http-equiv=\"refresh\" content=\"2; url=wugong_practice.php\">";
		exit();
	}
	
	echo "<form action=wugong_practice.php?practice=2 method=post>\n";
	echo "修炼功夫<input type=text size=10 name=T1 value=".$wugongid." readonly>\n";
	echo "使用多少精力？<input type=text size=5 name=T2>(最少50)\n";	
	echo "<input type=submit value=开始 name=wugong_xiulian style=\"font-family: 宋体; border-style: ridge; border-width: 0; background-color: #CCFF99; color:#666633\">\n";
			
	echo "</form>\n";
	echo "<hr width=80%>\n";
}
?>
<?
if($practice == 2){
	include "inc/resume.inc.php";
	include "./inc/db.inc.php";
		
	if($T2 < 50){
		echo "使用精力不正确。\n";
		echo "<meta http-equiv=\"refresh\" content=\"2; url=wugong_practice.php\">";
		exit();
	}
		
	$wugong_p_info = mysql_query("SELECT wugongexp FROM renwu_wugong WHERE id='$user_id' AND wugongid='$T1'");
	$wugong_p_exp = mysql_result($wugong_p_info,0,"wugongexp");
	
	$wugong_p_info = mysql_query("SELECT name FROM wugong_gongfu WHERE id='$T1'");
	$wugong_p_name = mysql_result($wugong_p_info,0,"name");
	
	renwu_resume($user_id,time());
	
	$renwu_p_info = mysql_query("SELECT hp,hpnow,po,ponow,zhi,yun,exp,sex FROM renwu_member WHERE id='$user_id'");
	
	$renwu_p_hp = mysql_result($renwu_p_info,0,"hp");
	$renwu_p_hpnow = mysql_result($renwu_p_info,0,"hpnow");
	$renwu_p_po = mysql_result($renwu_p_info,0,"po");
	$renwu_p_ponow = mysql_result($renwu_p_info,0,"ponow");
	$renwu_p_zhi = mysql_result($renwu_p_info,0,"zhi");
	$renwu_p_yun = mysql_result($renwu_p_info,0,"yun");
	$renwu_p_exp = mysql_result($renwu_p_info,0,"exp");
	$renwu_p_sex = mysql_result($renwu_p_info,0,"sex");
	
	if($T2 > $renwu_p_ponow){
		echo "你精神恍惚，无法进行武功修炼。\n";
		echo "<meta http-equiv=\"refresh\" content=\"2; url=wugong_practice.php\">";
		exit();
	}
	if($T2 > $renwu_p_hpnow){
		echo "你体虚力弱，怎么还能练功！\n";
		echo "<meta http-equiv=\"refresh\" content=\"2; url=wugong_practice.php\">";
		exit();
	}
	
	if($renwu_p_sex == "侠客"){
		echo ("
		<p align=center><img src=".$pic3_url."/xiake/xiake11.jpg border=0></img><br>
		");
	}else{
		echo ("
		<p align=center><img src=".$pic3_url."/xiake/xiake06.jpg border=0></img><br>
		");
	}
	$yun_add = rand(0,intval($renwu_p_yun/10));
	
	if($renwu_p_zhi > 15) $renwu_p_zhi -= 14; else $renwu_p_zhi = 1;//智慧处理
	$wugong_p_exp += $renwu_p_zhi * intval($T2/50) + $yun_add + ($renwu_p_exp/10000);//武功经验计算
	$renwu_p_hpnow -= (intval($T2/5) + $yun_add);//生命
	$renwu_p_ponow -= $T2;//精力
	
	$nowtime = time();
		
	mysql_query("UPDATE renwu_member SET hpnow='$renwu_p_hpnow',ponow='$renwu_p_ponow' WHERE id='$user_id'");
	mysql_query("UPDATE renwu_wugong SET wugongexp='$wugong_p_exp' WHERE id='$user_id' AND wugongid='$T1'");
	
	echo "<font color=#800080>只见你神坚意定，开始把所学的".$wugong_p_name."口诀默默温习了一篇。</font><br>\n";	
	echo "<font color=#00ff00>根据口诀，你开始练习".$wugong_p_name."</font><br>\n";
	echo "<font color=#800000>随着来回几招，你觉得你在这方面有了一些体会。</font><br>\n";
	echo "<font color=#94E4CA>你对".$wugong_p_name."熟悉了不少。</font>\n";
	
	echo "<p align=center>你的".$wugong_p_name."熟练度现在为".$wugong_p_exp;
	
	mysql_close();
	exit();
}
?>
<?
if($practice_jingli == 1){
		
	echo "<form action=wugong_practice.php?practice_jingli=2 method=post>\n";
	echo "使用多少体力？<input type=text size=5 name=T2>(最少40)\n";	
	echo "<input type=submit value=修炼 name=wugong_xiulian style=\"font-family: 宋体; border-style: ridge; border-width: 0; background-color: #CCFF99; color:#666633\">\n";
			
	echo "</form>\n";
	echo "<hr width=80%>\n";
}
if($practice_jingli == 2){

	include "inc/resume.inc.php";
	include "./inc/db.inc.php";
		
	if($T2 < 40){
		echo "使用体力不正确。\n";
		exit();
	}
	
	renwu_resume($user_id,time());
	
	$renwu_p_info = mysql_query("SELECT hpnow,po,ponow,yun,pur,exp FROM renwu_member WHERE id='$user_id'");
	
	$renwu_p_hpnow = mysql_result($renwu_p_info,0,"hpnow");
	$renwu_p_po = mysql_result($renwu_p_info,0,"po");
	$renwu_p_ponow = mysql_result($renwu_p_info,0,"ponow");
	$renwu_p_yun = mysql_result($renwu_p_info,0,"yun");
	$renwu_p_pur = mysql_result($renwu_p_info,0,"pur");
	$renwu_p_exp = mysql_result($renwu_p_info,0,"exp");
	
	if($T2 > $renwu_p_hpnow){
		echo "你体虚力弱，怎么还能练功！\n";
		echo "<meta http-equiv=\"refresh\" content=\"2; url=wugong_practice.php\">";
		exit();
	}
		
	$yun_add = rand(0,intval($renwu_p_yun/10));
	$renwu_p_hpnow -= $T2;//生命
	$add_jingli = $renwu_p_pur * intval($T2/40) + $yun_add + intval($renwu_p_exp/10000);
	$renwu_p_ponow += $add_jingli;
	if($renwu_p_ponow > ($renwu_p_po*2)){
		$renwu_p_po += 1;
		$renwu_p_ponow = 0;
		$add_po_now = 1;
	}
	
	mysql_query("UPDATE renwu_member SET ponow='$renwu_p_ponow',po='$renwu_p_po',hpnow='$renwu_p_hpnow' WHERE id='$user_id'");
	mysql_query("UPDATE renwu_wugong SET wugongexp='$wugong_p_exp' WHERE id='$user_id' AND wugongid='$T1'");
	
	echo "<font color=#808080>只见你双腿一盘，就地坐下来开始打坐。</font><br>\n";	
	echo "<font color=#cococo>只见你忽喜，忽悲，已经进入了忘我的状态。</font><br>\n";
	echo "几个时辰后你觉得自己的精神强了不少。<br>\n";
	
	if($add_po_now == 1)	echo "<p><br><font color=red>你的最大精力升高了！</font>\n";
	
	mysql_close();
	exit();
}
if($practice_neili == 1){
	include "./inc/db.inc.php";
	
	$neili_info = @mysql_query("SELECT wugongid FROM renwu_wugong WHERE id='$user_id' AND cla='内功' AND used='Y'");
	$neili_id = @mysql_result($neili_info,0,"wugongid");
	
	if(empty($neili_id)){
		echo "你没有使用任何内功心法，怎么练内力啊？\n";
		echo "<meta http-equiv=\"refresh\" content=\"2; url=wugong_practice.php\">";
		exit();
	}
	
	echo "<form action=wugong_practice.php?practice_neili=2 method=post>\n";
	echo "修炼功夫<input type=text size=10 name=T1 value=".$neili_id." readonly>\n";
	echo "使用多少体力？<input type=text size=5 name=T2>(最少40)\n";	
	echo "<input type=submit value=修炼 name=wugong_xiulian style=\"font-family: 宋体; border-style: ridge; border-width: 0; background-color: #CCFF99; color:#666633\">\n";
			
	echo "</form>\n";
	echo "<hr width=80%>\n";
	mysql_close();
}
if($practice_neili == 2){
	include "inc/resume.inc.php";
	include "./inc/db.inc.php";
		
	if($T2 < 40){
		echo "使用体力不正确。\n";
		exit();
	}
		
	$wugong_p_info = mysql_query("SELECT wugongexp FROM renwu_wugong WHERE id='$user_id' AND wugongid='$T1'");
	$wugong_p_exp = mysql_result($wugong_p_info,0,"wugongexp");
	
	$wugong_p_info = mysql_query("SELECT name FROM wugong_gongfu WHERE id='$T1'");
	$wugong_p_name = mysql_result($wugong_p_info,0,"name");
	
	renwu_resume($user_id,time());
	
	$renwu_p_info = mysql_query("SELECT hp,hpnow,po,ponow,en,ennow,zhi,yun,con,exp FROM renwu_member WHERE id='$user_id'");
	
	$renwu_p_hp = mysql_result($renwu_p_info,0,"hp");
	$renwu_p_hpnow = mysql_result($renwu_p_info,0,"hpnow");
	$renwu_p_po = mysql_result($renwu_p_info,0,"po");
	$renwu_p_ponow = mysql_result($renwu_p_info,0,"ponow");
	$renwu_p_en = mysql_result($renwu_p_info,0,"en");
	$renwu_p_ennow = mysql_result($renwu_p_info,0,"ennow");
	$renwu_p_zhi = mysql_result($renwu_p_info,0,"zhi");
	$renwu_p_yun = mysql_result($renwu_p_info,0,"yun");
	$renwu_p_con = mysql_result($renwu_p_info,0,"con");
	$renwu_p_exp = mysql_result($renwu_p_info,0,"exp");
	
	if($T2 > $renwu_p_ponow){
		echo "你精神恍惚，无法进行内力修炼。\n";
		echo "<meta http-equiv=\"refresh\" content=\"2; url=wugong_practice.php\">";
		exit();
	}
	if($T2 > $renwu_p_hpnow){
		echo "你体虚力弱，怎么还能练功！\n";
		echo "<meta http-equiv=\"refresh\" content=\"2; url=wugong_practice.php\">";
		exit();
	}
		
	$yun_add = rand(0,intval($renwu_p_yun/10));
	if($renwu_p_zhi > 16) $renwu_p_zhi -= 16; else $renwu_p_zhi = 1;//智慧处理
	if($renwu_p_con > 16) $renwu_p_con -= 16; else $renwu_p_con = 1;//体质处理
	$wugong_p_exp += $renwu_p_zhi * intval($T2/40) + $yun_add + ($renwu_p_exp/10000);//武功经验计算
	$renwu_p_hpnow -= $T2;//生命
	$renwu_p_ponow -= (intval($T2/5) + $yun_add);//精力
	$add_neili = $renwu_p_con * intval($T2/40) + $yun_add + intval($wugongexp/6000);
	$renwu_p_ennow += $add_neili;
	if($renwu_p_ennow > ($renwu_p_en*2)){
		$renwu_p_en += 1;
		$renwu_p_ennow = 0;
		$add_en_now = 1;
		if(is_int($renwu_p_en/5)){
		$renwu_p_hp += 1;
		$add_hp_now = 1;
		}
	}
	
	mysql_query("UPDATE renwu_member SET hpnow='$renwu_p_hpnow',hp='$renwu_p_hp',ponow='$renwu_p_ponow',en='$renwu_p_en',ennow='$renwu_p_ennow' WHERE id='$user_id'");
	mysql_query("UPDATE renwu_wugong SET wugongexp='$wugong_p_exp' WHERE id='$user_id' AND wugongid='$T1'");
	
	echo "<font color=#808080>只见你开始坐下来打坐。</font><br>\n";	
	echo "<font color=#cococo>根据".$wugong_p_name."口诀，你让体内气体在身体内不断流转。</font><br>\n";
	echo "几个时辰后你觉得自己的内力增加了。<br>\n";
	echo "你对".$wugong_p_name."熟悉了不少。\n";
	
	if($add_en_now == 1)	echo "<p><br><font color=red>你的最大内力升高了！</font>\n";
	if($add_hp_now == 1)	echo "<br><font color=red>你的最大体力升高了！</font>\n";		
	
	mysql_close();
	exit();
}
?>
<?
	echo ("
	<p align=center><img src=".$pic3_url."/xiake/xiake04.jpg border=0></img>
	");
	include "./inc/db.inc.php";
	include "./include/wugong_level.inc.php";

	$wugong_info = mysql_query("SELECT wugongid,wugongexp,name FROM wugong_gongfu,renwu_wugong WHERE renwu_wugong.id='$user_id' AND renwu_wugong.wugongid=wugong_gongfu.id AND renwu_wugong.cla <> '内功'");
	$wugong_num = mysql_num_rows($wugong_info);
	for($i=0;$i < $wugong_num ;$i++){
		$wugong_cid[$i] = mysql_result($wugong_info,$i,"wugongid");
		$wugong_name[$i] = mysql_result($wugong_info,$i,"name");
		$wugong_exp[$i] = mysql_result($wugong_info,$i,"wugongexp");
	}
	echo "<br>==============修炼武功==============";
	if($wugong_num){
	echo "<form action=wugong_practice.php?practice=1 method=post>\n";
	
	choose_lev("不明不白",$wugong_cid,$wugong_name,$wugong_exp);	
	choose_lev("稍有心得",$wugong_cid,$wugong_name,$wugong_exp);
	choose_lev("马马虎虎",$wugong_cid,$wugong_name,$wugong_exp);
	choose_lev("小有成就",$wugong_cid,$wugong_name,$wugong_exp);
	choose_lev("略有大成",$wugong_cid,$wugong_name,$wugong_exp);
	choose_lev("心领神会",$wugong_cid,$wugong_name,$wugong_exp);
	choose_lev("信手拈来",$wugong_cid,$wugong_name,$wugong_exp);
	choose_lev("深不可测",$wugong_cid,$wugong_name,$wugong_exp);
	
	echo "<input type=submit value=修炼 name=wugong_use1 style=\"font-family: 宋体; border-style: ridge; border-width: 0; background-color: #CCFF99; color:#666633\">\n";
			
	echo "</form>\n";
	}else{
		echo "<br><font color=#cococo>你没有可以修炼的武功</font>\n";
	}
	
	echo "<br><a href=wugong_practice.php?practice_neili=1>【修炼内力】</a>－－提高自己的最大内力<br>\n";
	
	echo "<br><a href=wugong_practice.php?practice_jingli=1>【修炼精力】</a>－－提高自己的最大精力\n";
	
mysql_close();
?>