<?php

$response = null;

exec('/usr/bin/sudo /home/linky/IDE/sdk/platform-tools/adb kill-server', $output);
exec('/usr/bin/sudo /home/linky/IDE/sdk/platform-tools/adb devices', $output);

foreach ($output as $val) {
    $response .= $val . '<br>';
}

echo $response;
