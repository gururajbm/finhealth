<?php
require('lib/db.php');
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
         $obj = (object) array('total_value' => $total_qty, 'folio_no' => $row['folio_no'], 'fund_name' => $row['fund_name'], 'trans_date'=> $row['trans_date'], 'trans_type' => $row['trans_type'], 'nav' => $row['nav'], 'units'=> $row['units']);
        // $username = $row['email'];
        // $password = $row['pan'];
        $finalArray[] = $obj;
        print_r($finalArray);
    }
} else {
    echo "0 results";
    exit;
}
$db->close();

?>