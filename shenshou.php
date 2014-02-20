<?
session_save_path("xytmp");
session_start();
$user_id=$_SESSION["user_id"];
$huifu=$_GET['huifu'];
include "./inc/attest.inc.php";

include "./inc/config.inc.php";
include "./inc/style.inc.php";
/*
==============
=
=公元 2002年月日
==============
*/
//判断瞬移
include "./include/area_now_ct.inc.php";
$way = array("bhc/bhc.php","shenshou.php");
area_now($way,$user_id);
//记录位置
include "./include/location.inc.php";
up_location("圣手回春","shenshou.php","$user_id");
?>
<?
	echo "<br>=============圣手回春===============<br>";
	echo ("这里是圣手回春的家，你可以看到一个仙人模样的老人
	坐在堂上。他的治疗技术举世无双，可以帮助你恢复能力。<br>
	注意：接受治疗将损失四分之一经验。<br>
	");
	echo "<a href=shenshou.php?huifu=1>接受治疗</a>";
	echo "<br><a href=shenshou.php?huifu=2>自废内功</a>";
/*
	$npc_org = "圣手回春";
    	include "../include/list_npc.inc.php";  
*/
	echo ("
	<br>
	这里可以通往==><br>	
	<a href=./bhc/bhc.php>【大街】<a/>
	");
	
	if($huifu == 1){
		include "./inc/db.inc.php";
		$myinfo = mysql_query("SELECT hp FROM renwu_member where id='$user_id'");
		
		$my_hp = mysql_result($myinfo,0,"hp");
		
		if($my_hp >= 100){
			echo "<font color=red>这里只帮助那些受伤十分严重的人恢复。</font>";
			mysql_close();
			exit();
		}
	mysql_query("UPDATE renwu_member SET hp=150,exp=exp*0.75 WHERE id='$user_id'");
	echo "<font color=red>妙手回春老人施展神术给你恢复了。。。</font>";
	
	mysql_close();
	}
	if($huifu == 2){
		include "./inc/db.inc.php";
		$myinfo = mysql_query("SELECT hp FROM renwu_member where id='$user_id'");
		
		$my_hp = mysql_result($myinfo,0,"hp");
		
		if($my_hp >= 100){
			echo "<font color=red>这里只帮助那些受伤十分严重的人恢复。</font>";
			mysql_close();
			exit();
		}
		mysql_query("UPDATE renwu_membe SET en=0,ennow=0 WHERE id='$user_id'");
		mysql_query("UPDATE renwu_wugong SET wugongexp=1 WHERE id='$user_id' AND cla='内功'");
		echo "<font color=red>妙手回春老人施展神术使你的内功全部失去了。。。</font>";
	}
?>