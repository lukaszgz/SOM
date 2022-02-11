<?php
require_once('../scripts/db.php');

$equipment = array();

$sql = 'SELECT * FROM som_equipment ORDER by equipment_name, popular desc';
$result = DB::query($sql);

while (($equipmentDB = $result -> fetch_assoc()) !== null)
{
    $equipment[$equipmentDB['id_equipment']] = $equipmentDB['equipment_name'];
}

// print_r($marks);

?>