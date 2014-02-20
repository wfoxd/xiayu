<?
/*
================
=显示NPC
=
================
*/
  //echo "测试npc_org".$npc_org;
	@mysql_close();
	//echo getcwd();
	include "/home/chunplay/public_html/warrior/inc/db.inc.php";
	
	if(!isset($npc_org)){
		echo "不正确差数！";
		mysql_close();
		exit();
	}
	
	$npc_info = mysql_query("SELECT id,name,nick,des,tou,shen,shou,tui,wuqi FROM npc_member WHERE org='$npc_org' ORDER BY exp DESC");
	
	$npc_num = mysql_num_rows($npc_info);
	
	echo "<p><font color=#0080FF>这里有＝＝></font><br>\n";
	
	for($i=0;$i<$npc_num;$i++){
		$npc_name = mysql_result($npc_info,$i,"name");
		$npc_id = mysql_result($npc_info,$i,"id");
		$npc_nick = mysql_result($npc_info,$i,"nick");
		$npc_des = mysql_result($npc_info,$i,"des");
		$npc_tou = mysql_result($npc_info,$i,"tou");
		$npc_shen = mysql_result($npc_info,$i,"shen");
		$npc_shou = mysql_result($npc_info,$i,"shou");
		$npc_tui = mysql_result($npc_info,$i,"tui");
		$npc_wuqi = mysql_result($npc_info,$i,"wuqi");
				
		echo "<a href=$xy_url/npc_hudong.php?npc_id=$npc_id>【".$npc_nick."】".$npc_name."（".$npc_id."）</a>\n";
		echo "<font color=#A79E52 size=1>\n";
		if($npc_tou != ""){
			$name = mysql_query("SELECT zhuangbei_wupin.name FROM zhuangbei_wupin,npc_member WHERE zhuangbei_wupin.id=npc_member.tou AND zhuangbei_wupin.id='$npc_tou'");
			echo "头戴:".mysql_result($name,0,"name")."&nbsp;";
		}
		if($npc_shen != ""){
			$name = mysql_query("SELECT zhuangbei_wupin.name FROM zhuangbei_wupin,npc_member WHERE zhuangbei_wupin.id=npc_member.shen AND zhuangbei_wupin.id='$npc_shen'");
			echo "身穿:".mysql_result($name,0,"name")."&nbsp;";
		}
		if($npc_shou != ""){
			$name = mysql_query("SELECT zhuangbei_wupin.name FROM zhuangbei_wupin,npc_member WHERE zhuangbei_wupin.id=npc_member.shou AND zhuangbei_wupin.id='$npc_shou'");
			echo "手戴:".mysql_result($name,0,"name")."&nbsp;";
		}
		if($npc_tui != ""){
			$name = mysql_query("SELECT zhuangbei_wupin.name FROM zhuangbei_wupin,npc_member WHERE zhuangbei_wupin.id=npc_member.tui AND zhuangbei_wupin.id='$npc_tui'");
			echo "腿绑:".mysql_result($name,0,"name")."&nbsp;";
		}
		if($npc_wuqi != ""){
			$name = mysql_query("SELECT zhuangbei_wuqi.name FROM zhuangbei_wuqi,npc_member WHERE zhuangbei_wuqi.id=npc_member.wuqi AND zhuangbei_wuqi.id='$npc_wuqi'");
			echo "手拿:".mysql_result($name,0,"name");			
		}
		echo "</font>&nbsp;&nbsp;".$npc_des."<br>\n";
	} 
	echo "</p>\n";	
?>