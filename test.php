<?php
include 'class/func.php';
 set_invoid_number_laz('50000800924rb8r8HCq2pQZB7gvDlwEuOjcd1bc13a40ey9P0tFJDShzSuRo63', '206551129930174', 'HAV-15245');
//var_dump(get_seller_laz('VN1XRBRL'));
//var_dump(check_token_laz('VN1XRTAP'));
//var_dump(get_product_test('50000100818c6pes6knp2rTgA0ftco1c0f9e56SeVvdfFdU4MuTdmeKKidqYzi'));
/**
$sku = array();
$c = $mysql->get('account');
for($j=0;$j<count($c);$j++){
	$token = $c[$j]['access_token'];
	//$a = get_orderid_laz($token, 'pending');
	$a = get_order_laz($token, $status, $c[$j]['seller_id']);
		for($i=0;$i<count($a);$i++){
			//$b = get_item($token, $a[$i]);
			$b = get_item($token, $a[$i], $c[$j]['seller_id']);
			//get_invoid_laz($token, $a[$i]);
				foreach ($b['quantity'] as $key => $value){
					$sku[$key] = $sku[$key] + (int) $value;

					echo 'SHOP: '.$c[$j]['seller_id'].'| Mã đơn hàng: '.$a[$i].'| Mã sản phẩm: '.$key.' | Số Lượng: '.$value.'| ';
					echo '<img height="50px" width="50px" src="'.$b['img'][$key].'" /><br /><hr />';
				}
		}
}

echo '<hr />';
echo '<h2>Thống Kê:</h2>';
foreach ($sku as $key => $value){
					//echo 'Mã hàng: '.$key.' - Số lượng cần lấy: '.$value.' - Tồn kho hiện tại: <i>Hết hàng </i>| <img height="50px" width="50px" src="'.$b['img'][$key].'" /><br />';
				}

//var_dump($a);

