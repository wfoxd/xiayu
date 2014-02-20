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
	
	if($my_exp > 20000 || $my_exp < 5000){
		echo "<br><font color=green>你经验不合适做我们这个工作。</font>\n";
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
	
	if($my_hpnow < 100 || $my_ponow < 100){
		echo "<br><font color=green>你身体虚弱，不能继续打工了。</font>\n";
		echo "<meta http-equiv=\"refresh\" content=\"3; url=work.php\">";
		mysql_close();
		exit();	
	}

	$action=array("你开始了你的工作。","老板娘给了你一桶的衣服让你洗。",
			"你看到这些不愧是大官们的衣服，都是一些极好面料做成的。",
			"'我以后也要卖这些漂亮的衣服穿'你想",
			"不停的洗阿洗，你不自觉得有点累了。",
			"终于把一桶衣服洗完了......",
			"你完成了今天的工作。");
	
	for($i=0;$i<count($action);$i++){
		echo "<font color=#859364>".$action[$i]."</font><br><br>\n";
	}
	
	$my_ponow -= 100;
	$my_hpnow -= 100;
	
	mysql_query("UPDATE renwu_member SET hpnow='$my_hpnow',ponow='$my_ponow',mon=mon+160,exp=exp+20 WHERE id='$user_id'");
	
	echo "<font color=blue>经过一天工作你得到了160金钱,20点经验。</font>\n";
	
	echo "<p align=center><input type=submit value='返 回' onclick=\"location.href='work.php'\" style=\"font-family: 宋体; border-style: ridge; border-width: 0; background-color: #CCFF99; color:#666633\">\n";
	mysql_close();
	exit();
?>