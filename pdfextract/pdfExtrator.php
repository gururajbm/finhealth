<?php
include('vendor/autoload.php');

$path    = 'pdf/';
$files = scandir($path);
$password = 'ABCDEFGT43';

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

	   	// $result = $db->query($sql);

	   	get_axis_fund_information($db->realEscapeString($text));
	   	get_bank_account_number($db->realEscapeString($text));
	   	get_folio_number($db->realEscapeString($text));
	   	get_email($text);
	   	get_mobile($text);
	   	get_redemption_price($text);
	}
}

function get_axis_fund_information($text){
	preg_match("/(AXIS BANK LTD)/", $text, $matches);
	
		print_r($matches);
	
}

function get_bank_account_number($text){
	preg_match("/(Bank Account No.{25})/", $text, $matches);

		print_r($matches);
}

function get_folio_number($text){
	preg_match("/(Folio No\. \: \d{10})/", $text, $matches);

		print_r($matches);
}

function get_email($text){
	preg_match("/(Email ID \: [.]{10})/", $text, $matches);

		print_r($matches);
	
}

function get_mobile($text){
	preg_match("/(Mobile : \d{10})/", $text, $matches);

		print_r($matches);
	
}

function get_purchase($text){
	preg_match("/(Mobile : \d{10})/", $text, $matches);

		print_r($matches);
	
}

function get_redemption_price($text){
	preg_match("/(Redemption Price - Rs [\d\.]{6})/", $text, $matches);

		print_r($matches);
	
}



