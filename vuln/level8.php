<?php
// Level 8: The Cookie Monster
error_reporting(0);

// Vulnerability: The file path is taken from a COOKIE, not GET/POST.
// Many WAFs/Scanners overlook cookies.
$file = isset($_COOKIE['file_path']) ? $_COOKIE['file_path'] : 'intro.txt';

// If cookie is not set, set it for the user
if (!isset($_COOKIE['file_path'])) {
    setcookie('file_path', 'intro.txt', time() + 3600, "/");
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
        <h3 class="vuln-title">Session Viewer v8.0</h3>
        <p style="color: #666; margin-top: 5px;">We remember your preferences using secure cookies.</p>
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
