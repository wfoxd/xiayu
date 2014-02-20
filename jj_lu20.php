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
$way = array("dl/jj_lu16.php","dl/jj_lu20.php","dl/jj_lu28.php");
area_now($way,$user_id);
//记录位置
include "../include/location_lu.inc.php";
up_location("荆棘路","dl/jj_lu20.php","$user_id");
?>
<?
	echo "<br>=============荆棘路===============<br>";
	echo ("这是一条布满了荆棘的小路，一直延伸到了森林里。<br>
	");
	
	include "../include/tianqi.inc.php";
	
	$damage = weather_info(20);
	include "../include/xiaohao.inc.php";
	xiaohao($damage,$user_id);
	
/*
	$npc_org = "";
    	include "../include/list_npc.inc.php";  
*/
	echo ("
	<br>
	这里可以通往==><br>	
	<a href=./jj_lu16.php>【荆棘路】<a/>
	<a href=./jj_lu28.php>【荆棘路】<a/>
	");
?>