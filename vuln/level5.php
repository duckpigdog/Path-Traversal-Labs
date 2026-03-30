<?php
error_reporting(0);
$file = isset($_GET['file']) ? $_GET['file'] : 'intro';
$file = str_replace(chr(0), '', $file);
$filepath = $file . '.html';

$MAX_SIMULATED_PATH = 256;

if (strlen($filepath) > $MAX_SIMULATED_PATH) {
    $truncated = substr($filepath, 0, $MAX_SIMULATED_PATH);
    $clean_path = str_replace(['/./', '\\.\\'], '', $file);
    if (file_exists($clean_path)) {
        include($clean_path);
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <title>第五关：路径的极限</title>
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
        <h3 class="vuln-title">第五关：路径的极限</h3>
        <p style="color: #666; margin-top: 5px;">空字节已被过滤，系统强制要求 <code>.html</code> 后缀。</p>
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