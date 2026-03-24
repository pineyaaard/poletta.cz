<?php
session_start();

// Поддерживаемые языки
$allowed_langs = ['cs', 'en', 'ru', 'de', 'uk'];
$l = (isset($_SESSION['lang']) && in_array($_SESSION['lang'], $allowed_langs)) ? $_SESSION['lang'] : 'cs';

$texts = [
    'cs' => [
        'title' => 'GDPR — Poletta',
        'h' => 'Zásady ochrany osobních údajů',
        'b' => '&larr; Zpět',
        'content' => '
            <p>Správcem vašich osobních údajů je společnost <strong>pineyardcz s.r.o</strong>, IČO: 19264674, se sídlem Frýdlantská 1312/19, Praha 8. Vaše data zpracováváme v přísném souladu s Nařízením EU (GDPR) a zákonem č. 110/2019 Sb., o zpracování osobních údajů.</p>
            
            <h2>1. Jaké údaje zpracováváme a proč?</h2>
            <ul>
                <li><strong>Komunikace a poptávky:</strong> Pokud nás kontaktujete, zpracováváme vaše jméno, e-mail a obsah zprávy pro vyřízení dotazu. Právním základem je jednání o smlouvě nebo oprávněný zájem.</li>
                <li><strong>Analytika webu:</strong> Používáme nástroj Google Analytics k analýze návštěvnosti. Tato data jsou anonymizována a pomáhají nám zlepšovat web.</li>
            </ul>

            <h2>2. Jak dlouho údaje uchováváme?</h2>
            <p>Údaje z poptávek uchováváme pouze po dobu nezbytně nutnou, nejdéle však 1 rok od posledního kontaktu, pokud nedojde k uzavření smlouvy (v takovém případě se řídíme zákonnými lhůtami).</p>

            <h2>3. Kdo má k údajům přístup?</h2>
            <p>Vaše údaje neprodáváme. Přístup k nim máme my a naši prověření zpracovatelé (např. poskytovatel hostingu nebo společnost Google pro analytiku), kteří splňují přísné normy GDPR.</p>

            <h2>4. Vaše práva</h2>
            <p>Podle GDPR máte právo:</p>
            <ul>
                <li>Požadovat přístup ke svým údajům a jejich opravu.</li>
                <li>Požadovat výmaz („právo být zapomenut“), pokud to neodporuje zákonu.</li>
                <li>Vznést námitku proti zpracování.</li>
                <li><strong>Podat stížnost:</strong> Máte právo obrátit se na <strong>Úřad pro ochranu osobních údajů (ÚOOÚ)</strong>, Pplk. Sochora 27, 170 00 Praha 7 (www.uoou.cz).</li>
            </ul>'
    ],
    'en' => [
        'title' => 'Privacy Policy — Poletta',
        'h' => 'Privacy Policy',
        'b' => '&larr; Back',
        'content' => '
            <p>The controller of your personal data is <strong>pineyardcz s.r.o</strong>, IČO: 19264674, registered at Frýdlantská 1312/19, Prague 8. We process your data in strict compliance with the EU Regulation (GDPR) and Czech Act No. 110/2019 Coll., on personal data processing.</p>
            
            <h2>1. What data do we process and why?</h2>
            <ul>
                <li><strong>Communication & Inquiries:</strong> If you contact us, we process your name, email, and message to handle your request based on contract negotiation or legitimate interest.</li>
                <li><strong>Website Analytics:</strong> We use Google Analytics to monitor traffic. This data is anonymized and helps us improve our website.</li>
            </ul>

            <h2>2. How long do we keep your data?</h2>
            <p>We retain inquiry data only as long as necessary, up to 1 year from the last contact, unless a contract is signed (in which case legal retention periods apply).</p>

            <h2>3. Who has access to your data?</h2>
            <p>We do not sell your data. Access is restricted to us and trusted processors (e.g., hosting providers, Google for analytics) who comply with GDPR.</p>

            <h2>4. Your rights</h2>
            <p>Under GDPR, you have the right to:</p>
            <ul>
                <li>Request access to and rectification of your data.</li>
                <li>Request erasure ("right to be forgotten") where legally applicable.</li>
                <li>Object to the processing of your data.</li>
                <li><strong>File a complaint:</strong> You can contact the Czech supervisory authority, <strong>Úřad pro ochranu osobních údajů (ÚOOÚ)</strong>, Pplk. Sochora 27, 170 00 Prague 7 (www.uoou.cz).</li>
            </ul>'
    ],
    'ru' => [
        'title' => 'Конфиденциальность — Poletta',
        'h' => 'Политика конфиденциальности',
        'b' => '&larr; Назад',
        'content' => '
            <p>Контролером ваших персональных данных является компания <strong>pineyardcz s.r.o</strong>, IČO: 19264674, юр. адрес: Frýdlantská 1312/19, Praha 8. Мы обрабатываем данные в строгом соответствии с Регламентом ЕС (GDPR) и Законом ЧР № 110/2019 Sb.</p>
            
            <h2>1. Какие данные мы собираем и зачем?</h2>
            <ul>
                <li><strong>Запросы и связь:</strong> При обращении мы обрабатываем ваше имя, email и текст сообщения для ответа на запрос.</li>
                <li><strong>Аналитика сайта:</strong> Мы используем Google Analytics. Данные анонимизированы и помогают нам улучшать работу сайта.</li>
            </ul>

            <h2>2. Как долго мы храним данные?</h2>
            <p>Мы храним данные запросов не более 1 года с момента последнего контакта, если не был заключен договор (в таком случае действуют сроки хранения по законам ЧР).</p>

            <h2>3. У кого есть доступ к данным?</h2>
            <p>Мы не продаем ваши данные. Доступ имеют только наши сотрудники и проверенные партнеры (хостинг, Google Analytics), соблюдающие GDPR.</p>

            <h2>4. Ваши права</h2>
            <p>Согласно GDPR вы имеете право:</p>
            <ul>
                <li>Запросить доступ к своим данным или их исправление.</li>
                <li>Потребовать удаления данных («право быть забытым»), если это не нарушает закон.</li>
                <li>Возразить против обработки.</li>
                <li><strong>Подать жалобу:</strong> Вы можете обратиться в надзорный орган Чехии — <strong>Úřad pro ochranu osobních údajů (ÚOOÚ)</strong>, Pplk. Sochora 27, 170 00 Praha 7 (www.uoou.cz).</li>
            </ul>'
    ],
    'de' => [
        'title' => 'Datenschutzerklärung — Poletta',
        'h' => 'Datenschutzerklärung',
        'b' => '&larr; Zurück',
        'content' => '
            <p>Der Verantwortliche für Ihre personenbezogenen Daten ist <strong>pineyardcz s.r.o</strong>, IČO: 19264674, mit Sitz in Frýdlantská 1312/19, Prag 8. Wir verarbeiten Ihre Daten streng nach der EU-Verordnung (DSGVO) und dem tschechischen Gesetz Nr. 110/2019 Slg.</p>
            
            <h2>1. Welche Daten verarbeiten wir und warum?</h2>
            <ul>
                <li><strong>Anfragen und Kommunikation:</strong> Wenn Sie uns kontaktieren, verarbeiten Ihren Namen, Ihre E-Mail und Nachricht zur Bearbeitung Ihrer Anfrage.</li>
                <li><strong>Webanalyse:</strong> Wir nutzen Google Analytics. Diese Daten sind anonymisiert und helfen uns, die Website zu verbessern.</li>
            </ul>

            <h2>2. Wie lange speichern wir Ihre Daten?</h2>
            <p>Wir bewahren Anfragedaten nur so lange wie nötig auf, maximal 1 Jahr ab dem letzten Kontakt, sofern kein Vertrag zustande kommt (dann gelten gesetzliche Fristen).</p>

            <h2>3. Wer hat Zugriff auf Ihre Daten?</h2>
            <p>Wir verkaufen Ihre Daten nicht. Zugriff haben nur wir und vertrauenswürdige Auftragsverarbeiter (z. B. Hosting-Anbieter, Google für Analysen), die DSGVO-konform sind.</p>

            <h2>4. Ihre Rechte</h2>
            <p>Nach der DSGVO haben Sie das Recht:</p>
            <ul>
                <li>Auskunft über Ihre Daten und deren Berichtigung zu verlangen.</li>
                <li>Die Löschung zu verlangen ("Recht auf Vergessenwerden"), soweit gesetzlich zulässig.</li>
                <li>Widerspruch gegen die Verarbeitung einzulegen.</li>
                <li><strong>Beschwerde einzureichen:</strong> Sie können sich an die tschechische Aufsichtsbehörde wenden: <strong>Úřad pro ochranu osobních údajů (ÚOOÚ)</strong>, Pplk. Sochora 27, 170 00 Prag 7 (www.uoou.cz).</li>
            </ul>'
    ],
    'uk' => [
        'title' => 'Політика конфіденційності — Poletta',
        'h' => 'Політика конфіденційності',
        'b' => '&larr; Назад',
        'content' => '
            <p>Контролером ваших персональних даних є компанія <strong>pineyardcz s.r.o</strong>, IČO: 19264674, юр. адреса: Frýdlantská 1312/19, Praha 8. Ми обробляємо дані в суворій відповідності до Регламенту ЄС (GDPR) та Закону ЧР № 110/2019 Sb.</p>
            
            <h2>1. Які дані ми збираємо і навіщо?</h2>
            <ul>
                <li><strong>Запити та зв\'язок:</strong> При зверненні ми обробляємо ваше ім\'я, email та текст повідомлення для відповіді на запит.</li>
                <li><strong>Аналітика сайту:</strong> Ми використовуємо Google Analytics. Дані анонімізовані та допомагають нам покращувати роботу сайту.</li>
            </ul>

            <h2>2. Як довго ми зберігаємо дані?</h2>
            <p>Ми зберігаємо дані запитів не більше 1 року з моменту останнього контакту, якщо не було укладено договір (у такому разі діють терміни зберігання за законами ЧР).</p>

            <h2>3. Хто має доступ до даних?</h2>
            <p>Ми не продаємо ваші дані. Доступ мають лише наші співробітники та перевірені партнери (хостинг, Google Analytics), які дотримуються GDPR.</p>

            <h2>4. Ваші права</h2>
            <p>Згідно з GDPR ви маєте право:</p>
            <ul>
                <li>Запитати доступ до своїх даних або їх виправлення.</li>
                <li>Вимагати видалення даних («право бути забутим»), якщо це не порушує закон.</li>
                <li>Заперечити проти обробки.</li>
                <li><strong>Подати скаргу:</strong> Ви можете звернутися до наглядового органу Чехії — <strong>Úřad pro ochranu osobních údajů (ÚOOÚ)</strong>, Pplk. Sochora 27, 170 00 Praha 7 (www.uoou.cz).</li>
            </ul>'
    ]
];

