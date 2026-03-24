<?php
session_start();
require_once 'config.php'; // Подключаем скрытые настройки

// Обработка входа
if (isset($_POST['password'])) {
    if ($_POST['password'] === ADMIN_PASSWORD) {
        $_SESSION['poletta_admin'] = true;
    } else {
        $error = "Špatné heslo!";
    }
}

// Обработка выхода
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
    <title>Poletta Admin Panel</title>
    <style>
        body { font-family: sans-serif; background: #050505; color: white; padding: 20px; }
        .container { max-width: 800px; margin: 0 auto; background: #111; padding: 30px; border-radius: 10px; border: 1px solid #333;}
        input { padding: 12px; width: 100%; margin-bottom: 15px; box-sizing: border-box; background: #000; border: 1px solid #333; color: white;}
        button { padding: 12px; background: #f5f5f5; color: #000; border: none; font-weight: bold; width: 100%; cursor: pointer;}
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 10px; border-bottom: 1px solid #333; text-align: left; }
        a { color: #f5f5f5; }
    </style>
</head>
<body>
<div class="container">
    <?php if (!$is_logged_in): ?>
        <h2>Poletta Admin Access</h2>
        <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
        <form method="POST">
            <input type="password" name="password" placeholder="Heslo" required>
            <button type="submit">Přihlásit</button>
        </form>
    <?php else: ?>
        <div style="display:flex; justify-content:space-between; align-items:center;">
            <h2>Poptávky (Leady)</h2>
            <a href="?logout=1" style="color:#ef4444; text-decoration:none;">Odhlásit</a>
        </div>
        <table>
            <tr>
                <th>Datum</th>
                <th>E-mail</th>
                <th>Zpráva</th>
            </tr>
            <?php
            if (file_exists(LEADS_FILE)) {
                $file = fopen(LEADS_FILE, "r");
                while (($data = fgetcsv($file)) !== FALSE) {
                    echo "<tr><td>" . htmlspecialchars($data[0]) . "</td><td>" . htmlspecialchars($data[1]) . "</td><td>" . htmlspecialchars($data[2] ?? '') . "</td></tr>";
                }
                fclose($file);
            } else {
                echo "<tr><td colspan='3'>Zatím žádné poptávky.</td></tr>";
            }
            ?>
        </table>
    <?php endif; ?>
</div>
</body>
</html>