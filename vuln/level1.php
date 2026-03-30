<?php
// Level 1: The Naked Parameter
error_reporting(0);
$file = isset($_GET['file']) ? $_GET['file'] : 'intro.txt';
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../css/light.css">
    <style>
        body { background: #fff; padding: 20px; }
    </style>
</head>
<body class="vuln-body">
    <div class="vuln-header">
        <h3 class="vuln-title">File Viewer System</h3>
        <p style="color: #666; margin-top: 5px;">Currently viewing: <strong><?php echo htmlspecialchars($file); ?></strong></p>
    </div>
    <div class="vuln-content">
<?php
    // VULNERABILITY: Direct include without sanitization
    if (file_exists($file)) {
        include($file);
    } else {
        echo "<span class='error-msg'>Error: File '$file' not found.</span>";
    }
?>
    </div>
</body>
</html>
