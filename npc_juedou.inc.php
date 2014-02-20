<?
/*
===========
=npc战斗----决斗
=
===========
*/
	if(empty($b_id)){
		echo "不能战斗状态！\n";
		exit();
		}
	
	include "./include/status_increase.inc.php";
	
	include "./inc/db.inc.php";
	
	$time_resume = time();
	
	$renwu_state = mysql_query("SELECT hp,hpnow,en,ennow,po,ponow,time,con,po,zhi FROM npc_member WHERE id='$b_id'");
	
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
	
	mysql_query("UPDATE npc_member SET time='$time_resume',hpnow='$renwu_state_hpnow',ennow='$renwu_state_ennow',ponow='$renwu_state_ponow' WHERE id='$b_id'");
	
	include "./inc/resume.inc.php";
	renwu_resume($user_id,time());
	
	$result=mysql_query("SELECT hpnow FROM renwu_member WHERE id='$user_id'");
    	$user_hpnow = mysql_result($result,0,"hpnow");
    	$result=mysql_query("SELECT hpnow FROM npc_member WHERE id='$b_id'");
    	$b_hpnow = mysql_result($result,0,"hpnow");
    	
    	if($user_hpnow < 100 || $b_hpnow < 100){
    		echo "<p align=center><font color=#222DF4>实在太累了，不能与敌人战斗。还是多休息休息吧。\n";
    		exit();
    	}
	$location_info = mysql_query("SELECT location,location_id FROM misc WHERE id='$user_id'");  	
	$location_id = mysql_result($location_info,0,"location_id");
	$location = mysql_result($location_info,0,"location");
	echo "<center><font color=#6A03D1>返回==><a href=$location_id>【".$location."】</a></font>\n";
	echo "</center><hr width=80%>\n";
	$my_info = mysql_query("SELECT name,exp,hpnow,ennow,ponow,cha,pos,str,zhi,con,pur,spe,yun,icon,org,mon,nick,sex FROM renwu_member WHERE id='$user_id'");
	//自己的基本信息
	$my_exp_info = mysql_result($my_info,0,"exp");
	$my_hpnow_info = mysql_result($my_info,0,"hpnow");
	$my_ennow_info = mysql_result($my_info,0,"ennow");
	$my_ponow_info = mysql_result($my_info,0,"ponow");
	$my_pos_info = mysql_result($my_info,0,"pos");
	$my_str_info = mysql_result($my_info,0,"str");
	$my_zhi_info = mysql_result($my_info,0,"zhi");
	$my_con_info = mysql_result($my_info,0,"con");
	$my_spe_info = mysql_result($my_info,0,"spe");
	$my_yun_info = mysql_result($my_info,0,"yun");
	$my_icon_info = mysql_result($my_info,0,"icon");
	$my_org_info = mysql_result($my_info,0,"org");
	$my_mon_info = mysql_result($my_info,0,"mon");
	$my_nick_info = mysql_result($my_info,0,"nick");
	$my_name_info = mysql_result($my_info,0,"name");
	$my_cha_info = mysql_result($my_info,0,"cha");
	$my_pur_info = mysql_result($my_info,0,"pur");
	$my_sex_info = mysql_result($my_info,0,"sex");
	//自己的武功信息
		//手上武功
	$my_wugong_info = @mysql_query("SELECT wugongid,wugongexp FROM renwu_wugong WHERE id='$user_id' AND used='Y' AND cla<>'轻功' AND cla<>'内功'");
	$my_swgid_wugong_info = @mysql_result($my_wugong_info,0,"wugongid");
	$my_swgexp_wugong_info = @mysql_result($my_wugong_info,0,"wugongexp");
	$my_wugong_info = @mysql_query("SELECT name,at,de,zao1,zao2,zao3,zao4,zao5,wep FROM wugong_gongfu WHERE id='$my_swgid_wugong_info'");
	$my_swgname = @mysql_result($my_wugong_info,0,"name");
	$my_swgat = @mysql_result($my_wugong_info,0,"at");
	$my_swgde = @mysql_result($my_wugong_info,0,"de");
	$my_swgzao[1] = @mysql_result($my_wugong_info,0,"zao1");
	$my_swgzao[2] = @mysql_result($my_wugong_info,0,"zao2");
	$my_swgzao[3] = @mysql_result($my_wugong_info,0,"zao3");
	$my_swgzao[4] = @mysql_result($my_wugong_info,0,"zao4");
	$my_swgzao[5] = @mysql_result($my_wugong_info,0,"zao5");
	$my_wep = @mysql_result($my_wugong_info,0,"wep");
		//内功
	$my_wugong_info = @mysql_query("SELECT wugongid,wugongexp FROM renwu_wugong WHERE id='$user_id' AND used='Y' AND cla='内功'");
	$my_nwgid_wugong_info = @mysql_result($my_wugong_info,0,"wugongid");
	$my_nwgexp_wugong_info = @mysql_result($my_wugong_info,0,"wugongexp");
	$my_wugong_info = @mysql_query("SELECT name,at,de FROM wugong_gongfu WHERE id='$my_nwgid_wugong_info'");
	$my_nwgname = @mysql_result($my_wugong_info,0,"name");
	$my_nwgat = @mysql_result($my_wugong_info,0,"at");
	$my_nwgde = @mysql_result($my_wugong_info,0,"de");
		//轻功
	$my_wugong_info = @mysql_query("SELECT wugongid,wugongexp FROM renwu_wugong WHERE id='$user_id' AND used='Y' AND cla='轻功'");
	$my_qwgid_wugong_info = @mysql_result($my_wugong_info,0,"wugongid");
	$my_qwgexp_wugong_info = @mysql_result($my_wugong_info,0,"wugongexp");
	$my_wugong_info = @mysql_query("SELECT name,at,de,zao1,zao2,zao3,zao4,zao5 FROM wugong_gongfu WHERE id='$my_qwgid_wugong_info'");
	$my_qwgname = @mysql_result($my_wugong_info,0,"name");
	$my_qwgat = @mysql_result($my_wugong_info,0,"at");
	$my_qwgde = @mysql_result($my_wugong_info,0,"de");
	$my_qwgzao[1] = @mysql_result($my_wugong_info,0,"zao1");
	$my_qwgzao[2] = @mysql_result($my_wugong_info,0,"zao2");
	$my_qwgzao[3] = @mysql_result($my_wugong_info,0,"zao3");
	$my_qwgzao[4] = @mysql_result($my_wugong_info,0,"zao4");
	$my_qwgzao[5] = @mysql_result($my_wugong_info,0,"zao5");
	
	
	$e_info = mysql_query("SELECT name,exp,hpnow,ennow,ponow,cha,pos,str,zhi,con,pur,spe,yun,icon,org,mon,nick FROM npc_member WHERE id='$b_id'");
	//自己的基本信息
	$e_exp_info = mysql_result($e_info,0,"exp");
	$e_hpnow_info = mysql_result($e_info,0,"hpnow");
	$e_ennow_info = mysql_result($e_info,0,"ennow");
	$e_ponow_info = mysql_result($e_info,0,"ponow");
	$e_pos_info = mysql_result($e_info,0,"pos");
	$e_str_info = mysql_result($e_info,0,"str");
	$e_zhi_info = mysql_result($e_info,0,"zhi");
	$e_con_info = mysql_result($e_info,0,"con");
	$e_spe_info = mysql_result($e_info,0,"spe");
	$e_yun_info = mysql_result($e_info,0,"yun");
	$e_icon_info = mysql_result($e_info,0,"icon");
	$e_org_info = mysql_result($e_info,0,"org");
	$e_mon_info = mysql_result($e_info,0,"mon");
	$e_nick_info = mysql_result($e_info,0,"nick");
	$e_name_info = mysql_result($e_info,0,"name");
	$e_cha_info = mysql_result($e_info,0,"cha");
	$e_pur_info = mysql_result($e_info,0,"pur");
	//自己的武功信息
		//手上武功
	$e_wugong_info = @mysql_query("SELECT wg_s FROM npc_member WHERE id='$b_id'");
	$e_swgid_wugong_info = @mysql_result($e_wugong_info,0,"wg_s");
	$e_wugong_info = @mysql_query("SELECT name,at,de,zao1,zao2,zao3,zao4,zao5,wep FROM wugong_gongfu WHERE id='$e_swgid_wugong_info'");
	$e_swgname = @mysql_result($e_wugong_info,0,"name");
	$e_swgat = @mysql_result($e_wugong_info,0,"at");
	$e_swgde = @mysql_result($e_wugong_info,0,"de");
	$e_swgzao[1] = @mysql_result($e_wugong_info,0,"zao1");
	$e_swgzao[2] = @mysql_result($e_wugong_info,0,"zao2");
	$e_swgzao[3] = @mysql_result($e_wugong_info,0,"zao3");
	$e_swgzao[4] = @mysql_result($e_wugong_info,0,"zao4");
	$e_swgzao[5] = @mysql_result($e_wugong_info,0,"zao5");
	$e_wep = @mysql_result($e_wugong_info,0,"wep");
		//内功
	$e_wugong_info = @mysql_query("SELECT wg_n FROM npc_member WHERE id='$b_id'");
	$e_nwgid_wugong_info = @mysql_result($e_wugong_info,0,"wg_n");
	$e_wugong_info = @mysql_query("SELECT name,at,de FROM wugong_gongfu WHERE id='$e_nwgid_wugong_info'");
	$e_nwgname = @mysql_result($e_wugong_info,0,"name");
	$e_nwgat = @mysql_result($e_wugong_info,0,"at");
	$e_nwgde = @mysql_result($e_wugong_info,0,"de");
		//轻功
	$e_wugong_info = @mysql_query("SELECT wg_q FROM npc_member WHERE id='$b_id'");
	$e_qwgid_wugong_info = @mysql_result($e_wugong_info,0,"wg_q");
	$e_wugong_info = @mysql_query("SELECT name,at,de,zao1,zao2,zao3,zao4,zao5 FROM wugong_gongfu WHERE id='$e_qwgid_wugong_info'");
	$e_qwgname = @mysql_result($e_wugong_info,0,"name");
	$e_qwgat = @mysql_result($e_wugong_info,0,"at");
	$e_qwgde = @mysql_result($e_wugong_info,0,"de");
	$e_qwgzao[1] = @mysql_result($e_wugong_info,0,"zao1");
	$e_qwgzao[2] = @mysql_result($e_wugong_info,0,"zao2");
	$e_qwgzao[3] = @mysql_result($e_wugong_info,0,"zao3");
	$e_qwgzao[4] = @mysql_result($e_wugong_info,0,"zao4");
	$e_qwgzao[5] = @mysql_result($e_wugong_info,0,"zao5");
	
	if(empty($my_swgid_wugong_info)) $my_swgid_wugong_info = "n";
	if(empty($my_nwgid_wugong_info)) $my_nwgid_wugong_info = "n";
	if(empty($my_qwgid_wugong_info)) $my_qwgid_wugong_info = "n";
	
	if(empty($e_swgid_wugong_info)) $e_swgid_wugong_info = "n";
	if(empty($e_nwgid_wugong_info)) $e_nwgid_wugong_info = "n";
	if(empty($e_qwgid_wugong_info)) $e_qwgid_wugong_info = "n";
	
		
	$my_use_neili = mysql_query("SELECT use_neili FROM misc WHERE id='$user_id'");
	$my_use_neili = mysql_result($my_use_neili,0,"use_neili");
	
	
	////////////////////////////
	
	echo "<table border=0 cellpadding=0 cellspacing=0 bordercolor=#111111 width=100%>\n";
	echo "<tr><td width=40%>\n";
	echo "<img src=".$pic2_url."/".$my_icon_info.".jpg border=0></img><br>".$my_org_info.$my_cha_info.$my_nick_info.$my_name_info;
	echo "</font></td>\n";
	echo "<td width=10%><font color=red>&nbsp;<h4>VS</h4>&nbsp;</td>\n";
	echo "<td width=40%>\n";
	echo $e_org_info.$e_cha_info.$e_nick_info.$e_name_info."<img src=".$npcpic_url."/".$e_icon_info.".jpg border=0 style=\"float:right\"></img><br>";
	echo "</td>\n";
	echo "</tr>\n";
	echo "</table>\n";
	
	$my_atdamage = $my_str_info;
	$e_atdamage = $e_str_info;
		
	$my_rec = $my_con_info + $my_spe_info;
	$e_rec = $e_con_info + $e_spe_info;
	
	switch($my_cha_info){
		case "勇猛":$my_atdamage += 15; $my_rec -= 5;break;
		case "和平":$my_atdamage += 3; $my_rec += 3;break;
		case "胆小":$my_rec += 15; $my_atdamage -= 5;break;
		case "冷酷":$my_rec += 4; $my_atdamage -= 7;break;
		case "激情":$my_rec += 7; $my_atdamage -= 4;break;
	}
	
	$my_vs_info = "你";
	$e_vs_info = $e_name_info;
	
	//物品使用
	$my_wupin_tou = @mysql_query("SELECT wupinid,sk FROM renwu_wupin WHERE id='$user_id' AND cla='头' AND used='Y'");
	$my_wupin_tou_id = @mysql_result($my_wupin_tou,0,"wupinid");
	$my_wupin_tou_sk = @mysql_result($my_wupin_tou,0,"sk");
	
	if(empty($my_wupin_tou_id)) $my_wupin_tou_id = "n";
	
	$my_wupin_xiong = @mysql_query("SELECT wupinid,sk FROM renwu_wupin WHERE id='$user_id' AND cla='胸' AND used='Y'");
	$my_wupin_xiong_id = @mysql_result($my_wupin_xiong,0,"wupinid");
	$my_wupin_xiong_sk = @mysql_result($my_wupin_xiong,0,"sk");
	
	if(empty($my_wupin_xiong_id)) $my_wupin_xiong_id = "n";
	
	$my_wupin_shou = @mysql_query("SELECT wupinid,sk FROM renwu_wupin WHERE id='$user_id' AND cla='手' AND used='Y'");
	$my_wupin_shou_id = @mysql_result($my_wupin_shou,0,"wupinid");
	$my_wupin_shou_sk = @mysql_result($my_wupin_shou,0,"sk");
	
	if(empty($my_wupin_shou_id)) $my_wupin_shou_id = "n";
	
	$my_wupin_tui = @mysql_query("SELECT wupinid,sk FROM renwu_wupin WHERE id='$user_id' AND cla='腿' AND used='Y'");
	$my_wupin_tui_id = @mysql_result($my_wupin_tui,0,"wupinid");
	$my_wupin_tui_sk = @mysql_result($my_wupin_tui,0,"sk");
	
	if(empty($my_wupin_tui_id)) $my_wupin_tui_id = "n";
	
	///////////////////////////////////////////////////////////
	$e_wupin_tou = @mysql_query("SELECT tou FROM npc_member WHERE id='$b_id'");
	$e_wupin_tou_id = @mysql_result($e_wupin_tou,0,"tou");
	if(empty($e_wupin_tou_id)) $e_wupin_tou_id = "n";
	
	$e_wupin_xiong = @mysql_query("SELECT shen FROM npc_member WHERE id='$b_id'");
	$e_wupin_xiong_id = @mysql_result($e_wupin_xiong,0,"shen");
	if(empty($e_wupin_xiong_id)) $e_wupin_xiong_id = "n";
	
	$e_wupin_shou = @mysql_query("SELECT shou FROM npc_member WHERE id='$b_id'");
	$e_wupin_shou_id = @mysql_result($e_wupin_shou,0,"shou");
	if(empty($e_wupin_shou_id)) $e_wupin_shou_id = "n";
	
	$e_wupin_tui = @mysql_query("SELECT tui FROM npc_member WHERE id='$b_id'");
	$e_wupin_tui_id = @mysql_result($e_wupin_tui,0,"tui");
	if(empty($e_wupin_tui_id)) $e_wupin_tui_id = "n";
	////////////////////////////////////////////////////////
	
	if($my_wupin_tou_id != "n"){
		$my_wupin_tou_info = mysql_query("SELECT name,at,de,sp FROM zhuangbei_wupin WHERE id='$my_wupin_tou_id'");
		$my_wupin_tou_name = mysql_result($my_wupin_tou_info,0,"name");
		$my_wupin_tou_at = mysql_result($my_wupin_tou_info,0,"at");
		$my_wupin_tou_de = mysql_result($my_wupin_tou_info,0,"de");
		$my_wupin_sp = mysql_result($my_wupin_tou_info,0,"sp");
		$my_atdamage += $my_wupin_tou_at + $my_wupin_tou_sk;
		$my_rec += $my_wupin_tou_de + $my_wupin_tou_sk;
		switch($my_wupin_sp){
		 	case "中毒": $my_atdamage += 3 + rand(0,$my_wupin_tou_sk); break;
		 	case "解毒": $my_rec += 3 + rand(0,$my_wupin_tou_sk); break;
		 	case "治疗": $my_hpnow += 2 + rand(0,$my_wupin_tou_sk); break;
		 	case "損血": $my_hpnow -= 2 - rand(0,$my_wupin_tou_sk); break;
		 	case "缓慢": $my_rec -= 2 - rand(0,$my_wupin_tou_sk); break;
		 	case "快速": $my_atdamage += 2 + rand(0,$my_wupin_tou_sk); break;
		 	case "快乐": $my_hpnow += 1 + rand(0,$my_wupin_tou_sk);
		}
		if($my_wupin_sp != ""){
			$my_vs_info .= "头戴可<font color=#9999FF>".$my_wupin_sp."</font>的<font color=#666633>".$my_wupin_tou_name."</font>\n";
		}else	$my_vs_info .= "头戴<font color=#666633>".$my_wupin_tou_name."</font>\n";
	}
	if($my_wupin_xiong_id != "n"){
		$my_wupin_xiong_info = mysql_query("SELECT name,at,de,sp FROM zhuangbei_wupin WHERE id='$my_wupin_xiong_id'");
		$my_wupin_xiong_name = mysql_result($my_wupin_xiong_info,0,"name");
		$my_wupin_xiong_at = mysql_result($my_wupin_xiong_info,0,"at");
		$my_wupin_xiong_de = mysql_result($my_wupin_xiong_info,0,"de");
		$my_wupin_sp = mysql_result($my_wupin_xiong_info,0,"sp");
		$my_atdamage += $my_wupin_xiong_at + $my_wupin_xiong_sk;
		$my_rec += $my_wupin_xiong_de + $my_wupin_xiong_sk;
		switch($my_wupin_sp){
		 	case "中毒": $my_atdamage += 3 + rand(0,$my_wupin_xiong_sk); break;
		 	case "解毒": $my_rec += 3 + rand(0,$my_wupin_xiong_sk); break;
		 	case "治疗": $my_hpnow += 2 + rand(0,$my_wupin_xiong_sk); break;
		 	case "損血": $my_hpnow -= 2 - rand(0,$my_wupin_xiong_sk); break;
		 	case "缓慢": $my_rec -= 2 - rand(0,$my_wupin_xiong_sk); break;
		 	case "快速": $my_atdamage += 2 + rand(0,$my_wupin_xiong_sk); break;
		 	case "快乐": $my_hpnow += 1 + rand(0,$my_wupin_xiong_sk);
		}
		if($my_wupin_sp != ""){
			$my_vs_info .= "胸配可<font color=#9999FF>".$my_wupin_sp."</font>的<font color=#666633>".$my_wupin_xiong_name."</font>\n";
		}else	$my_vs_info .= "胸配<font color=#666633>".$my_wupin_xiong_name."</font>\n";
	}
	if($my_wupin_shou_id != "n"){
		$my_wupin_shou_info = mysql_query("SELECT name,at,de,sp FROM zhuangbei_wupin WHERE id='$my_wupin_shou_id'");
		$my_wupin_shou_name = mysql_result($my_wupin_shou_info,0,"name");
		$my_wupin_shou_at = mysql_result($my_wupin_shou_info,0,"at");
		$my_wupin_shou_de = mysql_result($my_wupin_shou_info,0,"de");
		$my_wupin_sp = mysql_result($my_wupin_shou_info,0,"sp");
		$my_atdamage += $my_wupin_shou_at + $my_wupin_shou_sk;
		$my_rec += $my_wupin_shou_de + $my_wupin_shou_sk;
		switch($my_wupin_sp){
		 	case "中毒": $my_atdamage += 3 + rand(0,$my_wupin_shou_sk); break;
		 	case "解毒": $my_rec += 3 + rand(0,$my_wupin_shou_sk); break;
		 	case "治疗": $my_hpnow += 2 + rand(0,$my_wupin_shou_sk); break;
		 	case "損血": $my_hpnow -= 2 - rand(0,$my_wupin_shou_sk); break;
		 	case "缓慢": $my_rec -= 2 - rand(0,$my_wupin_shou_sk); break;
		 	case "快速": $my_atdamage += 2 + rand(0,$my_wupin_shou_sk); break;
		 	case "快乐": $my_hpnow += 1 + rand(0,$my_wupin_shou_sk);
		}
		if($my_wupin_sp != ""){
			$my_vs_info .= "手戴可<font color=#9999FF>".$my_wupin_sp."</font>的<font color=#666633>".$my_wupin_shou_name."</font>\n";
		}else	$my_vs_info .= "手戴<font color=#666633>".$my_wupin_shou_name."</font>\n";
	}
	if($my_wupin_tui_id != "n"){
		$my_wupin_tui_info = mysql_query("SELECT name,at,de,sp FROM zhuangbei_wupin WHERE id='$my_wupin_tui_id'");
		$my_wupin_tui_name = mysql_result($my_wupin_tui_info,0,"name");
		$my_wupin_tui_at = mysql_result($my_wupin_tui_info,0,"at");
		$my_wupin_tui_de = mysql_result($my_wupin_tui_info,0,"de");
		$my_wupin_sp = mysql_result($my_wupin_tui_info,0,"sp");
		$my_atdamage += $my_wupin_tui_at + $my_wupin_tui_sk;
		$my_rec += $my_wupin_tui_de + $my_wupin_tui_sk;
		switch($my_wupin_sp){
		 	case "中毒": $my_atdamage += 3 + rand(0,$my_wupin_tui_sk); break;
		 	case "解毒": $my_rec += 3 + rand(0,$my_wupin_tui_sk); break;
		 	case "治疗": $my_hpnow += 2 + rand(0,$my_wupin_tui_sk); break;
		 	case "損血": $my_hpnow -= 2 - rand(0,$my_wupin_tui_sk); break;
		 	case "缓慢": $my_rec -= 2 - rand(0,$my_wupin_tui_sk); break;
		 	case "快速": $my_atdamage += 2 + rand(0,$my_wupin_tui_sk); break;
		 	case "快乐": $my_hpnow += 1 + rand(0,$my_wupin_tui_sk);
		}
		if($my_wupin_sp != ""){
			$my_vs_info .= "腿绑可<font color=#9999FF>".$my_wupin_sp."</font>的<font color=#666633>".$my_wupin_tui_name."</font>\n";
		}else	$my_vs_info .= "腿绑<font color=#666633>".$my_wupin_tui_name."</font>\n";
	}
	///////////////////////////////////////////////////////////
	if($e_wupin_tou_id != "n"){
		$e_wupin_tou_info = mysql_query("SELECT name,at,de,sp FROM zhuangbei_wupin WHERE id='$e_wupin_tou_id'");
		$e_wupin_tou_name = mysql_result($e_wupin_tou_info,0,"name");
		$e_wupin_tou_at = mysql_result($e_wupin_tou_info,0,"at");
		$e_wupin_tou_de = mysql_result($e_wupin_tou_info,0,"de");
		$e_wupin_sp = mysql_result($e_wupin_tou_info,0,"sp");
		$e_atdamage += $e_wupin_tou_at + $e_wupin_tou_sk;
		$e_rec += $e_wupin_tou_de + $e_wupin_tou_sk;
		switch($e_wupin_sp){
		 	case "中毒": $e_atdamage += 3 + rand(0,$e_wupin_tou_sk); break;
		 	case "解毒": $e_rec += 3 + rand(0,$e_wupin_tou_sk); break;
		 	case "治疗": $e_hpnow += 2 + rand(0,$e_wupin_tou_sk); break;
		 	case "損血": $e_hpnow -= 2 - rand(0,$e_wupin_tou_sk); break;
		 	case "缓慢": $e_rec -= 2 - rand(0,$e_wupin_tou_sk); break;
		 	case "快速": $e_atdamage += 2 + rand(0,$e_wupin_tou_sk); break;
		 	case "快乐": $e_hpnow += 1 + rand(0,$e_wupin_tou_sk);
		}
		if($e_wupin_sp != ""){
			$e_vs_info .= "头戴可<font color=#9999FF>".$e_wupin_sp."</font>的<font color=#666633>".$e_wupin_tou_name."</font>\n";
		}else	$e_vs_info .= "头戴<font color=#666633>".$e_wupin_tou_name."</font>\n";
	}
	if($e_wupin_xiong_id != "n"){
		$e_wupin_xiong_info = mysql_query("SELECT name,at,de,sp FROM zhuangbei_wupin WHERE id='$e_wupin_xiong_id'");
		$e_wupin_xiong_name = mysql_result($e_wupin_xiong_info,0,"name");
		$e_wupin_xiong_at = mysql_result($e_wupin_xiong_info,0,"at");
		$e_wupin_xiong_de = mysql_result($e_wupin_xiong_info,0,"de");
		$e_wupin_sp = mysql_result($e_wupin_xiong_info,0,"sp");
		$e_atdamage += $e_wupin_xiong_at + $e_wupin_xiong_sk;
		$e_rec += $e_wupin_xiong_de + $e_wupin_xiong_sk;
		switch($e_wupin_sp){
		 	case "中毒": $e_atdamage += 3 + rand(0,$e_wupin_xiong_sk); break;
		 	case "解毒": $e_rec += 3 + rand(0,$e_wupin_xiong_sk); break;
		 	case "治疗": $e_hpnow += 2 + rand(0,$e_wupin_xiong_sk); break;
		 	case "損血": $e_hpnow -= 2 - rand(0,$e_wupin_xiong_sk); break;
		 	case "缓慢": $e_rec -= 2 - rand(0,$e_wupin_xiong_sk); break;
		 	case "快速": $e_atdamage += 2 + rand(0,$e_wupin_xiong_sk); break;
		 	case "快乐": $e_hpnow += 1 + rand(0,$e_wupin_xiong_sk);
		}
		if($e_wupin_sp != ""){
			$e_vs_info .= "胸配可<font color=#9999FF>".$e_wupin_sp."</font>的<font color=#666633>".$e_wupin_xiong_name."</font>\n";
		}else	$e_vs_info .= "胸配<font color=#666633>".$e_wupin_xiong_name."</font>\n";
	}
	if($e_wupin_shou_id != "n"){
		$e_wupin_shou_info = mysql_query("SELECT name,at,de,sp FROM zhuangbei_wupin WHERE id='$e_wupin_shou_id'");
		$e_wupin_shou_name = mysql_result($e_wupin_shou_info,0,"name");
		$e_wupin_shou_at = mysql_result($e_wupin_shou_info,0,"at");
		$e_wupin_shou_de = mysql_result($e_wupin_shou_info,0,"de");
		$e_wupin_sp = mysql_result($e_wupin_shou_info,0,"sp");
		$e_atdamage += $e_wupin_shou_at + $e_wupin_shou_sk;
		$e_rec += $e_wupin_shou_de + $e_wupin_shou_sk;
		switch($e_wupin_sp){
		 	case "中毒": $e_atdamage += 3 + rand(0,$e_wupin_shou_sk); break;
		 	case "解毒": $e_rec += 3 + rand(0,$e_wupin_shou_sk); break;
		 	case "治疗": $e_hpnow += 2 + rand(0,$e_wupin_shou_sk); break;
		 	case "損血": $e_hpnow -= 2 - rand(0,$e_wupin_shou_sk); break;
		 	case "缓慢": $e_rec -= 2 - rand(0,$e_wupin_shou_sk); break;
		 	case "快速": $e_atdamage += 2 + rand(0,$e_wupin_shou_sk); break;
		 	case "快乐": $e_hpnow += 1 + rand(0,$e_wupin_shou_sk);
		}
		if($e_wupin_sp != ""){
			$e_vs_info .= "手戴可<font color=#9999FF>".$e_wupin_sp."</font>的<font color=#666633>".$e_wupin_shou_name."</font>\n";
		}else	$e_vs_info .= "手戴<font color=#666633>".$e_wupin_shou_name."</font>\n";
	}
	if($e_wupin_tui_id != "n"){
		$e_wupin_tui_info = mysql_query("SELECT name,at,de,sp FROM zhuangbei_wupin WHERE id='$e_wupin_tui_id'");
		$e_wupin_tui_name = mysql_result($e_wupin_tui_info,0,"name");
		$e_wupin_tui_at = mysql_result($e_wupin_tui_info,0,"at");
		$e_wupin_tui_de = mysql_result($e_wupin_tui_info,0,"de");
		$e_wupin_sp = mysql_result($e_wupin_tui_info,0,"sp");
		$e_atdamage += $e_wupin_tui_at + $e_wupin_tui_sk;
		$e_rec += $e_wupin_tui_de + $e_wupin_tui_sk;
		switch($e_wupin_sp){
		 	case "中毒": $e_atdamage += 3 + rand(0,$e_wupin_tui_sk); break;
		 	case "解毒": $e_rec += 3 + rand(0,$e_wupin_tui_sk); break;
		 	case "治疗": $e_hpnow += 2 + rand(0,$e_wupin_tui_sk); break;
		 	case "損血": $e_hpnow -= 2 - rand(0,$e_wupin_tui_sk); break;
		 	case "缓慢": $e_rec -= 2 - rand(0,$e_wupin_tui_sk); break;
		 	case "快速": $e_atdamage += 2 + rand(0,$e_wupin_tui_sk); break;
		 	case "快乐": $e_hpnow += 1 + rand(0,$e_wupin_tui_sk);
		}
		if($e_wupin_sp != ""){
			$e_vs_info .= "腿绑可<font color=#9999FF>".$e_wupin_sp."</font>的<font color=#666633>".$e_wupin_tui_name."</font>\n";
		}else	$e_vs_info .= "腿绑<font color=#666633>".$e_wupin_tui_name."</font>\n";
	}
	
	//武器使用
	$my_wuqi = @mysql_query("SELECT wuqiid,sk,cla FROM renwu_wuqi WHERE id='$user_id' AND used='Y'");
	$my_wuqi_id = @mysql_result($my_wuqi,0,"wuqiid");
	$my_wuqi_sk = @mysql_result($my_wuqi,0,"sk");
	$my_wuqi_cla = @mysql_result($my_wuqi,0,"cla");
	
	if(empty($my_wuqi_id)) $my_wuqi_id = "n";
	
	
	//========================================================
	
	$e_wuqi = @mysql_query("SELECT wuqi FROM npc_member WHERE id='$b_id'");
	$e_wuqi_id = @mysql_result($e_wuqi,0,"wuqi");
	$e_wuqi_cla = @mysql_query("SELECT cla FROM zhuangbei_wuqi WHERE id='$e_wuqi_id'");
	$e_wuqi_cla = @mysql_result($e_wuqi_cla,0,"cla");
	if(empty($e_wuqi_id)) $e_wuqi_id = "n";
	
	//=========================================================
	
	if($my_wuqi_id != "n"){
		$my_wuqi_info = mysql_query("SELECT name,at,de FROM zhuangbei_wuqi WHERE id='$my_wuqi_id'");
		$my_wuqi_name = mysql_result($my_wuqi_info,0,"name");
		$my_wuqi_at = mysql_result($my_wuqi_info,0,"at");
		$my_wuqi_de = mysql_result($my_wuqi_info,0,"de");
		$my_atdamage += $my_wuqi_at + $my_wuqi_sk;
		$my_rec += $my_wuqi_de + $my_wuqi_sk;
		
		$my_vs_info .= "手持<font color=#FF9900>".$my_wuqi_name."</font>\n";
	}
	
	if($e_wuqi_id != "n"){
		$e_wuqi_info = mysql_query("SELECT name,at,de FROM zhuangbei_wuqi WHERE id='$e_wuqi_id'");
		$e_wuqi_name = mysql_result($e_wuqi_info,0,"name");
		$e_wuqi_at = mysql_result($e_wuqi_info,0,"at");
		$e_wuqi_de = mysql_result($e_wuqi_info,0,"de");
		$e_atdamage += $e_wuqi_at + $e_wuqi_sk;
		$e_rec += $e_wuqi_de + $e_wuqi_sk;
		
		$e_vs_info .= "手持<font color=#FF9900>".$e_wuqi_name."</font>\n";
	}
	
	if($my_swgid_wugong_info != "n"){		
		if($my_wep == $my_wuqi_cla){
		$my_atdamage += $my_swgat + intval($my_swgexp_wugong_info/50);
		$my_rec += $my_swgde + intval($my_swgexp_wugong_info/50);
		$my_vs_info .= "使出<font color=#000080>".$my_swgname."</font>\n";
		}else{
		$my_atdamage += intval($my_swgat/10) + intval($my_swgexp_wugong_info/50);
		$my_rec += intval($my_swgde/10) + intval($my_swgexp_wugong_info/50);
		$my_vs_info .= "（可不能发挥<font color=#000080>".$my_swgname."</font>的全部威力）\n";
		}
	}
	if($e_swgid_wugong_info != "n"){		
		if($e_wep == $e_wuqi_cla){
		$e_atdamage += intval($e_swgat/10) + intval($e_swgexp_wugong_info/50);
		$e_rec += intval($e_swgde/10) + intval($e_swgexp_wugong_info/50);
		$e_vs_info .= "使出<font color=#000080>".$e_swgname."</font>\n";
		}else{
		$e_vs_info .= "（可不能发挥<font color=#000080>".$e_swgname."</font>的全部威力）\n";
		}
	}
	
	if($my_nwgid_wugong_info != "n"){		
		$my_atdamage += $my_nwgat + intval($my_nwgexp_wugong_info/50);
		$my_rec += $my_nwgde + intval($my_nwgexp_wugong_info/50);
		$my_vs_info .= "运起<font color=#800>".$my_nwgname."</font>\n";
	}
	if($e_nwgid_wugong_info != "n"){		
		$e_atdamage += $e_nwgat + intval($e_nwgexp_wugong_info/50);
		$e_rec += $e_nwgde + intval($e_nwgexp_wugong_info/50);
		$e_vs_info .= "运起<font color=#800>".$e_nwgname."</font>\n";
	}
	
	if($my_qwgid_wugong_info != "n"){		
		$my_atdamage += $my_qwgat + intval($my_qwgexp_wugong_info/50);
		$my_rec += $my_qwgde + intval($my_qwgexp_wugong_info/50);
		$my_vs_info .= "脚踏<font color=#800000>".$my_qwgname."</font>\n";
	}
	if($e_qwgid_wugong_info != "n"){		
		$e_atdamage += $e_qwgat + intval($e_qwgexp_wugong_info/50);
		$e_rec += $e_qwgde + intval($e_qwgexp_wugong_info/50);
		$e_vs_info .= "脚踏<font color=#800000>".$e_qwgname."</font>\n";
	}
	
	$my_atdamage += intval($my_exp_info/100);
	$e_atdamage += intval($e_exp_info/100);
	$my_rec += intval($my_exp_info/10000);
	$e_rec += intval($e_exp_info/10000);
	
	$my_vs_info .= "开始发动攻击。\n<br>";
	$e_vs_info .= "开始发动攻击。\n";
	
	echo "<hr align=center width=80%>\n";
	echo $my_vs_info;
	echo $e_vs_info;	
	echo "<hr align=center width=80%>\n";
	
	
	while($my_hpnow_info > 0){
	
	$huihe_num += 1;
	if($huihe_num > 30){
		if(rand(0,1)){
		echo "<p><font color=red>只见你跳出战圈，收拳回气说道：今日能遇见".$e_name_info."你这样能与我旗鼓相当的对手也算我们有缘分，不如我们歇歇再战？</font>\n";
		echo "<br><font color=green>".$e_name_info."见你拆招，也即刻退出了战圈。</font>\n";
		}else{
		echo "<p><font color=red>".$e_name_info."一个急退，跳出战圈，收拳回气说道：今日能遇见".$my_name_info."你这样能与我旗鼓相当的对手也算我们有缘分，不如我们歇歇再战？</font>\n";
		echo "<p><font color=green>你见".$e_name_info."拆招，也即刻退出了战圈。</font>\n";		
		}
		echo "<h3 color=red align=center>你与".$e_name_info."来回三十招，可还是没有分出胜负！</h3>\n";
		$batten_info = $e_org_info.$e_name_info."与你进行决斗，三十回合后仍然没有分出胜负。\n";
		mysql_query("UPDATE misc SET person_info='$batten_info' WHERE id='$user_id'");
		$batten_info = $my_org_info.$my_name_info."与你进行决斗，三十回合后仍然没有分出胜负。\n";
				
		echo "<center><font color=#6A03D1>返回==><a href=$location_id>【".$location."】</a></font>\n";
		mysql_close();
		exit();
	}
	
	if($my_ennow_info > $my_use_neili){
	$my_damage = $my_atdamage - $e_atdamage + rand(0,$my_yun_info)*2 + $my_use_neili;
	$my_ennow_info -= $my_use_neili;
	}
	else
	$my_damage = $my_atdamage - $e_atdamage + rand(0,$my_yun_info)*2;
	
	//echo "<font color=red>自己调试攻击力</font>".$my_damage;
	//echo "<font color=red>自己调试防御力</font>".$my_rec;
	
	if($my_damage < 0) $my_damage = 1;
	else $my_damage -= $e_rec + rand(0,$my_yun_info)*2;
	if($my_damage < 0) $my_damage = 1;
	
	///////////////////////////////////////////////////////////
	$e_use_neili = $e_ennow_info/4;
	if($e_ennow_info > $e_use_neili){	
	$e_damage = $e_atdamage - $my_atdamage + rand(0,$e_yun_info)*2 + $e_use_neili;
	$e_ennow_info -= $e_use_neili;
	}
	else
	$e_damage = $e_atdamage - $my_atdamage + rand(0,$e_yun_info)*2;	
	
	//echo "<font color=red>敌人调试攻击力</font>".$e_damage;
	//echo "<font color=red>敌人调试防御力</font>".$e_rec;
	
	if($e_damage < 0) $e_damage = 1;
	else $e_damage -= $my_rec + rand(0,$e_yun_info)*2;
	if($e_damage < 0) $e_damage = 1;	
	
		
		switch(rand(0,4)){
			case "0":echo "<br>你注视着".$e_name_info."的行动，企图寻找机会出手。\n";break;
			case "1":echo "<br>你正盯着".$e_name_info."的一举一动，随时准备发动攻势。\n";break;
			case "2":echo "<br>你缓缓地移动脚步，想要找出".$e_name_info."的破绽。\n";break;
			case "3":echo "<br>你目不转睛地盯着".$e_name_info."的动作，寻找进攻的最佳时机。\n";break;
			case "4":echo "<br>你慢慢地移动着脚步，伺机出手。\n";break;
		}
		if($my_swgid_wugong_info != "n"){			
			$my_hpnow_info -= $e_damage;
			$e_hpnow_info -= $my_damage;
			
			echo "<br><font color=#cococo>你使出</font><font color=#000080>".$my_swgname."</font><font color=#cococo>的</font><font color=#9999FF>".$my_swgzao[strval(rand(1,5))]."</font><font color=#cococo>，向".$e_name_info."攻去。</font>\n";
			}else{
			$my_hpnow_info -= $e_damage;
			$e_hpnow_info -= $my_damage;
			
			echo "<br>你一阵拳脚向".$e_name_info."打去。\n";
			}
		switch(rand(0,4)){
			case "0":echo "<br>".$e_name_info."注视着你的行动，企图寻找机会出手。\n";break;
			case "1":echo "<br>".$e_name_info."正盯着你的一举一动，随时准备发动攻势。\n";break;
			case "2":echo "<br>".$e_name_info."缓缓地移动脚步，想要找出你的破绽。\n";break;
			case "3":echo "<br>".$e_name_info."目不转睛地盯着你的动作，寻找进攻的最佳时机。\n";break;
			case "4":echo "<br>".$e_name_info."慢慢地移动着脚步，伺机出手。\n";break;
		}
		if($e_qwgid_wugong_info != "n"){			
			echo "<br><font color=#808080>".$e_name_info."使出</font><font color=#800000>".$e_qwgname."</font><font color=#808080>的</font><font color=#CC99FF>".$e_qwgzao[strval(rand(1,5))]."</font><font color=#808080>，不停躲避你的攻势。</font>\n";
			}else{			
			echo "<br>只见".$e_name_info."乱手乱脚的抵挡着你的进攻。\n";
			}		
		if($e_swgid_wugong_info != "n"){			
			$my_hpnow_info -= $e_damage;
			$e_hpnow_info -= $my_damage;
			
			echo "<br><font color=#cococo>".$e_name_info."使出</font><font color=#000080>".$e_swgname."</font><font color=#cococo>的</font><font color=#9999FF>".$e_swgzao[strval(rand(1,5))]."</font><font color=#cococo>，向你袭来。</font>\n";
			}else{
			$my_hpnow_info -= $e_damage;
			$e_hpnow_info -= $my_damage;
			
			echo "<br>".$e_name_info."一阵拳脚向你打来。\n";
			}
		if($my_qwgid_wugong_info != "n"){			
			echo "<br><font color=#808080>你使出</font><font color=#800000>".$my_qwgname."</font><font color=#808080>的</font><font color=#CC99FF>".$my_qwgzao[strval(rand(1,5))]."</font><font color=#808080>，躲避".$e_name_info."的攻击。</font>\n";
			}else{			
			echo "<br>你乱手乱脚的抵挡着".$e_name_info."的进攻。\n";
			}
			
		
	if($my_hpnow_info < 0) $my_hpnow_info = -1;
	if($e_hpnow_info < 0) $e_hpnow_info = -1;
	
	include "include/batten_status.inc.php";
	
	$my_exp_info += 1;
		
	mysql_query("UPDATE renwu_member SET hpnow='$my_hpnow_info',exp='$my_exp_info',ennow='$my_ennow_info' WHERE id='$user_id'");
	mysql_query("UPDATE npc_member SET hpnow='$e_hpnow_info',ennow='$e_ennow_info' WHERE id='$b_id'");
	
	if($my_hpnow_info < 0){
		if($e_damage >= 2000){
		echo "<br><font color=#990033>你还没有看清".$e_name_info."的路数，就已经躺在了地上......</font>\n";
		echo "<br><font color=red>你严重受伤，昏死了过去.....</font>\n";
		echo "<br><font color=red>你的体力下降了....</font>\n";
		$my_hp_info = mysql_query("SELECT hp FROM renwu_member WHERE id='$user_id'");
		$my_hp_info = mysql_result($my_hp_info,0,"hp");
		$my_hp_info -= 1;
		mysql_query("UPDATE renwu_member SET hp='$my_hp_info' WHERE id='$user_id'");
		}else{
		echo "<br><font color=red>你只觉胸闷头晕，一口气就上不来了.....</font>\n";
		echo "<br>你昏了过去.....\n";
		}
		
		if($my_exp_info > $e_exp_info){
			$my_exp_info += rand(0,$my_zhi_info) + intval($e_exp_info/20000);
			if($my_pos_info >= 0 && $e_pos_info > 0){
				$my_pos_info -= 3;
			}
			if($my_pos_info < 0 && $e_pos_info < 0){
				$my_pos_info += 3;
			}
			if($my_pos_info < 0 && $e_pos_info > 0){
				$my_pos_info -= 3;
			}
			if($my_pos_info >= 0 && $e_pos_info < 0){
				$my_pos_info += 3;
			}
		}else{
			if($my_pos_info <= 0 && $e_pos_info < 0){
				if($my_pos_info >= $e_pos_info) $my_pos_info += intval($e_pos_info/500);
				else $my_pos_info -= 3;
			}
			if($my_pos_info < 0 && $e_pos_info > 0){
				$my_pos_info -= intval($e_pos_info/500);
				$my_pos_info -= 3;
			}
			if($my_pos_info > 0 && $e_pos_info > 0){
				if($my_pos_info > $e_pos_info) $my_pos_info -= intval($e_pos_info/500);
				else $my_pos_info -= 3;
			}
			if($my_pos_info >= 0 && $e_pos_info < 0){
				$my_pos_info -= intval($e_pos_info/500);
				$my_pos_info += 3;
			}
			$my_exp_info += $my_zhi_info + rand(0,$my_yun_info) + 5 + intval($e_exp_info/10000);
		}
		if($my_sex_info == "侠客" && $my_pos_info >=0){
		if($my_pos_info >= 500 && $my_pos_info < 1200 && $my_nick_info != "良民")	$my_nick_info = "良民";
		if($my_pos_info >= 1200 && $my_pos_info < 2000 && $my_nick_info != "小义士")	$my_nick_info = "小义士";
		if($my_pos_info >= 2000 && $my_pos_info < 3000 && $my_nick_info != "义士")	$my_nick_info = "义士";	
		if($my_pos_info >= 3000 && $my_pos_info < 4500 && $my_nick_info != "小侠客")	$my_nick_info = "小侠客";
		if($my_pos_info >= 4500 && $my_pos_info < 7500 && $my_nick_info != "侠义之士")	$my_nick_info = "侠义之士";
		if($my_pos_info >= 7500 && $my_pos_info < 11000 && $my_nick_info != "豪侠")	$my_nick_info = "豪侠";
		if($my_pos_info >= 11000 && $my_pos_info < 19000 && $my_nick_info != "大侠")	$my_nick_info = "大侠";
		if($my_pos_info >= 19000 && $my_pos_info < 30000 && $my_nick_info != "旷世大侠")	$my_nick_info = "旷世大侠";
		if($my_pos_info >= 30000 && $my_nick_info != "神侠")	$my_nick_info = "神侠";
		}else if($my_sex_info == "侠客" && $my_pos_info <0){
		if($my_pos_info < -500 && $my_pos_info > -1200 && $my_nick_info != "小贼")	$my_nick_info = "小贼";
		if($my_pos_info <= -1200 && $my_pos_info > -2000 && $my_nick_info != "混混")	$my_nick_info = "混混";
		if($my_pos_info <= -2000 && $my_pos_info > -3000 && $my_nick_info != "小恶霸")	$my_nick_info = "小恶霸";	
		if($my_pos_info <= -3000 && $my_pos_info > -4500 && $my_nick_info != "恶霸")	$my_nick_info = "恶霸";
		if($my_pos_info <= -4500 && $my_pos_info > -7500 && $my_nick_info != "万恶之人")	$my_nick_info = "万恶之人";
		if($my_pos_info <= -7500 && $my_pos_info > -11000 && $my_nick_info != "魔人")	$my_nick_info = "魔人";
		if($my_pos_info <= -11000 && $my_pos_info > -19000 && $my_nick_info != "邪魔")	$my_nick_info = "邪魔";
		if($my_pos_info <= -19000 && $my_pos_info > -30000 && $my_nick_info != "绝世邪魔")	$my_nick_info = "绝世邪魔";
		if($my_pos_info <= -30000 && $my_nick_info != "魔神")	$my_nick_info = "魔神";
		}
		if($my_sex_info == "侠女" && $my_pos_info >=0){
		if($my_pos_info >= 500 && $my_pos_info < 1200 && $my_nick_info != "良民")	$my_nick_info = "良民";
		if($my_pos_info >= 1200 && $my_pos_info < 2000 && $my_nick_info != "小义女")	$my_nick_info = "小义女";
		if($my_pos_info >= 2000 && $my_pos_info < 3000 && $my_nick_info != "义女")	$my_nick_info = "义女";	
		if($my_pos_info >= 3000 && $my_pos_info < 4500 && $my_nick_info != "小侠女")	$my_nick_info = "小侠女";
		if($my_pos_info >= 4500 && $my_pos_info < 7500 && $my_nick_info != "侠义女")	$my_nick_info = "侠义女";
		if($my_pos_info >= 7500 && $my_pos_info < 11000 && $my_nick_info != "女豪")	$my_nick_info = "女豪";
		if($my_pos_info >= 11000 && $my_pos_info < 19000 && $my_nick_info != "女侠")	$my_nick_info = "女侠";
		if($my_pos_info >= 19000 && $my_pos_info < 30000 && $my_nick_info != "旷世女侠")	$my_nick_info = "旷世女侠";
		if($my_pos_info >= 30000 && $my_nick_info != "女神侠")	$my_nick_info = "女神侠";
		}else if($my_sex_info == "侠女" && $my_pos_info <0){
		if($my_pos_info < -500 && $my_pos_info > -1200 && $my_nick_info != "小贼")	$my_nick_info = "小贼";
		if($my_pos_info <= -1200 && $my_pos_info > -2000 && $my_nick_info != "混混")	$my_nick_info = "混混";
		if($my_pos_info <= -2000 && $my_pos_info > -3000 && $my_nick_info != "小妖女")	$my_nick_info = "小妖女";	
		if($my_pos_info <= -3000 && $my_pos_info > -4500 && $my_nick_info != "妖女")	$my_nick_info = "妖女";
		if($my_pos_info <= -4500 && $my_pos_info > -7500 && $my_nick_info != "邪女")	$my_nick_info = "邪女";
		if($my_pos_info <= -7500 && $my_pos_info > -11000 && $my_nick_info != "魔女")	$my_nick_info = "魔女";
		if($my_pos_info <= -11000 && $my_pos_info > -19000 && $my_nick_info != "女邪魔")	$my_nick_info = "女邪魔";
		if($my_pos_info <= -19000 && $my_pos_info > -30000 && $my_nick_info != "绝世女邪魔")	$my_nick_info = "绝世女邪魔";
		if($my_pos_info <= -30000 && $my_nick_info != "女魔神")	$my_nick_info = "女魔神";
		}		
		$my_mon_info += 1;
		echo "<br><font color=#0000ff>你现在经验是".$my_exp_info."点了。</font>\n";
				
		switch($my_cha_info){
			case "勇猛":is_up($user_id,$my_exp_info,$my_str_info,$my_cha_info,$my_str_info,$my_zhi_info,$my_spe_info,$my_con_info,$my_pur_info);break;
			case "和平":is_up($user_id,$my_exp_info,$my_zhi_info,$my_cha_info,$my_str_info,$my_zhi_info,$my_spe_info,$my_con_info,$my_pur_info);break;
			case "胆小":is_up($user_id,$my_exp_info,$my_spe_info,$my_cha_info,$my_str_info,$my_zhi_info,$my_spe_info,$my_con_info,$my_pur_info);break;
			case "冷酷":is_up($user_id,$my_exp_info,$my_con_info,$my_cha_info,$my_str_info,$my_zhi_info,$my_spe_info,$my_con_info,$my_pur_info);break;
			case "激情":is_up($user_id,$my_exp_info,$my_pur_info,$my_cha_info,$my_str_info,$my_zhi_info,$my_spe_info,$my_con_info,$my_pur_info);break;
			}
		
		mysql_query("UPDATE renwu_member SET exp='$my_exp_info',pos='$my_pos_info',mon='$my_mon_info',nick='$my_nick_info' WHERE id='$user_id'");
		
		if($e_swgid_wugong_info != "n"){
		$batten_info = $e_org_info.$e_name_info."与你进行决斗，你实在不敌".$e_name_info."的".$e_swgname;
		}else
		$batten_info = $e_org_info.$e_name_info."与你进行决斗，你实在不敌".$e_name_info."。\n";
		mysql_query("UPDATE misc SET person_info='$batten_info' WHERE id='$user_id'");
		
		echo "<center><font color=#6A03D1>返回==><a href=$location_id>【".$location."】</a></font>\n";
		
		mysql_close();
		exit();	
		}
	if($e_hpnow_info < 0){
		if($my_damage >= 2000){
		echo "<br><font color=#990033>".$e_name_info."还没有看清你的路数，就已经躺在了地上......</font>\n";
		echo "<br><font color=red>".$e_name_info."严重受伤，昏死了过去.....</font>\n";
		echo "<br><font color=red>".$e_name_info."的体力下降了....</font>\n";
		}else{
		echo "<br><font color=red>".$e_name_info."只觉胸闷头晕，一口气就上不来了.....</font>\n";
		echo "<br>".$e_name_info."昏了过去.....\n";
		}
		
		if($my_exp_info > $e_exp_info){
			$my_exp_info += rand(0,$my_zhi_info) + intval($e_exp_info/10000);
			if($my_pos_info >= 0 && $e_pos_info > 0){
				$my_pos_info -= 3;
			}
			if($my_pos_info < 0 && $e_pos_info < 0){
				$my_pos_info += 3;
			}
			if($my_pos_info < 0 && $e_pos_info > 0){
				$my_pos_info -= 3;
			}
			if($my_pos_info >= 0 && $e_pos_info < 0){
				$my_pos_info += 3;
			}
		}else{
			if($my_pos_info <= 0 && $e_pos_info < 0){
				if($my_pos_info >= $e_pos_info) $my_pos_info += intval($e_pos_info/500);
				else $my_pos_info -= 3;
			}
			if($my_pos_info < 0 && $e_pos_info > 0){
				$my_pos_info -= intval($e_pos_info/500);
				$my_pos_info -= 3;
			}
			if($my_pos_info > 0 && $e_pos_info > 0){
				if($my_pos_info > $e_pos_info) $my_pos_info -= intval($e_pos_info/500);
				else $my_pos_info -= 3;
			}
			if($my_pos_info >= 0 && $e_pos_info < 0){
				$my_pos_info -= intval($e_pos_info/500);
				$my_pos_info += 3;
			}
			$my_exp_info += $my_zhi_info + rand(0,$my_yun_info) + 25 + intval($e_exp_info/5000);
		}
		if($my_sex_info == "侠客" && $my_pos_info >=0){
		if($my_pos_info >= 500 && $my_pos_info < 1200 && $my_nick_info != "良民")	$my_nick_info = "良民";
		if($my_pos_info >= 1200 && $my_pos_info < 2000 && $my_nick_info != "小义士")	$my_nick_info = "小义士";
		if($my_pos_info >= 2000 && $my_pos_info < 3000 && $my_nick_info != "义士")	$my_nick_info = "义士";	
		if($my_pos_info >= 3000 && $my_pos_info < 4500 && $my_nick_info != "小侠客")	$my_nick_info = "小侠客";
		if($my_pos_info >= 4500 && $my_pos_info < 7500 && $my_nick_info != "侠义之士")	$my_nick_info = "侠义之士";
		if($my_pos_info >= 7500 && $my_pos_info < 11000 && $my_nick_info != "豪侠")	$my_nick_info = "豪侠";
		if($my_pos_info >= 11000 && $my_pos_info < 19000 && $my_nick_info != "大侠")	$my_nick_info = "大侠";
		if($my_pos_info >= 19000 && $my_pos_info < 30000 && $my_nick_info != "旷世大侠")	$my_nick_info = "旷世大侠";
		if($my_pos_info >= 30000 && $my_nick_info != "神侠")	$my_nick_info = "神侠";
		}else if($my_sex_info == "侠客" && $my_pos_info <0){
		if($my_pos_info < -500 && $my_pos_info > -1200 && $my_nick_info != "小贼")	$my_nick_info = "小贼";
		if($my_pos_info <= -1200 && $my_pos_info > -2000 && $my_nick_info != "混混")	$my_nick_info = "混混";
		if($my_pos_info <= -2000 && $my_pos_info > -3000 && $my_nick_info != "小恶霸")	$my_nick_info = "小恶霸";	
		if($my_pos_info <= -3000 && $my_pos_info > -4500 && $my_nick_info != "恶霸")	$my_nick_info = "恶霸";
		if($my_pos_info <= -4500 && $my_pos_info > -7500 && $my_nick_info != "万恶之人")	$my_nick_info = "万恶之人";
		if($my_pos_info <= -7500 && $my_pos_info > -11000 && $my_nick_info != "魔人")	$my_nick_info = "魔人";
		if($my_pos_info <= -11000 && $my_pos_info > -19000 && $my_nick_info != "邪魔")	$my_nick_info = "邪魔";
		if($my_pos_info <= -19000 && $my_pos_info > -30000 && $my_nick_info != "绝世邪魔")	$my_nick_info = "绝世邪魔";
		if($my_pos_info <= -30000 && $my_nick_info != "魔神")	$my_nick_info = "魔神";
		}
		if($my_sex_info == "侠女" && $my_pos_info >=0){
		if($my_pos_info >= 500 && $my_pos_info < 1200 && $my_nick_info != "良民")	$my_nick_info = "良民";
		if($my_pos_info >= 1200 && $my_pos_info < 2000 && $my_nick_info != "小义女")	$my_nick_info = "小义女";
		if($my_pos_info >= 2000 && $my_pos_info < 3000 && $my_nick_info != "义女")	$my_nick_info = "义女";	
		if($my_pos_info >= 3000 && $my_pos_info < 4500 && $my_nick_info != "小侠女")	$my_nick_info = "小侠女";
		if($my_pos_info >= 4500 && $my_pos_info < 7500 && $my_nick_info != "侠义女")	$my_nick_info = "侠义女";
		if($my_pos_info >= 7500 && $my_pos_info < 11000 && $my_nick_info != "女豪")	$my_nick_info = "女豪";
		if($my_pos_info >= 11000 && $my_pos_info < 19000 && $my_nick_info != "女侠")	$my_nick_info = "女侠";
		if($my_pos_info >= 19000 && $my_pos_info < 30000 && $my_nick_info != "旷世女侠")	$my_nick_info = "旷世女侠";
		if($my_pos_info >= 30000 && $my_nick_info != "女神侠")	$my_nick_info = "女神侠";
		}else if($my_sex_info == "侠女" && $my_pos_info <0){
		if($my_pos_info < -500 && $my_pos_info > -1200 && $my_nick_info != "小贼")	$my_nick_info = "小贼";
		if($my_pos_info <= -1200 && $my_pos_info > -2000 && $my_nick_info != "混混")	$my_nick_info = "混混";
		if($my_pos_info <= -2000 && $my_pos_info > -3000 && $my_nick_info != "小妖女")	$my_nick_info = "小妖女";	
		if($my_pos_info <= -3000 && $my_pos_info > -4500 && $my_nick_info != "妖女")	$my_nick_info = "妖女";
		if($my_pos_info <= -4500 && $my_pos_info > -7500 && $my_nick_info != "邪女")	$my_nick_info = "邪女";
		if($my_pos_info <= -7500 && $my_pos_info > -11000 && $my_nick_info != "魔女")	$my_nick_info = "魔女";
		if($my_pos_info <= -11000 && $my_pos_info > -19000 && $my_nick_info != "女邪魔")	$my_nick_info = "女邪魔";
		if($my_pos_info <= -19000 && $my_pos_info > -30000 && $my_nick_info != "绝世女邪魔")	$my_nick_info = "绝世女邪魔";
		if($my_pos_info <= -30000 && $my_nick_info != "女魔神")	$my_nick_info = "女魔神";
		}
		//得到金钱
		$npc_mon = mysql_query("SELECT mon FROM npc_member WHERE id='$b_id'");
		$npc_mon = mysql_result($npc_mon,0,"mon");
		$my_mon_info += intval($npc_mon/5);
						
		echo "<br><font color=#0000ff>你现在经验是".$my_exp_info."点了。</font><br>\n";
		
		$wupin_num = mysql_query("SELECT count(id) FROM renwu_wupin WHERE id='$user_id'");
		$wupin_num = mysql_fetch_row($wupin_num);
		//得到物品	
		if($wupin_num[0] > 15) echo "<br>你现在身上的物品太多了，再也装不下了。<br>\n";
		else{
		if($e_wupin_tou_id != "n") mysql_query("INSERT INTO renwu_wupin VALUES('','$user_id','$e_wupin_tou_id','0','N','头')") or die("数据库问题\n");
		if($e_wupin_xiong_id != "n") mysql_query("INSERT INTO renwu_wupin VALUES('','$user_id','$e_wupin_xiong_id','0','N','胸')") or die("数据库问题\n");
		if($e_wupin_shou_id != "n") mysql_query("INSERT INTO renwu_wupin VALUES('','$user_id','$e_wupin_shou_id','0','N','手')") or die("数据库问题\n");
		if($e_wupin_tui_id != "n") mysql_query("INSERT INTO renwu_wupin VALUES('','$user_id','$e_wupin_tui_id','0','N','腿')") or die("数据库问题\n");
		if($e_wupin_tou_id != "n")	echo "你得到了".$e_wupin_tou_name."<br>";
		if($e_wupin_xiong_id != "n")	echo "你得到了".$e_wupin_xiong_name."<br>";
		if($e_wupin_shou_id != "n")	echo "你得到了".$e_wupin_shou_name."<br>";
		if($e_wupin_tui_id != "n")	echo "你得到了".$e_wupin_tui_name."<br>";
		}
		
		$wuqi_num = mysql_query("SELECT count(id) FROM renwu_wuqi WHERE id='$user_id'");
		$wuqi_num = mysql_fetch_row($wuqi_num);		
		//得到武器
		if($wuqi_num[0] > 4) echo "<br>你现在身上的武器太多了，再也装不下了。<br>\n";
		else if($e_wuqi_id == "di_lu"){
			$de_bao = mysql_query("SELECT de_dao FROM dl_bao");
			if(mysql_result($de_bao,0,"de_dao") == "N"){
				mysql_query("INSERT INTO renwu_wuqi VALUES('','$user_id','$e_wuqi_id','0','N','$e_wuqi_cla')") or die("数据库问题\n");
				echo "<font color=red>恭喜！恭喜！你得到了绝世神剑之一的【".$e_wuqi_name."】宝剑。</font><br>";
				mysql_query("UPDATE dl_bao SET de_dao='Y'");
				$notice_channel = "宝藏";
				$notice_to = "di_lu";
				include "./include/notice.inc.php";
				}
		}else  if($e_wuqi_id == "qi_sd"){
			$de_bao = mysql_query("SELECT n_status FROM sp_wupin WHERE id='qi_sd'");
			if(mysql_result($de_bao,0,"n_status") == "N"){
				mysql_query("INSERT INTO renwu_wuqi VALUES('','$user_id','$e_wuqi_id','0','N','$e_wuqi_cla')") or die("数据库问题\n");
				echo "<font color=red>恭喜！恭喜！你得到了绝世魔刀之一的【".$e_wuqi_name."】。</font><br>";
				mysql_query("UPDATE sp_wupin SET n_status='Y' WHERE id='qi_sd'");
				$notice_channel = "宝藏";
				$notice_to = "qi_sd";
				include "./include/notice.inc.php";
				}
		}else  if($e_wuqi_id == "qis_tl"){
			$de_bao = mysql_query("SELECT n_status FROM sp_wupin WHERE id='qis_tl'");
			if(mysql_result($de_bao,0,"n_status") == "N"){
				mysql_query("INSERT INTO renwu_wuqi VALUES('','$user_id','$e_wuqi_id','0','N','$e_wuqi_cla')") or die("数据库问题\n");
				echo "<font color=red>恭喜！恭喜！你得到了绝世魔鞭之一的【".$e_wuqi_name."】。</font><br>";
				mysql_query("UPDATE sp_wupin SET n_status='Y' WHERE id='qis_tl'");
				$notice_channel = "宝藏";
				$notice_to = "qis_tl";
				include "./include/notice.inc.php";
				}
		}else{
		if($e_wuqi_id != "n") mysql_query("INSERT INTO renwu_wuqi VALUES('','$user_id','$e_wuqi_id','0','N','$e_wuqi_cla')") or die("数据库问题\n");
		if($e_wuqi_id != "n") echo "你得到了".$e_wuqi_name."<br>";
		}
						
		switch($my_cha_info){
			case "勇猛":is_up($user_id,$my_exp_info,$my_str_info,$my_cha_info,$my_str_info,$my_zhi_info,$my_spe_info,$my_con_info,$my_pur_info);break;
			case "和平":is_up($user_id,$my_exp_info,$my_zhi_info,$my_cha_info,$my_str_info,$my_zhi_info,$my_spe_info,$my_con_info,$my_pur_info);break;
			case "胆小":is_up($user_id,$my_exp_info,$my_spe_info,$my_cha_info,$my_str_info,$my_zhi_info,$my_spe_info,$my_con_info,$my_pur_info);break;
			case "冷酷":is_up($user_id,$my_exp_info,$my_con_info,$my_cha_info,$my_str_info,$my_zhi_info,$my_spe_info,$my_con_info,$my_pur_info);break;
			case "激情":is_up($user_id,$my_exp_info,$my_pur_info,$my_cha_info,$my_str_info,$my_zhi_info,$my_spe_info,$my_con_info,$my_pur_info);break;
			}
		
		mysql_query("UPDATE renwu_member SET exp='$my_exp_info',pos='$my_pos_info',mon='$my_mon_info',nick='$my_nick_info' WHERE id='$user_id'");
		
		if($my_swgid_wugong_info != "n"){
		$batten_info = $e_org_info.$e_name_info."与你进行决斗，你凭借".$my_swgname."战胜了敌手。\n";
		}else
		$batten_info = $e_org_info.$e_name_info."与你进行决斗，你大胜".$e_name_info."。\n";
		mysql_query("UPDATE misc SET person_info='$batten_info' WHERE id='$user_id'");
		
		echo "<center><font color=#6A03D1>返回==><a href=$location_id>【".$location."】</a></font>\n";
		
		mysql_close();
		exit();	
	}
	
		
	}
	mysql_close();
	exit();	
?>