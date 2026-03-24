<?php
require_once 'config.php'; // Подключаем скрытые настройки

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // ПРОВЕРКА НА БОТА
    if (!empty($_POST["website"])) {
        header("Location: https://poletta.cz/thanks.html");
        exit();
    }

    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    $message = isset($_POST["message"]) ? htmlspecialchars(trim($_POST["message"])) : '';
    
    if (filter_var($email, FILTER_VALIDATE_EMAIL) && isset($_POST['gdpr'])) {
        
        // 1. Пишем лид в CSV (Имя файла берется из конфига)
        $date = date('Y-m-d H:i:s');
        $file = fopen(LEADS_FILE, "a");
        $clean_msg = str_replace(array("\r", "\n"), ' ', $message);
        fputcsv($file, array($date, $email, $clean_msg));
        fclose($file);

        // 2. Отправляем письмо-уведомление ТЕБЕ (Почта берется из конфига)
        $subject = "Novy lead z Poletta.cz: " . $email;
        $headers = "From: web@poletta.cz\r\n"; 
        $headers .= "Reply-To: " . $email . "\r\n";
        
        $body = "Novy lead z webu Poletta.cz\n\n";
        $body .= "E-mail: " . $email . "\n";
        $body .= "Zprava: \n" . $message . "\n";

        mail(ADMIN_EMAIL, $subject, $body, $headers);
    }
    
    header("Location: https://poletta.cz/thanks.html");
    exit();
    
} else {
    header("Location: https://poletta.cz/");
    exit();
}
?>