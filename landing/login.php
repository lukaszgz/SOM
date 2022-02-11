<?php
    session_start();
	require_once('../scripts/db.php');
	// $h = password_hash("haslo", PASSWORD_DEFAULT);
	// $test = 'UPDATE som_users SET pass = "'.$h.'"';
	// $result = DB::query($test);


	if ((!isset($_POST['login'])) || (!isset($_POST['password'])))
	{
		header('Location: index.php');
		exit();
	}
	else
	{
		$login = $_POST['login'];
		$password = $_POST['password'];
		
		$login = htmlentities($login, ENT_QUOTES, "UTF-8");
		$password = htmlentities($password, ENT_QUOTES, "UTF-8");
    
        $sql = 'SELECT * FROM som_users WHERE email like "'.$login.'"';

		if ($result = DB::query($sql))
		{
			$rows = $result->num_rows;

			if($rows>0)
			{
				$row = $result->fetch_assoc();

				if(password_verify($_POST['password'], $row['pass']))
				{	
					$_SESSION['user_login'] = true;

					$_SESSION['id_user'] = $row['id_user'];
					$_SESSION['name'] = $row['name'];
					$_SESSION['surname'] = $row['surname'];
					$_SESSION['company'] = $row['company'];
					$_SESSION['email'] = $row['email'];
					$_SESSION['phone'] = $row['phone'];
					$_SESSION['id_country'] = $row['id_country'];
					$_SESSION['city'] = $row['city'];
					$_SESSION['province'] = $row['id_province'];
					$_SESSION['post_code'] = $row['post_code'];
					$_SESSION['street'] = $row['street'];
					$_SESSION['street_number'] = $row['street_number'];
					$_SESSION['home_number'] = $row['home_number'];
					$_SESSION['login'] = true;
					
					unset($_SESSION['error']);
					// $result->free_result();
					header('Location: '.$_SERVER['HTTP_REFERER']);
				}
				else
				{
					$_SESSION['error'] .= 'Nieprawidłowe hasło!'.$test;
					// $_SESSION['error'] = $sql;
					header('Location: '.$_SERVER['HTTP_REFERER']);
				}
			} 
			else 
			{
				$_SESSION['error'] = 'Nieprawidłowy login lub hasło! '.$test;
				// $_SESSION['error'] = $sql;
				header('Location: '.$_SERVER['HTTP_REFERER']);
			}
			
		}
	}
	
?>