<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // 1. ПРОВЕРКА НА БОТА (HONEYPOT)
    if (!empty($_POST["website"])) {
        header("Location: thanks.php");
        exit();
    }

    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    
    // Перевод значения селекта в читаемый вид
    $service_raw = isset($_POST["service"]) ? htmlspecialchars($_POST["service"]) : '';
    $service_map = [
        'landing' => 'Landing Page',
        'ecommerce' => 'E-commerce',
        'automation' => 'Automatizace',
        'google' => 'Google Profil',
        'other' => 'Jiné / Ostatní'
    ];
    $service = isset($service_map[$service_raw]) ? $service_map[$service_raw] : 'Nespecifikováno';
    
    if (filter_var($email, FILTER_VALIDATE_EMAIL) && isset($_POST['gdpr'])) {
        
        // 2. ПИШЕМ В АДМИНКУ (CSV)
        $date = date('Y-m-d H:i:s');
        $file = fopen("poletta_leads_99x.csv", "a");
        fputcsv($file, array($date, $email, $service));
        fclose($file);

        // 3. ПИСЬМО АДМИНУ (ВНИМАНИЕ: замените email на свой реальный)
        $admin_email = "YOUR_ADMIN_EMAIL@domain.com";
        $admin_subject = "Novy lead z webu: " . $email;
        $admin_headers = "From: noreply@yourdomain.com\r\nReply-To: " . $email . "\r\nContent-Type: text/plain; charset=UTF-8\r\n";
        $admin_body = "Máš nový lead z webu!\n\nE-mail: $email\nSlužba: $service\nČas: $date\n\nKlientovi byl odeslán automatický dotazník.";
        mail($admin_email, $admin_subject, $admin_body, $admin_headers);

        // 4. HTML АВТО-БРИФ КЛИЕНТУ (Премиум дизайн)
        $client_subject = "Děkujeme za váš zájem | Další krok k projektu";
        
        // Обязательные заголовки для HTML-письма
        $client_headers = "From: Your Company <noreply@yourdomain.com>\r\n";
        $client_headers .= "Reply-To: YOUR_ADMIN_EMAIL@domain.com\r\n";
        $client_headers .= "MIME-Version: 1.0\r\n";
        $client_headers .= "Content-Type: text/html; charset=UTF-8\r\n";
        
        // HTML структура письма
        $client_body = <<<HTML
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&family=Playfair+Display:ital,wght@0,400;0,600&display=swap" rel="stylesheet">
</head>
<body style="margin: 0; padding: 0; background-color: #fcfcfc;">
    <div style="font-family: 'Inter', Helvetica, Arial, sans-serif; max-width: 600px; margin: 0 auto; padding: 50px 20px; color: #0a0a0a; line-height: 1.6;">
        
        <div style="text-align: center; margin-bottom: 50px;">
            <h1 style="font-family: 'Playfair Display', Georgia, serif; font-size: 28px; font-weight: 400; margin: 0; letter-spacing: -0.5px; color: #0a0a0a;">
                COMPANY NAME<br>
                <span style="font-family: 'Inter', sans-serif; font-size: 10px; text-transform: uppercase; letter-spacing: 2px; color: #888888; display: block; margin-top: 5px;">digital lab</span>
            </h1>
        </div>

        <p style="font-size: 15px; color: #333333;">Dobrý den,</p>
        <p style="font-size: 15px; color: #333333;">děkujeme za vaši poptávku. Abychom vám mohli co nejdříve připravit přesný návrh a cenovou nabídku, prosíme o zodpovězení několika základních otázek. <strong>Stačí odpovědět přímo na tento e-mail:</strong></p>
        
        <div style="background-color: #ffffff; border-left: 2px solid #0a0a0a; padding: 25px; margin: 35px 0; border-radius: 0 8px 8px 0; box-shadow: 0 4px 15px rgba(0,0,0,0.03);">
            <ol style="margin: 0; padding-left: 20px; font-size: 14px; color: #444444; font-weight: 300;">
                <li style="margin-bottom: 12px;"><strong>O jakou firmu se jedná?</strong> (Jaký je váš produkt nebo služba?)</li>
                <li style="margin-bottom: 12px;"><strong>Co přesně potřebujete vytvořit?</strong> (Jaký je hlavní cíl projektu?)</li>
                <li style="margin-bottom: 12px;"><strong>Jaký problém tím řešíte?</strong> (Co vám na současném stavu vadí nejvíce?)</li>
                <li><strong>Máte představu o rozpočtu a termínu dodání?</strong></li>
            </ol>
        </div>
        
        <p style="font-size: 15px; color: #333333;">Odpovězte nám přímo na tuto zprávu a my se obratem ozveme s konkrétním řešením.</p>

        <hr style="border: none; border-top: 1px solid #e5e5e5; margin: 50px 0;">
        
        <p style="font-size: 15px; color: #333333;">Hello,</p>
        <p style="font-size: 15px; color: #333333;">Thank you for reaching out! To speed up the process and prepare an accurate proposal, please reply to this email answering the following questions:</p>
        
        <div style="background-color: #ffffff; border-left: 2px solid #0a0a0a; padding: 25px; margin: 35px 0; border-radius: 0 8px 8px 0; box-shadow: 0 4px 15px rgba(0,0,0,0.03);">
            <ol style="margin: 0; padding-left: 20px; font-size: 14px; color: #444444; font-weight: 300;">
                <li style="margin-bottom: 12px;"><strong>What is your company/project?</strong> (What product or service do you offer?)</li>
                <li style="margin-bottom: 12px;"><strong>What exactly do you need to build?</strong> (What is the main goal?)</li>
                <li style="margin-bottom: 12px;"><strong>What problem are you trying to solve?</strong></li>
                <li><strong>Do you have a timeline and budget in mind?</strong></li>
            </ol>
        </div>

        <p style="font-size: 15px; color: #333333;">Please reply directly to this email, and we will get back to you with a tailored solution.</p>

    </div>
</body>
</html>
HTML;

        // Отправка письма клиенту
        mail($email, $client_subject, $client_body, $client_headers);
    }
    
    // 5. РЕДИРЕКТ
    header("Location: thanks.php");
    exit();
}
?>