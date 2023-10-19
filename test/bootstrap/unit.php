<?php

/*
 * This file is part of the symfony package.
 * (c) Fabien Potencier <fabien.potencier@symfony-project.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/** @var Composer\Autoload\ClassLoader $classLoader */
$classLoader = require dirname(__DIR__, 4) . '/vendor/autoload.php';
$classLoader->addClassMap([
    'ProjectConfiguration' => dirname(__DIR__) . '/functional/fixtures/config/ProjectConfiguration.class.php',
]);

define('SYMFONY_LIB_DIR', dirname(__DIR__, 4) . '/vendor/symfony/symfony1/lib');

require(SYMFONY_LIB_DIR . '/vendor/lime/lime.php');
