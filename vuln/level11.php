<?php
// Level 11: The Required Prefix
error_reporting(0);

// Define the required base path (Absolute Path to images folder)
$base_path = __DIR__ . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR;

// Default file
$file = isset($_GET['file']) ? $_GET['file'] : $base_path . 'logo.txt';

// Filter: Strict Prefix Check
// The developer ensures the path starts with the trusted directory.
// But they forgot that valid paths can contain traversal characters!
if (strpos($file, $base_path) !== 0) {
    die("<span class='error-msg'>Security Alert: Access restricted! File path must start with: <br><code>" . htmlspecialchars($base_path) . "</code></span>");
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
        <h3 class="vuln-title">Secure Image Viewer v11.0</h3>
        <p style="color: #666; margin-top: 5px;">Security: We only allow accessing files inside our secure images folder.</p>
        <p style="font-size: 0.8em; color: #999;">Required Prefix: <?php echo htmlspecialchars($base_path); ?></p>
    </div>
    <div class="vuln-content">
<?php
    // Vulnerability: The application checks the prefix but doesn't sanitize the rest of the path.
    // You can start with the valid prefix and then traverse back up.
    
    if (file_exists($file)) {
        // Simple file extension check for display (optional, just for realism)
        $ext = pathinfo($file, PATHINFO_EXTENSION);
        if ($ext === 'txt') {
            echo "<pre>" . htmlspecialchars(file_get_contents($file)) . "</pre>";
        } else {
            // For other files, just say included (or actually include if PHP)
            include($file);
        }
    } else {
        echo "<span class='error-msg'>Error: File not found.</span>";
    }
?>
    </div>
</body>
</html>