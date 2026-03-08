<?php
// Load Config
require_once '../config/config.php';

// Autoload Core Libraries
spl_autoload_register(function($className) {
    if (file_exists('../app/core/' . $className . '.php')) {
        require_once '../app/core/' . $className . '.php';
    }
});
