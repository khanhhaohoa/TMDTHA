<?php
include 'header.php';

switch ($_GET['home']) {
			case 'don-hang':
				include_once('client/order/get_order.php');
				break;
			case 'add-product':
				include_once('client/product/add.php');
				break;
			default:
				include_once('client/order/get_order.php');
				//include_once('client/order/get_item.php');
				break;
	}

include 'footer.php';