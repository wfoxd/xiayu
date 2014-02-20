<?
session_save_path("xytmp");
session_start();
$user_id=$_SESSION["user_id"];
$npc_id=$_GET['npc_id'];
$kill=$_GET['kill'];
$qiecuo=$_GET['qiecuo'];
$geiyu=$_GET['geiyu'];
$gei=$_GET['gei'];
//echo "测试gei".$gei;
$wupin_person=$_POST['wupin_person'];
$b_id=$_GET['b_id'];

include "./inc/attest.inc.php";

include "./inc/config.inc.php";
include "./inc/style.inc.php";
/*
================================
=NPC互动 (Ver 0.4.5)
=公元 2001年12月30日
================================
*/
?>
<?
	if($kill == 1) include "./include/npc_juedou.inc.php";
	if($qiecuo == 1) include "./include/npc_qiecuo.inc.php";
	if($geiyu == 1) include "./include/npc_geiyu.inc.php";
	
	$a_talk = array('跳了跳～～',
		'叫了一下～～～',
		'走来走去，停不下来的样子.....',
		'似乎要跑开了......',
		'向你走了过来......'
		);
	$t_talk = array('我正好有空，你有什么事阿？',
		'我忙着呢，有事请说吧！',
		'我能帮你什么啊？'
		);
	$ztz_talk = array('这位p_nick你好啊，不知找我有什么事吗？',
		'敢问这位p_nick,找我有什么事吗？',
		'在下这厢有礼了，这位p_nick不知道我有什么能帮你的吗？',
		'请问这位p_nick,有何贵干？',
		'这位p_nick,有事请说！'
		);
	$ztx_talk = array('这位p_nick戾气太重，如果没有什么事，我就少陪了。',
		'哼！我最讨厌的就是你们这种邪恶的人了，没事就块滚。',
		'我劝你这位p_nick放下屠刀，做些好事吧！',
		'你这种p_nick还敢和我说话，小心我劈了你！'
		);
	$xtx_talk = array('这位p_nick最近那里发财啊？有好的货色可不要忘了我们兄弟哦！',
		'这位p_nick，咱们都是一条道上的，有什么事尽管说！',
		'哈！没想到今天还在这里遇到你这个p_nick了!',
		'最近江湖上有不少正派人士，那天我们也去杀它几个！'
		);
	$xtz_talk = array('我平生最讨厌的就是你这样的p_nick了，有屁快放！，老子还有买卖要做！',
		'你这个p_nick找老子有什么事阿？',
		'老子今天心情不错，就不和你这个p_nick计较了，有屁快放哈！',
		'你个p_nick,找我干什么啊？说了快滚！'
		);	
	
	include "./inc/db.inc.php";
	
	if(!isset($npc_id)){
		echo "不正确参数！";
		mysql_close();
		exit();
	}
	
	$my_info = mysql_query("SELECT pos,nick FROM renwu_member WHERE id='$user_id'");
	$my_pos = mysql_result($my_info,0,"pos");
	$my_nick = mysql_result($my_info,0,"nick");
	
	$time_resume = time();
	
	$renwu_state = mysql_query("SELECT hp,hpnow,en,ennow,po,ponow,time,con,po,zhi FROM npc_member WHERE id='$npc_id'");
	
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
	
	mysql_query("UPDATE npc_member SET time='$time_resume',hpnow='$renwu_state_hpnow',ennow='$renwu_state_ennow',ponow='$renwu_state_ponow' WHERE id='$npc_id'");
	
	$npc_info = mysql_query("SELECT des,pos,hpnow,name,nick,tou,shen,shou,tui,wuqi FROM npc_member WHERE id='$npc_id'");
	
	$npc_name = mysql_result($npc_info,0,"name");
	$npc_hpnow = mysql_result($npc_info,0,"hpnow");	
	if($npc_hpnow < 100){
		echo "<p align=center>".$npc_name."实在太累了，无法与你交流！\n";
		$location_info = mysql_query("SELECT location_id FROM misc WHERE id='$user_id'");  	
		$location = mysql_result($location_info,0,"location_id");
		echo "<p align=center><a href=$location>【后退】</a>\n";
		mysql_close();
		exit();
	}	
	$npc_nick = mysql_result($npc_info,0,"nick");
	$npc_tou = mysql_result($npc_info,0,"tou");
	$npc_shen = mysql_result($npc_info,0,"shen");
	$npc_shou = mysql_result($npc_info,0,"shou");
	$npc_tui = mysql_result($npc_info,0,"tui");
	$npc_wuqi = mysql_result($npc_info,0,"wuqi");
	$npc_pos = mysql_result($npc_info,0,"pos");
	$npc_des = mysql_result($npc_info,0,"des");
				
	echo "<a href=npc_hudong.php?npc_id=$npc_id>【".$npc_nick."】".$npc_name."（".$npc_id."）</a><br>".$npc_des."<br>\n";
	echo "<font color=#A79E52>\n";
	if($npc_tou != ""){
		$name = mysql_query("SELECT zhuangbei_wupin.name FROM zhuangbei_wupin,npc_member WHERE zhuangbei_wupin.id=npc_member.tou AND zhuangbei_wupin.id='$npc_tou'");
		echo "头戴:".mysql_result($name,0,"name")."&nbsp;<br>";
	}
	if($npc_shen != ""){
		$name = mysql_query("SELECT zhuangbei_wupin.name FROM zhuangbei_wupin,npc_member WHERE zhuangbei_wupin.id=npc_member.shen AND zhuangbei_wupin.id='$npc_shen'");
		echo "身穿:".mysql_result($name,0,"name")."&nbsp;<br>";
	}
	if($npc_shou != ""){
		$name = mysql_query("SELECT zhuangbei_wupin.name FROM zhuangbei_wupin,npc_member WHERE zhuangbei_wupin.id=npc_member.shou AND zhuangbei_wupin.id='$npc_shou'");
		echo "手戴:".mysql_result($name,0,"name")."&nbsp;<br>";
	}
	if($npc_tui != ""){
		$name = mysql_query("SELECT zhuangbei_wupin.name FROM zhuangbei_wupin,npc_member WHERE zhuangbei_wupin.id=npc_member.tui AND zhuangbei_wupin.id='$npc_tui'");
		echo "腿绑:".mysql_result($name,0,"name")."&nbsp;<br>";
	}
	if($npc_wuqi != ""){
		$name = mysql_query("SELECT zhuangbei_wuqi.name FROM zhuangbei_wuqi,npc_member WHERE zhuangbei_wuqi.id=npc_member.wuqi AND zhuangbei_wuqi.id='$npc_wuqi'");
		echo "手拿:".mysql_result($name,0,"name");			
	}
	echo "</font>\n";
	
	if($npc_nick != "动物"){
	if($npc_pos != 0 && $my_pos != 0){
	if($npc_pos > 0 && $my_pos > 0){
		$num_talk = count($ztz_talk)-1;
		$talk_msg = $ztz_talk[rand(0,$num_talk)];
		$talk_msg = str_replace("p_nick","$my_nick","$talk_msg");
	}
	if($npc_pos > 0 && $my_pos < 0){
		$num_talk = count($ztx_talk)-1;
		$talk_msg = $ztx_talk[rand(0,$num_talk)];
		$talk_msg = str_replace("p_nick","$my_nick","$talk_msg");
	}
	if($npc_pos < 0 && $my_pos < 0){
		$num_talk = count($xtx_talk)-1;
		$talk_msg = $xtx_talk[rand(0,$num_talk)];
		$talk_msg = str_replace("p_nick","$my_nick","$talk_msg");
	}
	if($npc_pos < 0 && $my_pos > 0){
		$num_talk = count($xtz_talk)-1;
		$talk_msg = $xtz_talk[rand(0,$num_talk)];
		$talk_msg = str_replace("p_nick","$my_nick","$talk_msg");
	}
	}else{
		$num_talk = count($t_talk)-1;
		$talk_msg = $t_talk[rand(0,$num_talk)];
		$talk_msg = str_replace("p_nick","$my_nick","$talk_msg");
	}
	
	echo "<br><font color=#4575A5>".$npc_name."对你说道：".$talk_msg."</font>";	
	}
	
	if($npc_nick == "动物"){
		$num_talk = count($a_talk)-1;
		$talk_msg = $a_talk[rand(0,$num_talk)];
		$talk_msg = str_replace("p_nick","$my_nick","$talk_msg");
		
		echo "<br><font color=#4575A5>".$npc_name.$talk_msg."</font>";	
	}
	echo "<p>你可以==><br>\n";
	if($npc_nick != "动物")	echo "<a href=npc_hudong.php?kill=1&b_id=$npc_id>杀死</a>&nbsp;&nbsp;<a href=npc_hudong.php?qiecuo=1&b_id=$npc_id>切磋</a>&nbsp;&nbsp;<a href=npc_hudong.php?geiyu=1&npc_id=$npc_id>给予</a>&nbsp;&nbsp;<a href=javascript:history.back(1)>离开</a>\n";
	else 	echo "<a href=npc_hudong.php?kill=1&b_id=$npc_id>杀死</a>&nbsp;&nbsp;<a href=npc_hudong.php?qiecuo=1&b_id=$npc_id>切磋</a>&nbsp;&nbsp;<a href=javascript:history.back(1)>离开</a>\n";
	
	mysql_close();
	exit();
?>