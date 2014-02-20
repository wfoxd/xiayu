<?
session_save_path("xytmp");
session_start();
$user_id=$_SESSION["user_id"];
$member_list=$_GET['member_list'];
$org_name=$_POST['org_name'];
$create=$_GET['create'];
$sheding=$_GET['sheding'];
$B1=$_POST['B1'];
$R1=$_POST['R1'];
$jiaru=$_GET['jiaru'];
$jorg_name=$_POST['jorg_name'];
$tigongmon=$_GET['tigongmon'];
$del_user=$_GET['del_user'];
$deluser_id=$_POST['deluser_id'];
$jiaojie=$_GET['jiaojie'];
$jiaojie_id=$_POST['jiaojie_id'];
$shouyu=$_GET['shouyu'];
$orgnick_id=$_POST['orgnick_id'];
$orgnick=$_POST['orgnick'];
$orglev=$_POST['orglev'];
$fabu=$_GET['fabu'];
$fabu_info=$_POST['fabu_info'];
$zongtan=$_GET['zongtan'];
$zt_lc=$_POST['zt_lc'];
$zt_info=$_POST['zt_info'];
$wuqi=$_GET['wuqi'];
$wuxue=$_GET['wuxue'];
$lgf=$_GET['lgf'];
$control=$_GET['control'];

include "./inc/attest.inc.php";

include "./inc/config.inc.php";
include "./inc/style.inc.php";
/*
===============
=组织系统(Ver 0.2.1)
=公元 2001年12月5日
===============
*/
/*
===============
=组织官衔(Ver 0.2.1)
=公元 2001年12月16日
===============
*/

include "./include/area_now_ct.inc.php";
$way = array("organization.php","xy_city.php");
area_now($way,$user_id);
include "./include/location.inc.php";
up_location("帮会组织","organization.php","$user_id");
?>
<?
	include "./inc/db.inc.php";
	
	$my_org = mysql_query("SELECT org FROM renwu_member WHERE id='$user_id'");
	$my_org = mysql_result($my_org,0,"org");
	
