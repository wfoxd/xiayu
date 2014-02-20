<?
session_save_path("xytmp");
session_start();
$user_id=$_SESSION["user_id"];
$here=$_GET['here'];

include "./inc/attest.inc.php";

include "./inc/config.inc.php";
include "./inc/style.inc.php";
/*
==============
=小巷 (Ver 0.4.0)
=公元 2002年1月2日
==============
*/
?>
<?
	echo "<br>==============小巷==============<br>";
	echo ("这是城里一条小巷，你可以看到两旁有不少店铺，还可以听到从中央大街上传来的喧嚣声。
	");
	
	if($here == 1){
		include "./include/area_now_ct.inc.php";
		$way = array("xiao_x.php?here=1","xy_city.php");
		area_now($way,$user_id);
		include "./include/location.inc.php";
		up_location("小巷1","xiao_x.php?here=1","$user_id");
		$npc_org = "小巷1";
    		include "./include/list_npc.inc.php";  
	}
	if($here == 2){
		include "./include/area_now_ct.inc.php";
		$way = array("xiao_x.php?here=2","xy_city.php");
		area_now($way,$user_id);
		include "./include/location.inc.php";
		up_location("小巷2","xiao_x.php?here=2","$user_id");
		$npc_org = "小巷2";
    		include "./include/list_npc.inc.php";  
	}
	if($here == 3){
		include "./include/area_now_ct.inc.php";
		$way = array("xiao_x.php?here=3","xy_city.php");
		area_now($way,$user_id);
		include "./include/location.inc.php";
		up_location("小巷3","xiao_x.php?here=3","$user_id");
		$npc_org = "小巷3";
    		include "./include/list_npc.inc.php";  
	}
	if($here == 4){
		include "./include/area_now_ct.inc.php";
		$way = array("xiao_x.php?here=4","xy_city.php");
		area_now($way,$user_id);
		include "./include/location.inc.php";
		up_location("小巷4","xiao_x.php?here=4","$user_id");
		$npc_org = "小巷4";
    		include "./include/list_npc.inc.php";  
	}
	if($here == 5){
		include "./include/area_now_ct.inc.php";
		$way = array("xiao_x.php?here=5","xy_city.php");
		area_now($way,$user_id);
		include "./include/location.inc.php";
		up_location("小巷5","xiao_x.php?here=5","$user_id");
		$npc_org = "小巷5";
    		include "./include/list_npc.inc.php";  
	}
	include "./include/back_xy.inc.php";
?>