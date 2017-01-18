<?php

echo "<title>安装</title>";

$response = null;
$ipAddress = $_GET['ip'] . ':5555';
$mobileName = $_GET['name'];
$apk = $_COOKIE['apk'];

$result = exec("/home/linky/IDE/sdk/platform-tools/adb -s $ipAddress install -r $apk");

echo $result;


