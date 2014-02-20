<?
/*
========
=区域判断
=
========
*/	
	function area_now($need_way,$user_id){//$need_way是传来的一个数组，包含了可能经过的路途文件名，与当前位置文件名进行比较，如果有相同则合法
		include "/home/chunplay/public_html/warrior/inc/db.inc.php";
		$feifa = 1;
		//echo "测试user_id".$user_id;
		$my_location = mysql_query("SELECT location_id FROM misc WHERE id='$user_id'");
		//echo "测试my_location".$my_location;
		$my_location = mysql_result($my_location,0,"location_id");
		//echo "测试my_location".$my_location;
		$my_info = mysql_query("SELECT hpnow FROM renwu_member WHERE id='$user_id'");
		//自己的基本信息
		$my_hpnow_info = mysql_result($my_info,0,"hpnow");
	
		if($my_hpnow_info < 10){
			echo "<font color=#4697C8>你太累了，还是休息休息再继续上路吧！</font>\n";
			exit();
			mysql_close();
			}
		//echo "测试need_way".$need_way[0];
		
		for($i=0;$i<count($need_way);$i++){
			if($need_way[$i] == $my_location){
				$feifa = 0;
				break;
			}
		}
		if($feifa == 1){
				echo "<font color=red>怎么，你还想瞬移啊？</font>\n";
				echo "<font color=red>系统判断到你想进行非法操作，对你进行惩罚！</font>\n";
				mysql_query("UPDATE renwu_member SET exp=exp-100 WHERE id='$user_id'");
				mysql_close();
				exit();
		}
		mysql_close();	
	}
?>