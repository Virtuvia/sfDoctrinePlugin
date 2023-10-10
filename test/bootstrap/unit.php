<?php

/*
 * This file is part of the symfony package.
 * (c) Fabien Potencier <fabien.potencier@symfony-project.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

require_once dirname(__DIR__, 2) . '/vendor/autoload.php';

define('SYMFONY_LIB_DIR', dirname(__DIR__, 2) . '/vendor/symfony/symfony1/lib');

require(SYMFONY_LIB_DIR . '/vendor/lime/lime.php');
