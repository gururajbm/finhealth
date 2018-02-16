<?php
include('vendor/autoload.php');

$path    = 'pdf/';
$files = scandir($path);
$password = 'AJPPG4513Q';

require('lib/db.php');
$db = new DBClass();



//decrypt and put it in Mysql server
foreach ($files as $file_name) {
	if (strpos($file_name, '.pdf') !== false) {
		print_r($file_name.PHP_EOL);
		exec("qpdf --password='" . $password . "' --decrypt 'pdf/" . $file_name . "' 'decrypted_pdf/temp_" . $file_name . "'");

		$text = \Spatie\PdfToText\Pdf::getText('decrypted_pdf/temp_' . $file_name);

		$sql = "INSERT INTO transcation_dump(data) VALUES ('" . $db->realEscapeString($text) . "')";

		echo $sql;
	   	print_r($sql);
      
	   	$result = $db->query($sql);
	}
}

function get_axis_fund_information($text){
	preg_match('/(AXIS BANK LTD))/', $text, $matches);

	print_r(get_fund_name($text));
}

function get_fund_name($text){
	preg_match('/(?<name>\w+): (?<digit>\d+)/', $str, $matches);

		print_r($matches);
}



