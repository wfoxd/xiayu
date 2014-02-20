<?
session_save_path("../xytmp");
session_start();
$user_id=$_SESSION["user_id"];
$dx=$_GET['dx'];
$R1=$_POST['R1'];
$use_mon=$_POST['use_mon'];
$ct=$_GET['ct'];
include "../inc/attest_lu.inc.php";

include "../inc/config.inc.php";
include "../inc/style.inc.php";
/*
==============
=小路1 1/5/2002
==============
*/
include "../include/area_now.inc.php";
$way = array("bhc/bhc.php","bhc/bhc_dc.php");
area_now($way,$user_id);

include "../include/location_lu.inc.php";
up_location("赌场","bhc/bhc_dc.php","$user_id");
?>
<?
	echo "<br>==============赌场==============<br>";
	echo ("这里是个赌场，里面人声鼎沸，热闹非常。<br>
	");
	
	$npc_org = "赌场";
    	include "../include/list_npc.inc.php";
    	
	echo ("
	<br>
	这里可以返回==><br>	
	<a href=./bhc.php>【大街】<a/><br>
	");
?>
<?
if($dx == 1){
	include "../inc/db.inc.php";
	
	$my_info = mysql_query("SELECT mon,yun FROM renwu_member WHERE id='$user_id'");
	$my_mon = mysql_result($my_info,0,"mon");
	$my_yun = mysql_result($my_info,0,"yun");
	
	$mon_num = intval($use_mon);
	if($mon_num > 100 || $mon_num <= 0 ){
		echo "<br><font color=green>请输入正确的金钱数量，至少5以上。</font>\n";
		echo "<meta http-equiv=\"refresh\" content=\"5; url=bhc_dc.php\">";
		mysql_close();
		exit();	
	}
	
	if($my_mon < $mon_num){
		echo "<br><font color=green>你没有那么多钱吧！</font>\n";
		echo "<meta http-equiv=\"refresh\" content=\"5; url=bhc_dc.php\">";
		mysql_close();
		exit();
	}
	
	$my_mon -= $use_mon;
	mysql_query("UPDATE renwu_member SET mon='$my_mon' WHERE id='$user_id'");
		
	$res = rand(0,20);
	$res = $res%2;
	echo "<br>一...二...三....开";
	if($res == 0){
		echo "<font color=#FF8040>大</font>";
		$res = "big";
	}else{
		echo "<font color=#808000>小</font>";
		$res = "small";
	}
	
	if($R1 == $res){
		echo "<br>恭喜啦，你赢了！";
		$my_mon += $use_mon*2;
		mysql_query("UPDATE renwu_member SET mon='$my_mon' WHERE id='$user_id'");
	}else	echo "<br>你输了！继续来吧！";	
	mysql_close();
}
if($ct == 1){
	include "../inc/db.inc.php";
	
	$my_info = mysql_query("SELECT mon,yun FROM renwu_member WHERE id='$user_id'");
	$my_mon = mysql_result($my_info,0,"mon");
	$my_yun = mysql_result($my_info,0,"yun");
	
	$mon_num = intval($use_mon);
	if($mon_num > 1500 || $mon_num <= 0 ){
		echo "<br><font color=green>请输入正确的金钱数量，至少5以上。</font>\n";
		echo "<meta http-equiv=\"refresh\" content=\"5; url=bhc_dc.php\">";
		mysql_close();
		exit();	
	}
	
	if($my_mon < $mon_num){
		echo "<br><font color=green>你没有那么多钱吧！</font>\n";
		echo "<meta http-equiv=\"refresh\" content=\"5; url=bhc_dc.php\">";
		mysql_close();
		exit();
	}
	$my_mon -= $use_mon;
	mysql_query("UPDATE renwu_member SET mon='$my_mon' WHERE id='$user_id'");
	
	$res = rand(0,40);
	echo "<br>一...二...三....开彩啦....";
	if($res >= 10 && $res <= 20){
		echo "<font color=#8ED2E1>牛</font>";
		$res = "niu";
	}else	if($res >= 0 && $res < 10){
		echo "<font color=#70E2B8>马</font>";
		$res = "ma";
	}else	if($res >= 20 && $res < 30){
		echo "<font color=#808000>猪</font>";
		$res = "zhu";
	}else	if($res >= 30 && $res < 40){
		echo "<font color=#619A8C>羊</font>";
		$res = "yang";
	}
	
	if($R1 == $res){
		echo "<br>恭喜啦，你赢了！";
		$my_mon += $use_mon*3;
		mysql_query("UPDATE renwu_member SET mon='$my_mon' WHERE id='$user_id'");
	}else	echo "<br>你输了！继续来吧！";
	mysql_close();
}
?>
<center>
赌大小 X2
<hr width=80%>
<form action=bhc_dc.php?dx=1 method=post>
押大<input type="radio" value="big" checked name="R1">押小<input type="radio" value="small" name="R1">
<br>钱数<input type=text size=4 name=use_mon>(最多100)<br>
<input type="submit" value="开 宝" name="B1" style="font-family: 宋体; border-style: ridge; border-width: 0; background-color: #CCFF99; color:#666633"></td>
</form>
买彩头 X3
<hr width=80%>
<form action=bhc_dc.php?ct=1 method=post>
马<input type="radio" value="ma" checked name="R1">牛<input type="radio" value="niu" name="R1">
猪<input type="radio" value="zhu" name="R1">羊<input type="radio" value="yang" name="R1">
<br>钱数<input type=text size=4 name=use_mon>(最多1500)<br>
<input type="submit" value="开 彩" name="B1" style="font-family: 宋体; border-style: ridge; border-width: 0; background-color: #CCFF99; color:#666633"></td>
</form>