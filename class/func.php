<?php
//error_reporting(0);
set_time_limit(0);
include "LazopSdk.php";
include "msql.php";
include "config.php";
require_once 'PHPExcel.php';
require_once 'PHPExcel/IOFactory.php';
$mysql = new MySQL('localhost', 'system', 'system', 'system');

function last30daysy($e){
$data = array();
$m= date("m");
$de= date("d");
$y= date("Y");
	for($i=0; $i<=30; $i++){
		$data[] = date('Y-m-d',mktime(0,0,0,$m,($de-$i),$y));
	}
	return $data;
}

function public_product_laz($seller_id){
	global $mysql;
	$a = array();
	$post = $mysql->not_like($seller_id);
	for($i=0;$i<count($post);$i++){

		$xml = '';
		$xml .= '<?xml version="1.0" encoding="UTF-8" ?> 
					<Request>
					     <Product>';
		$xml .= '<PrimaryCategory>'.$post[$i]['primarycategory'].'</PrimaryCategory>';
		$xml .= '<SPUId>'.$post[$i]['spuid'].'</SPUId>';
		$xml .= '<AssociatedSku>'.$post[$i]['associatedsku'].'</AssociatedSku>';
		$xml .= '<Attributes>';
		$xml .= '<name>'.$post[$i]['name'].'</name>';
		$xml .= '<short_description><![CDATA['.$post[$i]['short_description'].']]></short_description>';
		$xml .= '<description><![CDATA['.$post[$i]['description_laz'].']]></description>';
		$xml .= '<brand>'.$post[$i]['brand'].'</brand>';
		$xml .= '<model>'.$post[$i]['model'].'</model>';
		$xml .= '<warranty_type>'.$post[$i]['warranty_type'].'</warranty_type>';
		$xml .= '<warranty>'.$post[$i]['warranty'].'</warranty>';
		$xml .= '<kid_years>'.$post[$i]['kid_years'].'</kid_years>';
		$xml .= '</Attributes>';
		$xml .= '<Skus>';
		$sku = json_decode($post[$i]['sellersku'], TRUE);
		for($j=0;$j<count($sku);$j++){
		$xml .= '<Sku>';
			foreach ($sku[$j] as $key => $value) {
				$xml .= '<'.$key.'>'.$value.'</'.$key.'>';
			}
	    $xml .= '                        
	            <package_length>'.$post[$i]['package_length'].'</package_length>                 
	            <package_height>'.$post[$i]['package_height'].'</package_height>                
	            <package_weight>'.$post[$i]['package_weight'].'</package_weight>                 
	            <package_width>'.$post[$i]['package_width'].'</package_width>                 
	            <package_content>No</package_content>                
	            <Images>';
		$img = explode(',', $sku[$j]['image']);
		    for($k=0;$k<count($img);$k++){
		    	if($img[$k] != null){
		    	$xml .= '<Image>'.$img[$k].'</Image>';
		    	}
		    }

	    $xml .= '</Images></Sku>';
	    } 
		$xml .= '</Skus>';
		$xml .= '</Product>';
		$xml .= '</Request>';
		if($post[$i]['primarycategory'] != null){
		$data = $mysql->where('seller_id', $seller_id)->get('account');
			$accessToken = $data[0]['access_token'];
			$c = new LazopClient('https://api.lazada.vn/rest',appkey,appsecret);
			$request = new LazopRequest('/product/create');
			$request->addApiParam('payload',$xml);
			$res_a = $c->execute($request, $accessToken);
			$res = json_decode($res_a, TRUE);
			if($res['code'] == 0){
				$mysql->where('item_id', $post[$i]['item_id'])->update('product', array(
				'seller_id' => $post[$i]['seller_id'].','.$seller_id
				));
				$a['success'][] = true;
				$file = 'log.txt';
				// Open the file to get existing content
				$current = file_get_contents($file);
				// Append a new person to the file
				$current .= "\n".hatime."|".$post[$i]['item_id']."|".$seller_id."|DONE";
				// Write the contents back to the file
				file_put_contents($file, $current);
			}else{
				if($res['detail'][0]['field'] == 'SellerSku'){
				$mysql->where('item_id', $post[$i]['item_id'])->update('product', array(
				'seller_id' => $post[$i]['seller_id'].','.$seller_id
				));

				}else{
					$mysql->where('item_id', $post[$i]['item_id'])->update('product', array('status' => 2));
				$file = 'log.txt';
				// Open the file to get existing content
				$current = file_get_contents($file);
				// Append a new person to the file
				$current .= "\n".hatime."|".$post[$i]['item_id']."|".$seller_id."|".$res_a;
				// Write the contents back to the file
				file_put_contents($file, $current);
				$a['fail'][] = true;
			}
			}
		}
			
	}
	return $a;
}

