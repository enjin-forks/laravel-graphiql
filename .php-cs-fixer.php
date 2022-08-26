<?php declare(strict_types=1);

$finder = PhpCsFixer\Finder::create()
    ->notPath('vendor')
    ->in(__DIR__)
    ->name('*.php')
    ->ignoreDotFiles(true)
    ->ignoreVCS(true);

return MLL\PhpCsFixerConfig\risky($finder);
