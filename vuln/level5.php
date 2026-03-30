<?php
// Level 5: The Path Limit
error_reporting(0);
$file = isset($_GET['file']) ? $_GET['file'] : 'intro';

// Backend Logic: Force .html extension
// Similar to Level 4, but Null Bytes are filtered or fixed.
// The only way is to overflow the OS path limit.
$file = str_replace(chr(0), '', $file); // Null bytes are gone!
$filepath = $file . '.html';

// VULNERABILITY SIMULATION (Path Truncation)
// Windows MAX_PATH is typically 260 characters. Linux is usually 4096.
// In older PHP versions on Windows, if a path exceeded MAX_PATH, 
// the extension part might get truncated if not handled correctly by the filesystem API,
// OR the system normalizes "././" but the string length check happens before normalization?
// Actually, the classic attack is:
// file.txt/././././././[...]/./././.html
// The OS normalizes /./ away, but if the string passed to the internal C function is too long,
// it might truncate.
// Since we are on modern PHP/Windows, we have to SIMULATE this behavior.

// Simulation: If the path length > 256 (arbitrary limit for this lab), 
// we assume the underlying system truncated the end.
$MAX_SIMULATED_PATH = 256;

if (strlen($filepath) > $MAX_SIMULATED_PATH) {
    // Check if the user is trying to read a valid file "buried" in the noise
    // The user input might be: ../../flags/flag5.txt/././././././././
    // We normalize the path manually to check if it points to a real file
    
    // Simple simulation: 
    // 1. Remove the forced .html extension (simulating truncation)
    // 2. Check if the remaining path (normalized) points to a file
    
    $truncated = substr($filepath, 0, $MAX_SIMULATED_PATH);
    
    // If the truncation cut off the '.html' completely or partially
    // For this lab, let's say if the user provided enough padding, we just ignore the .html
    // To make it realistic-ish:
    // If input ends with many /././ or similar, we treat it as the base file.
    
    // Let's strip the noise for the simulation
    $clean_path = str_replace(['/./', '\\.\\'], '', $file);
    
    // If the user spammed ./././ to reach length > 256
    if (file_exists($clean_path)) {
        include($clean_path);
        exit;
    }
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
        <h3 class="vuln-title">Secure Reader v5.0</h3>
        <p style="color: #666; margin-top: 5px;">Security: Null bytes filtered. Extension forced.</p>
    </div>
    <div class="vuln-content">
<?php
    if (file_exists($filepath)) {
        include($filepath);
    } else {
        echo "<span class='error-msg'>Error: File '$filepath' not found.</span>";
        // echo "<br>Debug: Length is " . strlen($filepath);
    }
?>
    </div>
</body>
</html>
