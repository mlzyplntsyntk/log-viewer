<?php
exec('sudo service php7.4-fpm status 2>&1', $output);
print_r($output);