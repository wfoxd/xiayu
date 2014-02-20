<?
/*
===============
=工作－－洗衣
=
===============
*/
	include "./inc/db.inc.php";
	include "./inc/resume.inc.php";
	
	renwu_resume($user_id,time());
	
	$my_info = mysql_query("SELECT hpnow,ponow,sex,exp FROM renwu_member WHERE id='$user_id'");
	$my_hpnow = mysql_result($my_info,0,"hpnow");
	$my_ponow = mysql_result($my_info,0,"ponow");
	$my_sex = mysql_result($my_info,0,"sex");
	$my_exp = mysql_result($my_info,0,"exp");
	
	if($my_exp > 25000 || $my_exp < 10000){
		echo "<br><font color=green>你经验不合适做我们这个工作。</font>\n";
		echo "<meta http-equiv=\"refresh\" content=\"3; url=work.php\">";
		mysql_close();
		exit();	
	}
	
	if($my_sex != "侠客"){
		echo "<br><font color=green>女子家家怎么来做这个工作了啊？！</font>\n";
		echo "<meta http-equiv=\"refresh\" content=\"3; url=work.php\">";
		mysql_close();
		exit();	
	}
	
	if($my_hpnow < 120 || $my_ponow < 120){
		echo "<br><font color=green>你身体虚弱，不能继续打工了。</font>\n";
		echo "<meta http-equiv=\"refresh\" content=\"3; url=work.php\">";
		mysql_close();
		exit();	
	}

	$action=array("你开始了你的工作。","你论起铁锤不停的敲打着铁块。",
			"看你汗流夹背的样子，你还是把上衣脱了再继续吧！",
			"铁匠老板不停的催促你：'用力打，用力。'",
			"不停的打阿打，你不自觉得很累了。",
			"终于把一块铁打好了......",
			"你完成了今天的工作。");
	
	for($i=0;$i<count($action);$i++){
		echo "<font color=#B8C765>".$action[$i]."</font><br><br>\n";
	}
	
	$my_ponow -= 120;
	$my_hpnow -= 120;
	
	mysql_query("UPDATE renwu_member SET hpnow='$my_hpnow',ponow='$my_ponow',mon=mon+180,exp=exp+25 WHERE id='$user_id'");
	
	echo "<font color=blue>经过一天工作你得到了180金钱,25点经验。</font>\n";
	
	echo "<p align=center><input type=submit value='返 回' onclick=\"location.href='work.php'\" style=\"font-family: 宋体; border-style: ridge; border-width: 0; background-color: #CCFF99; color:#666633\">\n";
	mysql_close();
	exit();
?>