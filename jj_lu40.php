<?
include "../inc/attest_lu.inc.php";
/*
===============================================================
=                 侠域(Ver 0.9.0) 使用规则版本(Ver 0.2)       =
             此程序所有版权归原作者所有. 此版权信息不得删除.
= Copyright (C) 2001-2002  WFoxd                              =
=                                                             =
=版权所有(C)2002，作者 田野（风狐） 未经许可 不得使用 传播    =
=E-MAIL:wfoxd@cnnetgame.com                                   =
=http://www.cnnetgame.com                                     =
===============================================================
*/
include "../inc/config.inc.php";
include "../inc/style.inc.php";
//判断瞬移
include "../include/area_now.inc.php";
$way = array("dl/jj_lu41.php","dl/jj_lu40.php");
area_now($way,$user_id);
//记录位置
include "../include/location_lu.inc.php";
up_location("荆棘路","dl/jj_lu40.php","$user_id");
?>
<?
	echo "<br>=============荆棘路===============<br>";
	echo ("这是一条布满了荆棘的小路。<br>
	");
	
	include "../inc/db.inc.php";
	$bao_time = mysql_query("SELECT bao7 FROM dl_bao");
	$bao_time = mysql_result($bao_time,0,"bao7");
	$now_time = time();
	$my_info = mysql_query("SELECT yun FROM renwu_member WHERE id='$user_id'");
	$my_yun = mysql_result($my_info,0,"yun");
	$add_exp = $my_yun * 20 + 500;
	$add_mon = $my_yun * 10 + 200;
	
	if(($now_time - $bao_time) > 72000){
		echo ("
			<p align=center><img src=$jzpic_url/bao.gif border=0></img><br>
			<font color=#D7BB5B>你发现了一个小宝箱.......</font><br><br>
			你得到了：".$add_exp."点经验<br>
			你得到了：".$add_mon."金钱<br>
			</p>			
		");
		mysql_query("UPDATE renwu_member SET exp=exp+'$add_exp',mon=mon+'$add_mon' WHERE id='$user_id'");
		mysql_query("UPDATE dl_bao SET bao7='$now_time'");
		mysql_close();		
	}else{
		echo "<br><br><font color=#D7BB5B>这里有个小宝箱，但好像刚刚才被打开过...</font><br><br>\n";
	}
	
/*
	$npc_org = "";
    	include "../include/list_npc.inc.php";  
*/
	echo ("
	<br>
	这里可以通往==><br>	
	<a href=./jj_lu41.php>【荆棘路】<a/>
	");
?>