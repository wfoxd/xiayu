<?
session_save_path("../xytmp");
session_start();
$user_id=$_SESSION["user_id"];
$here=$_GET['here'];
include "../inc/attest_lu.inc.php";

include "../inc/config.inc.php";
include "../inc/style.inc.php";
/*
==============
=恶人村小巷 (Ver 0.4.0)
=公元 2002年1月7日
==============
*/
?>
<?
	echo "<br>==============小路==============<br>";
	echo ("这是恶人村里一条小路，再往前面走就出村了。
	");
	
	if($here == 1){
		include "../include/area_now.inc.php";
		$way = array("ereng/erenc.php","ereng/erenc_xiao_x.php?here=1");
		area_now($way,$user_id);
		include "../include/location_lu.inc.php";
		up_location("恶人小路1","ereng/erenc_xiao_x.php?here=1","$user_id");
		$npc_org = "恶人小路1";
    		include "../include/list_npc.inc.php";
	}
	if($here == 2){
		include "../include/area_now.inc.php";
		$way = array("ereng/erenc.php","ereng/erenc_xiao_x.php?here=2");
		area_now($way,$user_id);
		include "../include/location_lu.inc.php";
		up_location("恶人小路2","ereng/erenc_xiao_x.php?here=2","$user_id");
		$npc_org = "恶人小路2";
    		include "../include/list_npc.inc.php";
	}
	if($here == 3){
		include "../include/area_now.inc.php";
		$way = array("ereng/erenc.php","ereng/erenc_xiao_x.php?here=3");
		area_now($way,$user_id);
		include "../include/location_lu.inc.php";
		up_location("恶人小路3","ereng/erenc_xiao_x.php?here=3","$user_id");
		$npc_org = "恶人小路3";
    		include "../include/list_npc.inc.php";
	}
	echo ("
	<br>
	这里可以返回==><br>	
	<a href=./erenc.php>【恶人村】<a/><br>
	");
?>