<?php

$startTime = time();

// Debug Diagnosic process attacher sleep time needed to link process
// More info about that: http://bugs.php.net/bugs-generating-backtrace-win32.php
//sleep(10);

error_reporting(E_ALL | E_STRICT);
ini_set('max_execution_time', 900);
ini_set('date.timezone', 'GMT+0');

require_once(__DIR__ . '/../../../../vendor/autoload.php');

require_once(__DIR__ . '/../../lib/vendor/doctrine/Doctrine.php');

spl_autoload_register(array('Doctrine', 'autoload'));
spl_autoload_register(array('Doctrine', 'modelsAutoload'));

require_once(__DIR__ . '/DoctrineTest.php');

spl_autoload_register(array('DoctrineTest', 'autoload'));
