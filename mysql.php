<?php
$fileName = $argv[1];

echo "reading file contents";

$contents = file_get_contents($fileName);

echo "file contents are read and being parsed\n";

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

echo "sorting array by query_time\n";

// sort by query time

$query = array_column($data, 'query');
array_multisort($query, SORT_DESC, $data);

echo "here it is: \n";

// list 10 of the queries.

echo "\n--------------------\n";
for ($i=0; $i<10; $i++) {
    print_r($data[$i]);
    echo "\n--------------------\n";
}

//c'mon ! no need to exit