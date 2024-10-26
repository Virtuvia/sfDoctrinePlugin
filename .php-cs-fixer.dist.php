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
        'encoding' => true,
        'no_trailing_whitespace_in_comment' => true,
        'no_trailing_whitespace' => true,
        'line_ending' => true,
        'no_whitespace_in_blank_line' => true,
        'single_blank_line_at_eof' => true,

        'array_indentation' => true,
        'statement_indentation' => true,
        'heredoc_indentation' => false,
        'method_chaining_indentation' => false,
        'indentation_type' => true,

        'no_extra_blank_lines' => true,
    ])
    ->setFinder($finder)
;

return $config;
