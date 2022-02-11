<?php
require_once('../scripts/db.php');

$color_type = array();

$sql = 'SELECT * FROM som_color_type';
$result = DB::query($sql);

while (($color_typeDB = $result -> fetch_assoc()) !== null)
{
    $color_type[$color_typeDB['id_color_type']] = $color_typeDB['color_type_name'];
}

// print_r($marks);

?>