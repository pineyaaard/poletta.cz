<?php
session_start();
$l = isset($_SESSION['lang']) ? $_SESSION['lang'] : 'cs';
$texts = [
    'cs' => ['h' => 'Poptávka <span>odeslána.</span>', 'p' => 'Děkujeme za váš zájem. Ozveme se vám co nejdříve.', 'b' => 'Zpět'],
    'en' => ['h' => 'Request <span>sent.</span>', 'p' => 'Thank you. We will contact you shortly.', 'b' => 'Back'],
    'ru' => ['h' => 'Заявка <span>отправлена.</span>', 'p' => 'Спасибо. Мы свяжемся с вами в ближайшее время.', 'b' => 'Назад'],
    'uk' => ['h' => 'Заявка <span>відправлена.</span>', 'p' => 'Дякуємо. Ми зв’яжемося з вами найближчим часом.', 'b' => 'Назад']
];
$t = isset($texts[$l]) ? $texts[$l] : $texts['en'];
?>
<!DOCTYPE html>
<html lang="<?= $l ?>">
<head>
    <meta charset="UTF-8"><title>Poletta</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400&family=Playfair+Display:ital,wght@0,400;1,400&display=swap" rel="stylesheet">
    <script>if(localStorage.getItem('theme')==='light')document.documentElement.classList.add('light-mode');</script>
    <style>
        :root{--bg:#050505;--t:#f5f5f5;--m:#888;}html.light-mode{--bg:#fcfcfc;--t:#0a0a0a;--m:#666;}
        body{background:var(--bg);color:var(--t);font-family:'Inter';height:100vh;display:flex;align-items:center;justify-content:center;text-align:center;margin:0;}
        h1{font-family:'Playfair Display';font-size:3.5rem;font-weight:400;} h1 span{font-style:italic;color:var(--m);}
        a{display:inline-block;padding:14px 32px;border:1px solid var(--t);color:var(--t);text-decoration:none;border-radius:40px;text-transform:uppercase;font-size:0.8rem;}
    </style>
</head>
<body>
    <div><h1><?= $t['h'] ?></h1><p style="color:var(--m);margin-bottom:40px"><?= $t['p'] ?></p><a href="index.php"><?= $t['b'] ?></a></div>
</body>
</html>