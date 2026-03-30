<?php
// Level 3: The Encoding Disguise
error_reporting(0);
$file = isset($_GET['file']) ? $_GET['file'] : 'intro.txt';

// The Filter: Simulated WAF
// It decodes the input ONCE automatically (PHP does this).
// Then it checks for dangerous characters like '.' or '/' in the decoded string.
// VULNERABILITY: If the attacker Double URL Encodes (%252e%252e%252f),
// PHP decodes it once -> %2e%2e%2f.
// The filter checks %2e%2e%2f -> No '.' or '/' found -> PASS.
// Then the application (in this specific vulnerable scenario) decides to decode AGAIN 
// or simply passes it to a function that might handle it (like include in some configs, 
// but here we simulate the 'Double Decode' vulnerability by explicitly decoding again 
// before use, which mimics some middleware/WAF bypass scenarios).

// Step 1: Filter Check (Simulated WAF)
if (preg_match('/[\.\/]/', $file)) {
    die("<span class='error-msg'>WAF Alert: Malicious characters detected!</span>");
}

// Step 2: The Vulnerable Application Logic
// The application thinks: "Maybe the user sent encoded data for valid reasons, let me decode it to use it."
$decoded_file = urldecode($file);

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
        <h3 class="vuln-title">Secure Image Viewer v3.0</h3>
        <p style="color: #666; margin-top: 5px;">Security: Advanced WAF detects and blocks <code>.</code> and <code>/</code> characters.</p>
    </div>
    <div class="vuln-content">
<?php
    // Debug info for educational purposes
    // echo "Input: " . htmlspecialchars($file) . "<br>";
    // echo "Decoded: " . htmlspecialchars($decoded_file) . "<br>";

    if (file_exists($decoded_file)) {
        include($decoded_file);
    } else {
        echo "<span class='error-msg'>Error: File not found.</span>";
    }
?>
    </div>
</body>
</html>
