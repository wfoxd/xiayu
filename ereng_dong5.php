<?
session_save_path("../xytmp");
session_start();
$user_id=$_SESSION["user_id"];
include "../inc/attest_lu.inc.php";

include "../inc/config.inc.php";
include "../inc/style.inc.php";
/*
==============
=恶人谷右路 1/8/2002
==============
*/
include "../include/area_now.inc.php";
$way = array("ereng/ereng_dong4.php","ereng/ereng_dong5.php");
area_now($way,$user_id);

include "../include/location_lu.inc.php";
up_location("洞内","ereng/ereng_dong5.php","$user_id");
?>
<?
	echo "<br>==============洞内岔路3==============<br>";
	echo ("
	这里似乎是个死路。<br>
	");
	
	include "./inc/ereng_xiaohao.inc.php";
	include "../inc/db.inc.php";
	$bao_time = mysql_query("SELECT ereng_bao1 FROM ereng_bao");
	$bao_time = mysql_result($bao_time,0,"ereng_bao1");
	$now_time = time();
	$my_info = mysql_query("SELECT yun FROM renwu_member WHERE id='$user_id'");
	$my_yun = mysql_result($my_info,0,"yun");
	$add_exp = $my_yun * 10 + 200;
	$add_mon = $my_yun * 5 + 100;
	
	if(($now_time - $bao_time) > 7200){
		echo ("
			<p align=center><img src=$jzpic_url/bao.gif border=0></img><br>
			<font color=#D7BB5B>你发现了一个小宝箱.......</font><br><br>
			你得到了：".$add_exp."点经验<br>
			你得到了：".$add_mon."金钱<br>
			</p>			
		");
		mysql_query("UPDATE renwu_member SET exp=exp+'$add_exp',mon=mon+'$add_mon' WHERE id='$user_id'");
		mysql_query("UPDATE ereng_bao SET ereng_bao1='$now_time'");
		mysql_close();		
	}else{
		echo "<br><br><font color=#D7BB5B>这里有个小宝箱，但好像刚刚才被打开过...</font><br><br>\n";
	}
	echo ("
	<br>
	这里可以通往==><br>	
	<a href=./ereng_dong4.php>【洞内岔路2】<a/>
	");
?>