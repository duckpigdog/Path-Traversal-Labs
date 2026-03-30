<?php
error_reporting(0);

$base_path = __DIR__ . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR;
$file = isset($_GET['file']) ? $_GET['file'] : $base_path . 'logo.txt';

if (strpos($file, $base_path) !== 0) {
    die("<span class='error-msg'>安全警告：访问受限！文件路径必须以以下内容开头：<br><code>" . htmlspecialchars($base_path) . "</code></span>");
}
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <title>第十一关：前缀的限制</title>
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
        <h3 class="vuln-title">第十一关：前缀的限制</h3>
        <p style="color: #666; margin-top: 5px;">安全系统：只允许访问安全图片目录下的文件。</p>
        <p style="font-size: 0.8em; color: #999;">要求的前缀：<?php echo htmlspecialchars($base_path); ?></p>
    </div>
    <div class="vuln-content">
<?php
    if (file_exists($file)) {
        $ext = pathinfo($file, PATHINFO_EXTENSION);
        if ($ext === 'txt') {
            echo "<pre>" . htmlspecialchars(file_get_contents($file)) . "</pre>";
        } else {
            include($file);
        }
    } else {
        echo "<span class='error-msg'>错误：文件不存在。</span>";
    }
?>
    </div>
</body>
</html>