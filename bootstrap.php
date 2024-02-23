<?php

// Inclua o autoloader do Composer
require 'vendor/autoload.php';

// Crie e registre um manipulador de exceções Whoops
$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();
