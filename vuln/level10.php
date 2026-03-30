<?php
error_reporting(0);
$file = isset($_GET['file']) ? $_GET['file'] : __DIR__ . '/intro.txt';

if (!preg_match('/^(\/|[a-zA-Z]:\\\\)/', $file)) {
    die("<span class='error-msg'>安全警告：只允许使用绝对路径！(例如 /etc/passwd 或 C:\Windows\win.ini)</span>");
}

$current_dir = __DIR__;
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <title>第十关：绝对的真理</title>
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
        <h3 class="vuln-title">第十关：绝对的真理</h3>
        <p style="color: #666; margin-top: 5px;">安全系统：已封锁相对路径，您必须使用完整的绝对路径。</p>
        <p style="font-size: 0.8em; color: #999;">当前目录：<?php echo htmlspecialchars($current_dir); ?></p>
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