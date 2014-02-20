<?
session_save_path("../xytmp");
session_start();
$user_id=$_SESSION["user_id"];
include "../inc/attest_lu.inc.php";

include "../inc/config.inc.php";
include "../inc/style.inc.php";
include "../include/area_now.inc.php";
$way = array("bhc/bhc.php","bhc/beimen.php","bhc/bhc_kd.php","bhc/bhc_wuqi_trade.php",
"bhc/bhc_wupin_trade.php","bhc/bhc_dc.php","bhc/wj_home.php","dl/jj_lu50.php","bhc/lu_8.php","shenshou.php"
,"bhc/bhc_yh.php"
);
area_now($way,$user_id);
include "../include/location_lu.inc.php";
up_location("百花城","bhc/bhc.php","$user_id");
?>
<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="100%">
  <tr>
    <td width="100%" colspan="3">
    <img src=<? echo $jzpic_url; ?>/bhsg.jpg border=0 align=left></img>
    <h2 align="center"><font color="#993300">百 花 城</font></h2>
    【百花城】聚集了很多商人，还有许多江湖人士。城里有不少店铺与客栈，还有赌场，可谓五花八门，多姿多彩。
    </td>
  </tr>
  <tr>
    <td width="27%">　</td>
    <td width="42%" align=center>
    <a href=beimen.php target=main>
<pre>
==========
=  北门  =
==========
</pre>
    </a>
    </td>
    <td width="31%">　</td>
  </tr>
  <tr>
    <td width="27%" align=center><a href=bhc_kd.php target=main>【侠客客栈】</a></td>
    <td width="42%" align=center>中央</td>
    <td width="31%" align=center><a href=bhc_wuqi_trade.php target=main>【百花武器店】</a></td>
  </tr>
  <tr>
    <td width="27%" align=center><a href=bhc_wupin_trade.php target=main>【百花装备店】</a></td>
    <td width="42%" align=center></td>
    <td width="31%" align=center><a href=bhc_dc.php target=main>【赌场】</a></td>
  </tr>
  <tr>
    <td width="27%" align=center><a href=../shenshou.php target=main>【圣手回春】</a></td>
    <td width="42%" align=center></td>
    <td width="31%" align=center><a href=bhc_yh.php target=main>【廖记银行】</a></td>
  </tr>
  <tr>
    <td width="27%" align=center><a href=wj_home.php target=main>
<pre>
========
=玩家村=
========
</pre></a></td>
    <td width="42%" align=center></td>
    <td width="31%" align=center><a href= target=main>【空房】</a></td>
  </tr>  
  <tr>
    <td width="27%" align=center><a href= target=main>【空房】</a></td>
    <td width="42%" align=center>道街</td>
    <td width="31%" align=center><a href= target=main>【空房】</a></td>
  </tr>  
  <tr>
    <td width="27%" align=center></td>
    <td width="42%" align=center><a href=lu_8.php target=main>
<pre>
==========
=  南门  =
==========
</pre></a>
   </td>
    <td width="31%" align=center></td>
  </tr>
</table>
