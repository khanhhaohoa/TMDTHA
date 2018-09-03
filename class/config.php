<?php
error_reporting(0);
session_start();
date_default_timezone_set("Asia/Bangkok");
define('style', 'http://'.$_SERVER['HTTP_HOST'].'/laz/style');
define('url', 'http://'.$_SERVER['HTTP_HOST']);
define('link', 'http://'.$_SERVER['HTTP_HOST'].''.$_SERVER['REQUEST_URI']);
define('appkey', '105265');
define('appsecret', 'RGbHb5QrXkuMVVd5ry8PVzekHYXQJwD8');
define('url', 'https://api.lazada.vn/rest');
define('hatime', date("y-m-d H:i:s"));
define('time', date("Y-m-d"));