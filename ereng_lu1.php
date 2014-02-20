<?
session_save_path("../xytmp");
session_start();
$user_id=$_SESSION["user_id"];
include "../inc/attest_lu.inc.php";

include "../inc/config.inc.php";
include "../inc/style.inc.php";
/*
==============
=恶人谷谷口 1/8/2002
==============
*/
include "../include/area_now.inc.php";
$way = array("ereng/ereng_lu1.php","ereng/ereng_lu2.php","ereng/erenc.php");
area_now($way,$user_id);

include "../include/location_lu.inc.php";
up_location("恶人谷口","ereng/ereng_lu1.php","$user_id");
?>
<?
	echo ("
<p align=center><img src=".$pic3_url."/xiake/xiake15.jpg border=0></img><br>
</p>
");
	echo "<br>==============恶人谷口==============<br>";
	echo ("再往前走就是恶人谷了，你可以看到路旁【恶人谷】三个大字的碑。<br>
	");
	
	include "../include/tianqi.inc.php";
	
	$damage = weather_info(10);
	include "../include/xiaohao.inc.php";
	xiaohao($damage,$user_id);
	
	echo ("
	<br>
	这里可以通往==><br>	
	<a href=./erenc.php>【恶人村】<a/>
	<a href=./ereng_lu2.php>【山路】<a/>
	");
?>