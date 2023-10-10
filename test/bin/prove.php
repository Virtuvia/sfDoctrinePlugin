<?php

/*
 * This file is part of the symfony package.
 * (c) 2004-2006 Fabien Potencier <fabien.potencier@symfony-project.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

require_once dirname(__DIR__, 2) . '/vendor/autoload.php';

define('SYMFONY_LIB_DIR', dirname(__DIR__, 2) . '/vendor/symfony/symfony1/lib');

require(SYMFONY_LIB_DIR . '/vendor/lime/lime.php');

$h = new lime_harness();
$h->base_dir = dirname(__DIR__);

$h->register(sfFinder::type('file')->prune('fixtures')->name('*Test.php')->in(array(
  // unit tests
  $h->base_dir.'/unit',
  // functional tests
  $h->base_dir.'/functional'
)));

exit($h->run() ? 0 : 1);