function update_product_laz($seller_id){
	global $mysql;
	$a = array();
	$post = $mysql->update_not_like($seller_id);
	for($i=0;$i<count($post);$i++){
		$xml = '';
		$xml .= '<?xml version="1.0" encoding="UTF-8" ?> 
					<Request>
					     <Product>';
		$xml .= '<Attributes>';
		$xml .= '<name>'.$post[$i]['name'].'</name>';
		$xml .= '<short_description><![CDATA['.$post[$i]['short_description'].']]></short_description>';
		$xml .= '<description><![CDATA['.$post[$i]['description_laz'].']]></description>';
		$xml .= '<brand>'.$post[$i]['brand'].'</brand>';
		$xml .= '<model>'.$post[$i]['model'].'</model>';
		$xml .= '<warranty_type>'.$post[$i]['warranty_type'].'</warranty_type>';
		$xml .= '<warranty>'.$post[$i]['warranty'].'</warranty>';
		$xml .= '<kid_years>'.$post[$i]['kid_years'].'</kid_years>';
		$xml .= '</Attributes>';
		$xml .= '<Skus>';
		$sku = json_decode($post[$i]['sellersku'], TRUE);
		for($j=0;$j<count($sku);$j++){
		$xml .= '<Sku>';
			foreach ($sku[$j] as $key => $value) {
				$xml .= '<'.$key.'>'.$value.'</'.$key.'>';
			}
	    $xml .= '                        
	            <package_length>'.$post[$i]['package_length'].'</package_length>                 
	            <package_height>'.$post[$i]['package_height'].'</package_height>                
	            <package_weight>'.$post[$i]['package_weight'].'</package_weight>                 
	            <package_width>'.$post[$i]['package_width'].'</package_width>                 
	            <package_content>No</package_content>                
	            <Images>';
		$img = explode(',', $sku[$j]['image']);
		    for($k=0;$k<count($img);$k++){
		    	if($img[$k] != null){
		    	$xml .= '<Image>'.$img[$k].'</Image>';
		    	}
		    }

	    $xml .= '</Images></Sku>';
	    } 
		$xml .= '</Skus>';
		$xml .= '</Product>';
		$xml .= '</Request>';
		if($post[$i]['primarycategory'] != null){
		$data = $mysql->where('seller_id', $seller_id)->get('account');
			$accessToken = $data[0]['access_token'];
			$c = new LazopClient('https://api.lazada.vn/rest',appkey,appsecret);
			$request = new LazopRequest('/product/update');
			$request->addApiParam('payload',$xml);
			$res_a = $c->execute($request, $accessToken);
			$res = json_decode($res_a, TRUE);
			if($res['code'] == 0){
				$mysql->where('item_id', $post[$i]['item_id'])->update('product', array(
				'update_sellerid' => $post[$i]['update_sellerid'].','.$seller_id
				));
				$file = 'log_update.txt';
				// Open the file to get existing content
				$current = file_get_contents($file);
				// Append a new person to the file
				$current .= "\n".hatime."| Update success|".$i."|".$post[$i]['item_id']."|".$seller_id."|".$res_a;
				// Write the contents back to the file
				file_put_contents($file, $current);
				$a['success'][] = TRUE;
			}else{
				$mysql->where('item_id', $post[$i]['item_id'])->update('product', array('error_update' => $post[$i]['error_update'].','.$seller_id
					));
				$file = 'log_update.txt';
				// Open the file to get existing content
				$current = file_get_contents($file);
				// Append a new person to the file
				$current .= "\n".hatime."| Update Fail|".$i."|".$post[$i]['item_id']."|".$seller_id."|".$res_a;
				// Write the contents back to the file
				file_put_contents($file, $current);
				$a['fail'][] = TRUE;
		}
	}
	}
	return $a;
}

function check_token_laz($seller_id){
	global $mysql;
	$seller = $mysql->where('seller_id', $seller_id)->get('account');
	$c = new LazopClient('https://auth.lazada.com/rest',appkey,appsecret);
	$request = new LazopRequest('/auth/token/refresh');
	$request->addApiParam('refresh_token',$seller[0]['refresh_token']);
	$res = $c->execute($request);
	$data = json_decode($res, TRUE);
	$new = $mysql->where('seller_id', $data['country_user_info'][0]['short_code'])->get('account');
	$new = $mysql->num_rows();
	if($data['access_token'] != null){
		try{
			if($new < 1){
			$mysql->insert('account', array(
				'seller_id' => $data['country_user_info'][0]['short_code'], 
				'email' => $data['account'],
				'access_token' => $data['access_token'],
				'refresh_token' => $data['refresh_token'],
				'exp' => $data['expires_in'],
				'appkey' => appkey,
				'appsecret' => appsecret
				));
			}else{
			$mysql->where('seller_id', $data['country_user_info'][0]['short_code'])->update('account', array(
				'access_token' => $data['access_token'],
				'refresh_token' => $data['refresh_token']
				));

			}
			return TRUE;
		}catch(Exception $e){
			//echo 'Caught exception: ', $e->getMessage();
			return FALSE;
		}
	}else{
		return FALSE;
	}
}

function get_seller_laz($seller_id){
	global $mysql;
	$data = $mysql->where('seller_id', $seller_id)->get('account');
	$c = new LazopClient('https://api.lazada.vn/rest',appkey,appsecret);
	$request = new LazopRequest('/seller/get','GET');
	$res = json_decode($c->execute($request, $data[0]['access_token']), TRUE);
	//var_dump($res);
	if($res['code'] != 0){
		check_token_laz($seller_id);
	}else{
		return TRUE;
	}
}

