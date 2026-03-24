<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Poletta — Vývoj webů a automatizace</title>
    
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-XXXXXXXXX"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
      gtag('config', 'G-XXXXXXXXX');
    </script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&family=Playfair+Display:ital,wght@0,400;0,600;1,400&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --bg-color: #050505;
            --text-main: #f5f5f5;
            --text-muted: #888888;
            --border-color: #222222;
        }
        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-color);
            color: var(--text-main);
            line-height: 1.6;
            margin: 0;
            padding: 0;
            -webkit-font-smoothing: antialiased;
            top: 0 !important; 
        }
        .container { max-width: 1000px; margin: 0 auto; padding: 0 40px; position: relative; }
        section { padding: 120px 0; border-bottom: 1px solid var(--border-color); }
        section:last-child { border-bottom: none; }
        
        /* Typography */
        h1, h2, h3 { font-family: 'Playfair Display', serif; font-weight: 400; margin-top: 0; }
        h1 { font-size: 4.5rem; line-height: 1.1; margin-bottom: 30px; letter-spacing: -0.02em; }
        h1 span { font-style: italic; color: var(--text-muted); }
        h2 { font-size: 3rem; margin-bottom: 50px; }
        .subheadline { font-size: 1.1rem; font-weight: 300; color: var(--text-muted); margin-bottom: 50px; max-width: 500px; line-height: 1.8; }
        
        /* Buttons */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background-color: transparent;
            color: var(--text-main);
            text-decoration: none;
            padding: 16px 36px;
            border-radius: 40px;
            font-size: 0.9rem;
            font-weight: 400;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            cursor: pointer;
            border: 1px solid var(--text-main);
            transition: all 0.4s ease;
        }
        .btn:hover { background-color: var(--text-main); color: var(--bg-color); }
        
        /* Cards Grid */
        .grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 30px; }
        @media (max-width: 768px) { 
            .grid-2 { grid-template-columns: 1fr; } 
            h1 { font-size: 3rem; }
            .container { padding: 0 20px; }
        }
        
        .card { 
            background: transparent; 
            border: 1px solid var(--border-color); 
            padding: 40px; 
            transition: border-color 0.4s ease;
        }
        .card:hover { border-color: #666; }
        .card h3 { font-size: 1.8rem; margin-bottom: 15px; }
        .card p { color: var(--text-muted); font-size: 0.95rem; font-weight: 300; margin: 0; }
        .price-tag { 
            display: block; 
            color: var(--text-main); 
            font-family: 'Inter', sans-serif;
            font-weight: 400; 
            margin-top: 30px; 
            font-size: 0.85rem; 
            text-transform: uppercase;
            letter-spacing: 0.05em;
            border-top: 1px solid var(--border-color);
            padding-top: 15px;
        }

        /* Form */
        .contact-form { padding: 0; }
        input[type="text"], input[type="email"], textarea {
            width: 100%; padding: 20px 0; margin-bottom: 30px; border-radius: 0;
            border: none; border-bottom: 1px solid var(--border-color);
            background: transparent; color: var(--text-main);
            box-sizing: border-box; font-family: 'Inter', sans-serif; font-size: 1rem;
            transition: border-color 0.3s;
        }
        input:focus, textarea:focus { outline: none; border-bottom-color: var(--text-main); }
        input::placeholder, textarea::placeholder { color: #555; }
        .honeypot { display: none; }
        
        .checkbox-group { display: flex; align-items: flex-start; gap: 15px; margin-bottom: 40px; }
        .checkbox-group input { margin-top: 4px; accent-color: #fff; }
        .checkbox-group label { font-size: 0.85rem; font-weight: 300; color: var(--text-muted); }
        .checkbox-group a { color: var(--text-main); text-decoration: underline; }

        /* Footer */
        footer { padding: 60px 0; color: var(--text-muted); font-size: 0.85rem; font-weight: 300; }
        .footer-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 40px; }
        .footer-grid h4 { font-family: 'Inter', sans-serif; text-transform: uppercase; letter-spacing: 0.05em; font-size: 0.8rem; color: var(--text-main); margin-bottom: 20px; }
        .footer-grid a { color: var(--text-muted); text-decoration: none; display: block; margin-bottom: 10px; transition: color 0.3s;}
        .footer-grid a:hover { color: var(--text-main); }
        @media (max-width: 600px) { .footer-grid { grid-template-columns: 1fr; } }

        /* Google Translate Widget */
        .goog-te-banner-frame { display: none !important; }
        #google_translate_element { position: absolute; top: 30px; right: 40px; z-index: 10; }
        .goog-te-gadget { color: transparent !important; }
        .goog-te-gadget .goog-te-combo {
            background-color: transparent;
            color: var(--text-muted);
            border: none;
            border-bottom: 1px solid var(--border-color);
            padding: 5px 0;
            font-family: 'Inter', sans-serif;
            font-size: 0.85rem;
            outline: none;
            cursor: pointer;
            text-transform: uppercase;
        }

        /* Animations */
        .anim-fade-up { opacity: 0; transform: translateY(30px); transition: opacity 0.8s ease, transform 0.8s ease; }
        .anim-fade-up.visible { opacity: 1; transform: translateY(0); }
        .delay-1 { transition-delay: 0.1s; }
        .delay-2 { transition-delay: 0.2s; }
    </style>
</head>
<body>

    <div class="container">
        <div id="google_translate_element"></div>

        <section id="hero" style="min-height: 80vh; display: flex; flex-direction: column; justify-content: center;">
            <h1 class="anim-fade-up">Rychlé weby <br><span>& automatizace.</span></h1>
            <p class="subheadline anim-fade-up delay-1">Tvoříme weby, které prodávají, a software, který šetří čas. Bez omáčky, bez zbytečných schůzek a přesně na termín. Doménu a hosting řešíme za vás.</p>
            <div class="anim-fade-up delay-2">
                <a href="#contact" class="btn">Probrat projekt</a>
            </div>
        </section>

        <section id="services">
            <h2 class="anim-fade-up">Služby & Ceník</h2>
            <div class="grid-2">
                <div class="card anim-fade-up">
                    <h3>Landing Pages</h3>
                    <p>Rychlé a konverzní jednostránkové weby pro sběr leadů a prodej. Čistý design, vysoký výkon.</p>
                    <span class="price-tag">od 4 900 Kč</span>
                </div>
                <div class="card anim-fade-up delay-1">
                    <h3>Firemní weby</h3>
                    <p>Moderní prezentační weby pro vaši firmu. Čistý kód a bleskové načítání.</p>
                    <span class="price-tag">od 9 900 Kč</span>
                </div>
                <div class="card anim-fade-up">
                    <h3>E-commerce</h3>
                    <p>Ziskové internetové obchody připravené k prodeji na platformách Shopify nebo Shoptet.</p>
                    <span class="price-tag">od 14 900 Kč</span>
                </div>
                <div class="card anim-fade-up delay-1">
                    <h3>Google Profil</h3>
                    <p>Registrace a optimalizace na Google Mapách, ať vás zákazníci snadno najdou.</p>
                    <span class="price-tag">1 500 Kč</span>
                </div>
                <div class="card anim-fade-up" style="grid-column: 1 / -1;">
                    <h3>Automatizace & Vlastní SW</h3>
                    <p>Píšeme skripty, parsery a interní panely (např. TTTAP), které nahradí ruční rutinu vašich zaměstnanců. Pokud děláte něco 100x denně, my to zautomatizujeme.</p>
                    <span class="price-tag">Individuální nacenění</span>
                </div>
            </div>
        </section>

        <section id="why-us">
            <h2 class="anim-fade-up">Náš přístup</h2>
            <div class="grid-2">
                <div class="card anim-fade-up">
                    <h3 style="font-family: 'Inter', sans-serif; font-size: 1.1rem; text-transform: uppercase; letter-spacing: 0.05em;">Vše v jednom</h3>
                    <p>Nehledáte třetí strany. Doménu, hosting, SSL certifikát i nasazení vyřešíme za vás na klíč.</p>
                </div>
                <div class="card anim-fade-up delay-1">
                    <h3 style="font-family: 'Inter', sans-serif; font-size: 1.1rem; text-transform: uppercase; letter-spacing: 0.05em;">Rychlost</h3>
                    <p>Nepoužíváme pomalé šablony a zbytečné pluginy. Tvoříme čistý kód, díky kterému weby létají.</p>
                </div>
            </div>
        </section>

        <section id="contact">
            <h2 class="anim-fade-up">Začněme projekt</h2>
            <div class="contact-form anim-fade-up delay-1">
                <form action="submit.php" method="POST">
                    <input type="text" name="website" class="honeypot" tabindex="-1" autocomplete="off">
                    
                    <input type="email" name="email" placeholder="Váš e-mail" required>
                    <textarea name="message" rows="3" placeholder="Co potřebujete vytvořit? (Nepovinné)"></textarea>
                    
                    <div class="checkbox-group">
                        <input type="checkbox" name="gdpr" id="gdpr" required>
                        <label for="gdpr">Souhlasím se zpracováním osobních údajů. Více v sekci <a href="gdpr.html" target="_blank">Ochrana osobních údajů</a>.</label>
                    </div>

                    <button type="submit" class="btn">Odeslat poptávku</button>
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
                    <h4>Kontakt</h4>
                    <a href="mailto:order@poletta.cz">order@poletta.cz</a>
                    <a href="tel:+420608485615">+420 608 485 615</a>
                    <a href="https://instagram.com/poletta.cz" target="_blank">Instagram</a>
                </div>
            </div>
            <div style="margin-top: 60px; display: flex; justify-content: space-between; align-items: center; border-top: 1px solid var(--border-color); padding-top: 20px;">
                <span>&copy; 2026 Poletta.</span>
                <div style="display: flex; gap: 20px;">
                    <a href="gdpr.html" style="color: var(--text-muted); text-decoration: none;">GDPR</a>
                    <a href="https://tttap.poletta.cz" style="color: var(--text-muted); text-decoration: none;">TTTAP</a>
                </div>
            </div>
        </footer>
    </div>

    <script type="text/javascript">
        function googleTranslateElementInit() {
          new google.translate.TranslateElement({
              pageLanguage: 'cs',
              includedLanguages: 'en,de,ru,uk,pl,es',
              layout: google.translate.TranslateElement.InlineLayout.SIMPLE,
              autoDisplay: false
          }, 'google_translate_element');
        }

        // Scroll Animation Logic
        document.addEventListener('DOMContentLoaded', () => {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible');
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.1 });

            document.querySelectorAll('.anim-fade-up').forEach(el => observer.observe(el));
        });
    </script>
    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

</body>
</html>