if($member_list == 1){
	$my_org_m = mysql_query("SELECT renwu_member.id,renwu_member.name FROM misc,renwu_member WHERE misc.id=renwu_member.id AND misc.orglev='5' AND renwu_member.org='$my_org'");
	echo "<br><font color=#E79A1B>======".$my_org."首脑=====</font><br>";
	echo mysql_result($my_org_m,0,"name")."(".mysql_result($my_org_m,0,"id").")";
	$my_org_m = mysql_query("SELECT renwu_member.id,renwu_member.name,misc.orgnick FROM misc,renwu_member WHERE misc.id=renwu_member.id AND misc.orglev='4' AND renwu_member.org='$my_org'");
	echo "<br><font color=#E79A1B>======".$my_org."首要人物=====</font><br>";	
	for($i=0;$i<mysql_num_rows($my_org_m);$i++){
		$name = mysql_result($my_org_m,$i,"name");
		$id = mysql_result($my_org_m,$i,"id");
		$orgnick = @mysql_result($my_org_m,$i,"orgnick");
		echo "※※<font color=#A9A358>".$orgnick."</font>".$name."(".$id.")";
	}
	$my_org_m = mysql_query("SELECT renwu_member.id,renwu_member.name,misc.orgnick FROM misc,renwu_member WHERE misc.id=renwu_member.id AND misc.orglev='3' AND renwu_member.org='$my_org'");
	echo "<br><font color=#E79A1B>======".$my_org."次要人物=====</font><br>";	
	for($i=0;$i<mysql_num_rows($my_org_m);$i++){
		$name = mysql_result($my_org_m,$i,"name");
		$id = mysql_result($my_org_m,$i,"id");
		$orgnick = @mysql_result($my_org_m,$i,"orgnick");
		echo "※※<font color=#A9A358>".$orgnick."</font>".$name."(".$id.")";
	}
	$my_org_m = mysql_query("SELECT renwu_member.id,renwu_member.name,misc.orgnick FROM misc,renwu_member WHERE misc.id=renwu_member.id AND misc.orglev='2' AND renwu_member.org='$my_org'");
	echo "<br><font color=#E79A1B>======".$my_org."一般人物=====</font><br>";	
	for($i=0;$i<mysql_num_rows($my_org_m);$i++){
		$name = mysql_result($my_org_m,$i,"name");
		$id = mysql_result($my_org_m,$i,"id");
		$orgnick = @mysql_result($my_org_m,$i,"orgnick");
		echo "※※<font color=#A9A358>".$orgnick."</font>".$name."(".$id.")";
	}
	$my_org_m = mysql_query("SELECT renwu_member.id,renwu_member.name,misc.orgnick FROM misc,renwu_member WHERE misc.id=renwu_member.id AND misc.orglev='1' AND renwu_member.org='$my_org'");
	echo "<br><font color=#E79A1B>======".$my_org."成员=====</font><br>";	
	for($i=0;$i<mysql_num_rows($my_org_m);$i++){
		$name = mysql_result($my_org_m,$i,"name");
		$id = mysql_result($my_org_m,$i,"id");
		$orgnick = @mysql_result($my_org_m,$i,"orgnick");
		echo "※※<font color=#A9A358>".$orgnick."</font>".$name."(".$id.")";
	}
	
}
	echo ("
		<img src=".$pic3_url."/xiake/xiake09.jpg border=0 align=left></img>		
		");
	
	echo "<br>====组织帮会管理处====<br>";
	echo ("这是侠域中所有帮会组织的管理处，在这里你可以进行组织申请，组织加入以及
	行使组织内部的工作等。请注意不要搞破坏，不然会受到惩罚的。
	<p>（现在侠域各组织可以申请建立自己的总坛，费用一百万,可自己申请总坛地点。
	总坛设有四间房间--练功房，储藏室，休息室，大厅。其它设备还可另行购买。）
	<p>武器研究室：三十万<br>
	增加练功房:二十万<br>
	武学研究室:四十万<br>
	装备研究室:四十万<br>
	");
	
	$npc_org = "帮会组织";
    	include "./include/list_npc.inc.php"; 
	
	echo "<p align=center>\n";
	echo "===================================<br>\n";
	echo "===&nbsp;&nbsp;你现在为<font color=black>".$my_org."</font>成员&nbsp;&nbsp;===<br>\n";
	echo "===================================<br>\n";

if($sheding == 1){
	if($R1 == "Y"){
		mysql_query("UPDATE org SET orgopen='Y' WHERE orgname='$my_org'");
		echo "状态转换中............\n<br>";
		echo "组织现在设定为<font color=red>自由入会</font>状态！\n";
		echo "<meta http-equiv=\"refresh\" content=\"2; url=organization.php\">";		
		mysql_close();
		exit();
	}else if($R1 == "N"){
		mysql_query("UPDATE org SET orgopen='N' WHERE orgname='$my_org'");
		echo "状态转换中............\n<br>";
		echo "你现在设定为<font color=green>限制入会</font>状态！\n";
		echo "<meta http-equiv=\"refresh\" content=\"2; url=organization.php\">";		
		mysql_close();
		exit();
	}
}
if($jiaru == 1){
	if($my_org != "无组织"){
		echo "无组织成员才能加入其它组织！";
    		echo "<meta http-equiv=\"refresh\" content=\"2; url=organization.php\">";	
    		mysql_close();
    		exit();
	}
	if($jorg_name == ""){
		echo "没有这个组织！";
    		echo "<meta http-equiv=\"refresh\" content=\"2; url=organization.php\">";	
    		mysql_close();
    		exit();
	}
	$org_info = mysql_query("SELECT orgopen FROM org WHERE orgname='$jorg_name'");
	$org_info = mysql_result($org_info,0,"orgopen");
	if($org_info == "N"){
		echo "此组织不允许自由加入！";
    		echo "<meta http-equiv=\"refresh\" content=\"2; url=organization.php\">";	
    		mysql_close();
    		exit();
	}
	$my_mon = mysql_query("SELECT mon FROM renwu_member WHERE id='$user_id'");
	$my_mon = mysql_result($my_mon,0,"mon");
	if($my_mon < 500){
		echo "你没有足够地入会费！";
    		echo "<meta http-equiv=\"refresh\" content=\"2; url=organization.php\">";	
    		mysql_close();
    		exit();
	}
	$my_mon -= 500;
	mysql_query("UPDATE renwu_member SET org='$jorg_name',mon='$my_mon' WHERE id='$user_id'");
	mysql_query("UPDATE org SET orgmon=(orgmon+500) WHERE orgname='$jorg_name'");
	mysql_query("UPDATE misc SET orgnick='',orglev='1' WHERE id='$user_id'");
	echo "<br><font color=black>你交纳了500会费，成功加入".$jorg_name."</font>\n";
	mysql_close();
    	exit();
}
if($create == 1){
	$my_info = mysql_query("SELECT mon FROM renwu_member WHERE id='$user_id'");
	$my_mon = mysql_result($my_info,0,"mon");
	
	if($my_mon < 50000){
		echo "你没有足够的基本建设费用！";
    		echo "<meta http-equiv=\"refresh\" content=\"2; url=organization.php\">";	
    		mysql_close();
    		exit();
	}
	
	echo ("
		<form action=organization.php?create=2 method=post>
		组织名称：<input type=text size=10 name=org_name>(十个汉字或20个字母)<br>
		<input type=submit name=create2 value=确定 style=\"color: #000080; border: 1px ridge #0099CC; background-color: #CCCCCC; font-size:8pt\">
		</form>
	");
	mysql_close();
	exit();
}
if($create == 2){
	$org_have = mysql_query("SELECT orgname FROM org WHERE orgname='$org_name'");
	if(mysql_num_rows($org_have)){
		echo "<font color=red>组织（".$org_name."）已经注册过了。</font>";
    		echo "<meta http-equiv=\"refresh\" content=\"2; url=organization.php\">";	
    		mysql_close();
    		exit();
	}
	
	if(empty($org_name)){
		echo "<font color=red>你没有确定组织名称！</font>";
    		echo "<meta http-equiv=\"refresh\" content=\"2; url=organization.php\">";	
    		mysql_close();
    		exit();
	}
	if(strlen($org_name) > 20){
		echo "<font color=red>组织名称不符合规定！</font>";
    		echo "<meta http-equiv=\"refresh\" content=\"2; url=organization.php\">";	
    		mysql_close();
    		exit();
	}
	
	$my_info = mysql_query("SELECT mon,pos FROM renwu_member WHERE id='$user_id'");
	$my_mon = mysql_result($my_info,0,"mon");
	
	if($my_mon < 50000){
		echo "你没有足够的基本建设费用！";
    		echo "<meta http-equiv=\"refresh\" content=\"2; url=organization.php\">";	
    		mysql_close();
    		exit();
	}
	$my_pos = mysql_result($my_info,0,"pos");
	$my_mon -= 50000;
	mysql_query("UPDATE renwu_member SET mon='$my_mon',org='$org_name' WHERE id='$user_id'");
	mysql_query("UPDATE misc SET orgnick='首脑',orglev='5' WHERE id='$user_id'");
	mysql_query("INSERT INTO org VALUES('$org_name','0','0','$user_id','组织建立成功。','','0','0','0','Y','侠域城')");
	echo "<br>你的组织<font color=black>".$org_name."</font>已经成立了，现在你可以行使组织管理权利了！";
	
	$notice_channel = "组织";
	$notice_to = "新组织";
	include "./include/notice.inc.php";
	
	mysql_close();
	exit();
}
if($tigongmon == 1){
	$my_info = mysql_query("SELECT mon FROM renwu_member WHERE id='$user_id'");
	$my_mon = mysql_result($my_info,0,"mon");
	
	$tigong_mon = intval($tigong_mon);
	if($tigong_mon > 9999999 || $tigong_mon <= 0 ){
		echo "<br><font color=green>请输入正确的金钱数量。</font>\n";
		echo "<meta http-equiv=\"refresh\" content=\"2; url=organization.php\">";
		mysql_close();
		exit();	
	}
	
	if($my_mon < $tigong_mon){
		echo "<br><font color=green>你没有那么多钱吧！</font>\n";
		echo "<meta http-equiv=\"refresh\" content=\"2; url=organization.php\">";
		mysql_close();
		exit();
	}
	$my_mon -= $tigong_mon;
	
	mysql_query("UPDATE renwu_member SET mon='$my_mon' WHERE id='$user_id'");
	mysql_query("UPDATE org SET orgmon=orgmon+'$tigong_mon' WHERE orgname='$my_org'");
	
	mysql_close();
	
	echo "<br>".$e_name."你的组织已经收到了你的资金！\n";	
	exit();
}
if($del_user == 1){
	if(empty($deluser_id)){
		echo "<br><font color=green>请选择你要开除的人!</font>\n";
		echo "<meta http-equiv=\"refresh\" content=\"2; url=organization.php\">";
		mysql_close();
		exit();	
	}
	
	mysql_query("UPDATE renwu_member SET org='无组织' WHERE id='$deluser_id'");
	mysql_query("UPDATE misc SET orgnick='',orglev='1' WHERE id='$deluser_id'");
	mysql_close();
	
	echo "<br>你开除了".$deluser_id."\n";	
	exit();
}
if($jiaojie == 1){
	if(empty($jiaojie_id)){
		echo "<br><font color=green>请选择你要授予首脑权利的人!</font>\n";
		echo "<meta http-equiv=\"refresh\" content=\"2; url=organization.php\">";
		mysql_close();
		exit();	
	}
	
	mysql_query("UPDATE org SET orgp='$jiaojie_id' WHERE orgname='$my_org'");
	mysql_query("UPDATE misc SET orgnick='首脑',orglev='5' WHERE id='$jiaojie_id'");
	mysql_query("UPDATE misc SET orgnick='退位首脑',orglev='4' WHERE id='$user_id'");
	
	mysql_close();
	
	echo "<br>你把本组织的首脑权利交接给了".$jiaojie_id."\n";	
	exit();
}
if($shouyu == 1){
	if(empty($orgnick_id) || empty($orgnick)){
		echo "<br><font color=green>请选择你要授予官衔的人以及他的官衔!</font>\n";
		echo "<meta http-equiv=\"refresh\" content=\"2; url=organization.php\">";
		mysql_close();
		exit();	
	}
	$orglev = intval($orglev);
	if($orglev < 1 || $orglev >5){
		echo "<br><font color=green>职位等级不合法。</font>\n";
		echo "<meta http-equiv=\"refresh\" content=\"2; url=organization.php\">";
		mysql_close();
		exit();
	}
	$my_lev = mysql_query("SELECT orglev FROM misc WHERE id='$user_id'");
	$my_lev = mysql_result($my_lev,0,"orglev");
	if($orglev >= $my_lev){
		echo "<br><font color=green>职位等级不能与你自己的等级相等或更高。</font>\n";
		echo "<meta http-equiv=\"refresh\" content=\"2; url=".$PHP_SELF."\">";
		mysql_close();
		exit();
	}
	if(strlen($orgnick) > 10){
		echo "<br><font color=green>官衔不能大于5个汉字！</font>\n";
		echo "<meta http-equiv=\"refresh\" content=\"2; url=organization.php\">";
		mysql_close();
		exit();	
	}
	
	mysql_query("UPDATE misc SET orgnick='$orgnick',orglev='$orglev' WHERE id='$orgnick_id'");
	mysql_close();
	echo "<br>你授予了".$jiaojie_id."职位：".$orgnick."\n";
	exit();
}
if($fabu == 1){
	if(strlen($fabu_info) < 0 || strlen($fabu_info) > 60){
		echo "<br><font color=green>消息长度不符合要求。</font>\n";
		echo "<meta http-equiv=\"refresh\" content=\"2; url=organization.php\">";
		mysql_close();
		exit();	
	}
	
	mysql_query("UPDATE org SET orginfo='$fabu_info' WHERE orgname='$my_org'");
	
	mysql_close();
	
	echo "<br>组织消息更新为:".$fabu_info."\n";	
	exit();
}
if($zongtan == 1){
	$org_info = mysql_query("SELECT orgmon FROM org WHERE orgname='$my_org'");
	$org_mon = mysql_result($org_info,0,"orgmon");
	
	if($org_mon < 1000000){
		echo "<br><font color=green>没钱怎么给你置办？？</font>\n";
		echo "<meta http-equiv=\"refresh\" content=\"2; url=organization.php\">";
		mysql_close();
		exit();	
	}
	$info = $zt_lc.$zt_info;
	$time = time();
	mysql_query("INSERT INTO other_info VALUES('$time','$info')");
	mysql_query("UPDATE org SET orgmon=orgmon-1000000 WHERE orgname='$my_org'");
	
	mysql_close();
	
	echo "<br>总坛已经预定了，请等待管理员通知。\n";	
	exit();
}
if($wuqi == 1){
	$org_info = mysql_query("SELECT orgmon FROM org WHERE orgname='$my_org'");
	$org_mon = mysql_result($org_info,0,"orgmon");
	
	if($org_mon < 300000){
		echo "<br><font color=green>没钱怎么给你置办？？</font>\n";
		echo "<meta http-equiv=\"refresh\" content=\"2; url=organization.php\">";
		mysql_close();
		exit();	
	}
	$info = $zt_lc.$zt_info;
	$time = time();
	mysql_query("INSERT INTO other_info VALUES('$time','$info')");
	mysql_query("UPDATE org SET orgmon=orgmon-300000 WHERE orgname='$my_org'");
	
	mysql_close();
	
	echo "<br>武器研究室已经预定了，请等待管理员通知。\n";	
	exit();
}
if($wuxue == 1){
	$org_info = mysql_query("SELECT orgmon FROM org WHERE orgname='$my_org'");
	$org_mon = mysql_result($org_info,0,"orgmon");
	
	if($org_mon < 400000){
		echo "<br><font color=green>没钱怎么给你置办？？</font>\n";
		echo "<meta http-equiv=\"refresh\" content=\"2; url=organization.php\">";
		mysql_close();
		exit();	
	}
	$info = $zt_lc.$zt_info;
	$time = time();
	mysql_query("INSERT INTO other_info VALUES('$time','$info')");
	mysql_query("UPDATE org SET orgmon=orgmon-400000 WHERE orgname='$my_org'");
	
	mysql_close();
	
	echo "<br>武学研究室已经预定了，请等待管理员通知。\n";	
	exit();
}
if($lgf == 1){
	$org_info = mysql_query("SELECT orgmon FROM org WHERE orgname='$my_org'");
	$org_mon = mysql_result($org_info,0,"orgmon");
	
	if($org_mon < 200000){
		echo "<br><font color=green>没钱怎么给你置办？？</font>\n";
		echo "<meta http-equiv=\"refresh\" content=\"2; url=organization.php\">";
		mysql_close();
		exit();	
	}
	$info = $zt_lc.$zt_info;
	$time = time();
	mysql_query("INSERT INTO other_info VALUES('$time','$info')");
	mysql_query("UPDATE org SET orgmon=orgmon-200000 WHERE orgname='$my_org'");
	
	mysql_close();
	
	echo "<br>练功房已经预定了，请等待管理员通知。\n";	
	exit();
}
?>
<?
if($control == 1){
	include "./inc/db.inc.php";
	
	if($B1 == "组织信息"){			
		$org_info = mysql_query("SELECT * FROM org WHERE orgname='$my_org'");
		$org_pos = mysql_result($org_info,0,"orgpos");
		$org_mon = mysql_result($org_info,0,"orgmon");
		$org_p = mysql_result($org_info,0,"orgp");
		$org_em = mysql_result($org_info,0,"orgem");
		$org_bin = mysql_result($org_info,0,"orgbin");
		$org_jiang = mysql_result($org_info,0,"orgjiang");
		$org_gao = mysql_result($org_info,0,"orggao");
		$org_open = mysql_result($org_info,0,"orgopen");
		$org_mnum = mysql_query("SELECT count(name) FROM renwu_member WHERE org='$my_org'");
		$org_mnum = mysql_fetch_row($org_mnum);
		
		$member_pos = mysql_query("SELECT sum(pos) FROM renwu_member WHERE org='$my_org'");
		$member_pos = mysql_fetch_row($member_pos);
		
		$org_pos = $member_pos[0];
		
		mysql_query("UPDATE org SET orgpos='$org_pos' WHERE orgname='$my_org'");
		
		echo ("
		<table border=1 cellpadding=0 cellspacing=0 style=\"border-collapse: collapse\" bordercolor=#111111 width=100%>
  		<tr>
   		 <td width=100% colspan=2>
    		<p align=center>组织信息</td>
 		 </tr>
  		<tr>
    		<td width=25% bgcolor=#0099CC><font color=#FFFF00>组织首脑</font>　</td>
    		<td width=85%>".$org_p."　</td>
  		</tr>
  		<tr>
    		<td width=25% bgcolor=#0099CC><font color=#FFFF00>组织财富</font>　</td>
    		<td width=85%>".$org_mon."　</td>
  		</tr>
  		<tr>
    		<td width=25% bgcolor=#0099CC><font color=#FFFF00>组织立场</font>　</td>
    		<td width=85%>".$org_pos."　</td>
  		</tr>
  		<tr>
    		<td width=25% bgcolor=#0099CC><font color=#FFFF00>敌对势力</font>　</td>
    		<td width=85%>".$org_em."　</td>
  		</tr>
  		<tr>
    		<td width=25% bgcolor=#0099CC><font color=#FFFF00>守兵数量</font>　</td>
    		<td width=85%>".$org_bin."　</td>
  		</tr>
  		<tr>
    		<td width=25% bgcolor=#0099CC><font color=#FFFF00>守将数量</font>　</td>
    		<td width=85%>".$org_jiang."　</td>
  		</tr>
  		<tr>
    		<td width=25% bgcolor=#0099CC><font color=#FFFF00>高手数量</font>　</td>
    		<td width=85%>".$org_gao."　</td>
  		</tr>
  		<tr>
    		<td width=25% bgcolor=#0099CC><font color=#FFFF00>成员数量</font>　</td>
    		<td width=85%>".$org_mnum[0]."     <a href=organization.php?member_list=1>详细情况表</a>　</td>
  		</tr>
  		<tr>
    		<td width=25% bgcolor=#0099CC><font color=#FFFF00>开放状态</font>　</td>
    		<td width=85%>".$org_open."　</td>
  		</tr>
		</table>		
		");
	}
	if($B1 == "设置状态"){
		echo ("
		<form method=POST action=organization.php?sheding=1>
  		自由入会<input type=radio value=Y checked name=R1>
  		限制入会<input type=radio name=R1 value=N>
  		<input type=submit value=设定 name=B1 style=\"font-family: 宋体; border-style: ridge; border-width: 0; background-color: #CCFF99; color:#666633\">  
  		</form>
  		");
		mysql_close();
		exit();
	}
	if($B1 == "捐献会费"){
		echo ("
		<form method=POST action=organization.php?tigongmon=1>
  		数量<input type=text name=tigong_mon>
  		<input type=submit value=捐款 name=B1 style=\"font-family: 宋体; border-style: ridge; border-width: 0; background-color: #CCFF99; color:#666633\">  
  		</form>
  		");
		mysql_close();
		exit();
	}
	if($B1 == "开除成员"){
		$org_m = mysql_query("SELECT id,name FROM renwu_member WHERE org='$my_org' AND id!='$user_id'");
		$num_now = mysql_num_rows($org_m);
		
		echo "<form action=organization.php?del_user=1 method=post>\n";
		echo "<select name=deluser_id size=1>\n";
		echo "<option value=>选择...</option>\n";
		for($i=0;$i<$num_now;$i++){
			$member_id = mysql_result($org_m,$i,"id");
			$member_name = mysql_result($org_m,$i,"name");
			
			echo "<option value=$member_id>$member_name</option>\n";
		}
		echo "</select>\n";
		echo "<input type=submit name=B1 value=开除 style=\"font-family: 宋体; border-style: ridge; border-width: 0; background-color: #CCFF99; color:#666633\">";
		echo "</form>\n";
		mysql_close();
		exit();
	}
	if($B1 == "权利交接"){
		$org_m = mysql_query("SELECT id,name FROM renwu_member WHERE org='$my_org' AND id!='$user_id'");
		$num_now = mysql_num_rows($org_m);
		
		echo "<form action=organization.php?jiaojie=1 method=post>\n";
		echo "<select name=jiaojie_id size=1>\n";
		echo "<option value=>选择...</option>\n";
		for($i=0;$i<$num_now;$i++){
			$member_id = mysql_result($org_m,$i,"id");
			$member_name = mysql_result($org_m,$i,"name");
			
			echo "<option value=$member_id>$member_name</option>\n";
		}
		echo "</select>\n";
		echo "<input type=submit name=B1 value=交接 style=\"font-family: 宋体; border-style: ridge; border-width: 0; background-color: #CCFF99; color:#666633\">";
		echo "</form>\n";
		mysql_close();
		exit();
	}
	
	if($B1 == "消息发布"){
		$info_now = mysql_query("SELECT orginfo FROM org WHERE orgname='$my_org'");
		$info_now = mysql_result($info_now,0,"orginfo");
		
		echo "<br>组织消息：<font color=black>".$info_now."</font>\n";
				
		echo "<form action=organization.php?fabu=1 method=post>\n";
		echo ("
			消息发布(30个汉字)<input type=text name=fabu_info size=30><br>			
		");
		echo "<input type=submit name=B1 value=发布 style=\"font-family: 宋体; border-style: ridge; border-width: 0; background-color: #CCFF99; color:#666633\">";
		echo "</form>\n";
		mysql_close();
		exit();
	}
	
	if($B1 == "设定职位"){
		$my_lev = mysql_query("SELECT orglev FROM misc WHERE id='$user_id'");
		$my_lev = mysql_result($my_lev,0,"orglev");
		$org_m = mysql_query("SELECT renwu_member.id,renwu_member.name FROM renwu_member,misc WHERE renwu_member.org='$my_org' AND renwu_member.id!='$user_id' AND misc.id=renwu_member.id AND misc.orglev < '$my_lev'");
		$num_now = mysql_num_rows($org_m);
		
		echo "<font color=#71B59E>组织职位等级分1至5等级，你只能设定比你底等级的人</font>";
		echo "<form action=organization.php?shouyu=1 method=post>\n";
		echo "<select name=orgnick_id size=1>\n";
		echo "<option value=>选择...</option>\n";
		for($i=0;$i<$num_now;$i++){
			$member_id = mysql_result($org_m,$i,"id");
			$member_name = mysql_result($org_m,$i,"name");
			
			echo "<option value=$member_id>$member_name</option>\n";
		}
		echo "</select>\n";
		echo "职位名称：<input type=text name=orgnick size=5>（最多5个汉字）\n";
		echo "<br>等级：<input type=text name=orglev size=5 value=".($my_lev-1).">（最多5个汉字）\n";
		echo "<input type=submit name=B1 value=授予 style=\"font-family: 宋体; border-style: ridge; border-width: 0; background-color: #CCFF99; color:#666633\">";
		echo "</form>\n";
		mysql_close();
		exit();
	}
		
	if($B1 == "退出组织"){
		mysql_query("UPDATE renwu_member SET org='无组织' WHERE id='$user_id'");
		mysql_query("UPDATE misc SET orgnick='' WHERE id='$user_id'");
		echo "<font color=black>你成功退出".$jorg_name."</font>\n";
		mysql_close();
		exit();
	}
	if($B1 == "置办总坛"){
		echo "<form action=organization.php?zongtan=1 method=post>\n";
		echo "预定总坛位置：<input type=text name=zt_lc size=8>\n";
		echo "其它说明：<input type=text name=zt_info size=8 value=".$my_org.">\n";
		echo "<input type=submit name=B1 value=置办 style=\"font-family: 宋体; border-style: ridge; border-width: 0; background-color: #CCFF99; color:#666633\">";
		echo "</form>\n";
		mysql_close();
		exit();
	}
	if($B1 == "置办武器研究室"){
		echo "<form action=organization.php?wuqi=1 method=post>\n";
		echo "预定组织：<input type=text name=zt_lc size=8 value=".$my_org.">\n";
		echo "其它说明：<input type=text name=zt_info size=8 value=武器研究室>\n";
		echo "<input type=submit name=B1 value=置办 style=\"font-family: 宋体; border-style: ridge; border-width: 0; background-color: #CCFF99; color:#666633\">";
		echo "</form>\n";
		mysql_close();
		exit();
	}
	if($B1 == "置办武学研究室"){
		echo "<form action=organization.php?wuxue=1 method=post>\n";
		echo "预定组织：<input type=text name=zt_lc size=8 value=".$my_org.">\n";
		echo "其它说明：<input type=text name=zt_info size=8 value=武学研究室>\n";
		echo "<input type=submit name=B1 value=置办 style=\"font-family: 宋体; border-style: ridge; border-width: 0; background-color: #CCFF99; color:#666633\">";
		echo "</form>\n";
		mysql_close();
		exit();
	}
	if($B1 == "置办装备研究室"){
		echo "<form action=organization.php?wuxue=1 method=post>\n";
		echo "预定组织：<input type=text name=zt_lc size=8 value=".$my_org.">\n";
		echo "其它说明：<input type=text name=zt_info size=8 value=装备研究室>\n";
		echo "<input type=submit name=B1 value=置办 style=\"font-family: 宋体; border-style: ridge; border-width: 0; background-color: #CCFF99; color:#666633\">";
		echo "</form>\n";
		mysql_close();
		exit();
	}
	if($B1 == "增加练功房"){
		echo "<form action=organization.php?lgf=1 method=post>\n";
		echo "预定组织：<input type=text name=zt_lc size=8 value=".$my_org.">\n";
		echo "其它说明：<input type=text name=zt_info size=8 value=练功房>\n";
		echo "<input type=submit name=B1 value=置办 style=\"font-family: 宋体; border-style: ridge; border-width: 0; background-color: #CCFF99; color:#666633\">";
		echo "</form>\n";
		mysql_close();
		exit();
	}
}
?>
<?
if($my_org != "无组织"){
	$my_orgp = mysql_query("SELECT orgp FROM org WHERE orgname='$my_org'");
	$my_orgp = mysql_result($my_orgp,0,"orgp");
	$my_lev = mysql_query("SELECT orglev FROM misc WHERE id='$user_id'");
	$my_lev = mysql_result($my_lev,0,"orglev");
	echo "<form action=organization.php?control=1 method=post>";
	
	if($my_lev == "1"){
	echo ("			
		<input type=submit name=B1 value=组织信息 style=\"color: #000080; border: 1px ridge #0099CC; background-color: #CCCCCC; font-size:8pt\">
		<input type=submit name=B1 value=捐献会费 style=\"color: #000080; border: 1px ridge #0099CC; background-color: #CCCCCC; font-size:8pt\">
	");
	}else if($my_lev == "2"){
		echo ("
		<input type=submit name=B1 value=组织信息 style=\"color: #000080; border: 1px ridge #0099CC; background-color: #CCCCCC; font-size:8pt\">
		<input type=submit name=B1 value=捐献会费 style=\"color: #000080; border: 1px ridge #0099CC; background-color: #CCCCCC; font-size:8pt\">
		<input type=submit name=B1 value=设定职位 style=\"color: #000080; border: 1px ridge #0099CC; background-color: #CCCCCC; font-size:8pt\">
	");
	}else if($my_lev == "3"){
		echo ("
		<input type=submit name=B1 value=组织信息 style=\"color: #000080; border: 1px ridge #0099CC; background-color: #CCCCCC; font-size:8pt\">
		<input type=submit name=B1 value=捐献会费 style=\"color: #000080; border: 1px ridge #0099CC; background-color: #CCCCCC; font-size:8pt\">
		<br><input type=submit name=B1 value=消息发布 style=\"color: #000080; border: 1px ridge #0099CC; background-color: #CCCCCC; font-size:8pt\">
		<input type=submit name=B1 value=设定职位 style=\"color: #000080; border: 1px ridge #0099CC; background-color: #CCCCCC; font-size:8pt\">
	");
	}else if($my_lev == "4"){
		echo ("
		<input type=submit name=B1 value=组织信息 style=\"color: #000080; border: 1px ridge #0099CC; background-color: #CCCCCC; font-size:8pt\">
		<input type=submit name=B1 value=捐献会费 style=\"color: #000080; border: 1px ridge #0099CC; background-color: #CCCCCC; font-size:8pt\">
		<input type=submit name=B1 value=开除成员 style=\"color: #000080; border: 1px ridge #0099CC; background-color: #CCCCCC; font-size:8pt\">
		<br><input type=submit name=B1 value=消息发布 style=\"color: #000080; border: 1px ridge #0099CC; background-color: #CCCCCC; font-size:8pt\">
		<input type=submit name=B1 value=设定职位 style=\"color: #000080; border: 1px ridge #0099CC; background-color: #CCCCCC; font-size:8pt\">
	");
	}else	if($user_id == $my_orgp && $my_lev == "5"){
	echo ("
		<input type=submit name=B1 value=组织信息 style=\"color: #000080; border: 1px ridge #0099CC; background-color: #CCCCCC; font-size:8pt\">
		<input type=submit name=B1 value=捐献会费 style=\"color: #000080; border: 1px ridge #0099CC; background-color: #CCCCCC; font-size:8pt\">
		<input type=submit name=B1 value=开除成员 style=\"color: #000080; border: 1px ridge #0099CC; background-color: #CCCCCC; font-size:8pt\">
		<br><input type=submit name=B1 value=消息发布 style=\"color: #000080; border: 1px ridge #0099CC; background-color: #CCCCCC; font-size:8pt\">
		<input type=submit name=B1 value=设定职位 style=\"color: #000080; border: 1px ridge #0099CC; background-color: #CCCCCC; font-size:8pt\">
		<br><input type=submit name=B1 value=设置状态 style=\"color: #000080; border: 1px ridge #0099CC; background-color: #CCCCCC; font-size:8pt\">
		<input type=submit name=B1 value=权利交接 style=\"color: #000080; border: 1px ridge #0099CC; background-color: #CCCCCC; font-size:8pt\">
		<br><input type=submit name=B1 value=置办总坛 style=\"color: #000080; border: 1px ridge #0099CC; background-color: #CCCCCC; font-size:8pt\">
		<input type=submit name=B1 value=置办武器研究室 style=\"color: #000080; border: 1px ridge #0099CC; background-color: #CCCCCC; font-size:8pt\">
		<input type=submit name=B1 value=增加练功房 style=\"color: #000080; border: 1px ridge #0099CC; background-color: #CCCCCC; font-size:8pt\">
		<br><input type=submit name=B1 value=置办武学研究室 style=\"color: #000080; border: 1px ridge #0099CC; background-color: #CCCCCC; font-size:8pt\">
		<input type=submit name=B1 value=置办装备研究室 style=\"color: #000080; border: 1px ridge #0099CC; background-color: #CCCCCC; font-size:8pt\">
	");
	}
	
	echo ("
		<br><input type=submit name=B1 value=退出组织 style=\"color: #808080; border: 1px ridge #0099CC; background-color: #CCCCCC; font-size:8pt\">
		</form>
	");
	include "./include/back_xy.inc.php";
	mysql_close();
	exit();
}
?>

<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="100%">
  <tr>
    <td width="100%" bgcolor="#0099FF">
    <p align="center"><font color="#FFFF00">建立组织</font></td>
  </tr>
  <tr>
    <td width="100%">组织建立需要基本建设费用50000====><a href=organization.php?create=1>建立组织</a></td>
  </tr>
  <tr>
    <td width="100%" bgcolor="#0099FF">
    <p align="center"><font color="#FFFF00">加入组织</font></td>
  </tr>
  <tr>
    <td width="100%">
    <form action=organization.php?jiaru=1 method=post>
    <select name=jorg_name size=1>
    <option value=>选择..</option>
    <?
    	$org_info = mysql_query("SELECT orgname FROM org");
    	$org_num = mysql_num_rows($org_info);
    	
    	for($i=0;$i<$org_num;$i++){
    		$org_name = mysql_result($org_info,$i,"orgname");
    		
    		echo "<option value=$org_name>".$org_name."</option>\n";
    	}
    	mysql_close();
    ?>
    </select>
    <input type=submit name=B1 value=加入 style="font-family: 宋体; border-style: ridge; border-width: 0; background-color: #CCFF99; color:#666633">
    </form>
    </td>
  </tr>
</table>
<?
	include "./include/back_xy.inc.php";
?>
