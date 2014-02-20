<?
session_save_path("xytmp");
session_start();
$user_id=$_SESSION["user_id"];
$b_id=$_SESSION['b_id'];

include "./inc/attest.inc.php";

/*
================================
=本地玩家 (Ver 0.4.1)
=公元：2002年1月2日
================================
*/
include "./inc/config.inc.php";
include "./inc/style.inc.php";
?>
<?
    	include "./inc/db.inc.php";	
	
	
	echo "<h4>这里有以下玩家：</h4>\n";
	$_SESSION['na']=1;
	//session_register("na");
	$location_info = mysql_query("SELECT location_id FROM misc WHERE id='$user_id'");  	
	$location = mysql_result($location_info,0,"location_id");
	$people_info = mysql_query("SELECT renwu_member.id FROM renwu_member,misc WHERE misc.zd='Y' AND renwu_member.id=misc.id AND misc.location_id='$location' AND renwu_member.id <> '$user_id' ORDER BY exp DESC");
	
	$num = mysql_num_rows($people_info);
	echo "<table border=2 cellpadding=0 cellspacing=0 bordercolor=#111111 width=100%>\n";
	
	for($i=0;$i<$num;$i++){	
		$people_id = mysql_result($people_info,$i,"id");
		
		$hp_info = mysql_query("SELECT hpnow FROM renwu_member WHERE id='$people_id' AND id<>'$user_id'");		
		$people_hp = @mysql_result($hp_info,0,"hpnow");
					
		$people_pinfo = mysql_query("SELECT exp,col,name,sex,nick,cha,icon,org FROM renwu_member WHERE id='$people_id'");
		$people_name = mysql_result($people_pinfo,0,"name");
		$people_sex = mysql_result($people_pinfo,0,"sex");
		$people_nick = mysql_result($people_pinfo,0,"nick");
		$people_cha = mysql_result($people_pinfo,0,"cha");
		$people_org = mysql_result($people_pinfo,0,"org");
		$people_icon = mysql_result($people_pinfo,0,"icon");
				
		$my_marry = mysql_query("SELECT duixiang FROM misc WHERE id='$people_id'");
		$my_marryed = @mysql_result($my_marry,0,"duixiang");
		
		$my_orgnick = mysql_query("SELECT orgnick FROM misc WHERE id='$people_id'");
		$my_orgnicked = @mysql_result($my_orgnick,0,"orgnick");	
		
		if($my_orgnicked != ""){
			if($people_org == "无组织")
			$orgmsg = "失去组织的".$my_orgnicked;
			else
			$orgmsg = $people_org."<font color=green>".$my_orgnicked."</font>";
		}
		
		echo "<tr>\n";
		
		echo "<td width=25% bgcolor=#CCFFCC align=center><font size=4 color=#FF9999>".$people_id."</font></td>\n";
		
		if($my_marryed != ""){
			$dx_name = mysql_query("SELECT name FROM renwu_member WHERE id='$my_marryed'");
			$my_marryed = mysql_result($dx_name,0,"name");
		}
		
		if($my_marryed != "" && $people_sex == "侠客"){
			$msg = "<font color=#FFCCFF>".$my_marryed."</font>的老公".$people_cha."的<font color=blue>".$people_nick."</font><font color=#66CCFF size=4>".$people_name."</font>";
		}else if($my_marryed != "" && $people_sex == "侠女"){
			$msg = "<font color=#33CC33>".$my_marryed."</font>的老婆".$people_cha."的<font color=blue>".$people_nick."</font><font color=#66CCFF size=4>".$people_name."</font>";
		}else	$msg = $people_cha."的<font color=blue>".$people_nick."</font><font color=#66CCFF size=4>".$people_name."</font></td>\n";
				
		if($my_orgnicked != ""){
			echo "<td width=25% align=center>".$orgmsg."<br><img src=".$pic2_url."/".$people_icon.".jpg border=0></img><br></td>\n";
		}else	echo "<td width=25% align=center><img src=".$pic2_url."/".$people_icon.".jpg border=0></img><br></td>\n";
		echo "<td width=25% bgcolor=#CCFFCC align=center><a href=people_hudong.php?b_id=$people_id>".$msg."</a></td>\n";
//		echo "<td width=25% bgcolor=#CCFFCC align=center><a href=here_pp.php?juedou=1&b_id=$people_id><img src=$pic_url"."/"."jd.jpg border=0></img></a><br><a href=here_pp.php?qiecuo=1&b_id=$people_id><img src=$pic_url"."/"."qc.jpg border=0></img></a>　</td>\n";
		
		echo "</tr>\n";
	}
	echo "</table>\n";	
	
	$location_info = mysql_query("SELECT location_id FROM misc WHERE id='$user_id'");  	
	$location = mysql_result($location_info,0,"location_id");
	echo "<p align=center><a href=$location>【后退】</a>\n";
	mysql_close();
?>
