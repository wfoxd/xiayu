<?
session_save_path("xytmp");
session_start();
$user_id=$_SESSION["user_id"];
$cla_c=$_GET['cla_c'];
include "./inc/attest.inc.php";

/*
================================
=战斗系统完成 (Ver 0.1.2)
=公元：2001年11月14日
================================
*/
/*
================================
=内力使用添加 (Ver 0.1.2)
=公元：2001年11月18日
================================
*/
/*
================================
=模块变更 (Ver 0.1.2)
=公元：2001年11月25日
================================
*/
/*
================================
=物品使用模块 (Ver 0.1.2)
=公元：2001年11月29日
================================
*/
/*
================================
=组织战斗模块 (Ver 0.1.2)
=公元：2001年12月10日
================================
*/
/*
================================
=武器模块 (Ver 0.1.2)
=公元：2001年12月14日
================================
*/
include "./inc/config.inc.php";
include "./inc/style.inc.php";
include "./include/area_now_ct.inc.php";
$way = array("batten.php","xy_city.php");
area_now($way,$user_id);
include "./include/location.inc.php";
up_location("组织武斗场","batten.php","$user_id");
?>
<?
	echo "<br>==============侠域组织==============<br>";
	echo ("【侠域组织】专门为各路武林人士提供了一个相互了解的地方。	
	");
	
    	$npc_org = "武斗场";
    	include "./include/list_npc.inc.php";   
?>
<form method=POST action=batten.php?cla_c=1>
<pre>=========================武林帮会组织=========================</pre>
<?
	$empty_r=0;
    	
	function compare_array($temp,$array){
	$num=count($array);
	for($i=0;$i<$num;$i++){
     	if($temp == $array[$i])
          	return 0;
	}
	return 1;
	}

	$result=mysql_query("SELECT orgname,orgpos,orgp,orgopen,orglocation FROM org");

	$num=mysql_num_rows($result);
	
    	echo "<ul>\n";
    	for($k=0;$k<$num;$k++){
    	echo "<li>\n";
    	
    	$orgname = mysql_result($result,$k,"orgname");
    	$orgpos = mysql_result($result,$k,"orgpos");
    	$orgp = mysql_result($result,$k,"orgp");
    	$orgopen = mysql_result($result,$k,"orgopen");
    	$orglocation = mysql_result($result,$k,"orglocation");
    	
    	if($orgpos > 0) $px = "<font color=#918B75>正派</font>";
    	if($orgpos == 0) $px = "不正不邪";
    	if($orgpos < 0) $px = "<font color=#D223DC>邪派</font>";
    	$name = mysql_query("SELECT name FROM renwu_member WHERE id='$orgp'");
    	$orgp = mysql_result($name,0,"name");
    	echo "（".$px."）<font color=#804040>$orgname</font>--首脑：（".$orgp."）开放状态：$orgopen 总坛位置：$orglocation\n";
        echo "</li>\n";
     	}
     	echo "</ul>\n";
     	
     	mysql_close();
     	
     	include "./include/back_xy.inc.php";
?>
</form>