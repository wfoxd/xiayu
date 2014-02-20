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
$way = array("ereng/ereng_dong4.php","ereng/ereng_dong6.php","ereng/ereng_dong9.php","ereng/ereng_dong8.php");
area_now($way,$user_id);
?>
<?
	echo "<br>==============洞内岔路4==============<br>";
	echo ("
	山洞内阴深恐怖，充满了邪恶之气，正气不够的人到这里一定受不了的。你可以看到
	这里有十根十分奇怪的石竹，似乎挡住了你的去路。<br>
	");
	
	include "./inc/ereng_xiaohao.inc.php";	
    	include "../inc/db.inc.php";
    	$my_info = mysql_query("SELECT exp FROM renwu_member WHERE id='$user_id'");
    	$my_exp = mysql_result($my_info,0,"exp");
    	if($my_exp < 100000){
    		echo ("
    			<br><br><font color=#4F88BB>你努力施展出平身所学，但还是无法通过这些石竹.....</font><br>
    			你无法前行了，看来你只有调头回去了。<br>
    			<a href=./ereng_dong4.php>【洞内岔路2】<a/>
    		");
    		exit();
    	}else{
    		echo ("
    			<br><br><p align=center><img src=$pic3_url/xiake/xiake10.jpg border=0></img><br>
    			<font color=#4F88BB>你施展平身所学，很轻易地跳过了十根石竹</font><br></p>
    		");
    	}
    	
    	include "../include/location_lu.inc.php";
	up_location("洞内","ereng/ereng_dong6.php","$user_id");
	echo ("
	<br>
	这里可以通往==><br>	
	<a href=./ereng_dong9.php>【洞内岔路7】<a/>
	<a href=./ereng_dong4.php>【洞内岔路2】<a/>
	<a href=./ereng_dong8.php>【洞内岔路6】<a/>
	");
?>