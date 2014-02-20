<?
include "./inc/attest.inc.php";

include "./inc/config.inc.php";
include "./inc/style.inc.php";
/*
================================
=详细资料查询 (Ver 0.4.1)
=公元 2001年12月27日
================================
*/
?>
<?
$mc=$_GET['mc'];
$cla=$_GET['cla'];
if($mc == "武功"){
	include "./inc/db.inc.php";
	
	$wugong_ziliao = mysql_query("SELECT * FROM wugong_gongfu WHERE cla='$cla' ORDER BY xz ASC");
	$wugong_num = mysql_num_rows($wugong_ziliao);
	
	echo ("
			<table border='1' cellpadding='0' cellspacing='0' style='border-collapse: collapse' bordercolor='#111111' width='100%'>
  			<tr>
    			<td width='50%' bgcolor='#669999'><font color=#FF8000>【名称及介绍】</font>　</td>
    			<td width='25%' bgcolor='#669999'><font color=#FF8000>【武功招数】</font>　</td>
    			<td width='25%' bgcolor='#669999'><font color=#FF8000>【要求】</font>　</td>
  			</tr>
  		");
  		
	for($i=0;$i<$wugong_num;$i++){	
		$wugong_name = mysql_result($wugong_ziliao,$i,'name');
		$wugong_zao1 = mysql_result($wugong_ziliao,$i,'zao1');
		$wugong_zao2 = mysql_result($wugong_ziliao,$i,'zao2');
		$wugong_zao3 = mysql_result($wugong_ziliao,$i,'zao3');
		$wugong_zao4 = mysql_result($wugong_ziliao,$i,'zao4');
		$wugong_zao5 = mysql_result($wugong_ziliao,$i,'zao5');
		$wugong_des = mysql_result($wugong_ziliao,$i,'des');
		$wugong_xz = mysql_result($wugong_ziliao,$i,'xz');
		$wugong_poslimit = mysql_result($wugong_ziliao,$i,'poslimit');
	
		$wugong_xz = $wugong_xz*1000;
		$need_mon = $wugong_xz/10;
		
		echo ("
  			<tr>
    			<td width='50%'>【".$wugong_name."】－－".$wugong_des."　</td>
    			<td width='25%'>".$wugong_zao1."<br>".$wugong_zao2."<br>".$wugong_zao3."<br>".$wugong_zao4."<br>".$wugong_zao5."</td>
    			<td width='25%'>要求经验：".$wugong_xz."<br>要求立场：".$wugong_poslimit."<br>学费：".$need_mon."　</td>
  			</tr>
  		");
	}
	echo "</table>\n";
	mysql_close();
	exit();
}
if($mc == "装备"){
	include "./inc/db.inc.php";
	
	$wupin_ziliao = mysql_query("SELECT * FROM zhuangbei_wupin WHERE cla='$cla' ORDER BY pri ASC");
	$wupin_num = mysql_num_rows($wupin_ziliao);
	
	echo ("
			<table border='1' cellpadding='0' cellspacing='0' style='border-collapse: collapse' bordercolor='#111111' width='100%'>
  			<tr>
    			<td width='50%' bgcolor='#669999'><font color=#FF8000>【名称及介绍】</font>　</td>
    			<td width='25%' bgcolor='#669999'><font color=#FF8000>【属性】</font>　</td>
    			<td width='25%' bgcolor='#669999'><font color=#FF8000>【价值】</font>　</td>
  			</tr>
  		");
	
	for($i=0;$i<$wupin_num;$i++){
		$wupin_name = mysql_result($wupin_ziliao,$i,"name");
		$wupin_pri = mysql_result($wupin_ziliao,$i,"pri");
		$wupin_at = mysql_result($wupin_ziliao,$i,"at");
		$wupin_de = mysql_result($wupin_ziliao,$i,"de");
		$wupin_te = mysql_result($wupin_ziliao,$i,"te");
		$wupin_sp = mysql_result($wupin_ziliao,$i,"sp");
		$wupin_des = mysql_result($wupin_ziliao,$i,"des");
		$wupin_xz = mysql_result($wupin_ziliao,$i,"xz");
		$wupin_here = mysql_result($wupin_ziliao,$i,"here");
		
		echo ("
  			<tr>
    			<td width='50%'>【".$wupin_name."】－－".$wupin_des."　</td>
    			<td width='25%'>攻击效果：".$wupin_at."<br>防御效果：".$wupin_de."<br>物品质地：".$wupin_te."<br>经验需要：".($wupin_xz*100)."<br>出产地：".$wupin_here."<br>特殊效果：".$wupin_sp."</td>
    			<td width='25%'>".$wupin_pri."　</td>
  			</tr>
  		");
	}
	echo "</table>\n";
	mysql_close();
	exit();
}
if($mc == "武器"){
	include "./inc/db.inc.php";
	
	$wuqi_ziliao = mysql_query("SELECT * FROM zhuangbei_wuqi WHERE cla='$cla' ORDER BY pri ASC");
	$wuqi_num = mysql_num_rows($wuqi_ziliao);
	
	echo ("
			<table border='1' cellpadding='0' cellspacing='0' style='border-collapse: collapse' bordercolor='#111111' width='100%'>
  			<tr>
    			<td width='50%' bgcolor='#669999'><font color=#FF8000>【名称及介绍】</font>　</td>
    			<td width='25%' bgcolor='#669999'><font color=#FF8000>【属性】</font>　</td>
    			<td width='25%' bgcolor='#669999'><font color=#FF8000>【价值】</font>　</td>
  			</tr>
  		");
  		
  	for($i=0;$i<$wuqi_num;$i++){
		$wuqi_name = mysql_result($wuqi_ziliao,$i,"name");
		$wuqi_pri = mysql_result($wuqi_ziliao,$i,"pri");
		$wuqi_at = mysql_result($wuqi_ziliao,$i,"at");
		$wuqi_de = mysql_result($wuqi_ziliao,$i,"de");
		$wuqi_te = mysql_result($wuqi_ziliao,$i,"te");
		$wuqi_des = mysql_result($wuqi_ziliao,$i,"des");
		$wuqi_xz = mysql_result($wuqi_ziliao,$i,"xz");
		$wuqi_here = mysql_result($wuqi_ziliao,$i,"here");
		
		echo ("
  			<tr>
    			<td width='50%'>【".$wuqi_name."】－－".$wuqi_des."　</td>
    			<td width='25%'>攻击效果：".$wuqi_at."<br>防御效果：".$wuqi_de."<br>经验需要：".($wuqi_xz*100)."<br>出产地：".$wuqi_here."<br>物品质地：".$wuqi_te."</td>
    			<td width='25%'>".$wuqi_pri."　</td>
  			</tr>
  		");
  	}
  	echo "</table>\n";
	mysql_close();
	exit();
}
?>