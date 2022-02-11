<?php
require_once('../scripts/db.php');

$countries = array();

$sql = 'SELECT * FROM som_countries ORDER BY name_country';
$result = DB::query($sql);

while (($country = $result -> fetch_assoc()) !== null)
{
    $countries[$country['id_country']] = $country['name_country'];
}

// print_r($marks);

?>