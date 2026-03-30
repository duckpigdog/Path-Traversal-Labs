<?php
// The Interface Wrapper - Clean Version
$id = isset($_GET['id']) ? (int)$_GET['id'] : 1;
$valid_levels = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];
if (!in_array($id, $valid_levels)) {
    header("Location: index.php");
    exit;
}

// Configuration for each level
$levels = [
    1 => [
        'title' => 'Level 1: The Naked Parameter',
        'desc' => 'This is where it all begins. The application takes your input and uses it directly to include a file. No questions asked.',
        'target' => 'vuln/level1.php?file=intro.txt',
        'mission' => 'Access the Windows system file: <code>C:\Windows\win.ini</code>',
        'hint' => 'Try traversing up the directory tree using <code>../</code>. Windows system files are usually in <code>C:\Windows\</code>.'
    ],
    2 => [
        'title' => 'Level 2: The Naive Filter',
        'desc' => 'The developer tries to secure the app by removing <code>../</code> sequences using <code>str_replace()</code>. However, this replacement only happens once.',
        'target' => 'vuln/level2.php?file=intro.txt',
        'mission' => 'Read the flag file: <code>../../flags/flag2.txt</code>',
        'hint' => '<strong>Double Writing Bypass:</strong> What happens if you nest the traversal sequences? Try <code>....//</code> or <code>..././</code>. When the inner <code>../</code> is removed, the outer parts might join together.'
    ],
    3 => [
        'title' => 'Level 3: The Encoding Disguise',
        'desc' => 'A strict WAF is deployed. It inspects your input and immediately blocks any request containing <code>.</code> or <code>/</code> characters.',
        'target' => 'vuln/level3.php?file=intro.txt',
        'mission' => 'Read <code>../../flags/flag3.txt</code>',
        'hint' => '<strong>Double URL Encoding:</strong> The WAF checks the input <em>after</em> the first decode. But what if the application decodes it again? Try encoding <code>../</code> twice. <br><code>.</code> -> <code>%2e</code> -> <code>%252e</code>'
    ],
    4 => [
        'title' => 'Level 4: The Art of Truncation',
        'desc' => 'The system enforces a <code>.html</code> extension. It takes your input and appends <code>.html</code> to it (e.g., <code>file</code> becomes <code>file.html</code>).',
        'target' => 'vuln/level4.php?file=intro',
        'mission' => 'Read <code>../../flags/flag4.txt</code>',
        'hint' => '<strong>Null Byte Injection:</strong> In older systems (and this simulated lab), strings are terminated by a Null Byte (<code>\0</code> or URL encoded as <code>%00</code>). If you inject this character, the system might stop reading the path right there, ignoring the appended extension.'
    ],
    5 => [
        'title' => 'Level 5: The Path Limit',
        'desc' => 'The system enforces a <code>.html</code> extension and filters Null Bytes. It seems secure, but operating systems have limits on how long a file path can be.',
        'target' => 'vuln/level5.php?file=intro',
        'mission' => 'Read <code>../../flags/flag5.txt</code>',
        'hint' => '<strong>Path Truncation:</strong> Windows paths have a limit (MAX_PATH). If you provide a path longer than this limit (e.g., using <code>./././</code> repeatedly), the system might truncate the string, effectively cutting off the appended <code>.html</code> extension.'
    ],
    6 => [
        'title' => 'Level 6: Zip Slip (The Archive Attack)',
        'desc' => 'The system allows you to upload and extract ZIP files. It claims to extract them safely to an <code>uploads/</code> directory.',
        'target' => 'vuln/level6.php',
        'mission' => 'Write a file named <code>shell.php</code> into the <code>vuln/</code> root directory (one level up from uploads).',
        'hint' => '<strong>Zip Slip:</strong> ZIP archives can contain files with names like <code>../shell.php</code>. If the extractor doesn\'t validate filenames, it will blindly write the file outside the intended directory. Use a tool to create such a malicious zip.'
    ],
    7 => [
        'title' => 'Level 7: LFI to RCE',
        'desc' => 'A classic LFI vulnerability. But there are no sensitive files to read. You need to achieve Remote Code Execution (RCE) to read the flag.',
        'target' => 'vuln/level7.php?file=intro.txt',
        'mission' => 'Execute code to read <code>../../flags/flag7.txt</code>',
        'hint' => '<strong>Log Poisoning:</strong> The system logs your User-Agent to <code>logs/access.log</code>. Can you inject PHP code into your User-Agent and then include the log file?<br><strong>Alternative:</strong> Try <code>php://filter</code> chains if you know the magic.'
    ],
    8 => [
        'title' => 'Level 8: The Hidden Cookie',
        'desc' => 'The URL looks clean. No parameters? Check your storage.',
        'target' => 'vuln/level8.php',
        'mission' => 'Read <code>../../flags/flag8.txt</code>',
        'hint' => '<strong>Cookie Poisoning:</strong> Developers sometimes use Cookies to store template names or paths. Inspect the HTTP request headers or use Developer Tools (F12) -> Application -> Cookies to modify the <code>file_path</code> cookie.'
    ],
    9 => [
        'title' => 'Level 9: The Case of Windows',
        'desc' => 'The system explicitly blocks the keyword <code>flags</code>. How can you access the folder if you can\'t type it?',
        'target' => 'vuln/level9.php?file=intro.txt',
        'mission' => 'Read <code>../../flags/flag9.txt</code>',
        'hint' => '<strong>Case Insensitivity:</strong> You are running on a Windows server. Windows file systems (NTFS/FAT) are case-insensitive. <code>flags</code> is the same as <code>FlAgS</code>. But the PHP string check might be case-sensitive.'
    ],
    10 => [
        'title' => 'Level 10: The Absolute Truth',
        'desc' => 'The system blocks all relative paths (<code>../</code>) and forces you to use Absolute Paths.',
        'target' => 'vuln/level10.php', // Default will be set by PHP script itself if empty
        'mission' => 'Read <code>/etc/passwd</code> (Linux) or <code>C:\Windows\win.ini</code> (Windows) using absolute path.',
        'hint' => '<strong>Absolute Paths Only:</strong> The application rejects anything that doesn\'t start with <code>/</code> or a drive letter (<code>C:\</code>). Find the full path to the flag file on the server. The page leaks the current directory.'
    ],
    11 => [
        'title' => 'Level 11: The Required Prefix',
        'desc' => 'The system enforces a strict path validation. You can only access files that start with the secure images directory path.',
        'target' => 'vuln/level11.php',
        'mission' => 'Read <code>../../flags/flag11.txt</code> (starting from the required prefix)',
        'hint' => '<strong>Prefix Bypass:</strong> The application checks if your input starts with the required directory (e.g., <code>/var/www/images/</code>). But it doesn\'t check what comes <em>after</em> that. Start with the valid prefix, then traverse back up using <code>../</code>.'
    ],
    12 => [
        'title' => 'Level 12: The PNG Validator',
        'desc' => 'The system ensures that only files ending with <code>.png</code> are processed. It seems secure.',
        'target' => 'vuln/level12.php?file=welcome.png',
        'mission' => 'Read <code>../../flags/flag12.txt</code>',
        'hint' => '<strong>Null Byte Extension Bypass:</strong> The check <code>substr($file, -4) === ".png"</code> is flawed if the underlying system stops reading at a Null Byte (<code>\0</code>). Append <code>%00.png</code> to satisfy the check, but access the file before the null byte.'
    ]
];

