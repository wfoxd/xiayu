<?
/*
========
=区域判断
=
========
*/	
	function area_now($need_way,$user_id){
		include "./inc/db.inc.php";
		$feifa = 1;
		$my_location = mysql_query("SELECT location_id FROM misc WHERE id='$user_id'");
		$my_location = mysql_result($my_location,0,"location_id");
		
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