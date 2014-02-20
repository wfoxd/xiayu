<?
/*
===============
=工作－－饭店
=
===============
*/
	include "./inc/db.inc.php";
	include "./inc/resume.inc.php";
	
	renwu_resume($user_id,time());
	
	$my_info = mysql_query("SELECT hpnow,ponow,exp FROM renwu_member WHERE id='$user_id'");
	$my_hpnow = mysql_result($my_info,0,"hpnow");
	$my_ponow = mysql_result($my_info,0,"ponow");
	$my_exp = mysql_result($my_info,0,"exp");
	
	if($my_exp > 6000){
		echo "<br><font color=green>你是有一定经验的人了，这些简单的工作就不用干了！</font>\n";
		echo "<meta http-equiv=\"refresh\" content=\"3; url=work.php\">";
		mysql_close();
		exit();	
	}
	if($my_hpnow < 80 || $my_ponow < 90){
		echo "<br><font color=green>你身体虚弱，不能继续打工了。</font>\n";
		echo "<meta http-equiv=\"refresh\" content=\"3; url=work.php\">";
		mysql_close();
		exit();	
	}

	$action=array("你开始了你的工作。","你看见客人们不断的进来，你都快忙不过来了。",
			"'小二～～',一声吆喝，你便循声跑了过去。","'老板，结帐啦～'",
			"一波一波的客人来来去去，你觉得这里应该请更多的小二了。",
			"看天气快是要黑了，你的工作快要结束了。",
			"'发什么呆啊！还不快工作去',老板看着发呆的你，不禁有点发怒了！",
			"天晚了，你完成了今天的工作。");
	
	for($i=0;$i<count($action);$i++){
		echo "<font color=green>".$action[$i]."</font><br><br>\n";
	}
	
	$my_hpnow -= 80;
	$my_ponow -= 90;
	
	mysql_query("UPDATE renwu_member SET hpnow='$my_hpnow',ponow='$my_ponow',mon=mon+40 WHERE id='$user_id'");
	
	echo "<font color=blue>经过一天工作你得到了40金钱。</font>\n";
	
	echo "<p align=center><input type=submit value='返 回' onclick=\"location.href='work.php'\" style=\"font-family: 宋体; border-style: ridge; border-width: 0; background-color: #CCFF99; color:#666633\">\n";
	mysql_close();
	exit();
?>