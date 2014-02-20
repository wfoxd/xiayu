<?
/*
===============================================================
=                 侠域(Ver 0.9.0) 使用规则版本(Ver 0.2)     =
 此程序所有版权归原作者所有. 此版权信息不得删除.
= Copyright (C) 2001-2002  WFoxd                              =
=                                                             =
=版权所有(C)2002，作者 田野（风狐） 未经许可 不得使用 传播    =
=E-MAIL:wfoxd@cnnetgame.com                                   =
=http://www.cnnetgame.com                                     =
===============================================================
*/
$DBhost   =   "localhost";   //数据库位置

$DBuser   =   "chunplay_warrior";    //数据库用户名

$DBpasswd  =  "ecnu214337";    //数据库密码

$DBdatabase  =  "chunplay_warrior";   //数据库名称

$SetCharacterSetSql = "SET NAMES 'gbk'";

$link=@mysql_connect($DBhost,$DBuser,$DBpasswd) or die("数据库连接错误！");

$Recordset1 = mysql_query($SetCharacterSetSql, $link) or die(mysql_error());

mysql_select_db($DBdatabase);

?>