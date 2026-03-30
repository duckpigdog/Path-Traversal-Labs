<?php
// Level 10: The Absolute Truth
error_reporting(0);
$file = isset($_GET['file']) ? $_GET['file'] : __DIR__ . '/intro.txt';

// Filter: Enforce Absolute Paths ONLY
// We block any path that doesn't look like an absolute path.
// Linux/Unix: Starts with /
// Windows: Starts with Drive Letter (e.g., C:\)
if (!preg_match('/^(\/|[a-zA-Z]:\\\\)/', $file)) {
    die("<span class='error-msg'>Security Alert: Only absolute paths are allowed! (e.g., /etc/passwd or C:\Windows\win.ini)</span>");
}

// Hint: Leaking the current directory
$current_dir = __DIR__;

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
        <h3 class="vuln-title">Absolute File Manager v10.0</h3>
        <p style="color: #666; margin-top: 5px;">Security: Relative paths are blocked. You must know exactly what you want.</p>
        <p style="font-size: 0.8em; color: #999;">System Root: <?php echo htmlspecialchars($current_dir); ?></p>
    </div>
    <div class="vuln-content">
<?php
    // Vulnerability: include() accepts absolute paths (e.g. C:\Windows\win.ini or /etc/passwd)
    // The filter only allows paths that start with / or [A-Z]:\
    // You must provide the full path to the file.
    
    // Hint: The flag is located at the project root + flags/flag10.txt
    // We already know the current directory: <?php echo __DIR__; ?>
    
    if (file_exists($file)) {
        include($file);
    } else {
        echo "<span class='error-msg'>Error: File not found.</span>";
    }
?>
    </div>
</body>
</html>
