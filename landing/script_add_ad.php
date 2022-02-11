<?php
	session_start();
	unset($_SESSION['error']);
	unset($_SESSION['info']);
	require_once('../scripts/db.php');

	if(isset($_POST['ad_mark']) && $_POST['ad_mark'] >= 0)
	{
		$id_mark = $_POST['ad_mark'];
	}
	else
	{
		$_SESSION['error'] = "Wybierz markę oferowanego pojazdu";
		header('Location: '.$_SERVER['HTTP_REFERER']);
		exit();
	}

	if(isset($_POST['ad_model']) && $_POST['ad_model'] >= 0)
	{
		$id_model = $_POST['ad_model'];
	}
	else
	{
		$_SESSION['error'] = "Wybierz model oferowanego pojazdu";
		header('Location: '.$_SERVER['HTTP_REFERER']);
		exit();
	}

	if(isset($_POST['car_type']) && $_POST['car_type'] >= 0)
	{
		$id_type_car = $_POST['car_type'];
	}
	else
	{
		$_SESSION['error'] = "Wybierz typ oferowanego pojazdu";
		header('Location: '.$_SERVER['HTTP_REFERER']);
		exit();
	}

	if(isset($_POST['fuel_type']) && $_POST['fuel_type'] >= 0)
	{
		$id_fuel = $_POST['fuel_type'];
	}
	else
	{
		$_SESSION['error'] = "Wybierz rodzaj paliwa oferowanego pojazdu";
		header('Location: '.$_SERVER['HTTP_REFERER']);
		exit();
	}	
	
	if(isset($_POST['ad_price']) && $_POST['ad_price'] > 0 && is_numeric($_POST['ad_price']))
	{
		$price = $_POST['ad_price'];
	}
	else
	{
		$_SESSION['error'] = "Podaj poprawną cenę pojazdu";
		header('Location: '.$_SERVER['HTTP_REFERER']);
		exit();
	}	

	if(isset($_POST['ad_millage']) && $_POST['ad_millage'] > 0 && is_numeric($_POST['ad_millage']))
	{
		$mileage = $_POST['ad_millage'];
	}
	else
	{
		$_SESSION['error'] = "Podaj poprawny przebieg pojazdu";
		header('Location: '.$_SERVER['HTTP_REFERER']);
		exit();
	}	

	if(isset($_POST['ad_year']) && $_POST['ad_year'] > 1900 && $_POST['ad_year'] < 2100 && is_numeric($_POST['ad_year']))
	{
		$year = $_POST['ad_year'];
	}
	else
	{
		$_SESSION['error'] = "Podaj poprawny rok produkcji pojazdu";
		header('Location: '.$_SERVER['HTTP_REFERER']);
		exit();
	}	

	if(isset($_POST['ad_vin']) && strlen($_POST['ad_vin']) == 17)
	{
		$VIN = $_POST['ad_vin'];
	}
	else
	{
		$VIN = "";
	}	

	if(isset($_POST['ad_title']) && strlen($_POST['ad_title']) > 0)
	{
		$title = $_POST['ad_title'];
	}
	else
	{
		$title = "";
	}	

	if(isset($_POST['ad_power']) && $_POST['ad_power'] > 0)
	{
		$horsepower = $_POST['ad_power'];
	}
	else
	{
		$horsepower = 0;
	}	

	if(isset($_POST['ad_gear']) && $_POST['ad_gear'] >= 0 && $_POST['ad_gear'] <= 1)
	{
		$id_gear_type = $_POST['ad_gear'];
	}
	else
	{
		$_SESSION['error'] = "Wybierz rodzaj skrzyni biegów pojazdu";
		header('Location: '.$_SERVER['HTTP_REFERER']);
		exit();
	}	

	if(isset($_POST['ad_gear']) && $_POST['ad_gear'] >= 0 && $_POST['ad_gear'] <= 1)
	{
		$id_gear_type = $_POST['ad_gear'];
	}
	else
	{
		$_SESSION['error'] = "Wybierz rodzaj skrzyni biegów pojazdu";
		header('Location: '.$_SERVER['HTTP_REFERER']);
		exit();
	}	

	if(isset($_POST['ad_Color']) && $_POST['ad_Color'] > 0)
	{
		$id_color = $_POST['ad_Color'];
	}
	else
	{
		$id_color = "null";
	}	

	if(isset($_POST['ad_count_doors']) && $_POST['ad_count_doors'] >= 0  && $_POST['ad_count_doors'] <= 1)
	{
		$count_doors = $_POST['ad_count_doors'];
	}
	else
	{
		$_SESSION['error'] = "Wybierz liczbę drzwi pojazdu";
		header('Location: '.$_SERVER['HTTP_REFERER']);
		exit();
	}	

	if(isset($_POST['ad_count_seats']) && $_POST['ad_count_seats'] > 0  && $_POST['ad_count_seats'] < 61)
	{
		$count_seats = $_POST['ad_count_seats'];
	}
	else
	{
		$count_seats = 0;
	}	

	if(isset($_POST['ad_color_type']) && $_POST['ad_color_type'] > 0)
	{
		$id_color_type = $_POST['ad_color_type'];
	}
	else
	{
		$id_color_type = "null";
	}	

	foreach ($_POST as $key => $value) {
		if(strpos($key, "equipment_"))
		{
			$equipment .= preg_replace('/[^0-9]/', '', $key)." ";
		}
		else
		{
			$equipment .= "";
		}
	}

	$id_ad = "null";
	$id_user = $_SESSION['id_user'];
	$id_som_car_kind=0;
	$crashed = (isset($_POST['ad_option_crashed'])) ? 1 : 0;
	$new_car = (isset($_POST['ad_option_new_car'])) ? 1 : 0;
	$ASO = (isset($_POST['ad_option_aso'])) ? 1 : 0;
	$pl_registration = (isset($_POST['ad_option_poland'])) ? 1 : 0;
	$england = (isset($_POST['ad_option_UK'])) ? 1 : 0;
	$drive_4x4 = (isset($_POST['ad_equipment_75'])) ? 1 : 0;
	$date_add = "NOW()";
	$date_upd = "NOW()";
	$active = 0;
	$active_days = 30;
	
	if(isset($_POST['ad_desc']))
	{
		$description = $_POST['ad_desc'];
	}
	else
	{
		$description = "";
	}	

	if(isset($_POST['ad_user_name']))
	{
		$salesman_name = $_POST['ad_user_name'];
	}
	else
	{
		$salesman_name = $_SESSION['name'];
	}	

	if(isset($_POST['ad_engine_capacity']) && is_numeric($_POST['ad_engine_capacity']) && $_POST['ad_engine_capacity']>0)
	{
		$engine_capacity = $_POST['ad_engine_capacity'];
	}
	else
	{
		$_SESSION['error'] = "Podaj pojemność silnika pojazdu";
		header('Location: '.$_SERVER['HTTP_REFERER']);
		exit();
	}	

	if(isset($_POST['ad_first_country']) && $_POST['ad_first_country'] > 0)
	{
		$id_country_of_origin = $_POST['ad_first_country'];
	}
	else
	{
		$id_country_of_origin = "null";
	}	
	// $sql = $conn->prepare
	// $sql->bind_param(
	
	if(isset($_POST['id_ad']))
	{
		$sql = "UPDATE som_ad SET 
			id_type_car=".$id_type_car.",
			id_fuel=".$id_fuel.",
			price=".$price.",
			mileage=".$mileage.",
			year=".$year.",
			VIN='".$VIN."',
			title='".$title."',
			horsepower=".$horsepower.",
			id_gear_type=".$id_gear_type.",
			id_som_car_kind=".$id_som_car_kind.",
			id_color=".$id_color.",
			count_doors=".$count_doors.",
			count_seats=".$count_seats.",
			id_color_type=".$id_color_type.",
			crashed=".$crashed.",
			new_car=".$new_car.",
			equipment='".$equipment."',
			ASO=".$ASO.",
			description='".$description."',
			salesman_name='".$salesman_name."',
			id_user=".$id_user.",
			engine_capacity=".$engine_capacity.",
			drive_4x4=".$drive_4x4.",
			england=".$england.",
			id_country_of_origin=".$id_country_of_origin.",
			pl_registration=".$pl_registration.",
			date_upd=".$date_upd." WHERE id_ad =".$_POST['id_ad'];
	}
	else
	{
		$sql = "INSERT INTO som_ad (id_ad, id_mark, id_model, id_type_car, id_fuel, price, mileage, year, VIN, title, horsepower, id_gear_type, id_som_car_kind, id_color, count_doors, count_seats, id_color_type, crashed, new_car, equipment, ASO, description, salesman_name, id_user, engine_capacity, drive_4x4, england, id_country_of_origin, pl_registration, date_add, date_upd, active, active_days) 
		VALUES (
			".$id_ad.",
			".$id_mark.",
			".$id_model.",
			".$id_type_car.",
			".$id_fuel.",
			".$price.",
			".$mileage.",
			".$year.",
			'".$VIN."',
			'".$title."',
			".$horsepower.",
			".$id_gear_type.",
			".$id_som_car_kind.",
			".$id_color.",
			".$count_doors.",
			".$count_seats.",
			".$id_color_type.",
			".$crashed.",
			".$new_car.",
			'".$equipment."',
			".$ASO.",
			'".$description."',
			'".$salesman_name."',
			".$id_user.",
			".$engine_capacity.",
			".$drive_4x4.",
			".$england.",
			".$id_country_of_origin.",
			".$pl_registration.",
			".$date_add.",
			".$date_upd.",
			".$active.",
			".$active_days."
		)";
	}
	if(DB::query($sql))
	{
		// echo "Dodano ogłoszenie </br>";

		// Dodawanie zdjec
		if(!isset($_POST['id_ad']))
		{
			$result = DB::query("SELECT max(id_ad) FROM som_ad");
			if($result !== false)
			{
				$id_ad_temp = $result -> fetch_assoc();
				$id_ad = $id_ad_temp['max(id_ad)'];

				$target_dir = "../img/".$id_ad."/";
				mkdir ($target_dir, 0777);				
					// echo "<pre>";
					// echo 'Tablica $_FILES: '.count($_FILES['images']).' </br>';
					// print_r($_FILES);
					// echo "</pre>";
				if(count($_FILES['images'])) 
				{
					$images_name;

					$countImg = count($_FILES['images']['name']);

					for ($i=0; $i<$countImg; $i++)
					{
						// $target_file = $target_dir . basename($_FILES['images']['name'][$i]);
						
						$tmp = pathinfo($_FILES['images']['name'][$i], PATHINFO_EXTENSION);
						$target_file = $target_dir.$i.".".$tmp;
						$uploadOk = 1;
						$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

						// Check if image file is a actual image or fake image
						$check = getimagesize($_FILES['images']["tmp_name"][$i]);
						if($check === false) {
							$_SESSION['error'] .= "Plik nie jest obrazkiem. ";
							$uploadOk = 0;
						}

						// Check if file already exists
						if (file_exists($target_file)) {
							$_SESSION['error'] .= "Plik o tej nazwie już istnieje. ";
							$uploadOk = 0;
						}

						// Check file size
						if ($_FILES['images']["size"][$i] > 500000) {
							$_SESSION['error'] .= "Plik jest zbyt duży.";
							$uploadOk = 0;
						}

						// Allow certain file formats
						if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
						&& $imageFileType != "gif" ) {
							$_SESSION['error'] .= "Możesz wgrać tylko pliki: JPG, JPEG, PNG i GIF. ";
							$uploadOk = 0;
						}

						// Check if $uploadOk is set to 0 by an error
						if ($uploadOk == 0) {
							$_SESSION['error'] .= "Twoje zdjęcia nie zostały wgrane na serwer! ";

						// if everything is ok, try to upload file
						} else {
							if (move_uploaded_file($_FILES['images']["tmp_name"][$i], $target_file)) {
								$images_name .= $i.".".$tmp." ";
								// echo "Plik ". basename( $file["name"]). " został załadowany pomyślnie.";
							} else {
								$_SESSION['error'] .= "Błąd wgrywania pliku ". basename($_FILES['images']['name'][$i]). "! ";
							}
						}
					}
					$sql = 'UPDATE som_ad SET images = "'.$images_name.'" WHERE id_ad = '.$id_ad;
					if(DB::query($sql))
					{
						$_SESSION['error'] .= "Dodano nazwy zdjęć";
					}
					else
					{
						$_SESSION['error'] .= "Nie dodano nazw zdjęć - problem z SQL: ".$sql;
					}
				}
				else
				{
					$_SESSION['error'] .= "Brak plików graficznych";
				}
			}
			else
			{
				// echo "nie można wyciągnąć max ID";
				$_SESSION['error'] = "Brak dostępu do bazy danych";
				header('Location: '.$_SERVER['HTTP_REFERER']);
				exit();
			}
		}
		// /Dodawanie zdjęć

		if(isset($_POST['id_ad']))
		{
			$_SESSION['info'] = "Gratualcje! Ogłoszenie zostało zaktualizowane.";
			header('Location: '.$_SERVER['HTTP_REFERER']); 
		}
		else
		{
			$_SESSION['info'] = "Gratualcje! Ogłoszenie zostało dodane.";
			header('Location: index.php');
		}
			
	}
	else
	{
		// echo "Nie udało się dodać ogłoszenia";
		$_SESSION['error'] = "Nie udało się dodać ogłoszenia do bazy danych - ponów próbę! ".$sql;
		header('Location: '.$_SERVER['HTTP_REFERER']); 
		exit();
	}

	// if(isset($_SESSION['error']))
	// {
	// 	echo $_SESSION['error'];
	// }

?>