function get_product_laz($accessToken, $start_date, $end_date){
	global $mysql;
	$c = new LazopClient('https://api.lazada.vn/rest',appkey,appsecret);
	$request = new LazopRequest('/products/get','GET');
	$request->addApiParam('filter','live');
	//$request->addApiParam('search','product_name');
	//$request->addApiParam('create_before','2018-01-01T00:00:00+0800');
	//$request->addApiParam('offset','0');
	$request->addApiParam('create_after',$start_date);
	$request->addApiParam('update_after',$start_date);
	$request->addApiParam('limit','500');
	//$request->addApiParam('options','1');
	//$request->addApiParam('sku_seller_list',' [\"39817:01:01\", \"Apple 6S Black\"]');
	//var_dump($c->execute($request, $accessToken));
	$res = json_decode($c->execute($request, $accessToken), TRUE);
	$a['total'] = $res['data']['total_products'];
	for($k=0;$k<$res['data']['total_products'];$k++){
	$sku = array();
	for ($i=0;$i<count($res['data']['products'][$k]['skus']);$i++)
		{
			foreach ($res['data']['products'][$k]['skus'][$i] as $key => $value) {
				$sku[$i][$key] = $value;
			}
			unset($sku[$i]['Images']);
			unset($sku[$i]['ShopSku']);
			unset($sku[$i]['SkuId']);
			unset($sku[$i]['Status']);
			unset($sku[$i]['Url']);
			if($sku[$i]['special_price'] == 0){
				unset($sku[$i]['special_price']);
			}
			$sku[$i]['image'] = '';
			for($j=0;$j<count($res['data']['products'][$k]['skus'][$i]['Images']);$j++){
				$sku[$i]['image'] .= $res['data']['products'][$k]['skus'][$i]['Images'][$j].',';
			}
		}
	$sku = json_encode($sku);
	try{
		if($res['data']['products'][$k]['attributes']['warranty_type'] == null){
			$warranty_type = 'No Warranty';
		}else{
			$warranty_type = $res['data']['products'][$k]['attributes']['warranty_type'];
		}

			$mysql->insert('product', array(
				'name' => $res['data']['products'][$k]['attributes']['name'], 
				'primarycategory' => $res['data']['products'][$k]['primary_category'],
				'item_id' => $res['data']['products'][$k]['item_id'],
				'short_description' => $res['data']['products'][$k]['attributes']['short_description'],
				'description_laz' => str_replace('/><img','/><br /><img',$res['data']['products'][$k]['attributes']['description']),
				'brand' => $res['data']['products'][$k]['attributes']['brand'],
				'model' => $res['data']['products'][$k]['attributes']['model'],
				'warranty_type' => $warranty_type,
				'warranty' => $res['data']['products'][$k]['attributes']['warranty'],
				'kid_years' => $res['data']['products'][$k]['attributes']['kid_years'],
				'sellersku' => $sku,
				'package_length' => $res['data']['products'][$k]['skus'][0]['package_length'],
				'package_height' => $res['data']['products'][$k]['skus'][0]['package_height'],
				'package_weight' => $res['data']['products'][$k]['skus'][0]['package_weight'],
				'package_width' => $res['data']['products'][$k]['skus'][0]['package_width']
				));
			$a['sql_success'][] = TRUE;
		}catch(Exception $e){
			try {
				$mysql->where('item_id', $res['data']['products'][$k]['item_id'])->update('product', array(
				'name' => $res['data']['products'][$k]['attributes']['name'], 
				'primarycategory' => $res['data']['products'][$k]['primary_category'],
				'item_id' => $res['data']['products'][$k]['item_id'],
				'short_description' => $res['data']['products'][$k]['attributes']['short_description'],
				'description_laz' => str_replace('/><img','/><br /><img',$res['data']['products'][$k]['attributes']['description']),
				'brand' => $res['data']['products'][$k]['attributes']['brand'],
				'model' => $res['data']['products'][$k]['attributes']['model'],
				'warranty_type' => $warranty_type,
				'warranty' => $res['data']['products'][$k]['attributes']['warranty'],
				'kid_years' => $res['data']['products'][$k]['attributes']['kid_years'],
				'sellersku' => $sku,
				'package_length' => $res['data']['products'][$k]['skus'][0]['package_length'],
				'package_height' => $res['data']['products'][$k]['skus'][0]['package_height'],
				'package_weight' => $res['data']['products'][$k]['skus'][0]['package_weight'],
				'package_width' => $res['data']['products'][$k]['skus'][0]['package_width']
				));
				$a['sql_update'][] = TRUE;
			} catch (Exception $e) {
				$a['sql_fail'][] = TRUE;
			}
		}
	}
	return $a;
}

function remove_product_laz($seller_id,$sku){
	global $mysql;
	$acc = $mysql->where('seller_id', $seller_id)->get('account');
	$c = new LazopClient(url,$acc[0]['appkey'],$acc[0]['appsecret']);
	$request = new LazopRequest('/product/remove');
	$request->addApiParam('seller_sku_list','['.$sku.']');
	var_dump($c->execute($request, $acc[0]['access_token']));
}

