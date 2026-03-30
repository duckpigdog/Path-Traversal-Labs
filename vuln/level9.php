<?php
error_reporting(0);
$file = isset($_GET['file']) ? $_GET['file'] : 'intro.txt';

if (strpos($file, 'flags') !== false) {
    die("<span class='error-msg'>安全警告：禁止访问 'flags' 目录！</span>");
}
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <title>第九关：大小写的秘密</title>
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
        <h3 class="vuln-title">第九关：大小写的秘密</h3>
        <p style="color: #666; margin-top: 5px;">安全系统：已启用关键字拦截。'flags' 已被列入黑名单。</p>
    </div>
    <div class="vuln-content">
<?php
    if (file_exists($file)) {
        include($file);
    } else {
        echo "<span class='error-msg'>错误：文件不存在。</span>";
    }
?>
    </div>
</body>
</html>