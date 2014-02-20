<?
session_save_path("../xytmp");
session_start();

include "../inc/config.inc.php";
include "../inc/style.inc.php";
include "../inc/db.inc.php";
?>
<meta http-equiv="refresh" content="300; url=input.php" charset="utf-8">
<?
$user_name=$_SESSION['user_name'];
$people = $user_name;
//if(!session_is_registered("comein")){
if(!$SESSION_['comein']){
	//session_register("comein");
	$time = time();
	$content = "某某某 :[".$user_name."]连线进入侠域。";
	mysql_query("INSERT INTO chat VALUES('$time','','〖系统〗','$content','all')");
	}	
?>
<form action=input.php method="post"> 
<font size=2>【频道】
<select name=room size=1>
<option value=闲聊 selected>闲聊</option>
<option value=谣言>谣言</option>
<option value=无聊>无聊</option>
<option value=挑战>挑战</option>
<option value=交易>交易</option>
<option value=情感>情感</option>
<?
	//if($user_id == "风狐") echo "<option value=系统>系统</option>";
?>
</select>
<br>
<font size=2>【大名】<font color=#CC9900 size=2><? echo $people; ?></font>
<?
//在线记录

$filename="online.txt"; 
$onlinetime=300; //多长时间算掉线，单位：秒 

$online_id=file($filename); 
$total_online=count($online_id); 
$nowtime=time(); 

//删除已掉线已列入的用户 
for($i=0;$i<$total_online;$i++){ 
$olduser=explode("|*|",$online_id[$i]); 

$hasonlinetime=$nowtime-$olduser[0]; 
if($hasonlinetime<$onlinetime and $user_name!=$olduser[1]) $nowonline[]=$online_id[$i]; 
} 

//记录当前IP用户 
$nowonline[]=$nowtime."|*|".$user_name."|*|"; 

//得到当前在线人数并重新写入文件 
$total_online=count($nowonline); 
$fp=fopen($filename,"w"); 
rewind($fp); 

echo "<br>【发送给】<select name=give_to size=1>";
if(!empty($to)) echo "<option value=".$to.">".$to."</option>\n";
else echo "<option value=all>所有人.</option>\n";
for($i=0;$i<$total_online;$i++){ 

fputs($fp,$nowonline[$i]); 
$online_name=explode("|*|",$nowonline[$i]);
echo "<option value=".$online_name[1].">".$online_name[1]."</option>\n";
fputs($fp,"\n"); 
} 
echo "</select>\n";
fclose($fp); 
?>
<input type="text" name="message" size=28> <br>
<input type="submit" value="发言" style="font-family: 宋体; border-style: ridge; border-width: 0; background-color: #CCFF99; color:#666633">
</form>

<?
//公告栏
$sp_info = mysql_query("SELECT name FROM renwu_wuqi,renwu_member WHERE renwu_wuqi.id=renwu_member.id AND wuqiid='di_lu'");
$dilu_name = @mysql_result($sp_info,0,"name");
$sp_info = mysql_query("SELECT name FROM renwu_wuqi,renwu_member WHERE renwu_wuqi.id=renwu_member.id AND wuqiid='qi_sd'");
$qisa_name = @mysql_result($sp_info,0,"name");
$sp_info = mysql_query("SELECT name FROM renwu_wuqi,renwu_member WHERE renwu_wuqi.id=renwu_member.id AND wuqiid='qis_tl'");
$qstl_name = @mysql_result($sp_info,0,"name");
echo ("
<pre>
====<font color=#DA9B45>最新信息</font>======<a href=http://www.chunplay.com/bbs/ target=_blank><font size=2>论坛</font></a>
※【的卢】持有者：$dilu_name
※【七杀刀】持有者：$qisa_name
※【七煞天罗】持有者：$qstl_name
================================
[16/02]【百花城】开张【廖记银行】
[14/02]【百花城】圣手回春，可以帮助最大
	体力小于100的人恢复到150
</pre>
");
?> 
<?
$r = 25;
$r_r = $r + 5;
$del_what = @mysql_query("SELECT time FROM chat ORDER BY time DESC LIMIT $r,$r_r");
for($i=0;$i<mysql_num_rows($del_what);$i++){
$del_time = @mysql_result($del_what,$i,"time");
@mysql_query("DELETE FROM chat WHERE time='$del_time'");
}
$message=$_POST['message'];
$room=$_POST['room'];
$msg = str_replace ( "\n", " ", $message); 
$msg = str_replace ( "<", "&lt",$msg); 
$msg = str_replace ( ">", "&gt",$msg); 
$msg = stripslashes ($msg);         

if ($msg !=  ""){
	$now_time = time();
	if($rumor_b == 1){	
		if((time()-$rumor_time)>$rumor_busytime){
		}else{
		$content = "某某某 :[".$people."]老是造谣,也不怕别人发现!";
		mysql_query("INSERT INTO chat VALUES('$time','$people','〖谣言〗','$content','all')");
		}
		$rumor_time = time();
		session_register("rumor_time");
		$content = "某某某 :$msg";
		mysql_query("INSERT INTO chat VALUES('$time','$people','〖谣言〗','$content','all')");
				
		$write_file="rumor_log.txt";
		$fp = fopen($write_file,  "a+");
		$fw = fwrite($fp,  "\n〖谣言记录〗$people :$msg");
		
	}else if($give_to == "all"){
		$people = "[".$user_nick."]".$people;
		$channel = "〖".$room."〗";
		mysql_query("INSERT INTO chat VALUES('$now_time','$people','$channel','$msg','all')");
	}else{
	$people = "[$user_nick]$people";	
	mysql_query("INSERT INTO chat VALUES('$now_time','$people','〖对话〗','$msg','$give_to')");
	}
}
mysql_close();
?>