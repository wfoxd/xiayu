<?
session_save_path("xytmp");
session_start();
include "./inc/attest.inc.php";

include "./inc/config.inc.php";
include "./inc/style.inc.php";

include "./include/area_now_ct.inc.php";
$user_id=$_SESSION["user_id"];
$way = array("batten.php","trade.php","xiao_x.php?here=1","xiao_x.php?here=2","xiao_x.php?here=3",
"xiao_x.php?here=4","xiao_x.php?here=5","board.php","explorer.php","kedian.php",
"listziliao.php","marry.php","list.php","organization.php","work.php","wugong_learn.php",
"wupin_trade.php","wuqi_trade.php","xy_city.php","xi_song.php","dong_song.php");

area_now($way,$user_id);
include "./include/location.inc.php";
up_location("侠域城","xy_city.php","$user_id");
?>
<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="100%">
  <tr>
    <td width="100%" colspan="3">
    <img src=<? echo $jzpic_url; ?>/xy_city_1.jpg border=0 align=left></img>
    <h2 align="center"><font color="#993300">侠 域 城</font></h2>
    欢迎各位江湖人士光临我们【侠域城】，本城专门为各类江湖人士提供了各种服务场所，你在这里可以
    得到你想要的一切。
    </td>
  </tr>
  <tr>
    <td width="27%" align=center><a href=xi_song.php target=main>【西巷】</a>　</td>
    <td width="42%" align=center><a href=wugong_learn.php target=main>【武林学院】</a></td>
    <td width="31%" align=center><a href=dong_song.php target=main>【东巷】</a>　</td>
  </tr>
  <tr>
    <td width="27%" align=center><a href=wupin_trade.php target=main>【天涯装备店】</a>　</td>
    <td width="42%" align=center>中</td>
    <td width="31%" align=center><a href=xiao_x.php?here=1 target=main>【小巷】</a></td>
  </tr>
  <tr>
    <td width="27%" align=center><a href=xiao_x.php?here=2 target=main>【小巷】</a></td>
    <td width="42%" align=center>　</td>
    <td width="31%" align=center><a href=work.php target=main>【劳力市场】</a>　</td>
  </tr>
  <tr>
    <td width="27%" align=center><a href=organization.php target=main>【帮会组织】</a></td>
    <td width="42%" align=center></a>央</td>
    <td width="31%" align=center><a href=kedian.php target=main>【红心饭庄】</a></td>
  </tr>
  <tr>
    <td width="27%" align=center><a href=xiao_x.php?here=3 target=main>【小巷】</a></td>
    <td width="42%" align=center></td>
    <td width="31%" align=center><a href=wuqi_trade.php target=main>【随风武器店】</a></td>
  </tr>
  <tr>
    <td width="27%" align=center><a href=board.php target=main>【留言板】</a></td>
    <td width="42%" align=center>大</td>
    <td width="31%" align=center><a href=trade.php target=main>【驿站】</a></td>
  </tr>
  <tr>
    <td width="27%" align=center><a href=xiao_x.php?here=4 target=main>【小巷】</a></td>
    <td width="42%" align=center></td>
    <td width="31%" align=center><a href=marry.php target=main>【红娘庄】</a></td>
  </tr>
  <tr>
    <td width="27%" align=center><a href=listziliao.php target=main>【档案馆】</a></td>
    <td width="42%" align=center>街</td>
    <td width="31%" align=center><a href=list.php target=main>【江湖排行榜】</a></td>
  </tr>
  <tr>
    <td width="27%" align=center><a href=batten.php target=main>【组织讯息榜】</a></td>
    <td width="42%" align=center></td>
    <td width="31%" align=center><a href=xiao_x.php?here=5 target=main>【小巷】</a></td>
  </tr>
  <tr>
    <td width="27%" align=center></td>
    <td width="42%" align=center><a href=explorer.php target=main>
<pre>
==========
=  出城  =
=  探险  =
==========
</pre>
    </a></td>
    <td width="31%" align=center></td>
  </tr>
</table>

