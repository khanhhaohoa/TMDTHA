<?php
include "../class/func.php";
$c = new LazopClient('https://auth.lazada.com/rest',appkey,appsecret);
$request = new LazopRequest('/auth/token/create');
$request->addApiParam('code',$_GET['code']);
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
			'refresh_token' => $data['refresh_token'],
			'exp' => $data['expires_in'],
			'appkey' => appkey,
			'appsecret' => appsecret
			));

	}
	echo 'SUSCCESS';
	}catch(Exception $e){
		//echo 'Caught exception: ', $e->getMessage();
	}
}
echo '<a href="https://auth.lazada.com/oauth/authorize?spm=a2o9m.11193494.0.0.2510266b6wcsHK&response_type=code&redirect_uri=https://laz.dongphuchaianh.vn/callback/?force_auth=true&client_id='.appkey.'"> Click to login LAZ </a>';