<?
session_save_path("xytmp");
session_start();
$user_id=$_SESSION["user_id"];
$work=$_GET['work'];
include "./inc/attest.inc.php";

include "./inc/config.inc.php";
include "./inc/style.inc.php";
/*
==================
=工作
=公元2001年12月19日
==================
*/

if($work == "fandian") include "./include/work/fandian.inc.php";
if($work == "chaoxie") include "./include/work/chaoxie.inc.php";
if($work == "caishi") include "./include/work/caishi.inc.php";
if($work == "maihua") include "./include/work/maihua.inc.php";
if($work == "xiyi") include "./include/work/xiyi.inc.php";
if($work == "datie") include "./include/work/datie.inc.php";
if($work == "peilian") include "./include/work/peilian.inc.php";

include "./include/area_now_ct.inc.php";
$way = array("work.php","xy_city.php");
area_now($way,$user_id);
include "./include/location.inc.php";
up_location("劳力市场","work.php","$user_id");
?>
<?	
	echo "<br>==============劳力市场==============<br>";
	echo ("这是城里专门给待业人士提供工作的【劳力市场】，在这里你可以找到不少
	好的工作，如果运气好，还有可能得到其它人的帮助呢！
	");
	
	$npc_org = "劳力市场";
    	include "./include/list_npc.inc.php";    	
?>

<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="100%">
  <tr>
    <td width="41%"><a href=work.php?work=fandian>杂役工</a></td>
    <td width="59%"><hr>这是一家有名的饭店，最近由于客人特别多，掌柜的准备请一些小二。虽然工资不高，但对于才踏入江湖的人来说，这里还可以挣点路费。（酬劳：40/次）　</td>
  </tr>
  <tr>
    <td width="41%"><a href=work.php?work=chaoxie>抄写员</a></td>
    <td width="59%"><hr>本城的最大一家书店需要一些抄写员，这可不是一件简单的工作，它不仅要求你能写还要求你不是很笨。（酬劳：100/次）</td>
  </tr>
  <tr>
    <td width="41%"><a href=work.php?work=caishi>采石工</a></td>
    <td width="59%"><hr>城外一家采石厂正在招收一批劳工，只要是身强体壮的年轻人都可以去。（酬劳：110/次）</td>
  </tr>
   <tr>
    <td width="41%"><a href=work.php?work=maihua>卖花姑娘</a></td>
    <td width="59%"><hr>城里的花店正需要一些年轻漂亮的女孩去做卖花姑娘，如果你觉得自己长的还算不错，就去试试吧！（酬劳：130/次）</td>
  </tr>
  <tr>
    <td width="41%"><a href=work.php?work=xiyi>洗衣店</a></td>
    <td width="59%"><hr>城里的洗衣店需要一些有能力的女子洗那些有钱人的衣服，但要求要有一定经验的才行哦！（酬劳：160/次）</td>
  </tr>
  <tr>
    <td width="41%"><a href=work.php?work=datie>打铁</a></td>
    <td width="59%"><hr>这是一项十分艰苦的适合男子做的工作，如有你觉得自己可以吃苦，那么可以来试试。（酬劳：180/次）</td>
  </tr>  
  <tr>
    <td width="41%"><a href=work.php?work=peilian>陪练</a></td>
    <td width="59%"><hr>近日有不少城里的富人家为了学点功夫，需要找一些会功夫的人当陪练，如果你不觉得挨打有失身份就去做吧。（酬劳：200/次）</td>
  </tr>
</table>
<?	
     include "./include/back_xy.inc.php";
?>