function to_shopee_xls(){
	global $mysql;
		// Create new PHPExcel object
		$objPHPExcel = new PHPExcel();
		// Create a first sheet, representing sales data
		$objPHPExcel->setActiveSheetIndex(0);
		$objPHPExcel->getActiveSheet()->setCellValue('A1', 'ps_category_list_id');
		$objPHPExcel->getActiveSheet()->setCellValue('B1', 'ps_product_name');
		$objPHPExcel->getActiveSheet()->setCellValue('C1', 'ps_product_description');
		$objPHPExcel->getActiveSheet()->setCellValue('D1', 'ps_price');
		$objPHPExcel->getActiveSheet()->setCellValue('E1', 'ps_stock');
		$objPHPExcel->getActiveSheet()->setCellValue('F1', 'ps_product_weight');
		$objPHPExcel->getActiveSheet()->setCellValue('G1', 'ps_days_to_ship');
		$objPHPExcel->getActiveSheet()->setCellValue('H1', 'ps_sku_ref_no_parent');
		$objPHPExcel->getActiveSheet()->setCellValue('I1', 'ps_mass_upload_variation_help');
		$objPHPExcel->getActiveSheet()->setCellValue('J1', 'ps_variation 1 ps_variation_sku');
		$objPHPExcel->getActiveSheet()->setCellValue('K1', 'ps_variation 1 ps_variation_name');
		$objPHPExcel->getActiveSheet()->setCellValue('L1', 'ps_variation 1 ps_variation_price');
		$objPHPExcel->getActiveSheet()->setCellValue('M1', 'ps_variation 1 ps_variation_stock');
		$objPHPExcel->getActiveSheet()->setCellValue('N1', 'ps_variation 2 ps_variation_sku');
		$objPHPExcel->getActiveSheet()->setCellValue('O1', 'ps_variation 2 ps_variation_name');
		$objPHPExcel->getActiveSheet()->setCellValue('P1', 'ps_variation 2 ps_variation_price');
		$objPHPExcel->getActiveSheet()->setCellValue('Q1', 'ps_variation 2 ps_variation_stock');
		$objPHPExcel->getActiveSheet()->setCellValue('R1', 'ps_variation 3 ps_variation_sku');
		$objPHPExcel->getActiveSheet()->setCellValue('S1', 'ps_variation 3 ps_variation_name');
		$objPHPExcel->getActiveSheet()->setCellValue('T1', 'ps_variation 3 ps_variation_price');
		$objPHPExcel->getActiveSheet()->setCellValue('U1', 'ps_variation 3 ps_variation_stock');
		$objPHPExcel->getActiveSheet()->setCellValue('V1', 'ps_variation 4 ps_variation_sku');
		$objPHPExcel->getActiveSheet()->setCellValue('W1', 'ps_variation 4 ps_variation_name');
		$objPHPExcel->getActiveSheet()->setCellValue('X1', 'ps_variation 4 ps_variation_price');
		$objPHPExcel->getActiveSheet()->setCellValue('Y1', 'ps_variation 4 ps_variation_stock');
		$objPHPExcel->getActiveSheet()->setCellValue('Z1', 'ps_variation 5 ps_variation_sku');
		$objPHPExcel->getActiveSheet()->setCellValue('AA1', 'ps_variation 5 ps_variation_name');
		$objPHPExcel->getActiveSheet()->setCellValue('AB1', 'ps_variation 5 ps_variation_price');
		$objPHPExcel->getActiveSheet()->setCellValue('AC1', 'ps_variation 5 ps_variation_stock');
		$objPHPExcel->getActiveSheet()->setCellValue('AD1', 'ps_variation 6 ps_variation_sku');
		$objPHPExcel->getActiveSheet()->setCellValue('AE1', 'ps_variation 6 ps_variation_name');
		$objPHPExcel->getActiveSheet()->setCellValue('AF1', 'ps_variation 6 ps_variation_price');
		$objPHPExcel->getActiveSheet()->setCellValue('AG1', 'ps_variation 6 ps_variation_stock');
		$objPHPExcel->getActiveSheet()->setCellValue('AH1', 'ps_variation 7 ps_variation_sku');
		$objPHPExcel->getActiveSheet()->setCellValue('AI1', 'ps_variation 7 ps_variation_name');
		$objPHPExcel->getActiveSheet()->setCellValue('AJ1', 'ps_variation 7 ps_variation_price');
		$objPHPExcel->getActiveSheet()->setCellValue('AK1', 'ps_variation 7 ps_variation_stock');
		$objPHPExcel->getActiveSheet()->setCellValue('AL1', 'ps_variation 8 ps_variation_sku');
		$objPHPExcel->getActiveSheet()->setCellValue('AM1', 'ps_variation 8 ps_variation_name');
		$objPHPExcel->getActiveSheet()->setCellValue('AN1', 'ps_variation 8 ps_variation_price');
		$objPHPExcel->getActiveSheet()->setCellValue('AO1', 'ps_variation 8 ps_variation_stock');
		$objPHPExcel->getActiveSheet()->setCellValue('AP1', 'ps_variation 9 ps_variation_sku');
		$objPHPExcel->getActiveSheet()->setCellValue('AQ1', 'ps_variation 9 ps_variation_name');
		$objPHPExcel->getActiveSheet()->setCellValue('AR1', 'ps_variation 9 ps_variation_price');
		$objPHPExcel->getActiveSheet()->setCellValue('AS1', 'ps_variation 9 ps_variation_stock');
		$objPHPExcel->getActiveSheet()->setCellValue('AT1', 'ps_variation 10 ps_variation_sku');
		$objPHPExcel->getActiveSheet()->setCellValue('AU1', 'ps_variation 10 ps_variation_name');
		$objPHPExcel->getActiveSheet()->setCellValue('AV1', 'ps_variation 10 ps_variation_price');
		$objPHPExcel->getActiveSheet()->setCellValue('AW1', 'ps_variation 10 ps_variation_stock');
		$objPHPExcel->getActiveSheet()->setCellValue('AX1', 'ps_variation 11 ps_variation_sku');
		$objPHPExcel->getActiveSheet()->setCellValue('AY1', 'ps_variation 11 ps_variation_name');
		$objPHPExcel->getActiveSheet()->setCellValue('AZ1', 'ps_variation 11 ps_variation_price');
		$objPHPExcel->getActiveSheet()->setCellValue('BA1', 'ps_variation 11 ps_variation_stock');
		$objPHPExcel->getActiveSheet()->setCellValue('BB1', 'ps_variation 12 ps_variation_sku');
		$objPHPExcel->getActiveSheet()->setCellValue('BC1', 'ps_variation 12 ps_variation_name');
		$objPHPExcel->getActiveSheet()->setCellValue('BD1', 'ps_variation 12 ps_variation_price');
		$objPHPExcel->getActiveSheet()->setCellValue('BE1', 'ps_variation 12 ps_variation_stock');
		$objPHPExcel->getActiveSheet()->setCellValue('BF1', 'ps_variation 13 ps_variation_sku');
		$objPHPExcel->getActiveSheet()->setCellValue('BG1', 'ps_variation 13 ps_variation_name');
		$objPHPExcel->getActiveSheet()->setCellValue('BH1', 'ps_variation 13 ps_variation_price');
		$objPHPExcel->getActiveSheet()->setCellValue('BI1', 'ps_variation 13 ps_variation_stock');
		$objPHPExcel->getActiveSheet()->setCellValue('BJ1', 'ps_variation 14 ps_variation_sku');
		$objPHPExcel->getActiveSheet()->setCellValue('BK1', 'ps_variation 14 ps_variation_name');
		$objPHPExcel->getActiveSheet()->setCellValue('BL1', 'ps_variation 14 ps_variation_price');
		$objPHPExcel->getActiveSheet()->setCellValue('BM1', 'ps_variation 14 ps_variation_stock');
		$objPHPExcel->getActiveSheet()->setCellValue('BN1', 'ps_variation 15 ps_variation_sku');
		$objPHPExcel->getActiveSheet()->setCellValue('BO1', 'ps_variation 15 ps_variation_name');
		$objPHPExcel->getActiveSheet()->setCellValue('BP1', 'ps_variation 15 ps_variation_price');
		$objPHPExcel->getActiveSheet()->setCellValue('BQ1', 'ps_variation 15 ps_variation_stock');
		$objPHPExcel->getActiveSheet()->setCellValue('BR1', 'ps_variation 16 ps_variation_sku');
		$objPHPExcel->getActiveSheet()->setCellValue('BS1', 'ps_variation 16 ps_variation_name');
		$objPHPExcel->getActiveSheet()->setCellValue('BT1', 'ps_variation 16 ps_variation_price');
		$objPHPExcel->getActiveSheet()->setCellValue('BU1', 'ps_variation 16 ps_variation_stock');
		$objPHPExcel->getActiveSheet()->setCellValue('BV1', 'ps_variation 17 ps_variation_sku');
		$objPHPExcel->getActiveSheet()->setCellValue('BW1', 'ps_variation 17 ps_variation_name');
		$objPHPExcel->getActiveSheet()->setCellValue('BX1', 'ps_variation 17 ps_variation_price');
		$objPHPExcel->getActiveSheet()->setCellValue('BY1', 'ps_variation 17 ps_variation_stock');
		$objPHPExcel->getActiveSheet()->setCellValue('BZ1', 'ps_variation 18 ps_variation_sku');
		$objPHPExcel->getActiveSheet()->setCellValue('CA1', 'ps_variation 18 ps_variation_name');
		$objPHPExcel->getActiveSheet()->setCellValue('CB1', 'ps_variation 18 ps_variation_price');
		$objPHPExcel->getActiveSheet()->setCellValue('CC1', 'ps_variation 18 ps_variation_stock');
		$objPHPExcel->getActiveSheet()->setCellValue('CD1', 'ps_variation 19 ps_variation_sku');
		$objPHPExcel->getActiveSheet()->setCellValue('CE1', 'ps_variation 19 ps_variation_name');
		$objPHPExcel->getActiveSheet()->setCellValue('CF1', 'ps_variation 19 ps_variation_price');
		$objPHPExcel->getActiveSheet()->setCellValue('CG1', 'ps_variation 19 ps_variation_stock');
		$objPHPExcel->getActiveSheet()->setCellValue('CH1', 'ps_variation 20 ps_variation_sku');
		$objPHPExcel->getActiveSheet()->setCellValue('CI1', 'ps_variation 20 ps_variation_name');
		$objPHPExcel->getActiveSheet()->setCellValue('CJ1', 'ps_variation 20 ps_variation_price');
		$objPHPExcel->getActiveSheet()->setCellValue('CK1', 'ps_variation 20 ps_variation_stock');
		$objPHPExcel->getActiveSheet()->setCellValue('CL1', 'ps_img_1');
		$objPHPExcel->getActiveSheet()->setCellValue('CM1', 'ps_img_2');
		$objPHPExcel->getActiveSheet()->setCellValue('CN1', 'ps_img_3');
		$objPHPExcel->getActiveSheet()->setCellValue('CO1', 'ps_img_4');
		$objPHPExcel->getActiveSheet()->setCellValue('CP1', 'ps_img_5');
		$objPHPExcel->getActiveSheet()->setCellValue('CQ1', 'ps_img_6');
		$objPHPExcel->getActiveSheet()->setCellValue('CR1', 'ps_img_7');
		$objPHPExcel->getActiveSheet()->setCellValue('CS1', 'ps_img_8');
		$objPHPExcel->getActiveSheet()->setCellValue('CT1', 'ps_img_9');
		$objPHPExcel->getActiveSheet()->setCellValue('CU1', 'ps_mass_upload_shipment_help');
		$objPHPExcel->getActiveSheet()->setCellValue('CV1', 'channel 50010 switch');
		$objPHPExcel->getActiveSheet()->setCellValue('CW1', 'channel 50011 switch');
		$objPHPExcel->getActiveSheet()->setCellValue('CX1', 'channel 50012 switch');
		$objPHPExcel->getActiveSheet()->setCellValue('CY1', 'channel 500166 switch');

		$row = 2;
		$data = $mysql->get('product');
	for($i=0;$i<count($data);$i++){
				$cot = $row++;
				$sku = json_decode($data[$i]['sellersku'], TRUE);
				$objPHPExcel->getActiveSheet()->setCellValue('A'.$cot, $data[$i]['shopee_category']);
				$objPHPExcel->getActiveSheet()->setCellValue('B'.$cot, $data[$i]['name']);
				$objPHPExcel->getActiveSheet()->setCellValue('C'.$cot, $data[$i]['short_description']);
			if(count($sku) == 1){
				$weight = $sku[0]['package_weight'] * 1000;
				$objPHPExcel->getActiveSheet()->setCellValue('D'.$cot, $sku[0]['price']);
				$objPHPExcel->getActiveSheet()->setCellValue('E'.$cot, $sku[0]['Available']);
				$objPHPExcel->getActiveSheet()->setCellValue('F'.$cot, $weight);
				$objPHPExcel->getActiveSheet()->setCellValue('G'.$cot, 2);
				$objPHPExcel->getActiveSheet()->setCellValue('H'.$cot, $sku[0]['SellerSku']);
			}
				$objPHPExcel->getActiveSheet()->setCellValue('I'.$cot, '');
			if(count($sku) > 1){
				$objPHPExcel->getActiveSheet()->setCellValue('J'.$cot, $sku[0]['SellerSku']);
				$objPHPExcel->getActiveSheet()->setCellValue('K'.$cot, $sku[0]['SellerSku']);
				$objPHPExcel->getActiveSheet()->setCellValue('L'.$cot, $sku[0]['price']);
				$objPHPExcel->getActiveSheet()->setCellValue('M'.$cot, $sku[0]['Available']);
				$objPHPExcel->getActiveSheet()->setCellValue('N'.$cot, $sku[1]['SellerSku']);
				$objPHPExcel->getActiveSheet()->setCellValue('O'.$cot, $sku[1]['SellerSku']);
				$objPHPExcel->getActiveSheet()->setCellValue('P'.$cot, $sku[1]['price']);
				$objPHPExcel->getActiveSheet()->setCellValue('Q'.$cot, $sku[1]['Available']);
				$objPHPExcel->getActiveSheet()->setCellValue('R'.$cot, $sku[2]['SellerSku']);
				$objPHPExcel->getActiveSheet()->setCellValue('S'.$cot, $sku[2]['SellerSku']);
				$objPHPExcel->getActiveSheet()->setCellValue('T'.$cot, $sku[2]['price']);
				$objPHPExcel->getActiveSheet()->setCellValue('U'.$cot, $sku[2]['Available']);
				$objPHPExcel->getActiveSheet()->setCellValue('V'.$cot, $sku[3]['SellerSku']);
				$objPHPExcel->getActiveSheet()->setCellValue('W'.$cot, $sku[3]['SellerSku']);
				$objPHPExcel->getActiveSheet()->setCellValue('X'.$cot, $sku[3]['price']);
				$objPHPExcel->getActiveSheet()->setCellValue('Y'.$cot, $sku[3]['Available']);
				$objPHPExcel->getActiveSheet()->setCellValue('Z'.$cot, $sku[4]['SellerSku']);
				$objPHPExcel->getActiveSheet()->setCellValue('AA'.$cot, $sku[4]['SellerSku']);
				$objPHPExcel->getActiveSheet()->setCellValue('AB'.$cot, $sku[4]['price']);
				$objPHPExcel->getActiveSheet()->setCellValue('AC'.$cot, $sku[4]['Available']);
				$objPHPExcel->getActiveSheet()->setCellValue('AD'.$cot, $sku[5]['SellerSku']);
				$objPHPExcel->getActiveSheet()->setCellValue('AE'.$cot, $sku[5]['SellerSku']);
				$objPHPExcel->getActiveSheet()->setCellValue('AF'.$cot, $sku[5]['price']);
				$objPHPExcel->getActiveSheet()->setCellValue('AG'.$cot, $sku[5]['Available']);
				$objPHPExcel->getActiveSheet()->setCellValue('AH'.$cot, $sku[6]['SellerSku']);
				$objPHPExcel->getActiveSheet()->setCellValue('AI'.$cot, $sku[6]['SellerSku']);
				$objPHPExcel->getActiveSheet()->setCellValue('AJ'.$cot, $sku[6]['price']);
				$objPHPExcel->getActiveSheet()->setCellValue('AK'.$cot, $sku[6]['Available']);
				$objPHPExcel->getActiveSheet()->setCellValue('AL'.$cot, $sku[7]['SellerSku']);
				$objPHPExcel->getActiveSheet()->setCellValue('AM'.$cot, $sku[7]['SellerSku']);
				$objPHPExcel->getActiveSheet()->setCellValue('AN'.$cot, $sku[7]['price']);
				$objPHPExcel->getActiveSheet()->setCellValue('AO'.$cot, $sku[7]['Available']);
				$objPHPExcel->getActiveSheet()->setCellValue('AP'.$cot, $sku[8]['SellerSku']);
				$objPHPExcel->getActiveSheet()->setCellValue('AQ'.$cot, $sku[8]['SellerSku']);
				$objPHPExcel->getActiveSheet()->setCellValue('AR'.$cot, $sku[8]['price']);
				$objPHPExcel->getActiveSheet()->setCellValue('AS'.$cot, $sku[8]['Available']);
				$objPHPExcel->getActiveSheet()->setCellValue('AT'.$cot, $sku[9]['SellerSku']);
				$objPHPExcel->getActiveSheet()->setCellValue('AU'.$cot, $sku[9]['SellerSku']);
				$objPHPExcel->getActiveSheet()->setCellValue('AV'.$cot, $sku[9]['price']);
				$objPHPExcel->getActiveSheet()->setCellValue('AW'.$cot, $sku[9]['Available']);
				$objPHPExcel->getActiveSheet()->setCellValue('AX'.$cot, $sku[10]['SellerSku']);
				$objPHPExcel->getActiveSheet()->setCellValue('AY'.$cot, $sku[10]['SellerSku']);
				$objPHPExcel->getActiveSheet()->setCellValue('AZ'.$cot, $sku[10]['price']);
				$objPHPExcel->getActiveSheet()->setCellValue('BA'.$cot, $sku[10]['Available']);
				$objPHPExcel->getActiveSheet()->setCellValue('BB'.$cot, $sku[11]['SellerSku']);
				$objPHPExcel->getActiveSheet()->setCellValue('BC'.$cot, $sku[11]['SellerSku']);
				$objPHPExcel->getActiveSheet()->setCellValue('BD'.$cot, $sku[11]['price']);
				$objPHPExcel->getActiveSheet()->setCellValue('BE'.$cot, $sku[11]['Available']);
				$objPHPExcel->getActiveSheet()->setCellValue('BF'.$cot, $sku[12]['SellerSku']);
				$objPHPExcel->getActiveSheet()->setCellValue('BG'.$cot, $sku[12]['SellerSku']);
				$objPHPExcel->getActiveSheet()->setCellValue('BH'.$cot, $sku[12]['price']);
				$objPHPExcel->getActiveSheet()->setCellValue('BI'.$cot, $sku[12]['Available']);
				$objPHPExcel->getActiveSheet()->setCellValue('BJ'.$cot, $sku[13]['SellerSku']);
				$objPHPExcel->getActiveSheet()->setCellValue('BK'.$cot, $sku[13]['SellerSku']);
				$objPHPExcel->getActiveSheet()->setCellValue('BL'.$cot, $sku[13]['price']);
				$objPHPExcel->getActiveSheet()->setCellValue('BM'.$cot, $sku[13]['Available']);
				$objPHPExcel->getActiveSheet()->setCellValue('BN'.$cot, $sku[14]['SellerSku']);
				$objPHPExcel->getActiveSheet()->setCellValue('BO'.$cot, $sku[14]['SellerSku']);
				$objPHPExcel->getActiveSheet()->setCellValue('BP'.$cot, $sku[14]['price']);
				$objPHPExcel->getActiveSheet()->setCellValue('BQ'.$cot, $sku[14]['Available']);
				$objPHPExcel->getActiveSheet()->setCellValue('BR'.$cot, $sku[15]['SellerSku']);
				$objPHPExcel->getActiveSheet()->setCellValue('BS'.$cot, $sku[15]['SellerSku']);
				$objPHPExcel->getActiveSheet()->setCellValue('BT'.$cot, $sku[15]['price']);
				$objPHPExcel->getActiveSheet()->setCellValue('BU'.$cot, $sku[15]['Available']);
				$objPHPExcel->getActiveSheet()->setCellValue('BV'.$cot, $sku[16]['SellerSku']);
				$objPHPExcel->getActiveSheet()->setCellValue('BW'.$cot, $sku[16]['SellerSku']);
				$objPHPExcel->getActiveSheet()->setCellValue('BX'.$cot, $sku[16]['price']);
				$objPHPExcel->getActiveSheet()->setCellValue('BY'.$cot, $sku[16]['Available']);
				$objPHPExcel->getActiveSheet()->setCellValue('BZ'.$cot, $sku[17]['SellerSku']);
				$objPHPExcel->getActiveSheet()->setCellValue('CA'.$cot, $sku[17]['SellerSku']);
				$objPHPExcel->getActiveSheet()->setCellValue('CB'.$cot, $sku[17]['price']);
				$objPHPExcel->getActiveSheet()->setCellValue('CC'.$cot, $sku[17]['Available']);
				$objPHPExcel->getActiveSheet()->setCellValue('CD'.$cot, $sku[18]['SellerSku']);
				$objPHPExcel->getActiveSheet()->setCellValue('CE'.$cot, $sku[18]['SellerSku']);
				$objPHPExcel->getActiveSheet()->setCellValue('CF'.$cot, $sku[18]['price']);
				$objPHPExcel->getActiveSheet()->setCellValue('CG'.$cot, $sku[18]['Available']);
				$objPHPExcel->getActiveSheet()->setCellValue('CH'.$cot, $sku[19]['SellerSku']);
				$objPHPExcel->getActiveSheet()->setCellValue('CI'.$cot, $sku[19]['SellerSku']);
				$objPHPExcel->getActiveSheet()->setCellValue('CJ'.$cot, $sku[19]['price']);
				$objPHPExcel->getActiveSheet()->setCellValue('CK'.$cot, $sku[19]['Available']);
			}
				$img = explode(',', $sku[0]['image']);
				$objPHPExcel->getActiveSheet()->setCellValue('CL'.$cot, $img[0]);
				$objPHPExcel->getActiveSheet()->setCellValue('CM'.$cot, $img[1]);
				$objPHPExcel->getActiveSheet()->setCellValue('CN'.$cot, $img[2]);
				$objPHPExcel->getActiveSheet()->setCellValue('CO'.$cot, $img[3]);
				$objPHPExcel->getActiveSheet()->setCellValue('CP'.$cot, $img[4]);
				$objPHPExcel->getActiveSheet()->setCellValue('CQ'.$cot, $img[5]);
				$objPHPExcel->getActiveSheet()->setCellValue('CR'.$cot, $img[6]);
				$objPHPExcel->getActiveSheet()->setCellValue('CS'.$cot, $img[7]);
				$objPHPExcel->getActiveSheet()->setCellValue('CT'.$cot, $img[8]);
				$objPHPExcel->getActiveSheet()->setCellValue('CU'.$cot, '');
				$objPHPExcel->getActiveSheet()->setCellValue('CV'.$cot, 'Mở');
				$objPHPExcel->getActiveSheet()->setCellValue('CW'.$cot, 'Mở');
				$objPHPExcel->getActiveSheet()->setCellValue('CX'.$cot, 'Mở');
				$objPHPExcel->getActiveSheet()->setCellValue('CY'.$cot, '');
	}

		// Rename sheet
		$objPHPExcel->getActiveSheet()->setTitle('Sheet1');
		// Create a new worksheet, after the default sheet
		$objPHPExcel->createSheet();
		// Add some data to the second sheet, resembling some different data types
		//$objPHPExcel->setActiveSheetIndex(1);
		//$objPHPExcel->getActiveSheet()->setCellValue('A1', 'loading');
		// Rename 2nd sheet
		//$objPHPExcel->getActiveSheet()->setTitle('Sheet2');
		// Redirect output to a client’s web browser (Excel5)
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="BAOCAO.xls"');
		header('Cache-Control: max-age=0');
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		$objWriter->save('php://output');
	return $objWriter;
}

