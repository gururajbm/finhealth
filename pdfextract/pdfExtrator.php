<?php
include('vendor/autoload.php');

$path    = 'pdf/';
$files = scandir($path);
$password = 'AJPPG4513Q';

$dbhost = 'localhost:3036';
$dbuser = 'root';
$dbpass = 'root';
$conn = new mysqli($servername, $username, $password, $dbname);

foreach ($files as $file_name) {
	if (strpos($file_name, '.pdf') !== false) {
		print_r($file_name.PHP_EOL);
		exec("qpdf --password='" . $password . "' --decrypt 'pdf/" . $file_name . "' 'decrypted_pdf/temp_" . $file_name . "'");

		$text = \Spatie\PdfToText\Pdf::getText('decrypted_pdf/temp_' . $file_name);

		$sql = 'INSERT INTO transaction_dump'.
	      '(data`) '.
	      'VALUES ( ' . $text. ')';
      
	   mysql_select_db('fin_health');
	   $retval = mysql_query( $sql, $conn );		
	}
}



