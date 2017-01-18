<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>

<script>

    function resetAdb() {
        document.getElementById('result_display').innerHTML = "";

        if (window.XMLHttpRequest) {
            xmlhttp = new XMLHttpRequest();
        } else {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }

        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("result_display").innerHTML = xmlhttp.responseText;
            }
        }

        xmlhttp.open("GET", "resetAdb.php", true);
        xmlhttp.send();
    }

    function connect(result, id) {
        document.getElementById(result).innerHTML = "";

        var ipAddress = document.getElementById(id).value;

        if (window.XMLHttpRequest) {
            xmlhttp = new XMLHttpRequest();
        } else {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }

        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById(result).innerHTML = xmlhttp.responseText;
            }
        }

        xmlhttp.open("GET", "connect.php?ip=" + ipAddress, true);
        xmlhttp.send();
    }

    function install(result, name) {

        document.getElementById(result).innerHTML = "正在安装到 " + name + " 请稍候...";

        var ipAddress = document.getElementById(name).value;

        if (window.XMLHttpRequest) {
            xmlhttp = new XMLHttpRequest();
        } else {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }

        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById(result).innerHTML = xmlhttp.responseText;
            }
        }

        xmlhttp.open("GET", "install.php?ip=" + ipAddress + "&name=" + name, true);
        xmlhttp.send();
    }

</script>

<body>

<?php

// 设置一个变量用于存放相册的目录名，这里首先在上面新建的www-data用户组的文件夹data下面，
// 因为这个文件夹是php执行用户的，所以要新建一个文件夹相册 album 文件夹目录

$file = "/home/linky/data/apk";
$success = false;

// 指向的文件夹是否存在如果没有这个目录，就创建这个变量目录
if (!is_dir($file)) {
    mkdir($file);   // 创建这个文件夹
}

// 是否存在约定变量，并且值正确（这里是input type = hidden 传过来的变量名 action 其值为upload）
// if(isset($_POST["action"]) and $_POST["action"] == "upload") {

// 检测$_FILES变量中是否存在数据，这里是传过来的（input type = file）
if (isset($_FILES["upload_file"]["tmp_name"])) {
    $filename = $_FILES["upload_file"]["name"]; // 定义新的文件名

    $apk = $file . "/" . $filename;

    // 把上传的临时文件移动到新目录（两个参数，第一个源文件，第二个目标文件）
    if (move_uploaded_file($_FILES["upload_file"]["tmp_name"], $apk)) {
        echo "上传成功！";
        setcookie("apk", $apk, time() + 3600, "/");
        $success = true;
    } else {
        echo "上传文件失败！";
        $success = false;
    }
}

?>

<br>
<br>

<p style="color: red;">
    注意事项：<br>
    1. 点击连接后，只有显示 device 方能开始安装 <br>
    2. 请确保手机的 ip 地址在 192.168.3.x 网段 <br>
    3. 如果显示 offline 或者 unauthorized，可以采取以下步骤 <br>
    (1) 点击重置 ADB，直到显示 Successful 为止<br>
    (2) 如果 (1) 的方法无效，可先关闭开发者选项 和 usb 调试后再打开，然后再次重复(1)步<br>
    Good Luck <br>
</p>

红米 IP 地址：<input id="homgmi" type="text" name="homgmi" value="192.168.">
<br>
<input type="button" value="连接" onclick="connect('homgmi_connect_result', 'homgmi')">
<p id="homgmi_connect_result"></p>
<br>
<input type="button" value="安装" onclick="install('homgmi_install_result', 'homgmi')">
<p id="homgmi_install_result"></p>
<hr>

小米 IP 地址：<input id="xiaomi" type="text" name="xiaomi" value="192.168.">
<br>
<input type="button" value="连接" onclick="connect('xiaomi_connect_result', 'xiaomi')">
<p id="xiaomi_connect_result" ></p>
<br>
<input type="button" value="安装" onclick="install('xiaomi_install_result', 'xiaomi')">
<p id="xiaomi_install_result"></p>
<br>

华为P8 IP 地址：<input id="p8" type="text" name="p8" value="192.168.">
<br>
<input type="button" value="连接" onclick="connect('p8_connect_result', 'p8')">
<p id="p8_connect_result" ></p>
<br>
<input type="button" value="安装" onclick="install('p8_install_result', 'p8')">
<p id="p8_install_result"></p>
<br>

华为mate8 IP 地址：<input id="mate8" type="text" name="mate8" value="192.168.">
<br>
<input type="button" value="连接" onclick="connect('mate8_connect_result', 'mate8')">
<p id="mate8_connect_result" ></p>
<br>
<input type="button" value="安装" onclick="install('mate8_install_result', 'mate8')">
<p id="mate8_install_result"></p>
<br>

三星 IP 地址：<input id="sanxing" type="text" name="sanxing" value="192.168.">
<br>
<input type="button" value="连接" onclick="connect('sanxing_connect_result', 'sanxing')">
<p id="sanxing_connect_result" ></p>
<br>
<input type="button" value="安装" onclick="install('sanxing_install_result', 'sanxing')">
<p id="sanxing_install_result"></p>
<br>

VIVO IP 地址：<input id="vivo" type="text" name="vivo" value="192.168.">
<br>
<input type="button" value="连接" onclick="connect('vivo_connect_result', 'vivo')">
<p id="vivo_connect_result" ></p>
<br>
<input type="button" value="安装" onclick="install('vivo_install_result', 'vivo')">
<p id="vivo_install_result"></p>
<br>

酷派 IP 地址：<input id="coolpad" type="text" name="coolpad" value="192.168.">
<br>
<input type="button" value="连接" onclick="connect('coolpad_connect_result', 'coolpad')">
<p id="coolpad_connect_result" ></p>
<br>
<input type="button" value="安装" onclick="install('coolpad_install_result', 'coolpad')">
<p id="coolpad_install_result"></p>
<br>

联想 IP 地址：<input id="lenovo" type="text" name="lenovo" value="192.168.">
<br>
<input type="button" value="连接" onclick="connect('lenovo_connect_result', 'lenovo')">
<p id="lenovo_connect_result" ></p>
<br>
<input type="button" value="安装" onclick="install('lenovo_install_result', 'lenovo')">
<p id="lenovo_install_result"></p>
<br>

魅族 IP 地址：<input id="meizu" type="text" name="meizu" value="192.168.">
<br>
<input type="button" value="连接" onclick="connect('meizu_connect_result', 'meizu')">
<p id="meizu_connect_result" ></p>
<br>
<input type="button" value="安装" onclick="install('meizu_install_result', 'meizu')">
<p id="meizu_install_result"></p>
<br>

<hr>

<!-- 重置 adb -->
<input type="button" value="重置ADB" onclick="resetAdb()">
<p id="result_display"></p>

</body>
</html>