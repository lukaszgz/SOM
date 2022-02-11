<?php
require_once('../scripts/db.php');

$fuesl = array();

$sql = 'SELECT * FROM som_fuel';
$result = DB::query($sql);

while (($fuelDB = $result -> fetch_assoc()) !== null)
{
    $fuel[$fuelDB['id_fuel']] = $fuelDB['fuel_name'];
}

// print_r($marks);

?>