<?php declare(strict_types=1);

use PhpCsFixer\Finder;

return (new PhpCsFixer\Config())
    ->setRiskyAllowed(true)
    ->setFinder(
        Finder::create()->in(__DIR__)
    )
    ->setUsingCache(false)
    ->setRules([
        '@PSR12' => true,

        // File layout
        'declare_strict_types' => true,
        'blank_line_after_opening_tag' => false,
        'no_closing_tag' => true,

        // Imports
        'global_namespace_import' => [
            'import_classes' => true,
            'import_functions' => true,
            'import_constants' => true,
        ],
        'ordered_imports' => [
            'sort_algorithm' => 'alpha',
            'imports_order' => ['class', 'function', 'const'],
        ],
        'no_unused_imports' => false,

        // Array usage
        'array_push' => true,
        'array_syntax' => ['syntax' => 'short'],
        'list_syntax' => ['syntax' => 'short'],

        // Function usage
        'strict_param' => true,
    ]);
