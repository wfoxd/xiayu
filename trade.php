<?
session_save_path("xytmp");
session_start();
$user_id=$_SESSION["user_id"];
$huikuan=$_GET['huikuan'];
$mon_num=$_POST['mon_num'];
$mon_person=$_POST['mon_person'];
$youji=$_GET['youji'];
$wupin_youji=$_POST['wupin_youji'];
$wupin_person=$_POST['wupin_person'];

include "./inc/attest.inc.php";

include "./inc/config.inc.php";
include "./inc/style.inc.php";
/*
==================
=交易系统
=
==================
*/

include "./include/area_now_ct.inc.php";
$way = array("trade.php","xy_city.php");
area_now($way,$user_id);
include "./include/location.inc.php";
up_location("驿站","trade.php","$user_id");
?>
<?
if($huikuan == 1){
	include "./inc/db.inc.php";
	
	$my_info = mysql_query("SELECT mon FROM renwu_member WHERE id='$user_id'");
	$my_mon = mysql_result($my_info,0,"mon");
	
	$mon_num = intval($mon_num);
	if($mon_num > 9999999 || $mon_num <= 5 ){
		echo "<br><font color=green>请输入正确的金钱数量，至少5以上。</font>\n";
		echo "<meta http-equiv=\"refresh\" content=\"5; url=trade.php\">";
		mysql_close();
		exit();	
	}
	
	if($my_mon < $mon_num){
		echo "<br><font color=green>你没有那么多钱吧！</font>\n";
		echo "<meta http-equiv=\"refresh\" content=\"5; url=trade.php\">";
		mysql_close();
		exit();
	}
	
	$e_info = @mysql_query("SELECT name,mon FROM renwu_member WHERE id='$mon_person'");
	$e_mon = @mysql_result($e_info,0,"mon");
	$e_name = @mysql_result($e_info,0,"name");
	
	if(empty($e_name)){
		echo "<br><font color=green>没有".$e_name."这个人呢！</font>\n";
		echo "<meta http-equiv=\"refresh\" content=\"5; url=trade.php\">";
		mysql_close();
		exit();
	}
	
	if($mon_person == $user_id){
		echo "<br><font color=green>哦！你还自己给自己钱，太有创意了吧！</font>\n";
		echo "<meta http-equiv=\"refresh\" content=\"5; url=trade.php\">";
		mysql_close();
		exit();
	}
	
	$my_mon -= $mon_num;
	$mon_num = $mon_num - intval($mon_num*0.05);	
	$e_mon += $mon_num;
	
	mysql_query("UPDATE renwu_member SET mon='$my_mon' WHERE id='$user_id'");
	mysql_query("UPDATE renwu_member SET mon='$e_mon' WHERE id='$mon_person'");
	
	mysql_close();
	
	echo $e_name."已经收到你汇票了！我们收取了5%的手续费。\n";
	$notice_channel = "log";
	$notice_to = "money";
	include "./include/notice.inc.php";
	exit();
}
if($youji == 1){
	include "./inc/db.inc.php";
	
	$my_info = mysql_query("SELECT mon FROM renwu_member WHERE id='$user_id'");
	$my_mon = mysql_result($my_info,0,"mon");
	
	if($my_mon < 100){
		echo "<br><font color=green>你邮资都不够，怎么给你处理啊！</font>\n";
		echo "<meta http-equiv=\"refresh\" content=\"10; url=trade.php\">";
		mysql_close();
		exit();
	}
	
	if(empty($wupin_youji)){
		echo "<br><font color=green>你要邮寄什么啊？</font>\n";
		echo "<meta http-equiv=\"refresh\" content=\"10; url=trade.php\">";
		mysql_close();
		exit();
	}
	
	$wupin_info = mysql_query("SELECT zhuangbei_wupin.id,zhuangbei_wupin.cla,zhuangbei_wupin.name FROM renwu_wupin,zhuangbei_wupin WHERE renwu_wupin.id_num='$wupin_youji' AND zhuangbei_wupin.id=renwu_wupin.wupinid LIMIT 0,1");
	$wupin_id = mysql_result($wupin_info,0,'id');
	$wupin_name = mysql_result($wupin_info,0,'name');
	$wupin_cla = mysql_result($wupin_info,0,'cla');
	
	if($wupin_name == "钻石戒指"){
	$notice_channel = "物品";
	$notice_to = "钻石戒指";
	include "./include/notice.inc.php";	
	}
	$e_info = @mysql_query("SELECT name FROM renwu_member WHERE id='$wupin_person'");
	$e_name = @mysql_result($e_info,0,"name");
	
	if(empty($e_name)){
		echo "<br><font color=green>没有这个人呢！</font>\n";
		echo "<meta http-equiv=\"refresh\" content=\"10; url=trade.php\">";
		mysql_close();
		exit();
	}
	
	if($wupin_person == $user_id){
		echo "<br><font color=green>哦！你还自己给自己东西，太有创意了吧！</font>\n";
		echo "<meta http-equiv=\"refresh\" content=\"5; url=trade.php\">";
		mysql_close();
		exit();
	}
	
	$my_mon -= 100;
	
	mysql_query("UPDATE renwu_member SET mon='$my_mon' WHERE id='$user_id'");
	mysql_query("DELETE FROM renwu_wupin WHERE id_num='$wupin_youji'");
	mysql_query("INSERT INTO renwu_wupin VALUES('','$wupin_person','$wupin_id','0','N','$wupin_cla')") or die("数据库问题\n");
	mysql_close();
	
	echo $e_name."已经收到你的邮寄物品了！我们收取了100的手续费。\n";
	
	$notice_channel = "log";
	$notice_to = "wupin";
	include "./include/notice.inc.php";
	exit();
	
}
if($wuqi == 1){
	include "./inc/db.inc.php";
	
	$my_info = mysql_query("SELECT mon FROM renwu_member WHERE id='$user_id'");
	$my_mon = mysql_result($my_info,0,"mon");
	
	if($my_mon < 100){
		echo "<br><font color=green>你邮资都不够，怎么给你处理啊！</font>\n";
		echo "<meta http-equiv=\"refresh\" content=\"10; url=trade.php\">";
		mysql_close();
		exit();
	}
	
	if(empty($wupin_youji)){
		echo "<br><font color=green>你要邮寄什么啊？</font>\n";
		echo "<meta http-equiv=\"refresh\" content=\"10; url=trade.php\">";
		mysql_close();
		exit();
	}
	
	$wupin_info = mysql_query("SELECT zhuangbei_wuqi.id,zhuangbei_wuqi.cla,zhuangbei_wuqi.name FROM renwu_wuqi,zhuangbei_wuqi WHERE renwu_wuqi.id_num='$wupin_youji' AND zhuangbei_wuqi.id=renwu_wuqi.wuqiid LIMIT 0,1");
	$wupin_id = mysql_result($wupin_info,0,'id');
	$wupin_name = mysql_result($wupin_info,0,'name');
	$wupin_cla = mysql_result($wupin_info,0,'cla');
	
	$e_info = @mysql_query("SELECT name FROM renwu_member WHERE id='$wupin_person'");
	$e_name = @mysql_result($e_info,0,"name");
	
	if(empty($e_name)){
		echo "<br><font color=green>没有这个人呢！</font>\n";
		echo "<meta http-equiv=\"refresh\" content=\"10; url=trade.php\">";
		mysql_close();
		exit();
	}
	
	if($wupin_person == $user_id){
		echo "<br><font color=green>哦！你还自己给自己东西，太有创意了吧！</font>\n";
		echo "<meta http-equiv=\"refresh\" content=\"5; url=trade.php\">";
		mysql_close();
		exit();
	}
	
	$my_mon -= 100;
	
	mysql_query("UPDATE renwu_member SET mon='$my_mon' WHERE id='$user_id'");
	mysql_query("DELETE FROM renwu_wuqi WHERE id_num='$wupin_youji'");
	mysql_query("INSERT INTO renwu_wuqi VALUES('','$wupin_person','$wupin_id','0','N','$wupin_cla')") or die("数据库问题\n");
	mysql_close();
	
	echo $e_name."已经收到你的邮寄物品了！我们收取了100的手续费。\n";
	
	$notice_channel = "log";
	$notice_to = "wupin";
	include "./include/notice.inc.php";
	exit();
	
}
?>
<?
	echo "<br>==============侠域驿站==============<br>\n";
	echo ("【侠域驿站】是提供给大家交易、交换物品的地方，为了提供更好的服务，
	这里的各项业务都要收取一定的费用。
	");
	$npc_org = "侠域驿站";
    	include "./include/list_npc.inc.php";
?>
<table border="1" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="100%">
  <tr>
    <td width="100%" bgcolor="#0099CC">
    <p align="center"><font color="#FF9900">汇款业务（手续费5%）</font></td>
  </tr>
  <tr>
    <td width="100%"><form action=trade.php?huikuan=1 method=post>
    数量<input name=mon_num size=4 type=text>
    接受人ID<input name=mon_person size=5 type=text>
    <input type=submit name=geimon value=汇款 style="font-family: 宋体; border-style: ridge; border-width: 0; background-color: #CCFF99; color:#666633">
    </form>
    </td>
  </tr>
  <tr>
    <td width="100%" bgcolor="#0099CC">
    <p align="center"><font color="#FF9900">物品邮寄业务（收费100/次）</font></td>
  </tr>
  <tr>
    <td width="100%">
    <?
    	include "./inc/db.inc.php";
	
	$my_wupin = mysql_query("SELECT name,id_num FROM renwu_wupin,zhuangbei_wupin WHERE zhuangbei_wupin.id=renwu_wupin.wupinid AND renwu_wupin.id='$user_id'");
	$wupin_num = mysql_num_rows($my_wupin);
	if($wupin_num > 0){
	echo "<form action=trade.php?youji=1 method=post>\n";
	echo "<select name=wupin_youji size=1>\n";
	echo "<option value=>选择物品</option>\n";
	for($i=0;$i<$wupin_num;$i++){
		$wupin_name = mysql_result($my_wupin,$i,"name");
		$wupin_idnum = mysql_result($my_wupin,$i,"id_num");
		echo "<option value=$wupin_idnum>".$wupin_name."</option>\n";
	}
	echo "</select>\n";
	echo "接受人ID<input name=wupin_person size=5 type=text>";
	echo "<input type=submit value=邮寄 name=wupin_nowuse style=\"font-family: 宋体; border-style: ridge; border-width: 0; background-color: #CCFF99; color:#666633\">\n";
	echo "</form>\n";
	}
    ?>
    </td>
  </tr>
  <tr>
    <td width="100%" bgcolor="#0099CC">
    <p align="center"><font color="#FF9900">武器邮寄业务（收费100/次）</font></td>
  </tr>
  <tr>
    <td width="100%">
    <?
    	include "./inc/db.inc.php";
	
	$my_wupin = mysql_query("SELECT name,id_num FROM renwu_wuqi,zhuangbei_wuqi WHERE zhuangbei_wuqi.id=renwu_wuqi.wuqiid AND renwu_wuqi.id='$user_id'");
	$wupin_num = mysql_num_rows($my_wupin);
	if($wupin_num > 0){
	echo "<form action=trade.php?wuqi=1 method=post>\n";
	echo "<select name=wupin_youji size=1>\n";
	echo "<option value=>选择武器</option>\n";
	for($i=0;$i<$wupin_num;$i++){
		$wupin_name = mysql_result($my_wupin,$i,"name");
		$wupin_idnum = mysql_result($my_wupin,$i,"id_num");
		echo "<option value=$wupin_idnum>".$wupin_name."</option>\n";
	}
	echo "</select>\n";
	echo "接受人ID<input name=wupin_person size=5 type=text>";
	echo "<input type=submit value=邮寄 name=wupin_nowuse style=\"font-family: 宋体; border-style: ridge; border-width: 0; background-color: #CCFF99; color:#666633\">\n";
	echo "</form>\n";
	}
    ?>（武器邮寄后将变更为基本状态）
    </td>
  </tr>
  <tr>
    <td width="100%">   
    　</td>
  </tr>
  <tr>
    <td width="100%">　</td>
  </tr>
  <tr>
    <td width="100%">　</td>
  </tr>
</table>
<?
     include "./include/back_xy.inc.php";
?>
