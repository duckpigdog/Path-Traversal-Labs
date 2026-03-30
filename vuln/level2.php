<?php
// Level 2: The Naive Filter
error_reporting(0);
$file = isset($_GET['file']) ? $_GET['file'] : 'intro.txt';

// The Filter: Naively replaces "../" with an empty string
// Vulnerability: str_replace is not recursive. It runs only once.
// If the attacker inputs "....//", the middle "../" is removed, leaving "../" behind.
$file = str_replace('../', '', $file);
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
        <h3 class="vuln-title">Secure Viewer v2.0</h3>
        <p style="color: #666; margin-top: 5px;">Security Patch: <code>../</code> sequences are removed from input.</p>
    </div>
    <div class="vuln-content">
<?php
    if (file_exists($file)) {
        include($file);
    } else {
        echo "<span class='error-msg'>Error: File '$file' not found.</span>";
    }
?>
    </div>
</body>
</html>
