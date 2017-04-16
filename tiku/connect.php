<?php
$host="localhost";
$user="root";
$pass="";
$dbname="testbank";
$timezone="Asia/Shanghai";

$link=mysql_connect($host,$user,$pass);
mysql_select_db($dbname,$link);
mysql_query("SET names UTF8");

header("Content-Type: text/html; charset=utf-8");
date_default_timezone_set($timezone);
?>