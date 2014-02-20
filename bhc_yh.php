<?
session_save_path("../xytmp");
session_start();
$user_id=$_SESSION["user_id"];
$cun=$_GET['cun'];
$cun_mon=$_POST['cun_mon'];
$qu=$_GET['qu'];
$qu_mon=$_POST['qu_mon'];
include "../inc/attest_lu.inc.php";

include "../inc/config.inc.php";
include "../inc/style.inc.php";
/*
==============
=小路1 1/5/2002
==============
*/
include "../include/area_now.inc.php";
$way = array("bhc/bhc.php","bhc/bhc_yh.php");
area_now($way,$user_id);

include "../include/location_lu.inc.php";
up_location("廖记银行","bhc/bhc_yh.php","$user_id");
?>
<?
	echo "<br>==============廖记银行==============<br>";
	echo ("这里是百年老店【廖记银行】，凭它百年信誉，你是完全可以信任的。<br>
	");
	
	include "../inc/db.inc.php";
		
	echo ("
		<form action=".$PHP_SELF."?cun=1 method=post>
		存款数量<input type=text size=4 name=cun_mon>
		<input type=submit value='存 款' name='B1' style='font-family: 宋体; border-style: ridge; border-width: 0; background-color: #CCFF99; color:#666633'>
		</form>
	");
	
	echo ("
		<form action=".$PHP_SELF."?qu=1 method=post>
		取款数量<input type=text size=4 name=qu_mon>
		<input type=submit value='取 款' name='B2' style='font-family: 宋体; border-style: ridge; border-width: 0; background-color: #CCFF99; color:#666633'>
		</form>
	");
	
	if($cun == 1){
		$cun_mon=intval($cun_mon);
		if($cun_mon <= 0 || $cun_mon > 10000000){
			echo "<br><font color=green>请输入正确的金钱数量。</font>\n";
			echo "<meta http-equiv=\"refresh\" content=\"5; url=bhc_yh.php\">";
			mysql_close();
			exit();		
		}
		$my_mon = mysql_query("SELECT mon FROM renwu_member WHERE id='$user_id'");
		$my_mon = mysql_result($my_mon,0,"mon");
		if($my_mon < $cun_mon){
			echo "<br><font color=green>你没那么多钱可以存。</font>\n";
			echo "<meta http-equiv=\"refresh\" content=\"5; url=bhc_yh.php\">";
			mysql_close();
			exit();	
		}
		mysql_query("UPDATE misc SET cun_mon=cun_mon+'$cun_mon' WHERE id='$user_id'");
		mysql_query("UPDATE renwu_member SET mon=mon-'$cun_mon' WHERE id='$user_id'");
		
		echo "<br><font color=red>你的钱存好了。</font>";
	}
	if($qu == 1){
		$qu_mon=intval($qu_mon);
		if($qu_mon <= 0 || $qu_mon > 10000000){
			echo "<br><font color=green>请输入正确的金钱数量。</font>\n";
			echo "<meta http-equiv=\"refresh\" content=\"5; url=bhc_yh.php\">";
			mysql_close();
			exit();		
		}
		$my_mon = mysql_query("SELECT cun_mon FROM misc WHERE id='$user_id'");
		$my_mon = mysql_result($my_mon,0,"cun_mon");
		if($my_mon < $qu_mon){
			echo "<br><font color=green>你没那么多钱可以取。</font>\n";
			echo "<meta http-equiv=\"refresh\" content=\"5; url=bhc_yh.php\">";
			mysql_close();
			exit();	
		}
		mysql_query("UPDATE misc SET cun_mon=cun_mon-'$qu_mon' WHERE id='$user_id'");
		mysql_query("UPDATE renwu_member SET mon=mon+'$qu_mon' WHERE id='$user_id'");
		
		echo "<br><font color=red>你的钱取好了。</font>";
	}
	
	$my_cun = mysql_query("SELECT cun_mon FROM misc WHERE id='$user_id'");
	$my_cun = mysql_result($my_cun,0,"cun_mon");
	
	echo "<br>你现在存款".$my_cun;
	
	echo ("
	<br>
	这里可以返回==><br>	
	<a href=./bhc.php>【大街】<a/><br>
	");
?>