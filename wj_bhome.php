<?
session_save_path("../xytmp");
session_start();
$user_id=$_SESSION["user_id"];
$id=$_GET['id'];
$edit=$_GET['edit'];
$home_name=$_POST['home_name'];
$home_des=$_POST['home_des'];
$R1=$_POST['R1'];
$kickout=$_GET['kickout'];
$sleep=$_GET['sleep'];

include "../inc/attest_lu.inc.php";

include "../inc/config.inc.php";
include "../inc/style.inc.php";
/*
==============
=
=公元 2002年月日
==============
*/
//判断瞬移
include "../include/area_now.inc.php";
$way = array("bhc/wj_home.php");
$way[] = "bhc/wj_bhome.php?id=".$id;
area_now($way,$user_id);
?>
<?
	if(empty($id)){
			echo "无效参数";
			exit();
		}
		
	include "../inc/db.inc.php";
	$home_info = mysql_query("SELECT * FROM wj_home WHERE id='$id'");
	$home_id = mysql_result($home_info,0,"id");	
	$home_open = mysql_result($home_info,0,"open");
	
	if($home_open == "N" && $home_id != "$user_id"){
		echo "<br><font color=green>房子已经被主人锁了，你进不去。</font>\n";
		echo "<meta http-equiv=\"refresh\" content=\"5; url=wj_home.php\">";
		mysql_close();
		exit();	
	}
	
	if($edit == 1){		
		echo ("
		<center>
			<form action=wj_bhome.php?edit=2&id=$id method=post>
			取名：<input type=text name=home_name size=10>(最多5个汉字)<br>
			房间描述：<input type=text name=home_des size=15><br>
			开放状态：开<input type=radio value=Y checked name=R1>关<input type=radio value=N name=R1>
			<input type=submit name=B1 value='设置' style='font-family: 宋体; border-style: ridge; border-width: 0; background-color: #CCFF99; color:#666633'>
			</form>
		</center>
		");
	}
	if($edit == 2){
		if($home_id != "$user_id"){
		echo "<br><font color=green>房间主人不是你，你怎么来捣蛋啊！</font>\n";
		echo "<meta http-equiv=\"refresh\" content=\"5; url=wj_home.php\">";
		mysql_close();
		exit();	
		}
		mysql_query("UPDATE wj_home SET home_name='$home_name',home_des='$home_des',open='$R1' WHERE id='$id'");
		echo "房间设置完毕。";
		$home_info = mysql_query("SELECT * FROM wj_home WHERE id='$id'");
	}
	if($kickout == 1){
		if($home_id != "$user_id"){
		echo "<br><font color=green>房间主人不是你，你怎么来捣蛋啊！</font>\n";
		echo "<meta http-equiv=\"refresh\" content=\"5; url=wj_home.php\">";
		mysql_close();
		exit();	
		}
		$at = "bhc/wj_bhome.php?id=".$id;
		mysql_query("UPDATE misc SET location_id='bhc/wj_home.php',location='玩家村' WHERE location_id='$at'");
		echo "房间设置完毕。";
	}
	
	if($sleep == 1){
	$my_info = mysql_query("SELECT kedian FROM misc WHERE id='$id'");
	$my_kedian = mysql_result($my_info,0,"kedian");
	
	$at = "wj_bhome.php?id=".$id;
	if(time() < $my_kedian+300){
		echo "<br><font color=green>休息也太频繁了，现在都没有任何效果了！</font>\n";
		echo "<meta http-equiv=\"refresh\" content=\"3; url=".$at."\">";
		mysql_close();
		exit();	
	}
		
	$time = time();
	
	mysql_query("UPDATE renwu_member SET hpnow=hp,ponow=po WHERE id='$id'");
	mysql_query("UPDATE misc SET kedian='$time' WHERE id='$id'");
	
	echo "<font color=#B3A43E>你美美地睡了一觉，觉得身心舒畅.....</font><br>\n";	
	}
	
	$home_name = mysql_result($home_info,0,"home_name");
	$home_des = mysql_result($home_info,0,"home_des");
	
	echo "<br>=============".$home_name."===============<br>";
	echo $home_des."。<br>\n";
	
	if($home_id == $user_id){
	echo "<br>你可以==><a href=wj_bhome.php?edit=1&id=$id>设置房间</a>|<a href=wj_bhome.php?kickout=1&id=$id>送客</a>|<a href=wj_bhome.php?sleep=1&id=$id>休息</a><br>";
	}
/*
	$npc_org = "";
    	include "../include/list_npc.inc.php";  
*/
	//记录位置
	include "../include/location_lu.inc.php";
	up_location("自己家","bhc/wj_bhome.php?id=$id","$user_id");
	
	echo ("
	<br>
	这里可以通往==><br>	
	<a href=./wj_home.php>【玩家村】<a/>
	");
?>