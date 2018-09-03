<?php
error_reporting(0);
session_start();
date_default_timezone_set("Asia/Bangkok");
define('style', 'http://'.$_SERVER['HTTP_HOST'].'/laz/style');
define('url', 'http://'.$_SERVER['HTTP_HOST']);
define('link', 'http://'.$_SERVER['HTTP_HOST'].''.$_SERVER['REQUEST_URI']);