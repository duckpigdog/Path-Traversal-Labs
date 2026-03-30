<?php
// Main Dashboard - Clean Light Theme
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Path Traversal Labs</title>
    <link rel="stylesheet" href="css/light.css">
</head>
<body>
    <div class="container">
        <header class="dashboard-header">
            <h1 class="dashboard-title">Path Traversal Labs</h1>
            <p class="dashboard-subtitle">Master file inclusion vulnerabilities in a secure, controlled environment.</p>
        </header>

        <div class="grid">
            <!-- Level 1 -->
            <div class="card">
                <div class="card-header">
                    <span class="difficulty-badge diff-easy">Easy</span>
                    <h2 class="card-title">Level 1: The Naked Parameter</h2>
                </div>
                <div class="card-body">
                    <p class="card-text">
                        The application accepts raw user input without any validation. This is the most basic form of Local File Inclusion (LFI).
                    </p>
                    <p class="card-text">
                        <strong>Goal:</strong> Traverse directories to find system files.<br>
                        <strong>Target:</strong> <span class="code-snippet">C:\Windows\win.ini</span>
                    </p>
                    <div class="card-footer">
                        <a href="view.php?id=1" class="btn-primary">Start Lab</a>
                    </div>
                </div>
            </div>

            <!-- Level 2 -->
            <div class="card">
                <div class="card-header">
                    <span class="difficulty-badge diff-easy">Easy</span>
                    <h2 class="card-title">Level 2: The Naive Filter</h2>
                </div>
                <div class="card-body">
                    <p class="card-text">
                        The developer attempts to block traversal by removing <span class="code-snippet">../</span> sequences. However, <span class="code-snippet">str_replace</span> is not recursive.
                    </p>
                    <p class="card-text">
                        <strong>Goal:</strong> Bypass the single-pass filter using double writing.<br>
                        <strong>Target:</strong> <span class="code-snippet">flag2.txt</span>
                    </p>
                    <div class="card-footer">
                        <a href="view.php?id=2" class="btn-primary">Start Lab</a>
                    </div>
                </div>
            </div>

            <!-- Level 3 -->
            <div class="card">
                <div class="card-header">
                    <span class="difficulty-badge diff-medium">Medium</span>
                    <h2 class="card-title">Level 3: The Encoding Disguise</h2>
                </div>
                <div class="card-body">
                    <p class="card-text">
                        A strict WAF blocks all requests containing <span class="code-snippet">.</span> or <span class="code-snippet">/</span>. But does it understand encoded data?
                    </p>
                    <p class="card-text">
                        <strong>Goal:</strong> Use Double URL Encoding to bypass the WAF.<br>
                        <strong>Target:</strong> <span class="code-snippet">flag3.txt</span>
                    </p>
                    <div class="card-footer">
                        <a href="view.php?id=3" class="btn-primary">Start Lab</a>
                    </div>
                </div>
            </div>

            <!-- Level 4 -->
            <div class="card">
                <div class="card-header">
                    <span class="difficulty-badge diff-medium">Medium</span>
                    <h2 class="card-title">Level 4: The Art of Truncation</h2>
                </div>
                <div class="card-body">
                    <p class="card-text">
                        The system enforces a <span class="code-snippet">.html</span> extension. You need to read a <span class="code-snippet">.txt</span> file.
                    </p>
                    <p class="card-text">
                        <strong>Goal:</strong> Use Null Byte Injection to truncate the path.<br>
                        <strong>Target:</strong> <span class="code-snippet">flag4.txt</span>
                    </p>
                    <div class="card-footer">
                        <a href="view.php?id=4" class="btn-primary">Start Lab</a>
                    </div>
                </div>
            </div>

            <!-- Level 5 -->
            <div class="card">
                <div class="card-header">
                    <span class="difficulty-badge diff-hard">Hard</span>
                    <h2 class="card-title">Level 5: The Path Limit</h2>
                </div>
                <div class="card-body">
                    <p class="card-text">
                        Forced extension is back, but Null Bytes are filtered. We need to use the operating system's limitations against it.
                    </p>
                    <p class="card-text">
                        <strong>Goal:</strong> Overflow the MAX_PATH limit.<br>
                        <strong>Target:</strong> <span class="code-snippet">flag5.txt</span>
                    </p>
                    <div class="card-footer">
                        <a href="view.php?id=5" class="btn-primary">Start Lab</a>
                    </div>
                </div>
            </div>

            <!-- Level 6 -->
            <div class="card">
                <div class="card-header">
                    <span class="difficulty-badge diff-hard">Hard</span>
                    <h2 class="card-title">Level 6: Zip Slip</h2>
                </div>
                <div class="card-body">
                    <p class="card-text">
                        A file upload feature that extracts ZIP archives. If the extraction logic is flawed, it can write files anywhere.
                    </p>
                    <p class="card-text">
                        <strong>Goal:</strong> Upload a malicious ZIP to write a WebShell.<br>
                        <strong>Target:</strong> Write to <span class="code-snippet">vuln/shell.php</span>
                    </p>
                    <div class="card-footer">
                        <a href="view.php?id=6" class="btn-primary">Start Lab</a>
                    </div>
                </div>
            </div>

            <!-- Level 7 -->
            <div class="card">
                <div class="card-header">
                    <span class="difficulty-badge diff-hard">Expert</span>
                    <h2 class="card-title">Level 7: LFI to RCE</h2>
                </div>
                <div class="card-body">
                    <p class="card-text">
                        Standard LFI, but no interesting files to read. You must find a way to execute code on the server.
                    </p>
                    <p class="card-text">
                        <strong>Goal:</strong> Log Poisoning or php://filter chains.<br>
                        <strong>Target:</strong> RCE to read <span class="code-snippet">flag7.txt</span>
                    </p>
                    <div class="card-footer">
                        <a href="view.php?id=7" class="btn-primary">Start Lab</a>
                    </div>
                </div>
            </div>

            <!-- Level 8 -->
            <div class="card">
                <div class="card-header">
                    <span class="difficulty-badge diff-medium">Medium</span>
                    <h2 class="card-title">Level 8: The Hidden Cookie</h2>
                </div>
                <div class="card-body">
                    <p class="card-text">
                        The page seems static and has no URL parameters. But is it really? Check your browser's storage.
                    </p>
                    <p class="card-text">
                        <strong>Goal:</strong> Manipulate the Cookie value.<br>
                        <strong>Target:</strong> <span class="code-snippet">flag8.txt</span>
                    </p>
                    <div class="card-footer">
                        <a href="view.php?id=8" class="btn-primary">Start Lab</a>
                    </div>
                </div>
            </div>

            <!-- Level 9 -->
            <div class="card">
                <div class="card-header">
                    <span class="difficulty-badge diff-medium">Medium</span>
                    <h2 class="card-title">Level 9: The Case of Windows</h2>
                </div>
                <div class="card-body">
                    <p class="card-text">
                        The application blacklists specific keywords like "flags". But the underlying OS might be more forgiving.
                    </p>
                    <p class="card-text">
                        <strong>Goal:</strong> Bypass keyword filter using case sensitivity.<br>
                        <strong>Target:</strong> <span class="code-snippet">flag9.txt</span>
                    </p>
                    <div class="card-footer">
                        <a href="view.php?id=9" class="btn-primary">Start Lab</a>
                    </div>
                </div>
            </div>

            <!-- Level 10 -->
            <div class="card">
                <div class="card-header">
                    <span class="difficulty-badge diff-hard">Hard</span>
                    <h2 class="card-title">Level 10: The Absolute Truth</h2>
                </div>
                <div class="card-body">
                    <p class="card-text">
                        The application rejects all relative paths. You must use an <strong>Absolute Path</strong>.
                    </p>
                    <p class="card-text">
                        <strong>Goal:</strong> Read a system file using its full path.<br>
                        <strong>Target:</strong> <span class="code-snippet">/etc/passwd</span> or <span class="code-snippet">C:\Windows\win.ini</span>
                    </p>
                    <div class="card-footer">
                        <a href="view.php?id=10" class="btn-primary">Start Lab</a>
                    </div>
                </div>
            </div>
            <!-- Level 11 -->
            <div class="card">
                <div class="card-header">
                    <span class="difficulty-badge diff-hard">Hard</span>
                    <h2 class="card-title">Level 11: The Required Prefix</h2>
                </div>
                <div class="card-body">
                    <p class="card-text">
                        The application requires all file paths to start with a specific trusted directory.
                    </p>
                    <p class="card-text">
                        <strong>Goal:</strong> Bypass the prefix check.<br>
                        <strong>Payload Form:</strong> <span class="code-snippet">/var/www/images/../../../etc/passwd</span>
                    </p>
                    <div class="card-footer">
                        <a href="view.php?id=11" class="btn-primary">Start Lab</a>
                    </div>
                </div>
            </div>
            <!-- Level 12 -->
            <div class="card">
                <div class="card-header">
                    <span class="difficulty-badge diff-hard">Hard</span>
                    <h2 class="card-title">Level 12: The PNG Validator</h2>
                </div>
                <div class="card-body">
                    <p class="card-text">
                        The application strictly validates the file extension. It must end with <code>.png</code>.
                    </p>
                    <p class="card-text">
                        <strong>Goal:</strong> Bypass the extension check.<br>
                        <strong>Payload Form:</strong> <span class="code-snippet">../../../etc/passwd%00.png</span>
                    </p>
                    <div class="card-footer">
                        <a href="view.php?id=12" class="btn-primary">Start Lab</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
