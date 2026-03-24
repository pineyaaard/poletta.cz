# Poletta.cz — Digital Lab & Web Development 🚀

![Version](https://img.shields.io/badge/version-1.0.0%20Release-blue.svg)
![Build](https://img.shields.io/badge/build-passing-brightgreen.svg)
![License](https://img.shields.io/badge/license-MIT-green.svg)

A modern, ultra-fast, and premium landing page built for an IT boutique agency. Developed with **pure PHP/HTML/CSS** to guarantee millisecond load times, maximum security, and high conversion rates. Zero bloat, zero dependencies.

![Poletta Preview](https://poletta.cz/preview.png)?text=Poletta.cz+-+Digital+Lab)

## ✨ Key Features (Release v1.0.0)

- ⚡ **Extreme Performance:** Achieves **95+ on Google PageSpeed Mobile**. Features asynchronous font loading, deferred Google Analytics execution, and highly optimized assets.
- 🌍 **Native Multilingual Routing:** Built-in localization (CS, EN, DE, RU, UK) driven by fast PHP sessions. No heavy JS translation plugins.
- 🧊 **Hardware-Accelerated 3D:** Features a custom, CSS-only 3D rotating cube background optimized with `will-change: transform` to run at 60 FPS even on mobile devices.
- 🛡️ **Smart Lead Processing:** - Honeypot anti-spam protection.
  - Flat-file `.csv` database (fast and easily portable).
  - Instant admin email notifications.
  - **Premium HTML Auto-replies:** Automatically sends a beautifully formatted, branded HTML brief to the client upon form submission.
- 🔐 **Secure Admin Dashboard:** A minimalist, password-protected control panel to view and manage leads without the need for MySQL.
- ⚖️ **Bulletproof Legal:** Fully compliant with EU GDPR and Czech personal data protection laws (*Zákon č. 110/2019 Sb.*).

## 🛠 Tech Stack
- **Frontend:** HTML5, Modern CSS3 (Grid/Flexbox, 3D Transforms), Vanilla JavaScript.
- **Backend:** PHP 8.x.
- **Storage:** Flat-file CSV (Safe, lightweight, and GDPR-friendly).

## 🔧 Installation & Setup
1. **Upload** all files to your server (Apache/Nginx with PHP 7.4+ support).
2. **Security Config:** Create a `config.php` file in the root directory and set your admin password:
   ```php
   <?php
   define('ADMIN_PASSWORD', 'YourSecurePasswordHere!');
   ?>

3. Configure Mail: Update the $admin_email variable in submit.php to receive lead notifications.

4. Permissions: Ensure the server has write permissions (CHMOD 664 or 666) for the generated .csv lead files.

5. Access: Log in to your dashboard at yourdomain.com/admin.php.

🔒 Security Note
Sensitive data (passwords, real email addresses, and client .csv files) are strictly excluded from this repository via .gitignore for security purposes.

Developed by: Pavel Dmitrevskij

Company: pineyardcz s.r.o | IČO: 19264674 | Prague, Czech Republic
