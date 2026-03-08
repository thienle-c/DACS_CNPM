<?php
// DB Params
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'techzone_mvc');

// App Root
define('APPROOT', dirname(dirname(__FILE__)));

// URL Root - Tự động phát hiện cổng và đường dẫn
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
$host = $_SERVER['HTTP_HOST'] ?? 'localhost';

// Xác định URLROOT dựa trên script path thực tế
// Ví dụ: nếu index.php nằm tại /public/index.php thì URLROOT = http://host/public
$scriptDir = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));
$scriptDir = rtrim($scriptDir, '/');
define('URLROOT', $protocol . '://' . $host . $scriptDir);

// Site Name
define('SITENAME', 'TechZone');
