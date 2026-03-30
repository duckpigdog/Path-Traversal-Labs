<?php
error_reporting(0);
$file = isset($_GET['file']) ? $_GET['file'] : 'intro';
$filepath = $file . '.html';

if (strpos($file, "\0") !== false) {
    $filepath = substr($file, 0, strpos($file, "\0"));
}
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <title>第四关：截断的艺术</title>
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
        <h3 class="vuln-title">第四关：截断的艺术</h3>
        <p style="color: #666; margin-top: 5px;">系统会强制在所有请求后添加 <code>.html</code> 后缀。</p>
    </div>
    <div class="vuln-content">
<?php
    if (file_exists($filepath)) {
        include($filepath);
    } else {
        echo "<span class='error-msg'>错误：文件 '$filepath' 不存在。</span>";
    }
?>
    </div>
</body>
</html>