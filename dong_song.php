<?
session_save_path("xytmp");
session_start();
include "./inc/attest.inc.php";

/*
================================
=送信任务 (Ver 0.4.2)
=公元：2002年1月12日
================================
*/
include "./inc/config.inc.php";
include "./inc/style.inc.php";
include "./include/area_now_ct.inc.php";
$way = array("dong_song.php","xy_city.php");

$user_id=$_SESSION["user_id"];
$help=$_GET['help'];
area_now($way,$user_id);
include "./include/location.inc.php";
up_location("东巷","dong_song.php","$user_id");
?>
<?
	echo "<br>==============东巷==============<br>";
	echo ("
		这是【侠域城】东边主要道路，从这里向前走可以出东门。
	");
    	$npc_org = "东巷";
    	include "./include/list_npc.inc.php";
    	
    	include "./inc/db.inc.php";
    	
    	$my_song = mysql_query("SELECT song_to,song_time FROM misc WHERE id='$user_id'");
    	$my_song_to = @mysql_result($my_song,0,"song_to");
    	$my_song_time = @mysql_result($my_song,0,"song_time");
    	
    	if($help == "1"){    		
    		$location_info = mysql_query("SELECT location_id FROM misc WHERE id='$user_id'");
  		$location_id = mysql_result($location_info,0,"location_id");
		
		if($location_id != "dong_song.php"){
		echo "<font color=red>怎么，你这样的人都喜欢干一些非法手段？</font>\n";
		echo "<font color=red>系统判断到你想进行非法操作，对你进行惩罚！</font>\n";
		mysql_query("UPDATE renwu_member SET exp=exp-1000 WHERE id='$user_id'");				
		exit();
		}
		$now_time =time();
		if($my_song_to != ""){    		
    		if(($my_song_time - $now_time) > 0){
    			echo "<br><font color=#4DB39B>何新对你说道：你的工作还没有完，你还要继续阿！</font><br><br>\n";	
    			mysql_close(); 
    			include "./include/back_xy.inc.php";
    			exit();
    			}
    		}
    		
    		mysql_query("DELETE FROM renwu_zawu WHERE id='$user_id' AND cla='信'");
    		
    		$npc_song = mysql_query("SELECT id,name FROM npc_member WHERE pos > 0 AND nick<>'动物'");
    		
    		$num_npc = mysql_num_rows($npc_song);
    		$choose_num = rand(0,$num_npc);
    		
    		$npc_id = mysql_result($npc_song,$choose_num,"id");
    		$npc_name = mysql_result($npc_song,$choose_num,"name");
    		echo "<br><font color=#4DB39B>何新对你说道：很好，既然你要帮我，那么请立刻出发在十五分钟内把这信送给：<font color=#D99631>".$npc_name."（".$npc_id."）</font></font>\n";	
    		
    		$now_time = $now_time + 900;
    		mysql_query("UPDATE misc SET song_to='$npc_id',song_time='$now_time' WHERE id='$user_id'");
    		mysql_query("INSERT INTO renwu_zawu VALUES ('','$user_id','xin','信')");
    		mysql_close();
    		include "./include/back_xy.inc.php";
    		exit();					
    	}
    	if($my_song_to != ""){
    		$now_time =time();
    		if(($my_song_time - $now_time) > 0){
    			echo "<br><font color=#4DB39B>何新对你说道：你的工作还没有完，你还要继续阿！</font><br><br>\n";	
    			mysql_close(); 
    			include "./include/back_xy.inc.php";
    			exit();
    		}
    	}
    	echo "<br><font color=#4DB39B>何新对你说道：我这里有个信件要送，你可以否给我帮忙？</font>\n";
    	echo "<br>你可以：<a href=dong_song.php?help=1>帮忙送信</a>\n";    
    	mysql_close(); 
    	include "./include/back_xy.inc.php";
?>