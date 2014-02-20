<?
session_save_path("../xytmp");
session_start();
$user_id=$_SESSION["user_id"];
include "../inc/attest_lu.inc.php";

include "../inc/config.inc.php";
include "../inc/style.inc.php";
/*
==============
=小路1 1/5/2002
==============
*/
include "../include/area_now.inc.php";
$way = array("ereng/lu_3.php","ereng/xiaodian_1.php");
area_now($way,$user_id);

include "../include/location_lu.inc.php";
up_location("小店","ereng/xiaodian_1.php","$user_id");
?>
<?
	echo "<br>==============小店==============<br>";
	echo ("这是一家驿道旁的小店，你可以在这里休息休息再继续赶路。<br>
	");
		
	echo ("
	<br>
	这里可以通往==><br>	
	<a href=./lu_3.php>【驿道】<a/><br>
	");
?>
<?
if($zf == 1){
	include "../inc/db.inc.php";
	
	$my_info = mysql_query("SELECT mon,hpnow,hp,po,ponow FROM renwu_member WHERE id='$user_id'");
	$my_mon = mysql_result($my_info,0,"mon");
	$my_hpnow = mysql_result($my_info,0,"hpnow");
	$my_hp = mysql_result($my_info,0,"hp");
	$my_po = mysql_result($my_info,0,"po");
	$my_ponow = mysql_result($my_info,0,"ponow");
	
	if($my_mon < $kefang){
		echo "<br><font color=green>你钱都不够怎么住店啊！</font>\n";
		echo "<meta http-equiv=\"refresh\" content=\"10; url=kedian.php?battle=1\">";
		mysql_close();
		exit();		
	}
	
	$my_info = mysql_query("SELECT kedian FROM misc WHERE id='$user_id'");
	$my_kedian = mysql_result($my_info,0,"kedian");
	
	if(time() < $my_kedian+1800){
		echo "<br><font color=green>你住店太频繁了，现在都没有任何效果了！</font>\n";
		echo "<meta http-equiv=\"refresh\" content=\"3; url=kedian.php?battle=1\">";
		mysql_close();
		exit();	
	}
	
	$my_hpnow = $my_hp*($hf/100) + $my_hpnow;
	$my_ponow = $my_po*($hf/100) + $my_ponow;
	if($my_hpnow > $my_hp) $my_hpnow = $my_hp;
	if($my_ponow > $my_po) $my_ponow = $my_po;
	
	$time = time();
	
	mysql_query("UPDATE renwu_member SET hpnow='$my_hpnow',mon=mon-'$kefang' WHERE id='$user_id'");
	mysql_query("UPDATE misc SET kedian='$time' WHERE id='$user_id'");
	
	echo "<font color=#B3A43E>你美美地睡了一觉，觉得身心舒畅.....</font>\n";
	echo "<meta http-equiv=\"refresh\" content=\"3; url=xiaodian_1.php\">";
	mysql_close();
	exit();
}
?>
<form>
<select name=xiuxi size=1 onChange="window.location=form.xiuxi.options[form.xiuxi.selectedIndex].value">
<option value=>客房..</option>
<option value=xiaodian_1.php?kefang=150&hf=20&zf=1>柴房（150/次/恢复20%）</option>
<option value=xiaodian_1.php?kefang=520&hf=40&zf=1>下房（520/次/恢复40%）</option>
<option value=xiaodian_1.php?kefang=1350&hf=60&zf=1>中房（1350/次/恢复60%）</option>
</select>
</form>