<?php
error_reporting(0);

$file = isset($_COOKIE['file_path']) ? $_COOKIE['file_path'] : 'intro.txt';

if (!isset($_COOKIE['file_path'])) {
    setcookie('file_path', 'intro.txt', time() + 3600, "/");
}
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <title>第八关：隐藏的参数</title>
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
        <h3 class="vuln-title">第八关：隐藏的参数</h3>
        <p style="color: #666; margin-top: 5px;">我们使用安全的 Cookie 来记住您的偏好设置。</p>
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