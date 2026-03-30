<?php
error_reporting(0);

$msg = "";
$uploadDir = 'uploads/';

if (isset($_FILES['zipfile'])) {
    $file = $_FILES['zipfile'];
    
    $mime = mime_content_type($file['tmp_name']);
    if ($mime !== 'application/zip') {
        $msg = "<span class='error-msg'>错误：只允许上传 ZIP 文件。检测到：$mime</span>";
    } else {
        $zip = new ZipArchive;
        if ($zip->open($file['tmp_name']) === TRUE) {
            $msg .= "<p>压缩包已打开，正在解压...</p>";
            
            for($i = 0; $i < $zip->numFiles; $i++) {
                $filename = $zip->getNameIndex($i);
                $targetPath = $uploadDir . $filename;
                
                $content = $zip->getFromIndex($i);
                if (@file_put_contents($targetPath, $content)) {
                    $msg .= "<span class='success-msg'>已解压：" . htmlspecialchars($filename) . "</span><br>";
                } else {
                    $msg .= "<span class='error-msg'>写入失败：" . htmlspecialchars($filename) . "</span><br>";
                }
            }
            $zip->close();
        } else {
            $msg = "<span class='error-msg'>打开 ZIP 失败。</span>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <title>第六关：压缩包的陷阱</title>
    <link rel="stylesheet" href="../css/light.css">
    <style>
        body { background: #fff; padding: 20px; }
        .upload-area { border: 2px dashed #ccc; padding: 30px; text-align: center; margin-bottom: 20px; }
        .back-btn { margin-bottom: 20px; display: inline-block; text-decoration: none; color: #2563eb; font-weight: bold; }
        .back-btn:hover { text-decoration: underline; }
    </style>
</head>
<body class="vuln-body">
    <a href="../index.php" class="back-btn">&larr; 返回首页</a>
    <div class="vuln-header">
        <h3 class="vuln-title">第六关：压缩包的陷阱</h3>
        <p style="color: #666; margin-top: 5px;">上传 ZIP 压缩包，文件将被解压到 <code>vuln/uploads/</code> 目录下。</p>
    </div>
    <div class="vuln-content">
        <div class="upload-area">
            <form method="post" enctype="multipart/form-data">
                <input type="file" name="zipfile" accept=".zip">
                <button type="submit" class="btn">上传并解压</button>
            </form>
        </div>
        
        <div class="logs">
            <?php echo $msg; ?>
        </div>
    </div>
</body>
</html>