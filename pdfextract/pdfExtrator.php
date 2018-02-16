<?php

$path    = 'pdf/';
$files = scandir($path);

foreach ($files as $file_name) {
	if (strpos($file_name, '.pdf') !== false) {
		print_r($file_name);		
	}
}

