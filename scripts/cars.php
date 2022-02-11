<?php
require_once('../scripts/db.php');

$marks = array();

$sql = 'SELECT * FROM som_marks order by mark_name';
$result = DB::query($sql);

while (($mark = $result -> fetch_assoc()) !== null)
{
    $marks[$mark['id_mark']] = $mark['mark_name'];
}

$models = array();

$sql = 'SELECT * FROM som_models';
$result = DB::query($sql);

while (($model = $result -> fetch_assoc()) !== null)
{
    $models[$model['id_model']] = $model['model_name'];
}

// print_r($marks);

?>