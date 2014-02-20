<?
session_save_path("../xytmp");
session_start();
$user_id=$_SESSION["user_id"];
include "../inc/attest_lu.inc.php";

include "../inc/config.inc.php";
include "../inc/style.inc.php";
/*
==============
=恶人谷 1/9/2002
==============
*/
include "../include/area_now.inc.php";
$way = array("ereng/ereng_dong14.php","ereng/ereng_dong15.php");
area_now($way,$user_id);

include "../include/location_lu.inc.php";
up_location("石室","ereng/ereng_dong15.php","$user_id");
?>
<?
	echo "<br>==============石室==============<br>";
	echo ("
	这里是一个石室，你可以看到这里布置的十分精致，似乎以前的主人十分珍惜这里。
	在石室四壁上有不少【壁画】，似乎还有什么秘密隐藏在里面，但你一时无法理解。<br>
	");
	
	include "./inc/ereng_xiaohao.inc.php";
	include "../inc/db.inc.php";
	$bao_info = mysql_query("SELECT ereng_bao4,de_ren FROM ereng_bao");
	$bao_time = mysql_result($bao_info,0,"ereng_bao4");
	$bao_ren = mysql_result($bao_info,0,"de_ren");
	$now_time = time();
	$my_info = mysql_query("SELECT yun FROM renwu_member WHERE id='$user_id'");
	$my_yun = mysql_result($my_info,0,"yun");
	$add_exp = $my_yun * 50 + 3000;
	$add_mon = $my_yun * 30 + 1000;
	
	$wupin_info = mysql_query("SELECT id,cla,name FROM zhuangbei_wupin WHERE hidden='N' AND here='恶人村'");
	$wupin_num = mysql_num_rows($wupin_info);
	$now_num = rand(0,$wupin_num-1);
	$wupin_id = mysql_result($wupin_info,$now_num,"id");
	$wupin_cla = mysql_result($wupin_info,$now_num,"cla");
	$wupin_name = mysql_result($wupin_info,$now_num,"name");
	
	if(($now_time - $bao_time) > 43200 && $bao_ren != $user_id){		
		echo ("
			<p align=center>
			<img src=$jzpic_url/bao.gif border=0></img>
			<img src=$jzpic_url/bao.gif border=0></img><br>
			<img src=$jzpic_url/bao.gif border=0></img><br>
			<font color=#D7BB5B>你发现最后的宝藏</font><br><br>
			你得到了：".$add_exp."点经验<br>
			你得到了：".$add_mon."金钱<br>
			你得到了：".$wupin_name."<br>
			</p>			
		");
		mysql_query("UPDATE renwu_member SET exp=exp+'$add_exp',mon=mon+'$add_mon' WHERE id='$user_id'");
		mysql_query("INSERT INTO renwu_wupin VALUES('','$user_id','$wupin_id','0','N','$wupin_cla')");
		mysql_query("UPDATE ereng_bao SET ereng_bao4='$now_time',de_ren='$user_id'");
		mysql_close();
		
		$notice_channel = "宝藏";
		$notice_to = "ereng_b";
		include "../include/notice.inc.php";
		$notice_channel = "log";
		$notice_to = "ereng_b";
		include "../include/notice.inc.php";
				
	}else{
		echo "<br><br><font color=#D7BB5B>这里的宝箱好像才被人翻过了......</font><br><br>\n";
	}
	echo ("
	<br>
	这里可以通往==><br>	
	<a href=./ereng_dong14.php>【洞内岔路12】<a/>
	");
?>