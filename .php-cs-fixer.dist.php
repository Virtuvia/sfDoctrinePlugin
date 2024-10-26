<?php

declare(strict_types=1);

$finder = (new PhpCsFixer\Finder())
    ->in(__DIR__)
    ->in(__DIR__.'/lib/vendor')
    ->exclude([
        'data/generator',
    ])
;

$config = new \PhpCsFixer\Config();
$config
    ->setRules([
        '@PER-CS2.0' => true,
        'method_argument_space' => ['on_multiline' => 'ignore'],
        'single_line_empty_body' => false,
    ])
    ->setFinder($finder)
;

return $config;
