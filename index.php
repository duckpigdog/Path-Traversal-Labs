<?php
// Main Dashboard - Clean Light Theme
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>路径遍历漏洞靶场</title>
    <link rel="stylesheet" href="css/light.css">
</head>
<body>
    <div class="container">
        <header class="dashboard-header">
            <h1 class="dashboard-title">路径遍历漏洞靶场</h1>
            <p class="dashboard-subtitle">在受控环境中学习并掌握文件包含与路径遍历漏洞。</p>
        </header>

        <div class="grid">
            <!-- Level 1 -->
            <div class="card">
                <div class="card-header">
                    <span class="difficulty-badge diff-easy">简单</span>
                    <h2 class="card-title">第一关：裸奔的参数</h2>
                </div>
                <div class="card-body">
                    <p class="card-text">
                        没有任何过滤，直接接收用户输入并包含文件。
                    </p>
                    <div class="card-footer">
                        <a href="vuln/level1.php?file=intro.txt" class="btn-primary">进入关卡</a>
                    </div>
                </div>
            </div>

            <!-- Level 2 -->
            <div class="card">
                <div class="card-header">
                    <span class="difficulty-badge diff-easy">简单</span>
                    <h2 class="card-title">第二关：天真的替换</h2>
                </div>
                <div class="card-body">
                    <p class="card-text">
                        尝试使用单次替换来过滤目录穿越字符。
                    </p>
                    <div class="card-footer">
                        <a href="vuln/level2.php?file=intro.txt" class="btn-primary">进入关卡</a>
                    </div>
                </div>
            </div>

            <!-- Level 3 -->
            <div class="card">
                <div class="card-header">
                    <span class="difficulty-badge diff-medium">中等</span>
                    <h2 class="card-title">第三关：编码的伪装</h2>
                </div>
                <div class="card-body">
                    <p class="card-text">
                        拦截了明文的目录穿越字符，尝试使用编码绕过。
                    </p>
                    <div class="card-footer">
                        <a href="vuln/level3.php?file=intro.txt" class="btn-primary">进入关卡</a>
                    </div>
                </div>
            </div>

            <!-- Level 4 -->
            <div class="card">
                <div class="card-header">
                    <span class="difficulty-badge diff-medium">中等</span>
                    <h2 class="card-title">第四关：截断的艺术</h2>
                </div>
                <div class="card-body">
                    <p class="card-text">
                        强制拼接了 .html 后缀，利用 %00 截断绕过。
                    </p>
                    <div class="card-footer">
                        <a href="vuln/level4.php?file=intro" class="btn-primary">进入关卡</a>
                    </div>
                </div>
            </div>

            <!-- Level 5 -->
            <div class="card">
                <div class="card-header">
                    <span class="difficulty-badge diff-hard">困难</span>
                    <h2 class="card-title">第五关：路径的极限</h2>
                </div>
                <div class="card-body">
                    <p class="card-text">
                        强制拼接后缀且过滤了空字节，利用系统最大路径长度限制绕过。
                    </p>
                    <div class="card-footer">
                        <a href="vuln/level5.php?file=intro" class="btn-primary">进入关卡</a>
                    </div>
                </div>
            </div>

            <!-- Level 6 -->
            <div class="card">
                <div class="card-header">
                    <span class="difficulty-badge diff-hard">困难</span>
                    <h2 class="card-title">第六关：压缩包的陷阱</h2>
                </div>
                <div class="card-body">
                    <p class="card-text">
                        Zip Slip 漏洞，上传恶意的 ZIP 压缩包实现目录穿越写文件。
                    </p>
                    <div class="card-footer">
                        <a href="vuln/level6.php" class="btn-primary">进入关卡</a>
                    </div>
                </div>
            </div>

            <!-- Level 7 -->
            <div class="card">
                <div class="card-header">
                    <span class="difficulty-badge diff-expert">专家</span>
                    <h2 class="card-title">第七关：日志投毒</h2>
                </div>
                <div class="card-body">
                    <p class="card-text">
                        结合文件包含与服务器访问日志，实现远程代码执行 (RCE)。
                    </p>
                    <div class="card-footer">
                        <a href="vuln/level7.php?file=intro.txt" class="btn-primary">进入关卡</a>
                    </div>
                </div>
            </div>

            <!-- Level 8 -->
            <div class="card">
                <div class="card-header">
                    <span class="difficulty-badge diff-medium">中等</span>
                    <h2 class="card-title">第八关：隐藏的参数</h2>
                </div>
                <div class="card-body">
                    <p class="card-text">
                        参数不在 URL 中，检查你的 Cookie。
                    </p>
                    <div class="card-footer">
                        <a href="vuln/level8.php" class="btn-primary">进入关卡</a>
                    </div>
                </div>
            </div>

            <!-- Level 9 -->
            <div class="card">
                <div class="card-header">
                    <span class="difficulty-badge diff-medium">中等</span>
                    <h2 class="card-title">第九关：大小写的秘密</h2>
                </div>
                <div class="card-body">
                    <p class="card-text">
                        过滤了特定关键字，利用 Windows 文件系统不区分大小写的特性绕过。
                    </p>
                    <div class="card-footer">
                        <a href="vuln/level9.php?file=intro.txt" class="btn-primary">进入关卡</a>
                    </div>
                </div>
            </div>

            <!-- Level 10 -->
            <div class="card">
                <div class="card-header">
                    <span class="difficulty-badge diff-hard">困难</span>
                    <h2 class="card-title">第十关：绝对的真理</h2>
                </div>
                <div class="card-body">
                    <p class="card-text">
                        封锁了所有相对路径，必须使用绝对路径。
                    </p>
                    <div class="card-footer">
                        <a href="vuln/level10.php" class="btn-primary">进入关卡</a>
                    </div>
                </div>
            </div>

            <!-- Level 11 -->
            <div class="card">
                <div class="card-header">
                    <span class="difficulty-badge diff-hard">困难</span>
                    <h2 class="card-title">第十一关：前缀的限制</h2>
                </div>
                <div class="card-body">
                    <p class="card-text">
                        强制校验了目录前缀，尝试绕过前缀限制读取文件。
                    </p>
                    <div class="card-footer">
                        <a href="vuln/level11.php" class="btn-primary">进入关卡</a>
                    </div>
                </div>
            </div>

            <!-- Level 12 -->
            <div class="card">
                <div class="card-header">
                    <span class="difficulty-badge diff-hard">困难</span>
                    <h2 class="card-title">第十二关：后缀的欺骗</h2>
                </div>
                <div class="card-body">
                    <p class="card-text">
                        严格校验了文件扩展名，利用截断特性绕过后缀检查。
                    </p>
                    <div class="card-footer">
                        <a href="vuln/level12.php" class="btn-primary">进入关卡</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</body>
</html>