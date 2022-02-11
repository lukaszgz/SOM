<?php
require_once('../scripts/db.php');

$colors = array();

$sql = 'SELECT * FROM som_colors';
$result = DB::query($sql);

while (($color = $result -> fetch_assoc()) !== null)
{
    $colors[$color['id_color']] = $color['color_name'];
}

// print_r($marks);

?>