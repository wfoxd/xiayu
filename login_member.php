<?

include "inc/config.inc.php";
include "inc/style.inc.php";

?>
<?
//echo "login".$login.$_GET[login];
//echo "T1".$T1;
$login=$_GET['login'];

if($login==1){//提交注册页面后login设为1
	   $T1=$_POST['T1'];//游戏用户名
     $T2=$_POST['T2'];//游戏密码
     $D3=$_POST['D3'];//力量
     $D4=$_POST['D4'];//智慧
     $D5=$_POST['D5'];//体质
     $D6=$_POST['D6'];//敏捷
     $D7=$_POST['D7'];//意志
     $R1=$_POST['R1'];//人物性别
     $R2=$_POST['R2'];//人物性格
     $icon=$_POST['icon'];
	   
     
     
     include "inc/db.inc.php";//连接数据库  
     echo "<p align=center><img src=$pic_url/zhuceinfo.jpg></img>\n<br><ul>";
     //检查人数限制
     $nowmember = mysql_query("SELECT id FROM renwu_member");
     if($maxmember <= mysql_num_rows($nowmember)){
          echo "<p align=center><img src=$pic_url/w.gif></img><br>";
          echo "<font size=4>注册人数已经达到最大，如需新帐号请联系管理员</font>\n";
          echo "<a href=\"javascript:history.back(1)\"><img valign=bottom border=0 src=\"$pic_url/back.gif\">后退</a>\n";
          exit(10);//如果最大注册人数小于等于已注册人数，则提示联系管理员并结束页面
     }
     //结束
         
     mysql_select_db($DBdatabase);
     $userid = mysql_query("SELECT id FROM renwu_member WHERE id='$T1'");//or die("Invalid query: " . mysql_error());
     //echo "userid".$userid;     
     if(mysql_num_rows($userid)){
          echo "<p align=center><img src=$pic_url/w.gif></img><br>";
          echo "<font size=4>十分抱歉，此ID已经被注册！</font>\n";
          echo "<a href=\"javascript:history.back(1)\"><img valign=bottom border=0 src=\"$pic_url/back.gif\">后退</a>\n";
          exit(1);//检查游戏用户名T1是否被注册，如是提示已被注册并结束页面，否则什么都不做
     }
     mysql_close();
     
     
     //密码检查
     //echo "测试2 T1".$T1;
     //$user_pd = mysql_query("SELECT pw FROM renwu_member WHERE id='$T1'");
     //if($T2 != $user_pd){
     //     echo "<p align=center><img src=$pic_url/w.gif></img><br>";
     //     echo "<font size=4>你的密码有问题，请检查</font>\n";
     //     echo "<a href=\"javascript:history.back(1)\"><img valign=bottom border=0 src=\"$pic_url/back.gif\">后退</a>\n";
     //     exit(2);//检查密码是否与原有密码一致，如果不一致提示密码有问题并结束页面，否则打印密码
     //}else echo "<li>你的密码：".$T2."<br>\n";     
     
     
     
     //姓名检查
     if($T1 == "" || strlen($T1) > 10){
          echo "<p align=center><img src=$pic_url/w.gif></img><br>";
          echo "<font size=4>你的姓名有问题，请检查</font>\n";
          echo "<a href=\"javascript:history.back(1)\"><img valign=bottom border=0 src=\"$pic_url/back.gif\">后退</a>\n";
          exit(3);//如果姓名T1为空或者长度大于10，提示姓名有问题并结束页面，否则打印姓名
     }else echo "<li>你的姓名：".$T1."<br>\n";
     //结束
     
     //属性总量检查
     $all = $D3 + $D4 + $D5 + $D6 + $D7;
     if($all != 80){
          echo "<p align=center><img src=$pic_url/w.gif></img><br>";
          echo "<font size=4>你的属性总和没有在规定范围内</font>\n";
          echo "<a href=\"javascript:history.back(1)\"><img valign=bottom border=0 src=\"$pic_url/back.gif\">后退</a>\n";
          exit(5);
     }
     //结束
     echo "<li>人物性别：".$R1."<br>\n";
     echo "<li>人物性格：".$R2."<br>\n";
     echo "<li>人物力量：".$D3."<br>\n";
     echo "<li>人物智慧：".$D4."<br>\n";
     echo "<li>人物体质：".$D5."<br>\n";
     echo "<li>人物敏捷：".$D6."<br>\n";
     echo "<li>人物意志：".$D7."<br>\n";
     echo "<li>人物头像：<img src=$pic2_url/$icon.jpg border=0><br>\n";

     echo "<form action=login_member.php?login=2 method=post>\n";//再提交一遍
     echo "<input type=hidden name=id value=$T1>";
     echo "<input type=hidden name=pw value=$T2>";
     echo "<input type=hidden name=name value=$T3>";
     echo "<input type=hidden name=sex value=$R1>";
     echo "<input type=hidden name=cha value=$R2>";
     echo "<input type=hidden name=str value=$D3>";
     echo "<input type=hidden name=zhi value=$D4>";
     echo "<input type=hidden name=con value=$D5>";
     echo "<input type=hidden name=spe value=$D6>";     
     echo "<input type=hidden name=pur value=$D7>";
     echo "<input type=hidden name=icon value=$icon>";
     echo "<input type=submit value=确定 name=B1 style=\"font-family: 宋体; border-style: ridge; border-width: 0; background-color: #CCFF99; color:#666633\">\n";
     echo "</form>\n";
     
     echo "<form action=login_member.php?login=0 method=post>\n";
     echo "<input type=submit value=返回 name=B2 style=\"font-family: 宋体; border-style: ridge; border-width: 0; background-color: #CCFF99; color:#666633\">\n";
     echo "</form>\n";
      
     include "help/copyright.inc.php";
     exit();//确认注册信息，进入注册成功后页面
}
?>
<?
if($login==2){
	   $id=$_POST['id'];
	   $pw=$_POST['pw'];
	   $name=$_POST['name'];
	   $sex=$_POST['sex'];
	   $cha=$_POST['cha'];
	   $str=$_POST['str'];
	   $zhi=$_POST['zhi'];
	   $con=$_POST['con'];
	   $spe=$_POST['spe'];
	   $pur=$_POST['pur'];
	   $icon=$_POST['icon'];
	   
     if(!$id){
          echo "<p align=center><img src=$pic_url/w.gif></img><br>";
          echo "<font size=4>请按正确顺序注册帐号</font>\n";
          echo "<a href=\"javascript:history.back(1)\"><img valign=bottom border=0 src=\"$pic_url/back.gif\">后退</a>\n";
          exit();
     }
     echo "<p>开始初始化数据........\n";
     //数据初始化
     
     $hp=$con*10;//生命
     $hpnow=$hp;
     $en=0;//内力
     $ennow=$en;
     $po=$zhi*10;//精力
     $ponow=$po;
     $lev=0;//等级
     $yun=5+rand(1,20);//运气
     $col=10+rand(1,15);//外貌
     $pos=1;//立场
     $time=time();
     $mon=0;
     $org="无组织";
     $nick="平民";
          
     $person_info="欢迎进入".$main_title."，我们将在这里为你提供最好的游戏环境。\n";
     
     echo "<p>数据初始化完成，开始处理数据......\n";
     include "inc/db.inc.php";
     
     mysql_query("INSERT INTO renwu_member (id, pw, name, exp, hp, hpnow, en, ennow, po, ponow, sex, cha, pos, str, zhi, con, spe, pur, col, yun, icon, org, time, mon, nick) VALUES
      ('$id', '$pw', '$id', '$exp', '$hp', '$hpnow', '$en', '$ennow','$po', '$ponow', '$sex', '$cha', '$pos', '$str', '$zhi', '$con', '$spe', '$pur', '$col', '$yun', '$icon', '$org', '$time', '$mon', '$nick')") or die("数据库出现问题！\n");
     mysql_query("INSERT INTO misc(id,person_info,logintime) VALUES('$id','$person_info','$time')") or die("数据库出现问题！\n");
     echo "<p>数据全部完成!请等待登陆.........\n<p>";
     echo "<meta http-equiv=\"refresh\" content=\"0; url=index.htm\">";
     
     include "help/copyright.inc.php";
     mysql_close();
     exit();
}
?>
<form action="login_member.php?login=1" method=post>
<center>
<table border="0" cellpadding="1" cellspacing="1" style="border-collapse: collapse" width="760">
  <tr>
    <td width="100%" bgcolor="#0099CC">
    <p align="center"><img src=<? echo $pic_url; ?>/t1.gif border=0></img><font face="楷体_GB2312" size="5" color="#FFFF00"><? echo $main_title; ?></font><img src=<? echo $pic_url; ?>/t1.gif border=0></img></td>
  </tr>
</table>
<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" width="100%" height="106">
  
  <tr>
    <td width="20%" height="106" rowspan="8" align=right valign=top>     
    </td>
    <td width="13%" height="15" bgcolor="#fffff7">
    <p align="center">游戏用户名</td>
    <td width="48%" height="15" colspan="3">
    <input type="text" name="T1" size="13"> <font size="2" color="#660088">
    （这里为侠域游戏用户名，长度最长为5个汉字）</font></td>
    <td width="19%" height="106" rowspan="8">　</td>
  </tr>
  <tr>
    <td width="12%" height="10" bgcolor="#fffff7">
    <p align="center">游戏密码</td>
    <td width="49%" height="10" colspan="3">
    <input type="password" name="T2" size="20"> <font size="2" color="#660088">
    （这里为你注册的游戏密码）</font></td>
  </tr> 
  <!--<tr>
    <td width="12%" height="10" bgcolor="#fffff7">
    <p align="center">人物名称</td>
    <td width="49%" height="10" colspan="3">
    <input type="text" name="T3" size="13"> <font size="2" color="#660088">（此人物名称将是你游戏中人物的名字，可使用5个汉字）</font></td>
  </tr>-->
  <tr>
    <td width="12%" height="14" bgcolor="#fffff7">
    <p align="center">人物性别</td>
    <td width="24%" height="14">
    侠客<input type="radio" value="侠客" checked name="R1">&nbsp;&nbsp;&nbsp;
    侠女<input type="radio" name="R1" value="侠女">
    </td>
  </tr>
  <tr>
    <td width="12%" height="10" bgcolor="#fffff7">
    <p align="center">人物性格</td>
    <td width="49%" height="10" colspan="3">
    勇猛<input type="radio" value="勇猛" checked name="R2">（对你力量的发展很有帮助）<br>
    和平<input type="radio" value="和平" name="R2">（对你智慧的发展很有帮助）<br>
    胆小<input type="radio" value="胆小" name="R2">（对你速度的发展很有帮助）<br>
    冷酷<input type="radio" value="冷酷" name="R2">（对你意志的发展很有帮助）<br>
    激情<input type="radio" value="激情" name="R2">（对你体质的发展很有帮助）<br>
    </tr>
  </tr>
  <tr>
    <td width="61%" height="13" colspan="4" bgcolor="#FFFFCC">
    <p align="center"><font color=#33CC33>基本属性设定（所有属性总和必须为：80）</font></td>
  </tr>
  <tr>
    <td width="61%" height="17" colspan="4">
   力量<select size="1" name="D3">
    <option value="11">11</option>
    <option value="12">12</option>
    <option value="13">13</option>
    <option value="14">14</option>
    <option value="15">15</option>
    <option value="16" selected>16</option>
    <option value="17">17</option>
    <option value="18">18</option>
    <option value="19">19</option>
    <option value="20">20</option>
    <option value="21">21</option>
    <option value="22">22</option>
    <option value="23">23</option>
    <option value="24">24</option>
    <option value="25">25</option>
    </select>（决定了你攻击力强度）<br>
    智慧<select size="1" name="D4">
    <option value="11">11</option>
    <option value="12">12</option>
    <option value="13">13</option>
    <option value="14">14</option>
    <option value="15">15</option>
    <option value="16" selected>16</option>
    <option value="17">17</option>
    <option value="18">18</option>
    <option value="19">19</option>
    <option value="20">20</option>
    <option value="21">21</option>
    <option value="22">22</option>
    <option value="23">23</option>
    <option value="24">24</option>
    <option value="25">25</option>
    </select>(决定了你的学习进度）<br>
    体质<select size="1" name="D5">   
    <option value="11">11</option>
    <option value="12">12</option>
    <option value="13">13</option>
    <option value="14">14</option>
    <option value="15">15</option>
    <option value="16" selected>16</option>
    <option value="17">17</option>
    <option value="18">18</option>
    <option value="19">19</option>
    <option value="20">20</option>
    <option value="21">21</option>
    <option value="22">22</option>
    <option value="23">23</option>
    <option value="24">24</option>
    <option value="25">25</option>
    </select>（决定了你的生命状态）<br>
    敏捷<select size="1" name="D6">
    <option value="11">11</option>
    <option value="12">12</option>
    <option value="13">13</option>
    <option value="14">14</option>
    <option value="15">15</option>
    <option value="16" selected>16</option>
    <option value="17">17</option>
    <option value="18">18</option>
    <option value="19">19</option>
    <option value="20">20</option>
    <option value="21">21</option>
    <option value="22">22</option>
    <option value="23">23</option>
    <option value="24">24</option>
    <option value="25">25</option>
    </select>（决定了你的速度）<br>
    意志<select size="1" name="D7">
    <option value="11">11</option>
    <option value="12">12</option>
    <option value="13">13</option>
    <option value="14">14</option>
    <option value="15">15</option>
    <option value="16" selected>16</option>
    <option value="17">17</option>
    <option value="18">18</option>
    <option value="19">19</option>
    <option value="20">20</option>
    <option value="21">21</option>
    <option value="22">22</option>
    <option value="23">23</option>
    <option value="24">24</option>
    <option value="25">25</option>
    </select>（决定了你的精神状况）
    </td>
  </tr>
  <tr>
    <td width="61%" height="15" colspan="4">
    </td>
  </tr>
  <tr>
    <td width="61%" height="15" colspan="4">
    <p align="center">人物造型设定:
    <select name=icon>
	<?
	     for($i=1;$i<$max_pic;$i++){
	          echo "<option value=\"$i\">ICON No.$i\n";
	     }
	?>
    </select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=icon.php target=_blank>查看现有人物造型</a></td>
  </tr>
  <tr>
    <td width="100%" height="12" colspan="4" align=center>
    <input type="submit" value="注册" name="B1" style="font-family: 宋体; border-style: ridge; border-width: 0; background-color: #CCFF99; color:#666633"></td>
  </tr>
</table>
</form>
<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" width="100%">
  <tr>
    <td width="100%"><? include "help/copyright.inc.php"; ?>　</td>
  </tr>
</table>

</body>

</html>