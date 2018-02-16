<?php

require('../lib/db.php');
$db = new DBClass();
$sql = "SELECT * from fund_trans";
$result = $db->query($sql);
if ($db->numRows($result) > 0) {
    $total_qty = 0;
    $finalArray = array();
    while($row = $db->fetchAssoc($result)) {
        if ($row['trans_type'] == 'P') {
         $total_qty += $row['nav'];    
        } else {
            $total_qty -= $row['nav'];
        }
         $obj = (object) array('total_value' => $total_qty, 'folio_no' => $row['folio_no'], 'fund_name' => $row['fund_name'], 'trans_date'=> $row['trans_date'], 'trans_type' => $row['trans_type'], 'nav' => $row['nav'], 'units'=> $row['units'], 'market_value' => $row['nav'] * $total_qty);
        // $username = $row['email'];
        // $password = $row['pan'];
        $finalArray[] = $obj;
        //print_r($finalArray);
    }
} else {
    echo "0 results";
    exit;
}

$interest_array = array();

for ($i = 0 ; $i < count($finalArray); $i++) {
    if ($i != 0) {
        $previousNav = $finalArray[$i-1]->nav;
        $previousUnits = $finalArray[$i-1]->units;
        $calculate = ($finalArray[$i]->nav - $previousNav) * $previousUnits /($previousNav * $previousUnits);
        $interest_array[] = $calculate * 100;
        // print_r($calculate);
    }
}

//print_r($interest_array);

$intial_investment = $finalArray[0]->total_value * $finalArray[0]->nav;
$final_value = $finalArray[count($finalArray)-1]->total_value * $finalArray[count($finalArray)-1]->nav;
// echo $intial_investment.PHP_EOL;
// echo $final_value.PHP_EOL;

foreach ($interest_array as $interest) {
	$final_value = $final_value + ($final_value * ($interest  * 1.0 / 100));
}

$compound_interest = pow(($final_value / $intial_investment), (1 / count($interest_array))) - 1;
//print_r($compound_interest * 100.0);

//market value 
$market_value = array();
foreach ($finalArray as $value) {
    $market_value[] = $value->market_value;
}

$finalResult = array( 'market_value' => $market_value, 'interest_value' => $interest_array, 'compound_interest'=> $compound_interest);

print_r(json_encode($finalResult)); 


$db->close();

?>