function get_order_laz($accessToken, $status, $seller_id){
	global $mysql;
	$array = array();
	$c = new LazopClient('https://api.lazada.vn/rest',appkey,appsecret);
	$request = new LazopRequest('/orders/get','GET');
	//$request->addApiParam('created_before','2018-02-10T16:00:00+08:00');
	$request->addApiParam('created_after','2017-02-10T09:00:00+08:00');
	$request->addApiParam('status','pending');
	//$request->addApiParam('update_before','2018-02-10T16:00:00+08:00');
	$request->addApiParam('sort_direction','ASC');
	//$request->addApiParam('offset','0');
	//$request->addApiParam('limit','10');
	//$request->addApiParam('update_after','2017-02-10T09:00:00+08:00');
	//$request->addApiParam('sort_by','updated_at');
	$a = $c->execute($request, $accessToken);
	$b = json_decode($a, TRUE, 512, JSON_BIGINT_AS_STRING);
	for($i=0;$i<count($b['data']['orders']);$i++){
		$array[] = $b['data']['orders'][$i]['order_number'];
		try {
			$mysql->insert('orderid', array(
				'order_id' => $b['data']['orders'][$i]['order_number'], 
				'status' => $b['data']['orders'][$i]['statuses'][0], 
				'source' => $seller_id
			));
		} catch (Exception $e) {
			$mysql->where('order_id', $b['data']['orders'][$i]['order_number'])->update('orderid', array('status' => $b['data']['orders'][$i]['statuses'][0]));
		}
	}
	return $array;
}


