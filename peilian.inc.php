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
	
	if($my_exp < 20000){
		echo "<br><font color=green>你经验不够，怎么陪练阿。</font>\n";
		echo "<meta http-equiv=\"refresh\" content=\"3; url=work.php\">";
		mysql_close();
		exit();	
	}
	
	if($my_hpnow < 150 || $my_ponow < 150){
		echo "<br><font color=green>你身体虚弱，不能继续打工了。</font>\n";
		echo "<meta http-equiv=\"refresh\" content=\"3; url=work.php\">";
		mysql_close();
		exit();	
	}

	$action=array("你开始准备陪练。","你开始演示一些基本功夫，以便陪练。",
			"陪练开始了。",
			"你不停躲避着攻击，但你不能还手。",
			"见招拆招，你象沙包一样被别人打着。",
			"打你的人看来有点累了.....",
			"你完成了今天的工作。");
	
	for($i=0;$i<count($action);$i++){
		echo "<font color=#46B6E6>".$action[$i]."</font><br><br>\n";
	}
	
	$my_ponow -= 150;
	$my_hpnow -= 150;
	
	mysql_query("UPDATE renwu_member SET hpnow='$my_hpnow',ponow='$my_ponow',mon=mon+200,exp=exp+30 WHERE id='$user_id'");
	
	echo "<font color=blue>经过一天工作你得到了200金钱,30点经验。</font>\n";
	
	echo "<p align=center><input type=submit value='返 回' onclick=\"location.href='work.php'\" style=\"font-family: 宋体; border-style: ridge; border-width: 0; background-color: #CCFF99; color:#666633\">\n";
	mysql_close();
	exit();
?>