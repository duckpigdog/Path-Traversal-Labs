<?php
// Level 12: The PNG Validator
error_reporting(0);

$file = isset($_GET['file']) ? $_GET['file'] : 'welcome.png';

// The developer only allows files with .png extension
// But forgets that strings in low-level OS calls are null-terminated.
// And they forget that PHP (older versions) passed strings directly to C functions.

// Check if file ends with .png
if (substr($file, -4) !== '.png') {
    die("<span class='error-msg'>Security Alert: Only PNG images are allowed! File must end with .png</span>");
}

// SIMULATE NULL BYTE TRUNCATION (for educational purposes)
// In vulnerable PHP (< 5.3.4), include("file.php\0.png") would include "file.php".
// The trailing .png satisfies the check above, but the OS ignores it due to the null byte.
$real_file = $file;
if (strpos($file, "\0") !== false) {
    $real_file = substr($file, 0, strpos($file, "\0"));
}

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
        <h3 class="vuln-title">Secure Image Loader v12.0</h3>
        <p style="color: #666; margin-top: 5px;">Security: Strict extension validation. Only .png files are processed.</p>
    </div>
    <div class="vuln-content">
<?php
    // Vulnerability: Bypass extension check using Null Byte
    // The check substr($file, -4) === '.png' passes because the string ends with .png
    // But the include() function (simulated) stops at the null byte.
    
    if (file_exists($real_file)) {
        // For this lab, we just cat the file content if it's text, or include if it's PHP
        $ext = pathinfo($real_file, PATHINFO_EXTENSION);
        if (in_array($ext, ['txt', 'php', 'ini'])) {
            if ($ext == 'php') {
                include($real_file);
            } else {
                echo "<pre>" . htmlspecialchars(file_get_contents($real_file)) . "</pre>";
            }
        } else {
            // Probably an image or binary
            echo "File included: " . htmlspecialchars($real_file);
        }
    } else {
        echo "<span class='error-msg'>Error: File not found.</span>";
    }
?>
    </div>
</body>
</html>