<?
/*
==========
=给予物品
=公元2002年1月12日
==========
*/
	include "./inc/db.inc.php";
	
	if($gei == 1){
		//echo "测试user_id".$user_id;
		//echo "/n测试wupin_person".$wupin_person;
		$my_song = mysql_query("SELECT song_to,song_time FROM misc WHERE id='$user_id'");
		$my_song_to = mysql_result($my_song,0,"song_to");
		$my_song_time = mysql_result($my_song,0,"song_time");
		$npc_info = mysql_query("SELECT name,pos FROM npc_member WHERE id='$wupin_person'");
		$npc_name = mysql_result($npc_info,0,"name");
		$npc_pos = mysql_result($npc_info,0,"pos");
		$now_time = time();
		$li_time = $my_song_time - $now_time;
		if($my_song_to == $wupin_person){
			echo "<br><font color=#58B5CF>".$npc_name."对你说道：这是给我的信吗？哦，谢谢你了。</font>";
			if($my_song_time - $now_time > 0){
				echo "<br><font color=#58B5CF>".$npc_name."对你说道：你还真行，来这是我给你的奖励。</font><br>";
				$li_time = intval($li_time / 300);
				$add_exp = $li_time + 40;
				$add_mon = $li_time;
				echo "<br><font color=#C99B56>你得到了奖励：".$add_exp."点经验。<br>";
				echo "<br><font color=#C99B56>你得到了奖励：".$add_mon."金钱。<br></font>";
				if($npc_pos < 0){
					echo "<br><font color=#C99B56>你得到了奖励：-5点立场。<br></font>";	
					mysql_query("UPDATE renwu_member SET exp='$add_exp'+exp,mon='$add_mon'+mon,pos=pos-5 WHERE id='$user_id'");				
					}
				if($npc_pos > 0){
					echo "<br><font color=#C99B56>你得到了奖励：5点立场。<br></font>";	
					mysql_query("UPDATE renwu_member SET exp='$add_exp'+exp,mon='$add_mon'+mon,pos=pos+5 WHERE id='$user_id'");				
					}
				}else{
				echo "<br><font color=#58B5CF>".$npc_name."对你说道：你太胡涂了吧，这已经超过时间还给我干什么啊。</font>";
			}
			mysql_query("DELETE FROM renwu_zawu WHERE id='$user_id' AND id_num='$wupin_zawu'");
			mysql_query("UPDATE misc SET song_to='',song_time='' WHERE id='$user_id'");
		}else{
			echo "<br><font color=#58B5CF>".$npc_name."对你说道：谢谢你给我的东西。但这个东西好像对我没有用处啊！</font>";
		}
		mysql_query("DELETE FROM renwu_zawu WHERE id='$user_id' AND id_num='$wupin_zawu'");
		mysql_close();
		exit();
	}	
	
	$my_wupin = mysql_query("SELECT name,id_num FROM renwu_zawu,za_wu WHERE za_wu.id=renwu_zawu.wupinid AND renwu_zawu.id='$user_id'");
	$wupin_num = mysql_num_rows($my_wupin);
	if($wupin_num > 0){
	echo "<form action=npc_hudong.php?geiyu=1&gei=1 method=post>\n";
	echo "<select name=wupin_zawu size=1>\n";
	echo "<option value=>选择物品</option>\n";
	for($i=0;$i<$wupin_num;$i++){
		$wupin_name = mysql_result($my_wupin,$i,"name");
		$wupin_idnum = mysql_result($my_wupin,$i,"id_num");
		echo "<option value=$wupin_idnum>".$wupin_name."</option>\n";
	}
	echo "</select>\n";
	echo "接受人ID<input name=wupin_person value=$npc_id readonly size=5 type=text>";
	echo "<input type=submit value=给予 name=wupin_nowuse style=\"font-family: 宋体; border-style: ridge; border-width: 0; background-color: #CCFF99; color:#666633\">\n";
	echo "</form>\n";
	}else{
		echo "你没有东西可以给别人。\n";		
	}	
	mysql_close();
	exit();
?>