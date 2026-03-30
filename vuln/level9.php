<?php
// Level 9: The Case of the Filter
error_reporting(0);
$file = isset($_GET['file']) ? $_GET['file'] : 'intro.txt';

// Filter: Blocks "flags" keyword to prevent reading flags.
// Vulnerability: On Windows, the filesystem is CASE INSENSITIVE.
// "flags" != "FlAgS", so the check passes.
// But the OS treats "FlAgS" as "flags" and opens the file.

if (strpos($file, 'flags') !== false) {
    die("<span class='error-msg'>Security Alert: Access to 'flags' directory is strictly prohibited!</span>");
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
        <h3 class="vuln-title">Strict Content Filter v9.0</h3>
        <p style="color: #666; margin-top: 5px;">Security: Keyword blocking enabled. 'flags' is blacklisted.</p>
    </div>
    <div class="vuln-content">
<?php
    if (file_exists($file)) {
        include($file);
    } else {
        echo "<span class='error-msg'>Error: File not found.</span>";
    }
?>
    </div>
</body>
</html>
