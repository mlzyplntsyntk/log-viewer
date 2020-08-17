<?php
$fileName = $argv[1];
$contents = file_get_contents($fileName);

$items = explode("# Time:", $contents);

print_r($items);
echo "\n--------------------\n";
echo $items[0];
echo "\n--------------------\n";
echo $items[1];
echo "\n--------------------\n";