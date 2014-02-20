<?
/*
====================
=公告系统
=
====================

*/
	include "./inc/db.inc.php";
	$talk = 100;                                # 注释3 
	
	if($notice_channel == "log"){
		if($notice_to == "login")	$write_file="$log_url/login.txt";
		if($notice_to == "wupin")	$write_file="$log_url/wupin.txt";
		if($notice_to == "money")	$write_file="$log_url/money.txt";
		if($notice_to == "ereng_b")	$write_file="$log_url/ereng_b.txt";
		$r = 300;
		$time = getdate(time());
		$nowtime = $time["mon"]."月".$time["mday"]."日".$time["hours"]."时".$time["minutes"]."分";
	}else{
		$write_file="./chat/1.txt";
		$r = 25;
	}	

	$max_file_size = $r + 100;
	$file_size= filesize($write_file);           
	if ($file_size > $max_file_size) { 

	$lines = file($write_file); 
	$tmp= count($lines); 

	$u = $tmp - $r; 
	for($i = $tmp; $i >= $u ;$i--)
          { 
           $msg_old =  $lines[$i] . $msg_old; 
          } 
	$deleted = unlink($write_file);       # 注释6

	$fp = fopen($write_file,  "a+");      # 注释7 
	$fw = fwrite($fp, $msg_old); 
	fclose($fp); 
	} 

	$fp = fopen($write_file,  "a+"); 
	$channelcolor="#0066CC";
	$time = time();
	
	if($notice_channel == "组织"){
	if($notice_to == "战略动议"){
			$content = $my_org."发动了对".$em_name."的战略动议！";
			mysql_query("INSERT INTO chat VALUES('$time','','〖系统〗','$content','all')");
		}
	if($notice_to == "放弃战略"){
			$content = $my_org."放弃了它们的战略动议！";
			mysql_query("INSERT INTO chat VALUES('$time','','〖系统〗','$content','all')");
		}
	if($notice_to == "新组织"){
			$content = "江湖又成立了一个新组织：".$org_name."！";
			mysql_query("INSERT INTO chat VALUES('$time','','〖系统〗','$content','all')");
		}
	if($notice_to == "消灭"){
			$content = $my_orgname."消灭了".$B1."所有人物，".$B1."成为了江湖历史！";
			mysql_query("INSERT INTO chat VALUES('$time','','〖系统〗','$content','all')");
		}
	}
	
	if($notice_channel == "结婚"){
	if($notice_to == "成婚"){
			$content = $marry_me_info."与".$user_id."正式成为夫妻！恭喜！！恭喜！！！";
			mysql_query("INSERT INTO chat VALUES('$time','','〖系统〗','$content','all')");
		}
	if($notice_to == "反对求婚"){
			$content = $user_id."拒绝了".$marry_me_info."的求婚！悲惨啊！！";
			mysql_query("INSERT INTO chat VALUES('$time','','〖系统〗','$content','all')");
		}
	if($notice_to == "求婚"){
			$content = $user_id."向".$duixiang_id."求婚了！<b>求婚宣言：</b>".$qiuhun_xy;
			mysql_query("INSERT INTO chat VALUES('$time','','〖系统〗','$content','all')");
		}
	if($notice_to == "离婚"){
			$content = $user_id."与".$marry_me_info."离婚了，简直是人间悲剧啊！！！";
			mysql_query("INSERT INTO chat VALUES('$time','','〖系统〗','$content','all')");
		}
	}
	if($notice_channel == "物品"){
	if($notice_to == "钻石戒指"){
			$content = $user_id."送给了".$e_name."一枚结婚钻戒！以表达".$user_id."的真切爱意！";
			mysql_query("INSERT INTO chat VALUES('$time','','〖系统〗','$content','all')");
		}
	}
	if($notice_channel == "log"){
	if($notice_to == "login")	$fw = fwrite($fp,  "\n〖登陆记录〗".$user_id."（".$user_name."）登陆侠域于".$nowtime."。");
	if($notice_to == "wupin")	$fw = fwrite($fp,  "\n〖物品交易〗".$user_id."（".$user_name."）给".$wupin_person."(".$e_name.")".$wupin_name."于".$nowtime."。");
	if($notice_to == "money")	$fw = fwrite($fp,  "\n〖物品交易〗".$user_id."（".$user_name."）给".$mon_person."(".$e_name.")".$mon_num."钱于".$nowtime."。");
	if($notice_to == "ereng_b")	$fw = fwrite($fp,  "\n〖江湖传闻〗".$user_id."（".$user_name."）得到恶人谷宝藏于".$nowtime."。");
	}
	if($notice_channel == "quit"){
	if($notice_to == "quit"){
			$content = "某某某 :[".$user_name."]退出侠域";
			mysql_query("INSERT INTO chat VALUES('$time','','〖系统〗','$content','all')");
		}
	}
	if($notice_channel == "宝藏"){
	if($notice_to == "ereng_b"){
			$content = "[".$user_name."]历经艰辛，终于在恶人山洞里找到了传说中的宝藏。";
			mysql_query("INSERT INTO chat VALUES('$time','','〖系统〗','$content','all')");
		}
	if($notice_to == "di_lu"){
			$content = "[".$user_name."]战胜了武士马飞，得到了绝世宝剑之一的【的鹿】宝剑。";
			mysql_query("INSERT INTO chat VALUES('$time','','〖系统〗','$content','all')");
		}
	if($notice_to == "qi_sd"){
			$content = "[".$user_name."]战胜了浪人，得到了绝世魔剑之一的【七杀刀】。";
			mysql_query("INSERT INTO chat VALUES('$time','','〖系统〗','$content','all')");
		}
	if($notice_to == "qis_tl"){
			$content = "[".$user_name."]战胜了罗笑环，得到了绝世魔鞭之一的【七煞天罗】。";
			mysql_query("INSERT INTO chat VALUES('$time','','〖系统〗','$content','all')");
		}
	}
	if($notice_channel == "特殊物品"){	
	if($notice_to == "di_lu"){
			$content = "[".$user_name."]战胜了[".$e_name_info."]，得到了绝世宝剑之一的【的鹿】宝剑。";
			mysql_query("INSERT INTO chat VALUES('$time','','〖系统〗','$content','all')");
		}
	if($notice_to == "qi_sd"){
			$content = "[".$user_name."]战胜了[".$e_name_info."]，得到了绝世魔刀之一的【七杀刀】。";
			mysql_query("INSERT INTO chat VALUES('$time','','〖系统〗','$content','all')");
		}
	if($notice_to == "qis_tl"){
			$content = "[".$user_name."]战胜了[".$e_name_info."]，得到了绝世魔鞭之一的【七煞天罗】。";
			mysql_query("INSERT INTO chat VALUES('$time','','〖系统〗','$content','all')");
		}
	}
	fclose($fp); 
?>