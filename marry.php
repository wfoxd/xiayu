<?
session_save_path("xytmp");
session_start();
$user_id=$_SESSION["user_id"];
$zhuce=$_GET['zhuce'];
$B1=$_POST['B1'];
$lihun=$_GET['lihun'];
$kai=$_GET['kai'];
$list=$_GET['list'];
$marry=$_GET['marry'];
$duixiang_id=$_POST['duixiang_id'];
$qiuhun_xy=$_POST['qiuhun_xy'];

include "./inc/attest.inc.php";

/*
==============
=结婚系统
=公元2001年12月11日
==============
*/
include "inc/config.inc.php";
include "inc/style.inc.php";

include "./include/area_now_ct.inc.php";
$way = array("marry.php","xy_city.php");
area_now($way,$user_id);
include "./include/location.inc.php";
up_location("红娘庄","marry.php","$user_id");
?>
<p align=center><img src=<? echo $pic3_url."/xiake/xiake02.jpg"; ?> border=0></img>
<h3><p align=center><font color=red><侠域>红娘庄</font></h3>
<hr width=80%>
<?
if($zhuce == 1){
if($B1 == "接受"){
	include "./inc/db.inc.php";
	
	$marry_me = mysql_query("SELECT id FROM misc WHERE duixiang='$user_id'");
	$marry_me_info = @mysql_result($marry_me,0,"id");
	
	echo "<br><font color=red>你同意了".$marry_me_info."的求婚！</font>\n";
	
	mysql_query("UPDATE misc SET duixiang='$marry_me_info' WHERE id='$user_id'");
	
	echo "<br><font color=red>恭喜你们成为了合法夫妻！快去摆酒席吧..........</font>\n";
	
	$notice_channel = "结婚";
	$notice_to = "成婚";
	include "./include/notice.inc.php";
	mysql_close();
	exit();	
}
if($B1 == "反对"){
	include "./inc/db.inc.php";
	
	$marry_me = mysql_query("SELECT id FROM misc WHERE duixiang='$user_id'");
	$marry_me_info = @mysql_result($marry_me,0,"id");
	
	echo "<br><font color=black>你不同意与".$marry_me_info."结婚！</font>\n";
	echo "<meta http-equiv=\"refresh\" content=\"10; url=marry.php\">";
	
	mysql_query("UPDATE misc SET duixiang='' WHERE id='$marry_me_info'");
	$notice_channel = "结婚";
	$notice_to = "反对求婚";
	include "./include/notice.inc.php";
	mysql_close();
	exit();
}}
if($lihun == 1){
	if($lihun == 1 && $kai != 2){
		echo "<form action=marry.php?lihun=1&kai=2 method=post>\n";
		echo "<p align=center><br><input type=submit name=B1 value=离婚 style=\"font-family: 楷体_GB2312; border-style: ridge; border-width: 0; background-color: #99CC00\">\n";
		echo "</form>\n";
		exit();
	}

	include "./inc/db.inc.php";
	
	$my_info = mysql_query("SELECT mon FROM renwu_member WHERE id='$user_id'");
	
	$my_mon = mysql_result($my_info,0,"mon");
	
	if($my_mon < 1000){
		echo "离婚手续费不够哦！\n";
		echo "<meta http-equiv=\"refresh\" content=\"10; url=marry.php\">";
		mysql_close();
		exit();
	}
	
	$my_mon -= 1000;
	mysql_query("UPDATE renwu_member SET mon='$my_mon' WHERE id='$user_id'");
	
	$marry_me = mysql_query("SELECT id FROM misc WHERE duixiang='$user_id'");
	$marry_me_info = @mysql_result($marry_me,0,"id");
	
	mysql_query("UPDATE misc SET duixiang='' WHERE id='$user_id' OR id='$marry_me_info'");
	
	echo "<font color=black>离婚手续办理完毕！</font>\n";
	$notice_channel = "结婚";
	$notice_to = "离婚";
	include "./include/notice.inc.php";
	mysql_close();
	exit();	
}
if($list == 1){
	include "./inc/db.inc.php";
	
	$my_info = mysql_query("SELECT sex,mon FROM renwu_member WHERE id='$user_id'");
	
	$my_sex = mysql_result($my_info,0,"sex");
	$my_mon = mysql_result($my_info,0,"mon");
	
	if($my_mon < 500){
		echo "查询费都没有，怎么找自己的心上人啊！\n";
		echo "<meta http-equiv=\"refresh\" content=\"10; url=marry.php\">";
		mysql_close();
		exit();
	}
	
	$my_mon -= 500;
	mysql_query("UPDATE renwu_member SET mon='$my_mon' WHERE id='$user_id'");
	
	if($my_sex == "侠客"){
		$list_info = mysql_query("SELECT id,name,org,cha,nick,icon FROM renwu_member WHERE sex='侠女'");
		$d_sex = "侠女";
	}else{
		$list_info = mysql_query("SELECT id,name,org,cha,nick FROM renwu_member WHERE sex='侠客'");
		$d_sex = "侠客";
	}
	$num_list = mysql_num_rows($list_info);
	
	if($num_list == 0){
		echo "很抱歉告诉你，这里没有合适做你伴侣的人！\n";
		echo "<meta http-equiv=\"refresh\" content=\"10; url=marry.php\">";
		mysql_close();
		exit();
	}
	
	echo "<table>\n";
	for($i=0;$i<$num_list;$i++){
		$d_id = mysql_result($list_info,$i,"id");
		$d_name = mysql_result($list_info,$i,"name");
		$d_org = mysql_result($list_info,$i,"org");
		$d_cha = mysql_result($list_info,$i,"cha");
		$d_nick = mysql_result($list_info,$i,"nick");
		$d_icon = mysql_result($list_info,$i,"icon");
		
		echo "<tr><td><img src=".$pic2_url."/".$d_icon.".gif  border=0></img><td><font color=green>".$d_org."的".$d_cha."<font color=blue>".$d_sex."</font>".$d_nick.$d_name."</font></td></tr>\n";
	}	
	
	mysql_close();
	exit();
}
if($marry == 1){
	include "./inc/db.inc.php";
	
	$marry_me = mysql_query("SELECT id FROM misc WHERE duixiang='$user_id'");
	$marry_me_info = @mysql_result($marry_me,0,"id");
	
	if($marry_me_info){
		echo "<form action=marry.php?zhuce=1 method=post>\n";
		
		echo "<br><font color=green>".$marry_me_info."已经注册要你作为他的爱人，你接受他的求婚吗？</font>\n";
		echo "<br><input type=submit name=B1 value=接受 style=\"font-family: 楷体_GB2312; border-style: ridge; border-width: 0; background-color: #99CC00\">\n";
		echo "<br><input type=submit name=B1 value=反对 style=\"font-family: 楷体_GB2312; border-style: ridge; border-width: 0; background-color: #99CC00\">\n";
		
		echo "</form>\n";
		mysql_close();
		exit();
	}

	echo ("
	<form action=marry.php?marry=2 method=post>
    	你的心上人识别号<input name=duixiang_id size=5 type=text><br>
    	给你心上人的求婚宣言<input name=qiuhun_xy size=25 type=text>
    	<input type=submit name=geimon value=登记注册 style=\"font-family: 宋体; border-style: ridge; border-width: 0; background-color: #CCFF99; color:#666633\">
    	</form>
	");
	
	exit();
}
if($marry == 2){
	include "./inc/db.inc.php";
	
	$my_info = mysql_query("SELECT sex,mon FROM renwu_member WHERE id='$user_id'");
	
	$my_sex = mysql_result($my_info,0,"sex");
	$my_mon = mysql_result($my_info,0,"mon");
	
	$have_marryed = mysql_query("SELECT count(id) FROM misc WHERE duixiang='$duixiang_id'");
	$have_marryed = mysql_fetch_row($have_marryed);	
	
	if($my_mon < 5000){
		echo "<br><font color=green>不是吧，你钱都没有准备好啊！</font>\n";
		echo "<meta http-equiv=\"refresh\" content=\"10; url=marry.php\">";
		mysql_close();
		exit();
	}
	
	if(empty($duixiang_id)){
		echo "<br><font color=green>你要和谁登记注册啊！</font>\n";
		echo "<meta http-equiv=\"refresh\" content=\"10; url=marry.php\">";
		mysql_close();
		exit();
	}
	
	if(empty($qiuhun_xy)){
		echo "<br><font color=green>你不会没有一点想说的吧！</font>\n";
		echo "<meta http-equiv=\"refresh\" content=\"10; url=marry.php\">";
		mysql_close();
		exit();
	}
	
	if($have_marryed[0]){
		echo "<br><font color=green>我们十分遗憾的告诉你，你的心上人已经被其它人提前“注册”了！</font>\n";
		echo "<meta http-equiv=\"refresh\" content=\"10; url=marry.php\">";
		mysql_close();
		exit();
	}
	
	$e_info = @mysql_query("SELECT name,sex FROM renwu_member WHERE id='$duixiang_id'");
	$e_name = @mysql_result($e_info,0,"name");
	$e_sex = @mysql_result($e_info,0,"sex");
	
	if(empty($e_name)){
		echo "<br><font color=green>没有这个人呢！</font>\n";
		echo "<meta http-equiv=\"refresh\" content=\"10; url=marry.php\">";
		mysql_close();
		exit();
	}
	
	if($e_sex == $my_sex){
		echo "<br><font color=red>不会吧！我们这里不办理同性恋手续！</font>\n";
		echo "<meta http-equiv=\"refresh\" content=\"10; url=marry.php\">";
		mysql_close();
		exit();
	}
	
	$my_mon -= 5000;
	mysql_query("UPDATE renwu_member SET mon='$my_mon' WHERE id='$user_id'");
	
	mysql_query("UPDATE misc SET duixiang='$duixiang_id' WHERE id='$user_id'");
	
	mysql_close();
	
	echo $e_name."已经登记注册成为你的未婚爱人，请等待对方同意，你们即可成为合法夫妻！\n";
	$notice_channel = "结婚";
	$notice_to = "求婚";
	include "./include/notice.inc.php";
	exit();
}
?>
<?
	include "./inc/db.inc.php";
	
	$my_marryed = mysql_query("SELECT duixiang FROM misc WHERE id='$user_id'");
	$my_duixiang = @mysql_result($my_marryed,0,"duixiang");
	
	$npc_org = "红娘庄";
	include "./include/list_npc.inc.php";
	
	if(!$my_duixiang){
		echo "<p align=center><font color=black>孤单侠客走江湖，欲寻红颜不知处！</font>\n";
		echo "<hr width=60%>";
		echo "<p align=center><a href=marry.php?list=1>红娘介绍（收费500）</a>\n";
		echo "<p align=center><a href=marry.php?marry=1>结婚登记（收费5000）</a>\n";		
	}else{
		echo "<p align=center><font color=red>侠侣相伴闯江湖，夫妻双双恩爱情！</font>\n";
		echo "<hr width=60%>";
		echo "<p align=center><a href=marry.php?lihun=1>离婚办理（收费1000）</a>\n";
	}
	
     include "./include/back_xy.inc.php";
     mysql_close();
     
?>