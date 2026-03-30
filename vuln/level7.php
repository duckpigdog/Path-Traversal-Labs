<?php
error_reporting(0);
$file = isset($_GET['file']) ? $_GET['file'] : 'intro.txt';

$logFile = 'logs/access.log';
if (!is_dir('logs')) mkdir('logs');

$userAgent = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : 'Unknown';
$logEntry = "[" . date('Y-m-d H:i:s') . "] IP:" . $_SERVER['REMOTE_ADDR'] . " UA:" . $userAgent . "\n";
file_put_contents($logFile, $logEntry, FILE_APPEND);
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <title>第七关：日志投毒</title>
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
        <h3 class="vuln-title">第七关：日志投毒</h3>
        <p style="color: #666; margin-top: 5px;">系统会监控并记录 User-Agent 信息用于调试。允许本地文件包含以查看报告。</p>
    </div>
    <div class="vuln-content">
<?php
    // <!-- 调试日志路径：logs/access.log -->
    if (file_exists($file)) {
        include($file);
    } else {
        echo "<span class='error-msg'>错误：文件 '$file' 不存在。</span>";
    }
?>
    </div>
</body>
</html>