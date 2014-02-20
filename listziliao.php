<?
session_save_path("xytmp");
session_start();
$user_id=$_SESSION["user_id"];
$list=$_GET['list'];
$content_id=$_GET['content_id'];
include "./inc/attest.inc.php";

include "./inc/config.inc.php";
include "./inc/style.inc.php";
/*
======================
=资料浏览
=公元2001年12月9日
=====================
*/
include "./include/area_now_ct.inc.php";
$way = array("listziliao.php","xy_city.php");
area_now($way,$user_id);
include "./include/location.inc.php";
up_location("档案馆","listziliao.php","$user_id");
include "./inc/db.inc.php";
?>
<?
if($list == 1){
	if(empty($content_id)){
		echo "参数错误。\n";
		exit();
	}
	
	$content = mysql_query("SELECT title,content FROM ziliao WHERE id='$content_id'");
	
	$content_title = mysql_result($content,0,"title");
	$content_content = mysql_result($content,0,"content");
	
	echo ("
	<form method=POST action=listziliao.php>
  	<p align=center>标题<br>
  	<input type=text name=T1 size=36 value=$content_title readonly></p>
  	<p align=center>内容<br>
  	<textarea rows=21 name=S1 cols=50 readonly>$content_content</textarea></p>
	</form>	
	");
	$location_info = mysql_query("SELECT location_id FROM misc WHERE id='$user_id'");  	
	$location = mysql_result($location_info,0,"location_id");
	echo "<p align=center><a href=$location>【后退】</a>\n";
	mysql_close();
	exit();
}
?>
<?	

	$content_text = mysql_query("SELECT id,title FROM ziliao ORDER BY time DESC");
	$num_text = mysql_num_rows($content_text);
	
	echo "<ul>\n";
	for($i=0;$i<$num_text;$i++){
		$content_id = mysql_result($content_text,$i,"id");
		$content_title = mysql_result($content_text,$i,"title");
		
		echo "<li><a href=listziliao.php?list=1&content_id=$content_id>".$content_title."</a>\n";
		
	}
	echo "</ul>\n";
	mysql_close();
	include "./include/back_xy.inc.php";
?>