<?
session_save_path("../xytmp");
session_start();
$user_id=$_SESSION["user_id"];
$begin_buy=$_GET['begin_buy'];
$buy=$_GET['buy'];
$D1=$_GET['D1'];
$wupin_use=$_POST['wupin_use'];
include "../inc/attest_lu.inc.php";

include "../inc/config.inc.php";
include "../inc/style.inc.php";

include "../include/area_now.inc.php";
$way = array("bhc/bhc.php","bhc/bhc_wupin_trade.php");
area_now($way,$user_id);

include "../include/location_lu.inc.php";
up_location("百花装备店","bhc/bhc_wupin_trade.php","$user_id");
?>

<?
if($begin_buy == 1){	
	include "../inc/db.inc.php";
	
	if(!session_is_registered("wupin_id")){
		echo "你想买什么啊?\n";
		exit();
	}
	
	$user_info = mysql_query("SELECT mon FROM renwu_member WHERE id='$user_id'");
	$user_mon = mysql_result($user_info,0,"mon");
	
	$user_mon -= $wupin_pri;
	
	mysql_query("UPDATE renwu_member SET mon='$user_mon' WHERE id='$user_id'");
	
	mysql_query("INSERT INTO renwu_wupin VALUES('','$user_id','$wupin_id','0','N','$wupin_cla')") or die("数据库问题\n");
	
	echo "物品".$wupin_name."已经购买。\n";
	echo "<meta http-equiv=\"refresh\" content=\"2; url=bhc_wupin_trade.php\">";
	mysql_close();
	exit();
}
?>

<?
if($buy == 1){
	include "../inc/db.inc.php";
	
	
	$wupin_info = mysql_query("SELECT * FROM zhuangbei_wupin WHERE id='$D1'");
	$wupin_name = mysql_result($wupin_info,0,"name");
	$wupin_pri = mysql_result($wupin_info,0,"pri");
	$wupin_at = mysql_result($wupin_info,0,"at");
	$wupin_de = mysql_result($wupin_info,0,"de");
	$wupin_te = mysql_result($wupin_info,0,"te");
	$wupin_sp = mysql_result($wupin_info,0,"sp");
	$wupin_des = mysql_result($wupin_info,0,"des");
	$wupin_cla = mysql_result($wupin_info,0,"cla");
	
	echo "【名称】[".$wupin_cla."]".$wupin_name."<br>\n";
	echo "【介绍】".$wupin_des."<br>\n";
	echo "【价格】".$wupin_pri."<br>\n";
	echo "【攻击力】".$wupin_at."<br>\n";
	echo "【防御力】".$wupin_de."<br>\n";
	echo "【质地】".$wupin_te."<br>\n";
	echo "【特殊】".$wupin_sp."<br>\n";
	
	$user_info = mysql_query("SELECT mon FROM renwu_member WHERE id='$user_id'");
	$user_mon = mysql_result($user_info,0,"mon");
	
	if($user_mon < $wupin_pri){
		echo "<br><font color=green>你的钱还不够</font>\n";
		echo "<meta http-equiv=\"refresh\" content=\"2; url=erenc_wupin_trade.php\">";
		exit();
	}
	
	$wupin_id = $D1;
	session_register("wupin_id");
	session_register("wupin_cla");
	session_register("wupin_pri");
	session_register("wupin_name");
	echo "<br><a href=bhc_wupin_trade.php?begin_buy=1><font color=green>购买</font></a>\n";
		
	mysql_close();
	echo "<hr align=center width=80%>";
}
?>

<?
	$empty_r=0;

	include "../inc/db.inc.php"; 	
	
	echo "<br>==============百花装备店==============<br>";
	echo ("
		【百花装备店】出售一些贵重的装饰，一般卖给有钱人。
	");
    	$npc_org = "百花装备店";
    	include "../include/list_npc.inc.php";
    	echo ("
	<br>
	这里可以返回==><br>	
	<a href=./bhc.php>【大街】<a/><br>
	");
    	if($wupin_sell) include "../include/sell_wupin.inc.php";
    	echo "<br>==============出售装备==============";
	
        $my_wupin = mysql_query("SELECT id_num,name,used FROM renwu_wupin,zhuangbei_wupin WHERE zhuangbei_wupin.id=renwu_wupin.wupinid AND renwu_wupin.id='$user_id'");
	$wupin_num = mysql_num_rows($my_wupin);
	if($wupin_num > 0){
	echo "<form action=bhc_wupin_trade.php method=post>\n";
	echo "<select name=wupin_use size=1>\n";
	echo "<option value=>选择物品</option>\n";
	for($i=0;$i<$wupin_num;$i++){	
		$wupin_namei = mysql_result($my_wupin,$i,"name");
		$wupin_idnum = mysql_result($my_wupin,$i,"id_num");
		$wupin_used = mysql_result($my_wupin,$i,"used");
		if($wupin_used == "Y")	echo "<option value=$wupin_idnum>".$wupin_namei."（装备中）</option>\n";
		else echo "<option value=$wupin_idnum>".$wupin_namei."</option>\n";
	}
	echo "</select>\n";
	echo "<input type=submit value=出售 name=wupin_sell style=\"font-family: 宋体; border-style: ridge; border-width: 0; background-color: #CCFF99; color:#666633\">\n";
	echo "</form>\n";
	}else{
		echo "<br><font color=#cococo>现在还孑然一身</font>\n";
	}
	function compare_array($temp,$array){
	$num=count($array);
	for($i=0;$i<$num;$i++){
     	if($temp == $array[$i])
          	return 0;
	}
	return 1;
	}

	$result=mysql_query("SELECT cla FROM zhuangbei_wupin");

	$num=mysql_num_rows($result);
	for($i=0;$i<$num;$i++){
     	$class_temp=mysql_result($result,$i,"cla");
     	if(compare_array($class_temp,$mainclass)){
          	$mainclass[$empty_r]=$class_temp;
          	$empty_r++;
     	}
	}

    $cla=$mainclass;
    
    for($k=0;$k<count($cla);$k++){
    
    	echo "<tr><td width=100%>\n";
    	echo "<form>\n";
    	echo "<select size=1 name=D1 onChange='window.location=form.D1.options[form.D1.selectedIndex].value'>\n";
    	$gongfu = mysql_query("SELECT id,name FROM zhuangbei_wupin WHERE cla='$cla[$k]' AND hidden='N' AND here='百花城' ORDER BY pri ASC");
        $gongfu_num = mysql_num_rows($gongfu);
        echo "<option value=>$cla[$k].....</option>\n";
        for($i=0;$i<=$gongfu_num-1;$i++){
        	$gongfu_name = mysql_result($gongfu,$i,"name");
        	$gongfu_id = mysql_result($gongfu,$i,"id");
        	echo "<option value=bhc_wupin_trade.php?buy=1&D1=$gongfu_id>".$gongfu_name."</option>\n";
        }
                
        echo "</select>\n";
        echo "<a href=../list_ziliao.php?mc=装备&cla=$cla[$k]>详细资料</a>\n";
        echo "</form>\n";
        echo "</td>\n";
     }
     
     mysql_close();     
?>