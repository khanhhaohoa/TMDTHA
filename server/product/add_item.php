<?php
include '../../class/func.php';
$res = array();
if($_REQUEST['action'] == 'add'){
	try {
		$mysql->insert('product_main', array(
			'sku' => $_REQUEST['sku'],
			'name' => $_REQUEST['name'],
			'price' => $_REQUEST['price'],
			'inventory' => $_REQUEST['inventory'] 
		));
		$res['status'] = 1;
		$res['mess'] = 'Tạo sản phẩm thành công';
	} catch (Exception $e) {
		$res['status'] = 2;
		$res['mess'] = 'Tạo sản phẩm lỗi SQL';
	}
}

if($_REQUEST['action'] == 'del'){
	
}
	
$res = json_encode($res);
print_r($res);