function get_item($accessToken, $orderid, $seller_id){
	global $mysql;
	$d = array();
	$sku = array();
	$img = array();
	$quantity = array();
	$c = new LazopClient('https://api.lazada.vn/rest',appkey,appsecret);
	$request = new LazopRequest('/orders/items/get','GET');
	$request->addApiParam('order_ids','['.$orderid.']');
	$a = $c->execute($request, $accessToken);
	$b = json_decode($a, TRUE, 512, JSON_BIGINT_AS_STRING);
	for($i=0;$i<count($b['data'][0]['order_items']);$i++){
		$quantity[$b['data'][0]['order_items'][$i]['sku']] = $quantity[$b['data'][0]['order_items'][$i]['sku']] + 1;
		$img[$b['data'][0]['order_items'][$i]['sku']] = $b['data'][0]['order_items'][$i]['product_main_image'];
		if($b['data'][0]['order_items'][$i]['status'] == 'canceled'){
			$invoid = null;
		}else{
			$invoid = get_invoid_laz($accessToken, $b['data'][0]['order_items'][$i]['order_item_id']);
		}
		try{
			$mysql->insert('orders', array(
				'order_id' => $orderid, 
				'order_item_id' => $b['data'][0]['order_items'][$i]['order_item_id'], 
				'sku' => $b['data'][0]['order_items'][$i]['sku'],
				'quantity' => 1,
				'price' => $b['data'][0]['order_items'][$i]['paid_price'],
				'status' => $b['data'][0]['order_items'][$i]['status'],
				'invoid' => $invoid,
				'source' => $seller_id,
				'info' => $b['data'][0]['order_items'][$i]['product_main_image']
			));
		}catch(Exception $e){
			if($invoid != null){
				$mysql->where('order_item_id', $b['data'][0]['order_items'][$i]['order_item_id'])->update('orders', array(
				'status' => $b['data'][0]['order_items'][$i]['status'],
				'invoid' => $invoid
				));

			}else{
				$mysql->where('order_item_id', $b['data'][0]['order_items'][$i]['order_item_id'])->update('orders', array(
				'status' => $b['data'][0]['order_items'][$i]['status']
				));
			}
			
		}
	}
	$d['quantity'] = $quantity;
	$d['img'] = $img;
	return $d;
}

function get_invoid_laz($accessToken, $id){
	$c = new LazopClient('https://api.lazada.vn/rest',appkey,appsecret);
	$request = new LazopRequest('/order/document/get','GET');
	$request->addApiParam('doc_type','shippingLabel');
	$request->addApiParam('order_item_ids','['.$id.', '.$id.']');
	$res = json_decode($c->execute($request, $accessToken), TRUE);
	return base64_decode($res['data']['document']['file']);
}

function set_invoid_number_laz($accessToken, $orderid, $invoice){
	$c = new LazopClient('https://api.lazada.vn/rest',appkey,appsecret);
	$request = new LazopRequest('/order/invoice_number/set');
	$request->addApiParam('order_item_id',$orderid);
	$request->addApiParam('invoice_number','INV-201');
	var_dump($c->execute($request, $accessToken));

}