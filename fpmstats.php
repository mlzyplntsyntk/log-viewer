<?php
exec('sudo service php7.4-fpm status 2>&1', $output);
$fileName = date("Y-m-d-H-i-s");
file_put_contents("/home/sarbay/perfmon/fpmstats/7.4.".$fileName.".txt", join("\n", $output));

unset($output);

exec('sudo service php7.1-fpm status 2>&1', $output);
$fileName = date("Y-m-d-H-i-s");
file_put_contents("/home/sarbay/perfmon/fpmstats/7.1.".$fileName.".txt", join("\n", $output));
