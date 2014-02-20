<?
session_save_path("../xytmp");
session_start();
$user_id=$_SESSION["user_id"];
include "../inc/attest_lu.inc.php";

include "../inc/config.inc.php";
include "/home/chunplay/public_html/warrior/inc/style.inc.php";
include "../include/area_now.inc.php";
$way = array("ereng/erenc.php","ereng/lu_6.php","ereng/erenc_kd.php","ereng/erenc_wuqi_trade.php",
"ereng/erenc_wupin_trade.php","ereng/erenc_xiao_x.php?here=1","ereng/erenc_xiao_x.php?here=2","ereng/erenc_xiao_x.php?here=3",
"ereng/erenc_xiaowu.php","ereng/ereng_lu1.php");
area_now($way,$user_id);
include "/home/chunplay/public_html/warrior/include/location_lu.inc.php";
up_location("恶人村","ereng/erenc.php","$user_id");
?>
<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="100%">
  <tr>
    <td width="100%" colspan="3">
    <img src=<? echo $jzpic_url; ?>/xesg.jpg border=0 align=left></img>
    <h2 align="center"><font color="#993300">恶 人 村</font></h2>
    【恶人村】是那些江湖中恶人聚集而形成的一个村庄，这里住的全部都是十恶不赦的人。一般的侠义人士
    是不屑来这样的地方的。
    </td>
  </tr>
  <tr>
    <td width="27%">　</td>
    <td width="42%" align=center>
    <a href=lu_6.php target=main>
<pre>
==========
=  东北  =
=  驿道  =
==========
</pre>
    </a>
    </td>
    <td width="31%">　</td>
  </tr>
  <tr>
    <td width="27%" align=center><a href=erenc_kd.php target=main>【凶煞饭庄】</a></td>
    <td width="42%" align=center>中</td>
    <td width="31%" align=center><a href=erenc_xiao_x.php?here=1 target=main>【小路】</a></td>
  </tr>
  <tr>
    <td width="27%" align=center><a href=erenc_xiao_x.php?here=2 target=main>【小路】</a></td>
    <td width="42%" align=center>央</td>
    <td width="31%" align=center><a href=erenc_wuqi_trade.php target=main>【老五武器店】</a></td>
  </tr>
  <tr>
    <td width="27%" align=center><a href=erenc_xiaowu.php target=main>【恶人村小屋】</a></td>
    <td width="42%" align=center>街</td>
    <td width="31%" align=center><a href=erenc_wupin_trade.php target=main>【无亲装备店】</a></td>
  </tr>
  <tr>
    <td width="27%" align=center><a href=erenc_xiao_x.php?here=3 target=main>【小路】</a></td>
    <td width="42%" align=center>道</td>
    <td width="31%" align=center></td>
  </tr>  
  <tr>
    <td width="27%" align=center></td>
    <td width="42%" align=center><a href=ereng_lu1.php target=main>
<pre>
==========
=  邪恶  =
=  山谷  =
==========
</pre>
    </a></td>
    <td width="31%" align=center></td>
  </tr>
</table>
