<?php
	session_start();	

	require_once('../scripts/db.php');
	require_once('../class/user.php');

	if ((!isset($_POST['inputEmailRegister'])) || (!isset($_POST['inputPasswordRegister'])))
	{
		header('Location: index.php');
		exit();
	}
	else
	{
		$_SESSION['inputNameRegister'] = $_POST['inputNameRegister'];
		$_SESSION['inputSurnameRegister'] = (isset($_POST['inputSurnameRegister']))?$_POST['inputSurnameRegister']:"";
		$_SESSION['inputEmailRegister'] = $_POST['inputEmailRegister'];
		$_SESSION['inputPhoneRegister'] = $_POST['inputPhoneRegister'];
		$_SESSION['inputCompanyRegister'] = $_POST['inputCompanyRegister']; 
		$_SESSION['inputStreetNameRegister'] = $_POST['inputStreetNameRegister'];
		$_SESSION['inputStreetNumberRegister'] = $_POST['inputStreetNumberRegister'];
		$_SESSION['inputHomeNumberRegister'] = $_POST['inputHomeNumberRegister'];
		$_SESSION['inputCityRegister'] = $_POST['inputCityRegister'];
		$_SESSION['inputZipCodeRegister'] = $_POST['inputZipCodeRegister'];
		$_SESSION['inputProvinceRegister'] = $_POST['inputProvinceRegister'];

		$sql = 'SELECT * FROM som_users WHERE email like "'.$_POST['inputEmailRegister'].'"';
		
		if($result = DB::query($sql));
		{
			if($result->num_rows>0)
			{
				$_SESSION['error'] = "Użytkownik o podanym adresie email już istnieje.";
				header('Location: index.php');
				exit();
			}
			else
			{
				if($_POST['inputPasswordRegister'] == $_POST['inputPasswordRegister2'])
				{
					$password_hash = password_hash($_POST['inputPasswordRegister'], PASSWORD_DEFAULT);
					$user = new User(
						$_POST['inputNameRegister'], 
						$_POST['inputSurnameRegister'], 
						$_POST['inputEmailRegister'], 
						$password_hash,
						$_POST['inputPhoneRegister'], 
						$_POST['inputCompanyRegister'], 
						$_POST['inputStreetNameRegister'],
						$_POST['inputStreetNumberRegister'],
						$_POST['inputHomeNumberRegister'],
						$_POST['inputCityRegister'],
						$_POST['inputZipCodeRegister'],
						$_POST['inputProvinceRegister']
					);
				}
				else
				{
					$_SESSION['error'] = "Walidacja nieudana: Podane hasła nie są takie same.";
					header('Location: index.php');
					exit();
				}
				if($user->validationToRegistration())
				{
					$user->register();
					$_SESSION['info'] = "Rejestracja przebiegła pomyślnie! ".$user->getName()." możesz się teraz zalogować";
					header('Location: index.php');
					exit();
				}
				else
				{
					$_SESSION['error'] = "Walidacja nieudana: ".$user->validate_error;
					header('Location: index.php');
					exit();
				}	
			}
		}
	}
	
?>