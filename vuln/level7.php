<?php
// Level 7: LFI to RCE
error_reporting(0);
$file = isset($_GET['file']) ? $_GET['file'] : 'intro.txt';

// SIMULATE ACCESS LOGGING
// In a real scenario, this would be Apache/Nginx access.log
// Here we log the User-Agent to a local file to allow the attack simulation.
$logFile = 'logs/access.log';
// Ensure directory exists
if (!is_dir('logs')) mkdir('logs');

$userAgent = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : 'Unknown';
$logEntry = "[" . date('Y-m-d H:i:s') . "] IP:" . $_SERVER['REMOTE_ADDR'] . " UA:" . $userAgent . "\n";
file_put_contents($logFile, $logEntry, FILE_APPEND);

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
        <h3 class="vuln-title">Debug Console v7.0</h3>
        <p style="color: #666; margin-top: 5px;">System monitors User-Agent strings for debugging. Local file inclusion allowed for report viewing.</p>
    </div>
    <div class="vuln-content">
<?php
    // The Vulnerability: Standard LFI
    // But this time, there are no interesting files to read (flags are hidden/randomized in a real scenario).
    // The goal is RCE.
    
    // Hint displayed in HTML comment
    // <!-- Debug Log Location: logs/access.log -->
    
    if (file_exists($file)) {
        include($file);
    } else {
        echo "<span class='error-msg'>Error: File '$file' not found.</span>";
    }
?>
    </div>
</body>
</html>
