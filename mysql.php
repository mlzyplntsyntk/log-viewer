<?php
$fileName = $argv[1];
$contents = file_get_contents($fileName);

$items = explode("# Time:", $contents);

$data = [];

for ($i=0; $i<count($items); $i++) {
    //ignore first item
    if ($i == 0) continue;

    $log = explode("\n", $items[$i]);

    $logItem = [
        "sql"=>""
    ];
    for ($j=0; $j<count($log); $j++) {
        $logText = trim(str_replace("# ", "", $log[$j]));
        switch ($j) {
            case 0:
                $logItem["time"] = $logText;
                break;
            case 3:
                $logQuery = floatval(str_replace("Query_time: ", "", explode("  ", $logText)[0]));
                $logItem["query"] = $logQuery;
                break;
            case 1:
            case 2:
            case 4:
            case 5:

                break;
            default:
                $logItem["sql"] .= $logText."\n";
            break;
        }
    }

    $data[] = $logItem;

}

$query = array_column($data, 'query');
array_multisort($query, SORT_DESC, $data);
print_r($data[0]);
exit;

echo "\n--------------------\n";
echo "total logs: ".count($data);
echo "\n--------------------\n";
print_r($data[0]);
echo "\n--------------------\n";
print_r($data[10]);
echo "\n--------------------\n";