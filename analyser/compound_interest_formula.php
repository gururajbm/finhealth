<?php
$interest_array = array(-10.0, 10, 20, -20, 50);

$intial_investment = 100;
$final_value = $intial_investment;

foreach ($interest_array as $interest) {
	$final_value = $final_value + ($final_value * ($interest  * 1.0 / 100));
}


$compound_interest = pow(($final_value / $intial_investment), (1 / count($interest_array))) - 1;
print_r($compound_interest * 100.0);