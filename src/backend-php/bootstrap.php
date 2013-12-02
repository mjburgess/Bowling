<?php
set_include_path(__DIR__ . DIRECTORY_SEPARATOR . 'lib' . PATH_SEPARATOR .
                 __DIR__ . DIRECTORY_SEPARATOR . 'app');

spl_autoload_register(function ($class) {
    require "$class.php";
});