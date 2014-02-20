<?
session_save_path("../xytmp");
session_start();
$user_id=$_SESSION["user_id"];
$begin_buy=$_GET['begin_buy'];
$buy=$_GET['buy'];
$D1=$_GET['D1'];
$wuqi_use=$_POST['wuqi_use'];
include "../inc/attest_lu.inc.php";

include "../inc/config.inc.php";
include "../inc/style.inc.php";
/*
==============
=恶人村武器交易 (Ver 0.4.2)
=公元 2002年1月7日
==============
*/

include "../include/area_now.inc.php";
$way = array("ereng/erenc.php","ereng/erenc_wuqi_trade.php");
area_now($way,$user_id);

include "../include/location_lu.inc.php";
up_location("老五武器店","ereng/erenc_wuqi_trade.php","$user_id");
?>
<?
if($begin_buy == 1){	
	include "../inc/db.inc.php";
	
	if(!$_SESSION['wuqi_id']){
		echo "你想买什么阿?\n";
		exit();
	}
	
	$user_info = mysql_query("SELECT mon FROM renwu_member WHERE id='$user_id'");
	$user_mon = mysql_result($user_info,0,"mon");
	
	$user_mon -= $wuqi_pri;
	
	mysql_query("UPDATE renwu_member SET mon='$user_mon' WHERE id='$user_id'");
	
	mysql_query("INSERT INTO renwu_wuqi VALUES('','$user_id','$wuqi_id','0','N','$wuqi_cla')") or die("数据库问题\n");
	
	echo "物品".$wuqi_name."已经购买。\n";
	echo "<meta http-equiv=\"refresh\" content=\"2; url=erenc_wuqi_trade.php\">";
	mysql_close();
	exit();
}
?>

<?
if($buy == 1){
	include "../inc/db.inc.php";
		
	$wuqi_info = mysql_query("SELECT * FROM zhuangbei_wuqi WHERE id='$D1'");
	$wuqi_name = mysql_result($wuqi_info,0,"name");
	$wuqi_pri = mysql_result($wuqi_info,0,"pri");
	$wuqi_at = mysql_result($wuqi_info,0,"at");
	$wuqi_de = mysql_result($wuqi_info,0,"de");
	$wuqi_te = mysql_result($wuqi_info,0,"te");
	$wuqi_des = mysql_result($wuqi_info,0,"des");
	$wuqi_cla = mysql_result($wuqi_info,0,"cla");
	
	echo "【名称】[".$wuqi_cla."]".$wuqi_name."<br>\n";
	echo "【介绍】".$wuqi_des."<br>\n";
	echo "【价格】".$wuqi_pri."<br>\n";
	echo "【攻击力】".$wuqi_at."<br>\n";
	echo "【防御力】".$wuqi_de."<br>\n";
	echo "【质地】".$wuqi_te."<br>\n";
	
	$user_info = mysql_query("SELECT mon FROM renwu_member WHERE id='$user_id'");
	$user_mon = mysql_result($user_info,0,"mon");
	
	if($user_mon < $wuqi_pri){
		echo "<br><font color=green>你的钱还不够</font>\n";
		echo "<meta http-equiv=\"refresh\" content=\"5; url=erenc_wuqi_trade.php\">";
		exit();
	}
			
	$wuqi_id = $D1;
	session_register("wuqi_id");
	session_register("wuqi_cla");
	session_register("wuqi_pri");
	session_register("wuqi_name");
	echo "<br><a href=erenc_wuqi_trade.php?begin_buy=1><font color=green>购买</font></a>\n";
		
	mysql_close();
	echo "<hr align=center width=80%>";
}
?>
<?
	$empty_r=0;	
	
	echo "<br>==============老五武器店==============<br>";
	echo ("这是恶人村里张老五开的武器商店，你可以看到这里布置的十分凶险，似乎每件武器中都隐藏了无数冤魂。在这里你可以买到【恶人村】特有的武器。
	");
	
    	$npc_org = "老五武器店";
    	include "../include/list_npc.inc.php";   
    	 	
    	echo ("
	<br>
	这里可以返回==><br>	
	<a href=./erenc.php>【恶人村】<a/><br>
	");
	
    	if($wuqi_sell) include "../include/sell_wuqi.inc.php";	
	
	echo "<br>==============出售武器==============";
        $my_wuqi = mysql_query("SELECT id_num,name,used,sk FROM renwu_wuqi,zhuangbei_wuqi WHERE zhuangbei_wuqi.id=renwu_wuqi.wuqiid AND renwu_wuqi.id='$user_id'");
	$wuqi_num = mysql_num_rows($my_wuqi);
	if($wuqi_num){
	echo "<form action=erenc_wuqi_trade.php method=post>\n";
	echo "<select name=wuqi_use size=1>\n";
	echo "<option value=>选择武器</option>\n";
	for($i=0;$i<$wuqi_num;$i++){
		$wuqi_namei = mysql_result($my_wuqi,$i,"name");
		$wuqi_idnum = mysql_result($my_wuqi,$i,"id_num");
		$wuqi_used = mysql_result($my_wuqi,$i,"used");
		$wuqi_sk = mysql_result($my_wuqi,$i,"sk");
		if($wuqi_used == "Y")	echo "<option value=$wuqi_idnum>".$wuqi_namei."（装备中）＋".$wuqi_sk."</option>\n";
		else echo "<option value=$wuqi_idnum>".$wuqi_namei."＋".$wuqi_sk."</option>\n";
	}
	echo "</select>\n";
	echo "<input type=submit value=出售 name=wuqi_sell style=\"font-family: 宋体; border-style: ridge; border-width: 0; background-color: #CCFF99; color:#666633\">\n";
	echo "</form>\n";
	}else{
		echo "<br><font color=#cococo>你还没有自己的武器</font>\n";
	}
	
	function compare_array($temp,$array){
	$num=count($array);
	for($i=0;$i<$num;$i++){
     	if($temp == $array[$i])
          	return 0;
	}
	return 1;
	}

	$result=mysql_query("SELECT cla FROM zhuangbei_wuqi");

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
    	$gongfu = mysql_query("SELECT id,name FROM zhuangbei_wuqi WHERE cla='$cla[$k]' AND hidden='N' AND here='恶人村' ORDER BY pri ASC");
        $gongfu_num = mysql_num_rows($gongfu);
        echo "<option value=>$cla[$k].......</option>\n";
        for($i=0;$i<=$gongfu_num-1;$i++){
        	$gongfu_name = mysql_result($gongfu,$i,"name");
        	$gongfu_id = mysql_result($gongfu,$i,"id");
        	echo "<option value=erenc_wuqi_trade.php?buy=1&D1=$gongfu_id>".$gongfu_name."</option>\n";
        }
                
        echo "</select>\n";
        echo "<a href=../list_ziliao.php?mc=武器&cla=$cla[$k]>详细资料</a>\n";
        echo "</form>\n";
        echo "</td>\n";
     }
     
     mysql_close();     
?>