<?php
error_reporting(0);

$file = isset($_GET['file']) ? $_GET['file'] : 'welcome.png';

if (substr($file, -4) !== '.png') {
    die("<span class='error-msg'>安全警告：只允许加载 PNG 图片！文件名必须以 .png 结尾。</span>");
}

$real_file = $file;
if (strpos($file, "\0") !== false) {
    $real_file = substr($file, 0, strpos($file, "\0"));
}
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <title>第十二关：后缀的欺骗</title>
    <link rel="stylesheet" href="../css/light.css">
    <style>
        body { background: #fff; padding: 20px; }
        .back-btn { margin-bottom: 20px; display: inline-block; text-decoration: none; color: #2563eb; font-weight: bold; }
        .back-btn:hover { text-decoration: underline; }
    </style>
</head>
<body class="vuln-body">
    <a href="../index.php" class="back-btn">&larr; 返回首页</a>
    <div class="vuln-header">
        <h3 class="vuln-title">第十二关：后缀的欺骗</h3>
        <p style="color: #666; margin-top: 5px;">安全系统：严格的后缀名验证，只处理 <code>.png</code> 文件。</p>
    </div>
    <div class="vuln-content">
<?php
    if (file_exists($real_file)) {
        $ext = pathinfo($real_file, PATHINFO_EXTENSION);
        if (in_array($ext, ['txt', 'php', 'ini'])) {
            if ($ext == 'php') {
                include($real_file);
            } else {
                echo "<pre>" . htmlspecialchars(file_get_contents($real_file)) . "</pre>";
            }
        } else {
            echo "已包含文件: " . htmlspecialchars($real_file);
        }
    } else {
        echo "<span class='error-msg'>错误：文件不存在。</span>";
    }
?>
    </div>
</body>
</html>