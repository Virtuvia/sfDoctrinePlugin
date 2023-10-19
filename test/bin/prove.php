<?php

/*
 * This file is part of the symfony package.
 * (c) 2004-2006 Fabien Potencier <fabien.potencier@symfony-project.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

$xml = $argv[1] ?? '';
if (!empty($xml)) {
    if ((file_exists($xml) && !is_writable($xml)) || (!file_exists($xml) && !is_writable(dirname($xml)))) {
        throw new \RuntimeException(sprintf('unable xml to write to file, %s', $xml));
    }
}

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

$ret = $h->run() ? 0 : 1;

if (!empty($xml)) {
    file_put_contents($xml, $h->to_xml());
    exit;
}

exit($ret);
