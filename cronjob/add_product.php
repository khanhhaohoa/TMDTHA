<?php
include "../class/func.php";
$data = $mysql->where('alive', 0)->get('account');
for($i=0;$i<count($data);$i++){
	get_seller_laz($data[$i]['seller_id']);
	public_product_laz($data[$i]['seller_id']);
}