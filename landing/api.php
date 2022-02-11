<?php
require_once('../scripts/db.php');

if(isset($_GET['v']) &&  isset($_GET['t']) && isset($_GET['id']))
{
    $sql = 'SELECT '.$_GET['v'].' FROM '.$_GET['t'].' WHERE id_mark = '.$_GET['id'];

    $result = $mysqli->query($sql);

    if($result->num_rows > 0)
    {
        $resultArray = $result->fetch_all(MYSQLI_ASSOC);
    }
    else
    {
        $array[] = '';
    }
        
}

$mysqli->close();

// $array = array(
//     "foo" => "bar",
//     "bar" => "foo",
// );

echo json_encode($resultArray);