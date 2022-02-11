<?php
require_once('../scripts/db.php');

$car_type = array();

$sql = 'SELECT * FROM som_type';
$result = DB::query($sql);

while (($type = $result -> fetch_assoc()) !== null)
{
    $car_type[$type['id_type']] = $type['name_type'];
}

// print_r($marks);

?>