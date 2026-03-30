<?php
// Level 4: The Art of Truncation
error_reporting(0);
$file = isset($_GET['file']) ? $_GET['file'] : 'intro';

// Backend Logic: Force .html extension
// The developer thinks: "I will just append .html, so they can never read .txt files!"
$filepath = $file . '.html';

// VULNERABILITY SIMULATION (Null Byte Injection)
// Modern PHP (>= 5.3.4) fixed Null Byte Poisoning.
// To teach this classic technique, we simulate the behavior of old PHP versions.
// In old PHP/C, a string ended at \0 (Null Byte). 
// So 'file.txt\0.html' was treated as 'file.txt'.

if (strpos($file, "\0") !== false) {
    // Simulate truncation: Stop reading at the null byte
    $filepath = substr($file, 0, strpos($file, "\0"));
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
        <h3 class="vuln-title">Legacy Note Reader v4.0</h3>
        <p style="color: #666; margin-top: 5px;">Security: System forces <code>.html</code> extension on all requests.</p>
    </div>
    <div class="vuln-content">
<?php
    // Debug info
    // echo "Input: " . htmlspecialchars($file) . "<br>";
    // echo "Target: " . htmlspecialchars($filepath) . "<br>";

    if (file_exists($filepath)) {
        include($filepath);
    } else {
        echo "<span class='error-msg'>Error: File '$filepath' not found.</span>";
    }
?>
    </div>
</body>
</html>
