<?php
require_once('../scripts/db.php');
require_once('../class/ads.php');
require_once('../parts/head.php');
require_once('../parts/nav.php');
require_once('../class/user.php');

$haslo = 'SilneHaslo123';

echo "MD-5: ".md5($haslo);
echo "</br>SHA-1: ".sha1($haslo);
echo "</br>SHA-256: ".hash("sha256",$haslo);
echo "</br>SHA-512: ".hash("sha512",$haslo);
echo "</br>BCRYPT: ".password_hash($haslo, PASSWORD_DEFAULT);


// echo "<pre>";
// echo print_r($_POST);
// echo "</pre>";

// echo substr('ad_equipment_28',13,100);
// foreach ($_POST as $key => $value) {
//     echo intval($key);
// }

// $sql = "SELECT a.id_ad, ma.mark_name, mo.model_name, a.description, a.id_gear_type, f.fuel_name, a.year, a.engine_capacity, a.price, a.date_add, u.city FROM som_ad a JOIN som_marks ma ON a.id_mark=ma.id_mark JOIN som_models mo ON a.id_model=mo.id_model JOIN som_fuel f ON a.id_fuel=f.id_fuel JOIN som_users u ON a.id_user=u.id_user";
// $result = DB::query($sql);

// while (($row = $result -> fetch_assoc()) !== null)
// {
//     $lipsum = simplexml_load_file('http://www.lipsum.com/feed/xml?amount=1&what=paras&start=0')->lipsum;

    // $sql1 = 'UPDATE som_ad SET title = "'.$row['mark_name'].' '.$row['model_name'].' - '.$row['fuel_name'].'" WHERE id_ad = '.$row['id_ad'];
    // $sql1 = 'UPDATE som_ad SET description = "'.$lipsum.'" WHERE id_ad = '.$row['id_ad']; 
    // echo $sql1;
    // $res = DB::query($sql1);
    // echo " RESULT: ".$res."</br>";

    
    // echo $lipsum."</br>";
    // echo '<pre>';
    // print_r($row);
    // echo  '</pre>';
// }

// $t1 = "Hasldskjfhasjkfhksjahfkjsahsjkfdhasjhjsahdfjsahfdjksahfjshakfjsaaaaaaajskafjsahfkjashfjksahfjksahfjkasho";
// $t2 = "Kraków";
// $t2 = password_hash($t1, PASSWORD_DEFAULT);
// $t2 = filter_var(substr($t1, 0, 16), FILTER_SANITIZE_SPECIAL_CHARS); 
// echo strcmp($t1, $t2);
// echo strlen($t2);

// echo idn_to_ascii($t1);
// print_r($t1);
// print_r($t2);


// $ad1->getAllAdData();

// echo realpath(dirname(__FILE__));

// echo '<pre>';
// print_r(__FILE__);
// echo  '</pre>';

// echo count(glob("../img/31/*.*"));

// $text = "0.png 1.jpg 2.png ";





// $target_dir = "../uploads/";
// $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
// $uploadOk = 1;
// $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// // Check if image file is a actual image or fake image
// if(isset($_POST["submit"])) {
//     $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
//     if($check !== false) {
//         echo "Plik jest obrazkiem - " . $check["mime"] . ".";
//         $uploadOk = 1;
//     } else {
//         echo "Plik nie jest obrazkiem.";
//         $uploadOk = 0;
//     }
// }
// // Check if file already exists
// if (file_exists($target_file)) {
//     echo "Plik o tej nazwie już istnieje.";
//     $uploadOk = 0;
// }
// // Check file size
// if ($_FILES["fileToUpload"]["size"] > 500000) {
//     echo "Plik jest zbyt duży.";
//     $uploadOk = 0;
// }
// // Allow certain file formats
// if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
// && $imageFileType != "gif" ) {
//     echo "Możesz wgrać tylko pliki: JPG, JPEG, PNG i GIF.";
//     $uploadOk = 0;
// }
// // Check if $uploadOk is set to 0 by an error
// if ($uploadOk == 0) {
//     echo "Twój plik nie został wgrany na serwer!";
// // if everything is ok, try to upload file
// } else {
//     if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
//         echo "Plik ". basename( $_FILES["fileToUpload"]["name"]). " został załadowany pomyślnie.";
//     } else {
//         echo "Błąd wgrywania pliku!";
//     }
// }

// echo '<pre>';
// print_r($_POST);
// echo  '</pre>';
?>