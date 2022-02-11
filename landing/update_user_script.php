<?php
	session_start();	

	require_once('../scripts/db.php');
	require_once('../class/user.php');

	// echo "<pre>";
	// print_r($_POST);
	// echo "</pre>";

	if ((!isset($_POST['inputEmailEdit'])))
	{
		header('Location: index.php');
		exit();
	}
	else
	{
		$_SESSION['inputNameEdit'] = $_POST['inputNameEdit'];
		$_SESSION['inputSurnameEdit'] = $_POST['inputSurnameEdit'];
		$_SESSION['inputEmailEdit'] = $_POST['inputEmailEdit'];
		$_SESSION['inputPhoneEdit'] = $_POST['inputPhoneEdit'];
		$_SESSION['inputCompanyEdit'] = $_POST['inputCompanyEdit']; 
		$_SESSION['inputStreetNameEdit'] = $_POST['inputStreetNameEdit'];
		$_SESSION['inputStreetNumberEdit'] = $_POST['inputStreetNumberEdit'];
		$_SESSION['inputHomeNumberEdit'] = $_POST['inputHomeNumberEdit'];
		$_SESSION['inputCityEdit'] = $_POST['inputCityEdit'];
		$_SESSION['inputZipCodeEdit'] = $_POST['inputZipCodeEdit'];
		$_SESSION['inputProvinceEdit'] = $_POST['inputProvinceEdit'];

		$password = "";
		$user = new User(
			$_POST['inputNameEdit'], 
			$_POST['inputSurnameEdit'], 
			$_POST['inputEmailEdit'], 
			$password,
			$_POST['inputPhoneEdit'], 
			$_POST['inputCompanyEdit'], 
			$_POST['inputStreetNameEdit'],
			$_POST['inputStreetNumberEdit'],
			$_POST['inputHomeNumberEdit'],
			$_POST['inputCityEdit'],
			$_POST['inputZipCodeEdit'],
			$_POST['inputProvinceEdit']
		);
		
		if($user->validationToRegistration())
		{
			// $user->getAllUserData();
			$user->update();
			$_SESSION['info'] = "Aktualizacja danych przebiegła pomyślnie ".$user->getName();
			header('Location: '.$_SERVER['HTTP_REFERER']);
		}
		else
		{
			$_SESSION['error'] = "Walidacja danych nieudana: ".$user->validate_error;
			header('Location: '.$_SERVER['HTTP_REFERER']);
		}	

		// $login = $_POST['login'];
		// $password = $_POST['password'];
		
		// $login = htmlentities($login, ENT_QUOTES, "UTF-8");
		// $password = htmlentities($password, ENT_QUOTES, "UTF-8");
    
        // $sql = "SELECT * FROM som_users WHERE email like '$login' AND pass like '$password'";

		// if ($result = $mysqli->query($sql))
		// {
        //     $rows = $result->num_rows;
            
		// 	if($rows>0)
		// 	{
		// 		$_SESSION['user_login'] = true;
				
		// 		$row = $result->fetch_assoc();
		// 		$_SESSION['id_user'] = $row['id_user'];
		// 		$_SESSION['name'] = $row['name'];
		// 		$_SESSION['surname'] = $row['surname'];
		// 		$_SESSION['company'] = $row['company'];
		// 		$_SESSION['email'] = $row['email'];
		// 		$_SESSION['phone'] = $row['phone'];
        //         $_SESSION['id_country'] = $row['id_country'];
        //         $_SESSION['city'] = $row['city'];
        //         $_SESSION['province'] = $row['province'];
        //         $_SESSION['post_code'] = $row['post_code'];
        //         $_SESSION['street'] = $row['street'];
        //         $_SESSION['street_number'] = $row['street_number'];
        //         $_SESSION['home_number'] = $row['home_number'];
				
		// 		unset($_SESSION['error']);
		// 		$result->free_result();
		// 		header('Location: index.php');
				
		// 	} else {
				
        //         // $_SESSION['error'] = 'Nieprawidłowy login lub hasło!';
        //         $_SESSION['error'] = $sql;
		// 		header('Location: index.php');
				
		// 	}
			
		// }
	}
	
?>