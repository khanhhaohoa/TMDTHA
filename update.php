<?php
set_time_limit(0);
include "class/func.php";
try{
		$mysql->where('primarycategory', $_REQUEST['id'])->update('product', array('shopee_category' => $_REQUEST['shopee']));
	}catch(Exception $e){
		echo 'Caught exception: ', $e->getMessage();
	}