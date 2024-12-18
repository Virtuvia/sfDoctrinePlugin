<?php

/*
 * This file is part of the symfony package.
 * (c) 2004-2006 Fabien Potencier <fabien.potencier@symfony-project.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

require __DIR__ . '/../bootstrap/autoload.php';

$h = new lime_harness();
$h->base_dir = dirname(__DIR__);

// unit tests
$h->register_glob($h->base_dir . '/unit/*/*Test.php');
$h->register_glob($h->base_dir . '/unit/*/*/*Test.php');

// functional tests
$h->register_glob($h->base_dir . '/functional/*Test.php');
$h->register_glob($h->base_dir . '/functional/*/*Test.php');

$c = new lime_coverage($h);
$c->extension = '.class.php';
$c->verbose = false;
$c->base_dir = dirname(__DIR__, 2) . '/lib';

$finder = sfFinder::type('file')->name('*.php')->prune('vendor')->prune('test')->prune('data');
$c->register($finder->in($c->base_dir));
$c->run();
