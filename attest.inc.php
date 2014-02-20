<?
session_save_path("xytmp");
session_start();

?>

<?
if(!session_is_registered(user_id) || !session_is_registered(user_name))
{
     include "./inc/style.inc.php";     
     echo "你的数据系统不能识别，请重新登陆！";
     echo "<br><a href=index.htm target=_parent>登录系统</a>\n";
     exit();
}
?>