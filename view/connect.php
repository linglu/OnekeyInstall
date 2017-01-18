<?php

echo "<title>连接</title>";

$ip = $_GET['ip'];
exec("/home/linky/IDE/sdk/platform-tools/adb connect $ip", $result);
exec("/home/linky/IDE/sdk/platform-tools/adb devices | grep $ip", $response);

echo $response[0];
