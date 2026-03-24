<?php
session_start();
if (isset($_GET['lang'])) {
    $_SESSION['lang'] = $_GET['lang'];
}
$l = isset($_SESSION['lang']) ? $_SESSION['lang'] : 'cs';

$lang_file = "lang/{$l}.php";
if (file_exists($lang_file)) {
    $t = include $lang_file;
} else {
    $t = [];
}
?>
<!DOCTYPE html>
<html lang="<?= $l ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Poletta Digital Lab - Rychlé weby a automatizace">
    <title><?= $t['title'] ?? 'Poletta — Digital Lab & Vývoj webů' ?></title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&family=Playfair+Display:ital,wght@0,400;0,600;1,400&display=swap" rel="stylesheet" media="print" onload="this.media='all'">
    <noscript><link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&family=Playfair+Display:ital,wght@0,400;0,600;1,400&display=swap"></noscript>
    
    <script>
        if (localStorage.getItem('theme') === 'light') { document.documentElement.classList.add('light-mode'); }
    </script>

    <style>
        :root {
            --bg-color: #050505; --text-main: #f5f5f5; --text-muted: #888888; --border-color: #222222;
            --shape-border: rgba(255, 255, 255, 0.15); --shape-bg: rgba(10, 10, 10, 0.5); --shape-glow: rgba(255, 255, 255, 0.05);
        }
        html.light-mode {
            --bg-color: #fcfcfc; --text-main: #0a0a0a; --text-muted: #666666; --border-color: #e5e5e5;
            --shape-border: rgba(0, 0, 0, 0.15); --shape-bg: rgba(240, 240, 240, 0.5); --shape-glow: rgba(0, 0, 0, 0.05);
        }
        ::-webkit-scrollbar { width: 6px; } ::-webkit-scrollbar-track { background: var(--bg-color); }
        ::-webkit-scrollbar-thumb { background: #333; border-radius: 10px; } ::-webkit-scrollbar-thumb:hover { background: var(--text-muted); }

        body { font-family: 'Inter', sans-serif; background-color: var(--bg-color); color: var(--text-main); line-height: 1.6; margin: 0; padding: 0; transition: background-color 0.4s ease; overflow-x: hidden; -webkit-font-smoothing: antialiased; }

        .scene { position: fixed; top: 20%; right: 5%; width: 500px; height: 500px; perspective: 1200px; z-index: -1; pointer-events: none; transition: transform 0.1s linear; will-change: transform; }
        .cube { position: absolute; transform-style: preserve-3d; top: 50%; left: 50%; will-change: transform; }
        .cube-outer { width: 400px; height: 400px; margin: -200px 0 0 -200px; animation: rotate1 40s infinite linear; }
        .cube-mid { width: 240px; height: 240px; margin: -120px 0 0 -120px; animation: rotate2 25s infinite linear reverse; }
        .cube-inner { width: 100px; height: 100px; margin: -50px 0 0 -50px; animation: rotate3 15s infinite linear; }
        .face { position: absolute; width: 100%; height: 100%; border: 1px solid var(--shape-border); background: var(--shape-bg); backdrop-filter: blur(2px); box-shadow: inset 0 0 60px var(--shape-glow); transition: border-color 0.4s ease, background 0.4s ease; will-change: transform; }
        .cube-outer .front { transform: rotateY(0deg) translateZ(200px); } .cube-outer .back { transform: rotateY(180deg) translateZ(200px); }
        .cube-outer .right { transform: rotateY(90deg) translateZ(200px); } .cube-outer .left { transform: rotateY(-90deg) translateZ(200px); }
        .cube-outer .top { transform: rotateX(90deg) translateZ(200px); } .cube-outer .bottom { transform: rotateX(-90deg) translateZ(200px); }
        .cube-mid .front { transform: rotateY(0deg) translateZ(120px); } .cube-mid .back { transform: rotateY(180deg) translateZ(120px); }
        .cube-mid .right { transform: rotateY(90deg) translateZ(120px); } .cube-mid .left { transform: rotateY(-90deg) translateZ(120px); }
        .cube-mid .top { transform: rotateX(90deg) translateZ(120px); } .cube-mid .bottom { transform: rotateX(-90deg) translateZ(120px); }
        .cube-inner .front { transform: rotateY(0deg) translateZ(50px); background: var(--text-main); opacity: 0.1; } .cube-inner .back { transform: rotateY(180deg) translateZ(50px); background: var(--text-main); opacity: 0.1;}
        .cube-inner .right { transform: rotateY(90deg) translateZ(50px); background: var(--text-main); opacity: 0.1;} .cube-inner .left { transform: rotateY(-90deg) translateZ(50px); background: var(--text-main); opacity: 0.1;}
        .cube-inner .top { transform: rotateX(90deg) translateZ(50px); background: var(--text-main); opacity: 0.1;} .cube-inner .bottom { transform: rotateX(-90deg) translateZ(50px); background: var(--text-main); opacity: 0.1;}
        @keyframes rotate1 { 0% { transform: rotateX(0deg) rotateY(0deg); } 100% { transform: rotateX(360deg) rotateY(360deg); } }
        @keyframes rotate2 { 0% { transform: rotateX(45deg) rotateY(0deg); } 100% { transform: rotateX(405deg) rotateY(-360deg); } }
        @keyframes rotate3 { 0% { transform: rotateX(0deg) rotateY(45deg); } 100% { transform: rotateX(360deg) rotateY(405deg); } }
        
        @media (max-width: 1000px) { 
            .scene { right: -150px; opacity: 0.3; transform: scale(0.6); top: 10%; } 
            .face { backdrop-filter: none; box-shadow: none; }
        }

        header { position: fixed; top: 0; left: 0; right: 0; display: flex; justify-content: space-between; align-items: center; padding: 20px 40px; background: rgba(5, 5, 5, 0.7); backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px); border-bottom: 1px solid var(--border-color); z-index: 1000; transition: background 0.4s ease; }
        html.light-mode header { background: rgba(252, 252, 252, 0.8); }
        .logo { text-decoration: none; color: var(--text-main); font-family: 'Playfair Display', serif; font-size: 1.4rem; line-height: 1; z-index: 1002; position: relative; }
        .logo span { display: block; font-family: 'Inter', sans-serif; font-size: 0.65rem; text-transform: uppercase; letter-spacing: 0.15em; color: var(--text-muted); margin-top: 4px; }
        
        .main-nav { display: flex; gap: 30px; }
        .main-nav a { text-decoration: none; color: var(--text-muted); font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.1em; transition: color 0.3s; font-weight: 600; }
        .main-nav a:hover { color: var(--text-main); }
        
        .header-controls { display: flex; gap: 20px; align-items: center; z-index: 1002; position: relative; }
        .lang-switch { display: flex; gap: 10px; }
        .lang-switch a { text-decoration: none; font-size: 0.75rem; font-weight: 600; text-transform: uppercase; color: var(--text-muted); transition: color 0.3s; }
        .lang-switch a:hover, .lang-switch a.active { color: var(--text-main); }
        .theme-toggle { cursor: pointer; background: none; border: 1px solid var(--border-color); color: var(--text-main); padding: 4px 10px; border-radius: 4px; font-size: 0.7rem; text-transform: uppercase; transition: 0.3s; }
        .theme-toggle:hover { border-color: var(--text-main); }
        
        .hamburger { display: none; background: none; border: none; color: var(--text-main); font-size: 1.8rem; cursor: pointer; padding: 0; line-height: 1; z-index: 1002; position: relative; }

        @media (max-width: 900px) { 
            header { padding: 15px 20px; flex-direction: column; gap: 15px; } 
            .logo { text-align: center; width: 100%; }
            .logo span { margin: 4px auto 0; }
            .hamburger { display: block; }
            .header-controls { width: 100%; justify-content: space-between; margin: 0; }
            .lang-switch { gap: 8px; }
            .lang-switch a { font-size: 0.7rem; }
            .main-nav { 
                position: fixed; top: 0; left: 0; width: 100%; height: 100vh; 
                background: var(--bg-color); flex-direction: column; justify-content: center; align-items: center; 
                gap: 40px; transform: translateY(-100%); transition: transform 0.4s ease-in-out; z-index: 1001; 
                opacity: 0; pointer-events: none;
            }
            .main-nav.active { transform: translateY(0); opacity: 1; pointer-events: auto; }
            .main-nav a { font-size: 1.2rem; }
        }

        .container { max-width: 1000px; margin: 0 auto; padding: 100px 40px 0 40px; position: relative; }
        section { padding: 120px 0; border-bottom: 1px solid var(--border-color); }
        section:last-child { border-bottom: none; }
        h1, h2, h3 { font-family: 'Playfair Display', serif; font-weight: 400; margin-top: 0; }
        h1 { font-size: 4.5rem; line-height: 1.1; margin-bottom: 30px; letter-spacing: -0.02em; }
        h1 span { font-style: italic; color: var(--text-muted); }
        h2 { font-size: 3rem; margin-bottom: 50px; }
        .subheadline { font-size: 1.1rem; font-weight: 300; color: var(--text-muted); margin-bottom: 50px; max-width: 500px; line-height: 1.8; }
        .btn { display: inline-flex; align-items: center; justify-content: center; background-color: transparent; color: var(--text-main); text-decoration: none; padding: 16px 36px; border-radius: 40px; font-size: 0.9rem; text-transform: uppercase; border: 1px solid var(--text-main); transition: all 0.4s ease; cursor: pointer; }
        .btn:hover { background-color: var(--text-main); color: var(--bg-color); }
        .grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 30px; }
        @media (max-width: 768px) { .grid-2 { grid-template-columns: 1fr; } h1 { font-size: 3rem; } .container { padding: 100px 20px 0 20px; } }
        
        .card { background: transparent; border: 1px solid var(--border-color); padding: 40px; transition: border-color 0.4s ease, transform 0.3s ease; z-index: 10; position: relative; cursor: pointer; }
        .card:hover { border-color: var(--text-main); transform: translateY(-5px); }
        .card h3 { font-size: 1.8rem; margin-bottom: 15px; }
        .card p { color: var(--text-muted); font-size: 0.95rem; font-weight: 300; margin: 0; }
        .price-tag { display: block; color: var(--text-main); font-family: 'Inter', sans-serif; margin-top: 30px; font-size: 0.85rem; text-transform: uppercase; border-top: 1px solid var(--border-color); padding-top: 15px; }
        .card-hint { margin-top: 20px; font-size: 0.8rem; text-transform: uppercase; color: var(--text-muted); font-weight: 600; display: inline-flex; align-items: center; gap: 5px; transition: color 0.3s; }
        .card:hover .card-hint { color: var(--text-main); }

        .modal-overlay { position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0, 0, 0, 0.85); backdrop-filter: blur(8px); z-index: 3000; display: flex; justify-content: center; align-items: center; opacity: 0; pointer-events: none; transition: opacity 0.4s ease; padding: 20px; }
        html.light-mode .modal-overlay { background: rgba(255, 255, 255, 0.85); }
        .modal-overlay.active { opacity: 1; pointer-events: auto; }
        .modal-content { background: var(--bg-color); border: 1px solid var(--border-color); padding: 50px 40px; max-width: 600px; width: 100%; border-radius: 12px; position: relative; transform: translateY(30px); transition: transform 0.4s ease; }
        .modal-overlay.active .modal-content { transform: translateY(0); }
        .modal-close { position: absolute; top: 20px; right: 20px; background: none; border: none; font-size: 2rem; color: var(--text-muted); cursor: pointer; line-height: 1; transition: color 0.3s; }
        .modal-close:hover { color: var(--text-main); }
        .modal-content h3 { font-size: 2rem; margin-bottom: 20px; margin-top: 0; }
        .modal-content p { color: var(--text-muted); font-size: 1rem; margin-bottom: 15px; font-weight: 300; }
        .modal-content ul { color: var(--text-muted); font-size: 1rem; font-weight: 300; padding-left: 20px; margin-bottom: 25px; }
        .modal-content li { margin-bottom: 10px; }
        .modal-note { font-size: 0.85rem; padding: 15px; border-radius: 8px; background: rgba(136, 136, 136, 0.1); color: var(--text-main); margin-top: 20px; border-left: 3px solid var(--text-main); }

        .contact-form { padding: 0; position: relative; z-index: 10;}
        input[type="text"], input[type="email"], select { width: 100%; padding: 20px 0; margin-bottom: 30px; border-radius: 0; border: none; border-bottom: 1px solid var(--border-color); background: transparent; color: var(--text-main); box-sizing: border-box; font-family: 'Inter', sans-serif; font-size: 1rem; transition: border-color 0.3s; appearance: none; }
        input:focus, select:focus { outline: none; border-bottom-color: var(--text-main); }
        input::placeholder { color: #555; }
        select option { background-color: var(--bg-color); color: var(--text-main); }
        .honeypot { display: none; }
        .checkbox-group { display: flex; align-items: flex-start; gap: 15px; margin-bottom: 40px; }
        .checkbox-group input { margin-top: 4px; accent-color: #fff; }
        .checkbox-group label { font-size: 0.85rem; font-weight: 300; color: var(--text-muted); }
        a { text-decoration: none; color: inherit; }
        .checkbox-group a { color: var(--text-main); text-decoration: underline; }

        .float-widgets { position: fixed; bottom: 30px; right: 30px; display: flex; flex-direction: column; gap: 10px; z-index: 999; }
        .float-btn { width: 45px; height: 45px; border-radius: 50%; border: 1px solid var(--border-color); background: var(--bg-color); color: var(--text-main); display: flex; align-items: center; justify-content: center; text-decoration: none; transition: all 0.3s ease; cursor: pointer; }
        .float-btn:hover { background: var(--text-main); color: var(--bg-color); border-color: var(--text-main); }
        #up-btn { opacity: 0; pointer-events: none; font-family: 'Inter', sans-serif; font-weight: 600; font-size: 1.2rem; }

        footer { padding: 60px 0; color: var(--text-muted); font-size: 0.85rem; font-weight: 300; position: relative; z-index: 10;}
        .footer-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 40px; }
        .footer-grid h4 { font-family: 'Inter', sans-serif; text-transform: uppercase; font-size: 0.8rem; color: var(--text-main); margin-bottom: 20px; }
        .footer-grid a { color: var(--text-muted); text-decoration: none; display: block; margin-bottom: 10px; transition: color 0.3s;}
        .footer-grid a:hover { color: var(--text-main); }

        .anim-fade-up { opacity: 0; transform: translateY(30px); transition: opacity 0.8s ease, transform 0.8s ease; }
        .anim-fade-up.visible { opacity: 1; transform: translateY(0); }
    </style>
</head>
<body>

    <div class="scene" id="parallax-shape">
        <div class="cube cube-outer">
            <div class="face front"></div><div class="face back"></div><div class="face right"></div><div class="face left"></div><div class="face top"></div><div class="face bottom"></div>
        </div>
        <div class="cube cube-mid">
            <div class="face front"></div><div class="face back"></div><div class="face right"></div><div class="face left"></div><div class="face top"></div><div class="face bottom"></div>
        </div>
        <div class="cube cube-inner">
            <div class="face front"></div><div class="face back"></div><div class="face right"></div><div class="face left"></div><div class="face top"></div><div class="face bottom"></div>
        </div>
    </div>

    <header>
        <a href="#hero" class="logo">poletta.cz<span>digital lab</span></a>
        <nav class="main-nav" id="mobile-nav">
            <a href="#hero" onclick="closeMenu()"><?= $t['nav_home'] ?? 'Home' ?></a>
            <a href="#services" onclick="closeMenu()"><?= $t['nav_serv'] ?? 'Služby' ?></a>
            <a href="#cases" onclick="closeMenu()"><?= $t['nav_cases'] ?? 'Zkušenosti' ?></a>
            <a href="#why-us" onclick="closeMenu()"><?= $t['nav_appr'] ?? 'Přístup' ?></a>
            <a href="#contact" onclick="closeMenu()"><?= $t['nav_cont'] ?? 'Kontakt' ?></a>
            <a href="gdpr.php">GDPR</a>
        </nav>
        <div class="header-controls">
            <div class="lang-switch">
                <a href="?lang=cs" class="<?= $l == 'cs' ? 'active' : '' ?>">CS</a>
                <a href="?lang=en" class="<?= $l == 'en' ? 'active' : '' ?>">EN</a>
                <a href="?lang=de" class="<?= $l == 'de' ? 'active' : '' ?>">DE</a>
                <a href="?lang=ru" class="<?= $l == 'ru' ? 'active' : '' ?>">RU</a>
                <a href="?lang=uk" class="<?= $l == 'uk' ? 'active' : '' ?>">UK</a>
            </div>
            <button class="theme-toggle" onclick="toggleTheme()" id="theme-btn">Light</button>
            <button class="hamburger" onclick="toggleMenu()">☰</button>
        </div>
    </header>

    <div class="float-widgets">
        <button id="up-btn" class="float-btn" onclick="scrollToTop()" title="Nahoru">&uarr;</button>
    </div>

    <div class="container">
        <section id="hero" style="min-height: 85vh; display: flex; flex-direction: column; justify-content: center;">
            <h1 class="anim-fade-up"><?= $t['hero_h1'] ?? 'Vytváříme <span>budoucnost</span>' ?></h1>
            <p class="subheadline anim-fade-up"><?= $t['hero_sub'] ?? 'Od elegantních landing pages po složité e-commerce systémy.' ?></p>
            <div class="anim-fade-up">
                <a href="#contact" class="btn"><?= $t['btn_proj'] ?? 'Probrat projekt' ?></a>
            </div>
        </section>

        <section id="services">
            <h2 class="anim-fade-up"><?= $t['serv_h2'] ?? 'Služby' ?></h2>
            <div class="grid-2">
                <div class="card anim-fade-up" onclick="openModal('modal-landing')">
                    <h3><?= $t['s1_h3'] ?? 'Landing pages' ?></h3>
                    <p><?= $t['s1_p'] ?? 'Rychlé weby' ?></p>
                    <span class="price-tag"><?= $t['s1_pr'] ?? 'od 4 900 Kč' ?></span>
                    <div class="card-hint"><?= $t['btn_details'] ?? 'Více &rarr;' ?></div>
                </div>
                <div class="card anim-fade-up" onclick="openModal('modal-corp')">
                    <h3><?= $t['s2_h3'] ?? 'Firemní weby' ?></h3>
                    <p><?= $t['s2_p'] ?? 'Reprezentativní weby' ?></p>
                    <span class="price-tag"><?= $t['s2_pr'] ?? 'od 9 900 Kč' ?></span>
                    <div class="card-hint"><?= $t['btn_details'] ?? 'Více &rarr;' ?></div>
                </div>
                <div class="card anim-fade-up" onclick="openModal('modal-ecom')">
                    <h3><?= $t['s3_h3'] ?? 'E-commerce' ?></h3>
                    <p><?= $t['s3_p'] ?? 'E-shopy' ?></p>
                    <span class="price-tag"><?= $t['s3_pr'] ?? 'od 14 900 Kč' ?></span>
                    <div class="card-hint"><?= $t['btn_details'] ?? 'Více &rarr;' ?></div>
                </div>
                <div class="card anim-fade-up" onclick="openModal('modal-auto')">
                    <h3><?= $t['s5_h3'] ?? 'Automatizace' ?></h3>
                    <p><?= $t['s5_p'] ?? 'Nahradíme rutinu' ?></p>
                    <span class="price-tag"><?= $t['s5_pr'] ?? 'Individuálně' ?></span>
                    <div class="card-hint"><?= $t['btn_details'] ?? 'Více &rarr;' ?></div>
                </div>
                <div class="card anim-fade-up" onclick="openModal('modal-google')">
                    <h3><?= $t['s4_h3'] ?? 'Google Profil' ?></h3>
                    <p><?= $t['s4_p'] ?? 'Optimalizace na mapách' ?></p>
                    <span class="price-tag"><?= $t['s4_pr'] ?? '1 500 Kč' ?></span>
                    <div class="card-hint"><?= $t['btn_details'] ?? 'Více &rarr;' ?></div>
                </div>
            </div>
        </section>

        <section id="cases">
            <h2 class="anim-fade-up"><?= $t['cases_h2'] ?? 'Zkušenosti' ?></h2>
            <div class="card anim-fade-up" style="background: var(--shape-bg); border-color: var(--shape-border);">
                <h3 style="font-family: 'Inter', sans-serif; font-size: 1.2rem; text-transform: uppercase;"><?= $t['cases_h3'] ?? 'Proč zde není portfolio?' ?></h3>
                <p style="margin-bottom: 20px; font-size: 1.05rem; line-height: 1.7;">
                    <?= $t['cases_p1'] ?? 'Nepřetěžujeme web' ?>
                </p>
                <p style="font-size: 1.05rem; line-height: 1.7;">
                    <?= $t['cases_p2'] ?? 'Máme desítky úspěšných projektů' ?>
                </p>
                <a href="#contact" class="btn" style="margin-top: 30px;"><?= $t['cases_btn'] ?? 'Vyžádat si ukázky' ?></a>
            </div>
        </section>

        <section id="why-us">
            <h2 class="anim-fade-up"><?= $t['appr_h2'] ?? 'Proč my?' ?></h2>
            <div class="grid-2">
                <div class="card anim-fade-up" onclick="openModal('modal-approach')">
                    <h3 style="font-family: 'Inter', sans-serif; font-size: 1.1rem; text-transform: uppercase;"><?= $t['a1_h3'] ?? 'Vše v jednom' ?></h3>
                    <p><?= $t['a1_p'] ?? 'Řešíme za vás na klíč' ?></p>
                    <div class="card-hint"><?= $t['btn_details'] ?? 'Více &rarr;' ?></div>
                </div>
                <div class="card anim-fade-up" onclick="openModal('modal-speed')">
                    <h3 style="font-family: 'Inter', sans-serif; font-size: 1.1rem; text-transform: uppercase;"><?= $t['a2_h3'] ?? 'Rychlost' ?></h3>
                    <p><?= $t['a2_p'] ?? 'Tvoříme čistý kód' ?></p>
                    <div class="card-hint"><?= $t['btn_details'] ?? 'Více &rarr;' ?></div>
                </div>
            </div>
        </section>

        <section id="contact">
            <h2 class="anim-fade-up"><?= $t['cont_h2'] ?? 'Napište nám' ?></h2>
            <div class="contact-form anim-fade-up">
                <form action="submit.php" method="POST">
                    <input type="text" name="website" class="honeypot" tabindex="-1" autocomplete="off">
                    <input type="email" name="email" placeholder="<?= $t['ph_email'] ?? 'Váš e-mail' ?>" required>
                    <select name="service" required>
                        <option value="" disabled selected><?= $t['sel_def'] ?? 'Co potřebujete?' ?></option>
                        <option value="landing"><?= $t['sel_1'] ?? 'Landing Page / Firemní web' ?></option>
                        <option value="ecommerce"><?= $t['sel_2'] ?? 'E-shop' ?></option>
                        <option value="automation"><?= $t['sel_3'] ?? 'Automatizace' ?></option>
                        <option value="google"><?= $t['sel_4'] ?? 'Google Workspace' ?></option>
                    </select>
                    <div class="checkbox-group">
                        <input type="checkbox" name="gdpr" id="gdpr" required>
                        <label for="gdpr"><?= $t['gdpr_text'] ?? 'Souhlasím s' ?> <a href="gdpr.php"><?= $t['gdpr_link'] ?? 'GDPR' ?></a>.</label>
                    </div>
                    <button type="submit" class="btn" style="width: 100%;"><?= $t['btn_submit'] ?? 'Odeslat' ?></button>
                </form>
            </div>
        </section>

        <footer>
            <div class="footer-grid">
                <div>
                    <h4>Poletta</h4>
                    <p>pineyardcz s.r.o<br>IČO: 19264674<br>Frýdlantská 1312/19, Praha 8</p>
                </div>
                <div>
                    <h4><?= $t['foot_cont'] ?? 'Kontakt' ?></h4>
                    <a href="https://poletta.cz" target="_blank">poletta.cz</a>
                    <a href="https://instagram.com/poletta.cz" target="_blank">INSTAGRAM</a>
                </div>
            </div>
            <div style="margin-top: 60px; display: flex; justify-content: space-between; border-top: 1px solid var(--border-color); padding-top: 20px;">
                <span>&copy; 2026 Poletta.</span>
                <a href="gdpr.php">GDPR</a>
            </div>
        </footer>
    </div>

    <div class="modal-overlay" id="modal-landing" onclick="closeModal(event)">
        <div class="modal-content" onclick="event.stopPropagation()">
            <button class="modal-close" onclick="closeModal()">&times;</button>
            <h3><?= $t['mod_land_title'] ?? 'Landing pages' ?></h3>
            <p><?= $t['mod_land_desc'] ?? 'Čistý kód bez vizuálních editorů.' ?></p>
            <div class="modal-note"><?= $t['mod_land_note'] ?? 'Důležité: doména a hosting se platí zvlášť.' ?></div>
            <p><i><?= $t['mod_land_extra'] ?? '💡 Na vyžádání můžeme web postavit na libovolném řešení.' ?></i></p>
        </div>
    </div>

    <div class="modal-overlay" id="modal-corp" onclick="closeModal(event)">
        <div class="modal-content" onclick="event.stopPropagation()">
            <button class="modal-close" onclick="closeModal()">&times;</button>
            <h3><?= $t['s2_h3'] ?? 'Firemní weby' ?></h3>
            <p><?= $t['mod_corp_desc'] ?? 'Vícestránkové weby pro prezentaci služeb.' ?></p>
            <ul>
                <li><?= $t['mod_corp_l1'] ?? 'Individuální design' ?></li>
                <li><?= $t['mod_corp_l2'] ?? 'Nastavení redakčního systému' ?></li>
                <li><?= $t['mod_corp_l3'] ?? 'Kompletní SEO' ?></li>
            </ul>
        </div>
    </div>

    <div class="modal-overlay" id="modal-ecom" onclick="closeModal(event)">
        <div class="modal-content" onclick="event.stopPropagation()">
            <button class="modal-close" onclick="closeModal()">&times;</button>
            <h3><?= $t['mod_ecom_title'] ?? 'E-commerce' ?></h3>
            <p><?= $t['mod_ecom_desc'] ?? 'E-shopy s platbami a dopravou.' ?></p>
            <ul>
                <li><?= $t['mod_ecom_l1'] ?? 'Integrace se Stripe, GoPay' ?></li>
                <li><?= $t['mod_ecom_l2'] ?? 'Automatizace skladových zásob' ?></li>
            </ul>
        </div>
    </div>

    <div class="modal-overlay" id="modal-auto" onclick="closeModal(event)">
        <div class="modal-content" onclick="event.stopPropagation()">
            <button class="modal-close" onclick="closeModal()">&times;</button>
            <h3><?= $t['mod_auto_title'] ?? 'Automatizace' ?></h3>
            <p><?= $t['mod_auto_desc'] ?? 'Zbavíme vás rutiny.' ?></p>
            <ul>
                <li><?= $t['mod_auto_l1'] ?? 'Telegram boti' ?></li>
                <li><?= $t['mod_auto_l2'] ?? 'Synchronizace CRM s webem' ?></li>
                <li><?= $t['mod_auto_l3'] ?? 'Skripty pro zpracování dat' ?></li>
            </ul>
        </div>
    </div>

    <div class="modal-overlay" id="modal-google" onclick="closeModal(event)">
        <div class="modal-content" onclick="event.stopPropagation()">
            <button class="modal-close" onclick="closeModal()">&times;</button>
            <h3><?= $t['mod_goog_title'] ?? 'Google Workspace' ?></h3>
            <p><?= $t['mod_goog_desc'] ?? 'Profesionální nastavení e-mailu.' ?></p>
            <ul>
                <li><?= $t['mod_goog_l1'] ?? 'E-mail na vlastní doméně' ?></li>
                <li><?= $t['mod_goog_l2'] ?? 'Nastavení SPF, DKIM, DMARC' ?></li>
                <li><?= $t['mod_goog_l3'] ?? 'Optimalizace na mapách' ?></li>
            </ul>
        </div>
    </div>

    <div class="modal-overlay" id="modal-approach" onclick="closeModal(event)">
        <div class="modal-content" onclick="event.stopPropagation()">
            <button class="modal-close" onclick="closeModal()">&times;</button>
            <h3><?= $t['a1_h3'] ?? 'Vše v jednom' ?></h3>
            <p><?= $t['mod_appr_desc'] ?? 'Přebíráme veškerou technickou část.' ?></p>
            <ul>
                <li><?= $t['mod_appr_l1'] ?? 'Registrace domén' ?></li>
                <li><?= $t['mod_appr_l2'] ?? 'Nastavení serverů' ?></li>
                <li><?= $t['mod_appr_l3'] ?? 'Instalace SSL' ?></li>
                <li><?= $t['mod_appr_l4'] ?? 'Pravidelná podpora' ?></li>
            </ul>
        </div>
    </div>

    <div class="modal-overlay" id="modal-speed" onclick="closeModal(event)">
        <div class="modal-content" onclick="event.stopPropagation()">
            <button class="modal-close" onclick="closeModal()">&times;</button>
            <h3><?= $t['a2_h3'] ?? 'Kvalita kódu & Rychlost' ?></h3>
            <p><?= $t['mod_speed_desc'] ?? 'Rychlost jsou peníze.' ?></p>
            <ul>
                <li><?= $t['mod_speed_l1'] ?? 'Hodnocení 90+ v Google PageSpeed' ?></li>
                <li><?= $t['mod_speed_l2'] ?? 'Optimalizované obrázky' ?></li>
                <li><?= $t['mod_speed_l3'] ?? 'Minimální velikost souborů' ?></li>
                <li><?= $t['mod_speed_l4'] ?? 'Odolnost vůči zátěži' ?></li>
            </ul>
        </div>
    </div>

    <script type="text/javascript">
        function toggleTheme() {
            document.documentElement.classList.toggle('light-mode');
            localStorage.setItem('theme', document.documentElement.classList.contains('light-mode') ? 'light' : 'dark');
            document.getElementById('theme-btn').innerText = document.documentElement.classList.contains('light-mode') ? 'Dark' : 'Light';
        }
        function toggleMenu() { document.getElementById('mobile-nav').classList.toggle('active'); }
        function closeMenu() { document.getElementById('mobile-nav').classList.remove('active'); }
        function openModal(id) { document.getElementById(id).classList.add('active'); document.body.style.overflow = 'hidden'; }
        function closeModal(event) {
            if(event && event.target !== event.currentTarget && !event.target.classList.contains('modal-close')) return;
            document.querySelectorAll('.modal-overlay').forEach(m => m.classList.remove('active'));
            document.body.style.overflow = '';
        }
        document.addEventListener('DOMContentLoaded', () => {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => { if (entry.isIntersecting) entry.target.classList.add('visible'); });
            }, { threshold: 0.1 });
            document.querySelectorAll('.anim-fade-up').forEach(el => observer.observe(el));
        });
        window.addEventListener('scroll', () => {
            let upBtn = document.getElementById('up-btn');
            if(window.scrollY > 400) { upBtn.style.opacity = '1'; upBtn.style.pointerEvents = 'auto'; } 
            else { upBtn.style.opacity = '0'; upBtn.style.pointerEvents = 'none'; }
        });
        function scrollToTop() { window.scrollTo({ top: 0, behavior: 'smooth' }); }
    </script>
</body>
</html>