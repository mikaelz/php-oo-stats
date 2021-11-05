<?php

declare(strict_types=1);

use OoStats\TokenCounter;
use PhpParser\ParserFactory;
use PhpParser\NodeTraverser;
use PhpParser\NodeVisitor\NameResolver;

require __DIR__ . '/../vendor/autoload.php';
const STATS_JSON_PATH = __DIR__ . '/../var/stats.json';

$inDir = $argv[1];
if ( ! is_dir($inDir)) {
    printf('Not a directory %s', $inDir);
    exit;
}

printf('Gathering stats from %s' . PHP_EOL, $inDir);

if (is_file(STATS_JSON_PATH)) {
    unlink(STATS_JSON_PATH);
}

$parser = (new ParserFactory)->create(ParserFactory::PREFER_PHP7);
$traverser = new NodeTraverser;

$traverser->addVisitor(new NameResolver);
$traverser->addVisitor(new TokenCounter);

$files = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($inDir));
$files = new \RegexIterator($files, '/\.php$/');

foreach ($files as $file) {
    try {
        $code = file_get_contents($file->getPathName());

        $stmts = $parser->parse($code);

        $traverser->traverse($stmts);
    } catch (PhpParser\Error $e) {
        echo 'Parse Error: ', $e->getMessage();
    }
}

$counts = json_decode(file_get_contents(STATS_JSON_PATH), true);
$data = [];
$totals = [];
foreach ($counts as $key => $arr) {
    arsort($arr);
    $data[$key] = $arr;
    $totals[$key] = count($arr);
}
$data['total'] = $totals;
printf('Generating stats in %s' . PHP_EOL, STATS_JSON_PATH);
file_put_contents(STATS_JSON_PATH, json_encode($data, JSON_PRETTY_PRINT));
