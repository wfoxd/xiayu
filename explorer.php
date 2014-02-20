<?
session_save_path("xytmp");
session_start();
$user_id=$_SESSION["user_id"];
include "./inc/attest.inc.php";

/*
================================
=探险 (Ver 0.2.1)
=公元2001年12月1日
================================
*/
include "./inc/config.inc.php";
include "./inc/style.inc.php";
include "./include/area_now_ct.inc.php";
$way = array("explorer.php","xy_city.php","ereng/lu_1.php","bhc/lu_1.php","org_zt/dgjp_1.php");
area_now($way,$user_id);
include "./include/location.inc.php";
up_location("大路口","explorer.php","$user_id");

echo ("
<p align=center><img src=".$pic3_url."/xiake/xiake16.jpg border=0></img><br>
</p>
");
?>
<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="100%">
  <tr>
    <td width="100%" colspan="6">
    这里是通往各地的一个大路口，你可以看到这里来来往往的人十分多，周围也十分热闹。
    <?
    $npc_org = "大路口";
    include "./include/list_npc.inc.php";   
    ?>
    </td>
  </tr>
  <tr>
    <td width="100%" colspan="6">　</td>
  </tr>
  <tr>
    <td width="25%">这里可以通往==><br><a href=./ereng/lu_1.php><font color=#977E6A>※西南驿道※</font><a/>  </td>
    <td width="25%"><br><a href=./bhc/lu_1.php><font color=#977E6A>※南驿道※</font><a/>　</td>
    <td width="25%">　</td>
    <td width="25%"><br><a href=./org_zt/dgjp_1.php><font color=#977E6A>※独孤剑派※</font><a/>　</td>
  </tr>
  <tr>
    <td width="100%" colspan="6" align=center><a href=xy_city.php>【进入侠域城】<a/></td>
  </tr>
</table>
