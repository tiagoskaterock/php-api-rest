<?php

declare(strict_types=1);
ini_set("display_errors", "On");

require 'vendor/autoload.php';

$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();