$t = $texts[$l];
?>
<!DOCTYPE html>
<html lang="<?= $l ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $t['title'] ?></title>
    
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-XXXXXXXX"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
      gtag('config', 'G-XXXXXXXX');
    </script>
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&family=Playfair+Display:wght@400;600&display=swap" rel="stylesheet">
    <script>
        if (localStorage.getItem('theme') === 'light') {
            document.documentElement.classList.add('light-mode');
        }
    </script>
    <style>
        :root {
            --bg: #050505;
            --t: #f5f5f5;
            --m: #888;
            --h: #ffffff;
            --border: #333;
        }
        html.light-mode {
            --bg: #fcfcfc;
            --t: #222222;
            --m: #666;
            --h: #0a0a0a;
            --border: #eaeaea;
        }
        body {
            background: var(--bg);
            color: var(--t);
            font-family: 'Inter', sans-serif;
            padding: 60px 20px;
            max-width: 750px;
            margin: 0 auto;
            line-height: 1.7;
            font-size: 16px;
        }
        h1 {
            font-family: 'Playfair Display', serif;
            font-size: 2.8rem;
            color: var(--h);
            margin-bottom: 30px;
            line-height: 1.2;
            word-wrap: break-word; /* Фикс для длинных слов */
        }
        h2 {
            font-family: 'Inter', sans-serif;
            font-size: 1.4rem;
            color: var(--h);
            margin-top: 40px;
            margin-bottom: 15px;
            font-weight: 600;
        }
        p {
            margin-bottom: 15px;
            color: var(--t);
        }
        ul {
            padding-left: 20px;
            margin-bottom: 25px;
        }
        li {
            margin-bottom: 10px;
        }
        a.back-btn {
            color: var(--m);
            text-decoration: none;
            border-bottom: 1px solid var(--border);
            padding-bottom: 2px;
            transition: color 0.2s;
            display: inline-block;
            margin-bottom: 30px;
        }
        a.back-btn:hover {
            color: var(--h);
            border-color: var(--m);
        }
        strong {
            font-weight: 600;
            color: var(--h);
        }

        /* АДАПТИВНОСТЬ ДЛЯ МОБИЛОК */
        @media (max-width: 768px) {
            body {
                padding: 40px 15px;
                font-size: 15px;
            }
            h1 {
                font-size: 2rem; /* Уменьшаем заголовок на телефоне */
                margin-bottom: 20px;
            }
            h2 {
                font-size: 1.2rem;
            }
        }
    </style>
</head>
<body>
    <a href="index.php" class="back-btn"><?= $t['b'] ?></a>
    <h1><?= $t['h'] ?></h1>
    <?= $t['content'] ?>
</body>
</html>