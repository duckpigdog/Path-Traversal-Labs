<?php
error_reporting(0);
$file = isset($_GET['file']) ? $_GET['file'] : 'intro.txt';

if (preg_match('/[\.\/]/', $file)) {
    die("<span class='error-msg'>WAF 拦截：检测到恶意字符！</span>");
}

$decoded_file = urldecode($file);
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <title>第三关：编码的伪装</title>
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
        <h3 class="vuln-title">第三关：编码的伪装</h3>
        <p style="color: #666; margin-top: 5px;">当前文件（解码前）：<strong><?php echo htmlspecialchars($file); ?></strong></p>
    </div>
    <div class="vuln-content">
<?php
    if (file_exists($decoded_file)) {
        include($decoded_file);
    } else {
        echo "<span class='error-msg'>错误：文件不存在。</span>";
    }
?>
    </div>
</body>
</html>