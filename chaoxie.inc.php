<?
/*
===============
=工作－－抄写员
=
===============
*/
	include "./inc/db.inc.php";
	include "./inc/resume.inc.php";
	
	renwu_resume($user_id,time());
	
	$my_info = mysql_query("SELECT hpnow,ponow,zhi,exp FROM renwu_member WHERE id='$user_id'");
	$my_hpnow = mysql_result($my_info,0,"hpnow");
	$my_ponow = mysql_result($my_info,0,"ponow");
	$my_zhi = mysql_result($my_info,0,"zhi");
	$my_exp = mysql_result($my_info,0,"exp");
	
	if($my_exp > 8500){
		echo "<br><font color=green>你是有一定经验的人了，这些简单的工作就不用干了！</font>\n";
		echo "<meta http-equiv=\"refresh\" content=\"3; url=work.php\">";
		mysql_close();
		exit();	
	}
	
	if($my_zhi < 20){
		echo "<br><font color=green>你奔头笨脑的也不怕把别人书搞坏了啊！</font>\n";
		echo "<meta http-equiv=\"refresh\" content=\"3; url=work.php\">";
		mysql_close();
		exit();	
	}
	
	if($my_hpnow < 40 || $my_ponow < 120){
		echo "<br><font color=green>你身体虚弱，不能继续打工了。</font>\n";
		echo "<meta http-equiv=\"refresh\" content=\"3; url=work.php\">";
		mysql_close();
		exit();	
	}

	$action=array("你开始了你的工作。","书店老板把一堆书放在你面前，看来有的你干的了。",
			"你磨墨洗笔，开始了抄写工作。","'怎么这么慢啊，你怎么搞的，再这样可要扣工钱的。'老板对你喉着",
			"你不敢怠慢，急忙赶起来。",
			"你终于抄写好了一本书，累得半死。",
			"你完成了今天的工作。");
	
	for($i=0;$i<count($action);$i++){
		echo "<font color=#397BB7>".$action[$i]."</font><br><br>\n";
	}
	
	$my_hpnow -= 40;
	$need_po = 140 - $my_zhi;
	if($need_po < 60) $need_po = 60;
	$my_ponow -= $need_po;
	
	mysql_query("UPDATE renwu_member SET hpnow='$my_hpnow',ponow='$my_ponow',mon=mon+100 WHERE id='$user_id'");
	
	echo "<font color=blue>经过一天工作你得到了100金钱。</font>\n";
	
	echo "<p align=center><input type=submit value='返 回' onclick=\"location.href='work.php'\" style=\"font-family: 宋体; border-style: ridge; border-width: 0; background-color: #CCFF99; color:#666633\">\n";
	mysql_close();
	exit();
?>