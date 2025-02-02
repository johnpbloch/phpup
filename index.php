<?php

if (!isset($argv[1])) {
    echo "Not enough arguments \n";
    exit(1);
}

putenv("COMPOSER_ALLOW_XDEBUG=1");

$command = escapeshellcmd($argv[1]);
$vendorBinPath = __DIR__ . '/vendor/bin/';

if ('list' === $command) {
    $files = scandir($vendorBinPath);
    foreach ($files as $file) {
        if ($file === '.' || $file === '..') { continue; }
        echo $file . "\n";
    }
    exit;
}

$pathToBinary = $vendorBinPath . $command;
if (file_exists($pathToBinary)) {
    array_shift($_SERVER['argv']);
    require_once $pathToBinary;
    exit;
}
exit(1);
