<?php
include "../class/func.php";
$d = last30daysy();
get_seller_laz('VN1XRBRL');
$a = $mysql->where('seller_id', 'VN1XRBRL')->get('account');
	$res = get_product_laz($a[0]['access_token'],$d[29].'T00:00:00+0800',time.'T00:00:00+0800');
	$file = 'log_get.txt';
				// Open the file to get existing content
	$current = file_get_contents($file);
				// Append a new person to the file
	$current .= "\n".hatime."|".$res['total']."|".count($res['sql_success'])."|".count($res['sql_update'])."|".count($res['sql_fail'])."|".$d[$i]."|".time;

	echo "\n".hatime."|".$res['total']."|".count($res['sql_success'])."|".count($res['sql_update'])."|".count($res['sql_fail'])."|".$d[$i]."|".time;
				// Write the contents back to the file
	file_put_contents($file, $current);
