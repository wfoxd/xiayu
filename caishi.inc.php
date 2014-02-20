<?
/*
===============
=工作－－采石工
=
===============
*/
	include "./inc/db.inc.php";
	include "./inc/resume.inc.php";
	
	renwu_resume($user_id,time());
	
	$my_info = mysql_query("SELECT hpnow,ponow,str,exp FROM renwu_member WHERE id='$user_id'");
	$my_hpnow = mysql_result($my_info,0,"hpnow");
	$my_ponow = mysql_result($my_info,0,"ponow");
	$my_str = mysql_result($my_info,0,"str");
	$my_exp = mysql_result($my_info,0,"exp");
	
	if($my_exp > 8000){
		echo "<br><font color=green>你是有一定经验的人了，这些简单的工作就不用干了！</font>\n";
		echo "<meta http-equiv=\"refresh\" content=\"3; url=work.php\">";
		mysql_close();
		exit();	
	}
	
	if($my_str < 20){
		echo "<br><font color=green>你连采石头的工具都拿不动，怎么干这个工作啊！</font>\n";
		echo "<meta http-equiv=\"refresh\" content=\"3; url=work.php\">";
		mysql_close();
		exit();	
	}
	
	if($my_hpnow < 120 || $my_ponow < 40){
		echo "<br><font color=green>你身体虚弱，不能继续打工了。</font>\n";
		echo "<meta http-equiv=\"refresh\" content=\"3; url=work.php\">";
		mysql_close();
		exit();	
	}

	$action=array("你开始了你的工作。","你看到山壁上一块块大石头，觉得它们真是大啊。",
			"你挽起袖子开始一下一下敲起石头来。","'不要偷懒～～'老板对你喉着",
			"大石头被你敲碎了。",
			"就要天黑了，你今天还是干的不错啊！",
			"你完成了今天的工作。");
	
	for($i=0;$i<count($action);$i++){
		echo "<font color=#4F9BA2>".$action[$i]."</font><br><br>\n";
	}
	
	
	$need_hp = 140 - $my_str;
	if($need_hp < 70) $need_hp = 70;
	$my_ponow -= 40;
	$my_hpnow -= $need_hp;
	
	mysql_query("UPDATE renwu_member SET hpnow='$my_hpnow',ponow='$my_ponow',mon=mon+110 WHERE id='$user_id'");
	
	echo "<font color=blue>经过一天工作你得到了110金钱。</font>\n";
	
	echo "<p align=center><input type=submit value='返 回' onclick=\"location.href='work.php'\" style=\"font-family: 宋体; border-style: ridge; border-width: 0; background-color: #CCFF99; color:#666633\">\n";
	mysql_close();
	exit();
?>