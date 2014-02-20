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
$way = array("dl/jj_lu49.php","dl/jj_lu48.php","dl/jj_lu50.php","bhc/bhc.php");
area_now($way,$user_id);
//记录位置
include "../include/location_lu.inc.php";
up_location("森林","dl/jj_lu50.php","$user_id");
?>
<?
	echo "<br>=============森林===============<br>";
	echo ("这里已经是森林深处了，透过参天大树缝隙里照射进来的一束束阳光，让这里的人觉得
	寒气逼人。你可以看到大树下坐着一个人。<br>
	");
	
	include "../include/tianqi.inc.php";
	
	$damage = weather_info(20);
	include "../include/xiaohao.inc.php";
	xiaohao($damage,$user_id);
	
	include "../inc/db.inc.php";
	$de_b = mysql_query("SELECT de_dao FROM dl_bao");
	
	if(mysql_result($de_b,0,"de_dao") == "N"){
	$npc_org = "的鹿森林";
    	include "../include/list_npc.inc.php";  
	}

	echo ("
	<br>
	这里可以通往==><br>	
	<a href=./jj_lu49.php>【荆棘路】<a/>
	<a href=../bhc/bhc.php>【通往百花城的小路】<a/>
	<a href=./jj_lu48.php>【荆棘路】<a/>
	");
?>