<?
session_save_path("xytmp");
session_start();
$user_id=$_SESSION["user_id"];
$del=$_GET['del'];
$post_time=$_GET['post_time'];
$view_post=$_GET['view_post'];
$title=$_POST['title'];
$t_t=$_POST['t_t'];
$submit=$_POST['submit'];
$memo=$_POST['memo'];
$search_time=$_POST['search_time'];
$cla=$_POST['cla'];

include "./inc/attest.inc.php";

include "./inc/config.inc.php";
include "./inc/style.inc.php";

include "./include/area_now_ct.inc.php";
$way = array("board.php","xy_city.php");
area_now($way,$user_id);

include "./include/location.inc.php";
up_location("留言板","board.php","$user_id");
?>

<?
include "./inc/db.inc.php";

if($del==1){
	if($post_time==""){
	echo("<script>
          window.alert('参数不正确')
          history.back()
          </script>
         ");
        }
        
        $content = mysql_query("SELECT id FROM board WHERE r_date='$post_time'");
        
        $content_id = mysql_result($content,0,"id");
        if($content_id == $user_id){
        	mysql_query("DELETE FROM board WHERE r_date='$post_time'");
        }
        echo "<meta http-equiv=\"refresh\" content=\"0; url=board.php\">";
}

if($view_post==1){
	if($post_time==""){
	echo("<script>
          window.alert('参数不正确')
          history.back()
          </script>
         ");
        }
        
        $content = mysql_query("SELECT id,title,memo FROM board WHERE r_date='$post_time'");
        
        $content_id = mysql_result($content,0,"id");
        $content_title = mysql_result($content,0,"title");
        $content_m = mysql_result($content,0,"memo");
        $content_m=htmlspecialchars($content_m);
	$content_m=str_replace("\n","<br>",$content_m);
	$content_m=str_replace(" ","&nbsp;",$content_m);
        $date = getdate($post_time);
	$e_date = $date['mday']."日".$date['hours']."时".$date['minutes']."分";
	
        echo ("<table>
        	<tr><td bgcolor='#6699cc' align=center width=550><font color=#ffff00>$content_title</font></td></tr>
        	<tr><td bgcolor='#6699cc' width=550><font color=#000080>&nbsp;&nbsp;&nbsp;$content_m</td></tr>
        	<tr><td bgcolor='#6699cc' width=550 align=right><font color=#ffff00>".$content_id."发表于$e_date</td></tr>
        	</table>");
        	
        echo "<input type=submit value='返 回' onclick=\"location.href='board.php'\" style=\"font-family: 宋体; border-style: ridge; border-width: 0; background-color: #CCFF99; color:#666633\">\n";
        if($content_id == $user_id){
        echo "<a href=board.php?post_time=$post_time&del=1>删除本条</a>\n";
        }
        mysql_close();
        exit();        
}

if($search_now){
	echo ("<table>
        <tr>
        <td colspan='5' bgcolor='#6699cc'>        
        <form name='form' method='post' action='$PHP_SELF'><p style='font-family:宋体;font-size:9pt'>
        <font color=#cococo>标题</font><input type='text' name='title' size='15' maxlength='30' style='border-style:none;'>
        <select name=t_t size=1>
        <option value=留言条 selected>留言条</option>
        <option value=问询条>问询条</option>
        <option value=问候条>问候条</option>
        <option value=挑战条>挑战条</option>
        <option value=交易条>交易条</option>
        </select>
        <input type='submit' name='submit' value='留言' style=\"font-family: 宋体; border-style: ridge; border-width: 0; background-color: #CCFF99; color:#666633\">
        <br>
        <font color=#cococo>内容</font>
        <textarea rows=4 name=memo cols=50></textarea><br>
        <select name='search_time' size='1'><option value=>显示记录..</option>
        <option value=86400>一天内</option>
        <option value=172800>二天内</option>
        <option value=432000>五天内</option>
        <option value=864000>十天内</option>
        <option value=1296000>十五天内</option>
        </select>
        <font color=#cococo>寻找留言人</font><input type='text' name='search_name' size='6' style='border-style:none;'>
        <input type='submit' name='search_now' value='搜索' style=\"font-family: 宋体; border-style: ridge; border-width: 0; background-color: #CCFF99; color:#666633\">
        </td>
        </tr>
        </table>
        ");
        
        if($search_time){        
	$need_time = time()-$search_time;
	$board_n = @mysql_query("SELECT id,title,r_date FROM board WHERE r_date>'$need_time' AND cla='留言板' ORDER BY r_date DESC");
	}else if($search_name){
	$board_n = @mysql_query("SELECT id,title,r_date FROM board WHERE id='$search_name' AND cla='留言板' ORDER BY r_date DESC");
	}else{
		echo "◎你没有指定搜索的内容◎\n";
		echo "<br><input type=submit value='返 回' onclick=\"location.href='board.php'\" style=\"font-family: 宋体; border-style: ridge; border-width: 0; background-color: #CCFF99; color:#666633\">\n";
        	mysql_close();
        	exit();
        }
	
	$num = @mysql_num_rows($board_n);
	if($num > 0){
	echo "<ul>\n";
	for($i=0;$i<$num;$i++){
		$id = mysql_result($board_n,$i,"id");
		$title = mysql_result($board_n,$i,"title");
		$time = mysql_result($board_n,$i,"r_date");
		
		$date = getdate($time);
		$e_date = $date['mday']."日".$date['hours']."时".$date['minutes']."分";
		echo "<li>\n";
		echo "<a href=board.php?post_time=$time&view_post=1>$title</a>-".$id."|".$e_date;
		echo "</li>\n";
	}
	echo "</ul>\n";
	}
mysql_close();
exit();
}

if($submit){
  if($memo=="" || $title=="")
  {
    echo("<script>
          window.alert('标题和留言不能为空白！！')
          history.back()
          </script>
         ");
  }
  else
  {
    $name  = addslashes($user_id);
    $memo  = addslashes($memo);
    $time  = time();
    
    switch ($t_t) {
  	case '问询条':
        $t_t = "<font color=#99CCFF>问询条</font>-";
        break;
  	case '交易条':
        $t_t = "<font color=#666633>交易条</font>-";
        break;
  	case '问候条':
        $t_t = "<font color=#996633>问候条</font>-";
        break;
  	case '挑战条':
        $t_t = "<font color=#0066CC>挑战条</font>-";
        break;
        default:
        $t_t = "<font color=#006600>留言条</font>-";
	}
  
    $title = $t_t.$title;
    if($cla != "公告")	$s_query="insert into board values('$name','$title','$memo','$time','留言板')";
    if($cla == "公告")	$s_query="insert into board values('$name','$title','$memo','$time','公告栏')";
    $result=mysql_query($s_query);
         
    if($result)
    {
      $mode="";
      echo("<meta http-equiv='Refresh' content='0; URL=$PHP_SELF'>");
    }
    else
    {
      echo("<script>
            window.alert('DataBase 数据库操作失败！！！')
            history.go(-1)
            </script>
          ");
          exit;
    }
  }
}


if(!$mode)
{
echo ("<table>
    <tr>
        <td colspan='5' bgcolor='#6699cc'>        
        <form name='form' method='post' action='$PHP_SELF'><p style='font-family:宋体;font-size:9pt'>
        <font color=#cococo>标题</font><input type='text' name='title' size='15' maxlength='30' style='border-style:none;'>
        <select name=t_t size=1>
        <option value=留言条 selected>留言条</option>
        <option value=问询条>问询条</option>
        <option value=问候条>问候条</option>
        <option value=挑战条>挑战条</option>
        <option value=交易条>交易条</option>
        </select>
	");
if($userid == $user_id){
	echo ("
	<font color=#cococo>管理员选项：</font>
	<select name=cla size=1>
        <option value=留言板 selected>留言板</option>
        <option value=公告>公告</option>
        </select>
	");
}
echo ("
        <input type='submit' name='submit' value='留言' style=\"font-family: 宋体; border-style: ridge; border-width: 0; background-color: #CCFF99; color:#666633\">
        <br>
        <font color=#cococo>内容</font>
        <textarea rows=4 name=memo cols=50></textarea><br>
        <select name='search_time' size='1'><option value=>显示记录..</option>
        <option value=86400>一天内</option>
        <option value=172800>二天内</option>
        <option value=432000>五天内</option>
        <option value=864000>十天内</option>
        <option value=1296000>十五天内</option>
        </select>
        <font color=#cococo>寻找留言人</font><input type='text' name='search_name' size='6' style='border-style:none;'>
        <input type='submit' name='search_now' value='搜索' style=\"font-family: 宋体; border-style: ridge; border-width: 0; background-color: #CCFF99; color:#666633\">
        </td>
    </tr>
    </table>
  ");
}

$board_n = @mysql_query("SELECT id,title,r_date FROM board WHERE cla='留言板' ORDER BY r_date DESC LIMIT 0,40");
$num = @mysql_num_rows($board_n);
if($num > 0){
	echo "<ul>\n";
	for($i=0;$i<$num;$i++){
		$id = mysql_result($board_n,$i,"id");
		$title = mysql_result($board_n,$i,"title");
		$time = mysql_result($board_n,$i,"r_date");
		
		$date = getdate($time);
		$e_date = $date['mday']."日".$date['hours']."时".$date['minutes']."分";
		echo "<li>\n";
		echo "<a href=board.php?post_time=$time&view_post=1>$title</a>-".$id."|".$e_date;
		echo "</li>\n";
	}
	echo "</ul>\n";
}
mysql_close();
?>
<?
	include "./include/back_xy.inc.php";
?>