<?php
session_start();
// ВНИМАНИЕ: Для продакшена измените пароль или вынесите его в config.php
$correct_password = 'YOUR_SECURE_PASSWORD_HERE';

if (isset($_POST['password'])) {
    if ($_POST['password'] === $correct_password) {
        $_SESSION['poletta_admin'] = true;
    } else {
        $error = "Špatné heslo!";
    }
}

if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: admin.php");
    exit();
}

$is_logged_in = isset($_SESSION['poletta_admin']) && $_SESSION['poletta_admin'] === true;
?>
<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Poletta — Admin Panel</title>
    
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-M95KHGGBE5"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
      gtag('config', 'G-M95KHGGBE5');
    </script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&family=Playfair+Display:ital,wght@0,400;1,400&display=swap" rel="stylesheet">
    
    <script>
        if (localStorage.getItem('theme') === 'light') {
            document.documentElement.classList.add('light-mode');
        }
    </script>

    <style>
        :root {
            --bg-color: #050505;
            --text-main: #f5f5f5;
            --text-muted: #888888;
            --border-color: #222222;
        }
        html.light-mode {
            --bg-color: #fcfcfc;
            --text-main: #0a0a0a;
            --text-muted: #666666;
            --border-color: #e5e5e5;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-color);
            color: var(--text-main);
            margin: 0; padding: 0;
            transition: background-color 0.4s ease;
            min-height: 100vh;
            display: flex; align-items: center; justify-content: center;
        }

        .admin-container {
            width: 100%;
            max-width: 1000px;
            padding: 60px 40px;
            position: relative;
        }

        h1 { font-family: 'Playfair Display', serif; font-size: 3rem; font-weight: 400; margin-bottom: 40px; }
        h1 span { font-style: italic; color: var(--text-muted); }

        /* Таблица лидов */
        .leads-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 40px;
            text-align: left;
        }
        .leads-table th {
            text-transform: uppercase;
            font-size: 0.7rem;
            letter-spacing: 0.1em;
            color: var(--text-muted);
            padding: 20px 10px;
            border-bottom: 1px solid var(--border-color);
        }
        .leads-table td {
            padding: 20px 10px;
            border-bottom: 1px solid var(--border-color);
            font-size: 0.9rem;
            font-weight: 300;
        }

        /* Форма входа */
        .login-box {
            max-width: 400px;
            margin: 0 auto;
            text-align: center;
        }
        input[type="password"] {
            width: 100%; padding: 20px 0; background: transparent; border: none;
            border-bottom: 1px solid var(--border-color); color: var(--text-main);
            font-family: inherit; font-size: 1rem; margin-bottom: 30px; outline: none;
        }
        .btn {
            display: inline-block; padding: 16px 36px; border-radius: 40px;
            border: 1px solid var(--text-main); text-decoration: none;
            color: var(--text-main); text-transform: uppercase; font-size: 0.8rem;
            cursor: pointer; background: transparent; transition: 0.4s;
        }
        .btn:hover { background: var(--text-main); color: var(--bg-color); }
        
        .logout-link { color: var(--text-muted); text-decoration: none; font-size: 0.8rem; text-transform: uppercase; }
        .logout-link:hover { color: var(--text-main); }

        /* Мини 3D куб для стиля */
        .scene-mini {
            position: fixed; bottom: 40px; left: 40px; width: 100px; height: 100px;
            perspective: 400px; z-index: -1; opacity: 0.3;
        }
        .cube-mini {
            width: 100%; height: 100%; position: absolute; transform-style: preserve-3d;
            animation: rotate 10s infinite linear;
        }
        .face-mini {
            position: absolute; width: 100px; height: 100px;
            border: 1px solid var(--border-color);
        }
        .f1 { transform: rotateY(0deg) translateZ(50px); }
        .f2 { transform: rotateY(90deg) translateZ(50px); }
        .f3 { transform: rotateX(90deg) translateZ(50px); }
        @keyframes rotate { from { transform: rotateX(0) rotateY(0); } to { transform: rotateX(360deg) rotateY(360deg); } }
    </style>
</head>
<body>

    <div class="scene-mini"><div class="cube-mini"><div class="face-mini f1"></div><div class="face-mini f2"></div><div class="face-mini f3"></div></div></div>

    <div class="admin-container">
        <?php if (!$is_logged_in): ?>
            <div class="login-box">
                <h1>Poletta <span>Admin.</span></h1>
                <?php if (isset($error)) echo "<p style='color:#ef4444; font-size:0.8rem;'>$error</p>"; ?>
                <form method="POST">
                    <input type="password" name="password" placeholder="Heslo" required>
                    <button type="submit" class="btn">Přihlásit se</button>
                </form>
            </div>
        <?php else: ?>
            <div style="display:flex; justify-content:space-between; align-items:flex-end; margin-bottom: 40px;">
                <h1>Leady <span>Poletta.</span></h1>
                <a href="?logout=1" class="logout-link">Odhlásit se</a>
            </div>
            
            <table class="leads-table">
                <thead>
                    <tr>
                        <th>Datum</th>
                        <th>E-mail</th>
                        <th>Služba / Zpráva</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $file_path = "poletta_leads_99x.csv";
                    if (file_exists($file_path)) {
                        $file = fopen($file_path, "r");
                        $rows = [];
                        while (($data = fgetcsv($file)) !== FALSE) {
                            $rows[] = $data;
                        }
                        // Показываем последние лиды сверху
                        foreach (array_reverse($rows) as $row) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row[0]) . "</td>";
                            echo "<td>" . htmlspecialchars($row[1]) . "</td>";
                            echo "<td>" . htmlspecialchars($row[2] ?? '') . "</td>";
                            echo "</tr>";
                        }
                        fclose($file);
                    } else {
                        echo "<tr><td colspan='3' style='text-align:center;'>Zatím žádné poptávky.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>

</body>
</html>