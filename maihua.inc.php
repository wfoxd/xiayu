<?
/*
===============
=工作－－买花姑娘
=
===============
*/
	include "./inc/db.inc.php";
	include "./inc/resume.inc.php";
	
	renwu_resume($user_id,time());
	
	$my_info = mysql_query("SELECT hpnow,ponow,sex,col,exp FROM renwu_member WHERE id='$user_id'");
	$my_hpnow = mysql_result($my_info,0,"hpnow");
	$my_ponow = mysql_result($my_info,0,"ponow");
	$my_sex = mysql_result($my_info,0,"sex");
	$my_col = mysql_result($my_info,0,"col");
	$my_exp = mysql_result($my_info,0,"exp");
	
	if($my_exp > 8500){
		echo "<br><font color=green>你是有一定经验的人了，这些简单的工作就不用干了！</font>\n";
		echo "<meta http-equiv=\"refresh\" content=\"3; url=work.php\">";
		mysql_close();
		exit();	
	}
	
	if($my_sex != "侠女"){
		echo "<br><font color=green>男子家家怎么来做这个工作了啊？！</font>\n";
		echo "<meta http-equiv=\"refresh\" content=\"3; url=work.php\">";
		mysql_close();
		exit();	
	}
	if($my_col < 20){
		echo "<br><font color=green>实在对不起了，我们这里需要一些能看得上眼的女孩子啊！</font>\n";
		echo "<meta http-equiv=\"refresh\" content=\"3; url=work.php\">";
		mysql_close();
		exit();	
	}
	
	if($my_hpnow < 75 || $my_ponow < 75){
		echo "<br><font color=green>你身体虚弱，不能继续打工了。</font>\n";
		echo "<meta http-equiv=\"refresh\" content=\"3; url=work.php\">";
		mysql_close();
		exit();	
	}

	$action=array("你开始了你的工作。","你可以看到这里各式各样的鲜花，美丽极了。",
			"你修饰着每朵鲜花，希望它们能永远这样美丽。","'这位美丽的女之能给我一朵鲜花吗？'",
			"花店里的顾客们不仅是被这些鲜花吸引而来，你美丽如花的面容吸引了不少青年才俊！",
			"今天的生意真是不错啊！",
			"你完成了今天的工作。");
	
	for($i=0;$i<count($action);$i++){
		echo "<font color=#47AF4F>".$action[$i]."</font><br><br>\n";
	}
	
	$my_ponow -= 75;
	$my_hpnow -= 75;
	
	mysql_query("UPDATE renwu_member SET hpnow='$my_hpnow',ponow='$my_ponow',mon=mon+130 WHERE id='$user_id'");
	
	echo "<font color=blue>经过一天工作你得到了130金钱。</font>\n";
	
	echo "<p align=center><input type=submit value='返 回' onclick=\"location.href='work.php'\" style=\"font-family: 宋体; border-style: ridge; border-width: 0; background-color: #CCFF99; color:#666633\">\n";
	mysql_close();
	exit();
?>