<?php
$fileName = $argv[1];
$contents = file_get_contents($fileName);

$items = explode("# Time:", $contents);

echo count($items);
for ($i=0; $i<count($items); $i++) {
    //ignore first item
    if ($i == 0) continue;

    $log = explode("\n", $items[$i]);
    print_r($log);
    exit;
}

echo "\n--------------------\n";
echo $items[0];
echo "\n--------------------\n";
echo $items[1];
echo "\n--------------------\n";