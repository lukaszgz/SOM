<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Upload Files</title>
</head>
<body>

<form action="index.php" method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload Image" name="submit">
</form>

<?php
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "Plik jest obrazkiem - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "Plik nie jest obrazkiem.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Plik o tej nazwie już istnieje.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Plik jest zbyt duży.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Możesz wgrać tylko pliki: JPG, JPEG, PNG i GIF.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Twój plik nie został wgrany na serwer!";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "Plik ". basename( $_FILES["fileToUpload"]["name"]). " został załadowany pomyślnie.";
    } else {
        echo "Błąd wgrywania pliku!";
    }
}
?>

</body>
</html>


// require_once('../conf/bd.php');

// $mysqli = new mysqli($DbHost, $DbUser, $DbPass, $BdName);
// if ($mysqli->connect_errno) {
//     $error_info = base64_encode ("Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error);
//     header('Location: error.php?msg='.$error_info);
// }

// if(isset($_GET['v']) &&  isset($_GET['t']) && isset($_GET['id']))
// {
//     $sql = 'SELECT '.$_GET['v'].' FROM '.$_GET['t'].' WHERE id_mark = '.$_GET['id'];

//     $result = $mysqli->query($sql);

//     if($result->num_rows > 0)
//     {
//         $resultArray = $result->fetch_all(MYSQLI_ASSOC);
//     }
//     else
//     {
//         $array[] = '';
//     }
        
// }

// $sql ="INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 6, '80', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 6, '100', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 6, 'A1', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 6, 'A2', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 6, 'A3', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 6, 'A4', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 6, 'A4 Allroad', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 6, 'A5', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 6, 'A6', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 6, 'A6 Allroad', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 6, 'A7', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 6, 'A8', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 6, 'Cabriolet', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 6, 'Q2', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 6, 'Q3', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 6, 'Q5', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 6, 'Q7', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 6, 'Q8', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 6, 'R8', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 6, 'RS3', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 6, 'RS4', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 6, 'RS5', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 6, 'RS6', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 6, 'RS7', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 6, 'S3', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 6, 'S4', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 6, 'S5', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 6, 'S6', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 6, 'S7', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 6, 'S8', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 6, 'SQ5', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 6, 'SQ7', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 6, 'TT', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 6, 'TT RS', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 6, 'TT S', '0');

// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 4, '147', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 4, '156', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 4, '159', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 4, '166', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 4, 'Giulia', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 4, 'Giulietta', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 4, 'GT', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 4, 'GTV', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 4, 'MiTo', '0');

// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 4, 'Spider', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 4, 'Sportwagon', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 4, 'Stelvio', '0');

// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 8, 'M5', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 8, 'M3', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 8, 'i8', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 8, '6GT', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 8, '3GT', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 8, 'M4', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 8, 'i3', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 8, 'M2', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 8, 'M6', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 8, '5GT', '0');

// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 8, 'Seria 1', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 8, 'Seria 2', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 8, 'Seria 3', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 8, 'Seria 4', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 8, 'Seria 5', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 8, 'Seria 6', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 8, 'Seria 7', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 8, 'Seria 8', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 8, 'X1', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 8, 'X2', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 8, 'X3', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 8, 'X4', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 8, 'X5', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 8, 'X5 M', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 8, 'X6', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 8, 'X6 M', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 8, 'Z3', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 8, 'Z4', '0');

// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 12, 'Express', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 12, 'Cruze', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 12, 'Captiva', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 12, 'Blazer', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 12, 'Astro', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 12, 'Epica', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 12, 'Camaro', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 12, 'Corvette', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 12, 'HHR', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 12, 'Aveo', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 12, 'Kalos', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 12, 'Lacetti', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 12, 'Malibu', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 12, 'Nubira', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 12, 'Orlando', '0');

// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 12, 'Rezzo', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 12, 'Silverado', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 12, 'Spark', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 12, 'Suburban', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 12, 'Tahoe', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 12, 'Trax', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 12, 'Volt', '0');

// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 13, 'Sebring', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 13, 'Pacifica', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 13, 'Crossfire', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 13, '300M', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 13, '200', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 13, 'PT Cruiser', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 13, 'Aspen', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 13, 'Grand Voyager', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 13, 'Town & Country', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 13, '300C', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 13, 'Voyager', '0');

// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 14, 'C4', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 14, 'C3 Picasso', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 14, 'C3', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 14, 'C1', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 14, '2 CV', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 14, 'C3 Pluriel', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 14, 'C2', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 14, 'C3 Aircross', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 14, 'C4 Aircross', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 14, 'Berlingo', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 14, 'C4 Cactus', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 14, 'C4 Grand Picasso', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 14, 'C4 Picasso', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 14, 'C5', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 14, 'C5 Aircross', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 14, 'C6', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 14, 'C8', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 14, 'C-Crosser', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 14, 'C-Elysee', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 14, 'DS', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 14, 'DS3', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 14, 'DS4', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 14, 'DS5', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 14, 'Evasion', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 14, 'Jumper', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 14, 'Jumpy Combi', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 14, 'Nemo', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 14, 'Saxo', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 14, 'SpaceTourer', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 14, 'Xantia', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 14, 'XM', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 14, 'Xsara', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 14, 'Xsara Picasso', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 14, 'ZX', '0');

// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 15, 'Dokker', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 15, 'Dokker Van', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 15, 'Duster', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 15, 'Lodgy', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 15, 'Logan', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 15, 'Sandero', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 15, 'Sandero Stepway', '0');

// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 16, 'Nubira', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 16, 'Matiz', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 16, 'Leganza', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 16, 'Lanos', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 16, 'Kalos', '0');

// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 17, 'Cuore', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 17, 'YRV', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 17, 'Trevis', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 17, 'Sirion', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 17, 'Materia', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 17, 'Feroza', '0');

// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 18, 'Avenger', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 18, 'RAM', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 18, 'Nitro', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 18, 'Journey', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 18, 'Grand Caravan', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 18, 'Durango', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 18, 'Diplomat', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 18, 'Dakota', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 18, 'Charger', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 18, 'Challenger', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 18, 'Caravan', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 18, 'Caliber', '0');

// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 21, '126', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 21, '500', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 21, '124 Spider', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 21, '125p', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 21, '500L', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 21, '500X', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 21, 'Albea', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 21, 'Brava', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 21, 'Bravo', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 21, 'Cinquecento', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 21, 'Coupe', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 21, 'Croma', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 21, 'Doblo', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 21, 'Ducato', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 21, 'Fiorino', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 21, 'Freemont', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 21, 'Fullback', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 21, 'Grande Punto', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 21, 'Idea', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 21, 'Linea', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 21, 'Multipla', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 21, 'Panda', '0');

// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 21, 'Punto', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 21, 'Punto 2012', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 21, 'Punto Evo', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 21, 'Qubo', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 21, 'Scudo', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 21, 'Sedici', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 21, 'Seicento', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 21, 'Siena', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 21, 'Stilo', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 21, 'Strada', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 21, 'Talento', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 21, 'Tipo', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 21, 'Uno', '0');

// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 22, 'B-MAX', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 22, 'Transit Custom', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 22, 'Transit Courier', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 22, 'Transit Connect', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 22, 'Transit', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 22, 'Tourneo Custom', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 22, 'Tourneo Courier', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 22, 'Tourneo Connect', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 22, 'S-MAX', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 22, 'Sierra', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 22, 'Scorpio', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 22, 'Ranger', '0');

// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 22, 'Mustang', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 22, 'Mondeo', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 22, 'Maverick', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 22, 'Kuga', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 22, 'KA', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 22, 'Grand C-MAX', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 22, 'Galaxy', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 22, 'Fusion', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 22, 'Focus C-Max', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 22, 'Focus', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 22, 'Fiesta', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 22, 'F350', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 22, 'F250', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 22, 'F150', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 22, 'Explorer', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 22, 'Escort', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 22, 'Escape', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 22, 'Edge', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 22, 'EcoSport', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 22, 'Courier', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 22, 'Cougar', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 22, 'C-MAX', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 22, 'Honda', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 22, 'Accord', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 22, 'Stream', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 22, 'Prelude', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 22, 'Odyssey', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 22, 'Legend', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 22, 'Jazz', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 22, 'Insight', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 22, 'HR-V', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 22, 'FR-V', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 22, 'CR-Z', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 22, 'CRX', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 22, 'CR-V', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 22, 'Civic', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 22, 'City', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 22, 'Hyundai', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 22, 'Accent', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 22, 'Veloster', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 22, 'Tucson', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 22, 'Trajet', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 22, 'Terracan', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 22, 'Sonata', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 22, 'Santa Fe', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 22, 'Matrix', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 22, 'Kona', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 22, 'ix35', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 22, 'ix20', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 22, 'IONIQ', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 22, 'i40', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 22, 'i30', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 22, 'i20', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 22, 'i10', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 22, 'H350', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 22, 'H-1', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 22, 'Grand Santa Fe', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 22, 'Getz', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 22, 'Genesis Coupe', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 22, 'Galloper', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 22, 'Elantra', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 22, 'Coupe', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 22, 'Atos', '0');

// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 26, 'EX', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 26, 'QX70', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 26, 'QX30', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 26, 'QX', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 26, 'Q70', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 26, 'Q60', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 26, 'Q50', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 26, 'Q30', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 26, 'G', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 26, 'FX', '0');

// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 29, 'E-Pace', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 29, 'X-Type', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 29, 'XK', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 29, 'XJ', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 29, 'XF', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 29, 'XE', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 29, 'S-Type', '0');

// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 29, 'F-Type', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 29, 'F-Pace', '0');

// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 30, 'Cherokee', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 30, 'Wrangler', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 30, 'Renegade', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 30, 'Patriot', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 30, 'Liberty', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 30, 'Grand Cherokee', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 30, 'Compass', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 30, 'Commander', '0');

// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 31, 'Carens', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 31, 'XCeed', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 31, 'Venga', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 31, 'Stonic', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 31, 'Stinger', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 31, 'Sportage', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 31, 'Soul', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 31, 'Sorento', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 31, 'Rio', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 31, 'Pro_cee'd', '0');

// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 31, 'Picanto', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 31, 'Optima', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 31, 'Opirus', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 31, 'Niro', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 31, 'Magentis', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 31, 'Cerato', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 31, 'Cee'd', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 31, 'Carnival', '0');

// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 33, 'Delta', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 33, 'Ypsilon', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 33, 'Voyager', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 33, 'Thesis', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 33, 'Thema', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 33, 'Phedra', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 33, 'Lybra', '0');

// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 34, 'Defender', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 34, 'Range Rover Velar', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 34, 'Range Rover Sport', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 34, 'Range Rover Evoque', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 34, 'Range Rover', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 34, 'Freelander', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 34, 'Discovery Sport', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 34, 'Discovery', '0');

// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 35, 'CT', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 35, 'SC', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 35, 'RX', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 35, 'RC', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 35, 'NX', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 35, 'LS', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 35, 'LC', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 35, 'IS', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 35, 'GS', '0');
// INSERT INTO `som_models` (`id_model`, `id_mark`, `model_name`, `popular`) VALUES (NULL, 35, 'ES', '0');
// ";
// $result = $mysqli->query($sql);

// $mysqli->close();

// $array = array(
//     "foo" => "bar",
//     "bar" => "foo",
// );

// echo json_encode($resultArray);