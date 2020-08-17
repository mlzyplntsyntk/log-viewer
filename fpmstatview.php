<?php
 function scan_dir($dir) {
    $ignored = array('.', '..', '.svn', '.htaccess');

    $files = array();    
    foreach (scandir($dir) as $file) {
	$file =$dir."/".$file;
        if (in_array($file, $ignored)) continue;
        $files[$file] = filemtime($file);
    }

    arsort($files);
    $files = array_keys($files);

    return ($files) ? $files : false;
}

$files = scan_dir("/home/sarbay/perfmon/fpmstats");
$i=0;
foreach ($files as $fileName)  {
	$contents = file_get_contents($fileName);
	echo $contents;
	echo "\n------------------------------\n";
	$explode = explode("\n", $contents);
	echo $explode[5];

	echo "\n------------------------------\n";
	$i++;
	if ($i > 10) break;
}

