<?php
// Level 6: Zip Slip (The Archive Attack)
error_reporting(0);

$msg = "";
$uploadDir = 'uploads/';

if (isset($_FILES['zipfile'])) {
    $file = $_FILES['zipfile'];
    
    // Check if it is a zip
    $mime = mime_content_type($file['tmp_name']);
    if ($mime !== 'application/zip') {
        $msg = "<span class='error-msg'>Error: Only ZIP files allowed. Detected: $mime</span>";
    } else {
        $zip = new ZipArchive;
        if ($zip->open($file['tmp_name']) === TRUE) {
            $msg .= "<p>Archive opened. Extracting...</p>";
            
            // VULNERABLE EXTRACTION CODE
            // The developer manually iterates and extracts files without checking for traversal characters.
            for($i = 0; $i < $zip->numFiles; $i++) {
                $filename = $zip->getNameIndex($i);
                
                // Educational Note: 
                // A secure implementation would check: if (strpos($filename, '../') !== false) die("Hacking attempt!");
                
                $targetPath = $uploadDir . $filename;
                
                // Simulate extraction (We use file_put_contents to allow writing whatever/wherever the filename says)
                // Note: We suppress errors (@) to avoid clutter if folders don't exist, 
                // but the vulnerability allows creating/overwriting files if the directory exists.
                
                $content = $zip->getFromIndex($i);
                if (@file_put_contents($targetPath, $content)) {
                    $msg .= "<span class='success-msg'>Extracted: " . htmlspecialchars($filename) . "</span><br>";
                } else {
                    $msg .= "<span class='error-msg'>Failed to write: " . htmlspecialchars($filename) . " (Check permissions or path)</span><br>";
                }
            }
            $zip->close();
        } else {
            $msg = "<span class='error-msg'>Failed to open ZIP.</span>";
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../css/light.css">
    <style>
        body { background: #fff; padding: 20px; }
        .upload-area { border: 2px dashed #ccc; padding: 30px; text-align: center; margin-bottom: 20px; }
    </style>
</head>
<body class="vuln-body">
    <div class="vuln-header">
        <h3 class="vuln-title">Archive Manager v1.0</h3>
        <p style="color: #666; margin-top: 5px;">Upload your backup archives (.zip). Files will be extracted to <code>vuln/uploads/</code>.</p>
    </div>
    <div class="vuln-content">
        <div class="upload-area">
            <form method="post" enctype="multipart/form-data">
                <input type="file" name="zipfile" accept=".zip">
                <button type="submit" class="btn">Upload & Extract</button>
            </form>
        </div>
        
        <div class="logs">
            <?php echo $msg; ?>
        </div>
        
        <p style="margin-top: 20px; font-size: 0.9em; color: #888;">
            Hint: If you upload a file named <code>../../shell.php</code> inside the ZIP, where will it go?
        </p>
    </div>
</body>
</html>