$current = $levels[$id];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lab <?php echo $id; ?> - Path Traversal</title>
    <link rel="stylesheet" href="css/light.css">
</head>
<body>

    <div class="lab-container">
        <div class="sidebar">
            <a href="index.php" class="back-btn">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="margin-right: 8px;">
                    <path d="M19 12H5M12 19l-7-7 7-7"/>
                </svg>
                Back to Home
            </a>
            
            <h2><?php echo $current['title']; ?></h2>
            <p><?php echo $current['desc']; ?></p>
            
            <div class="mission-box">
                <span class="mission-title">Mission Objective</span>
                <div style="font-size: 0.9rem; color: #333;">
                    <?php echo $current['mission']; ?>
                </div>
            </div>

            <button onclick="toggleHint()" class="hint-toggle">Need a hint?</button>
            <div id="hint-box" class="hint-box">
                <?php echo $current['hint']; ?>
            </div>
        </div>

        <div class="game-window">
            <div class="url-bar">
                <span class="url-label">GET</span>
                <input type="text" id="urlInput" class="url-input" value="<?php echo $current['target']; ?>">
                <button onclick="navigate()" class="btn">Send Request</button>
            </div>
            <iframe id="vulnFrame" src="<?php echo $current['target']; ?>"></iframe>
        </div>
    </div>

    <script>
        function toggleHint() {
            var h = document.getElementById('hint-box');
            h.style.display = h.style.display === 'block' ? 'none' : 'block';
        }

        function navigate() {
            var url = document.getElementById('urlInput').value;
            // Basic check to prevent breaking out of iframe for Level 6 POST
            if (url.indexOf('level6.php') !== -1) {
                document.getElementById('vulnFrame').src = url;
            } else {
                document.getElementById('vulnFrame').src = url;
            }
        }

        document.getElementById('urlInput').addEventListener('keypress', function (e) {
            if (e.key === 'Enter') {
                navigate();
            }
        });
    </script>
</body>
</html>
