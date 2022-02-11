<?php
require_once('../scripts/db.php');

$mysqli;

class User{

    protected $id;
    protected $name;
    protected $surname;
    protected $email;
    protected $password;
    protected $company;
    protected $phone;
    protected $id_country;
    protected $country;
    protected $city;
    protected $id_province;
    protected $province;
    protected $post_code;
    protected $street;
    protected $street_number;
    protected $home_number;

    public $validate_error;
    public $error;

    function __construct($name, $surname, $email, $password, $phone, $company, $street, $street_number, $home_number, $city, $post_code, $id_province, $id_country=1)
    {
        $this->name = $name;
        $this->surname = $surname;
        $this->email = $email;
        $this->password = $password;
        $this->phone = $phone;
        $this->company = $company;
        $this->street = $street;
        $this->street_number = $street_number;
        $this->home_number = $home_number;
        $this->city = $city;
        $this->post_code = $post_code;
        $this->id_province = $id_province;
        $this->id_country = $id_country;
    }    

    // function __construct1($id_user)
    // {
    //     $sql = "Select * from som_users WHERE id_user =".$id_user;
    //     if ($result = DB::query($sql))
    //     {
    //         if($result->num_rows>0)
    //         {
    //             $row = $result->fetch_assoc();

    //             $this->name = $row['name'];
    //             $this->surname = $row['surname'];
    //             $this->email = $row['email'];
    //             $this->phone = $row['phone'];
    //             $this->company = $row['company'];
    //             $this->street = $row['street'];
    //             $this->password = $row['pass'];
    //             $this->street_number = $row['street_number'];
    //             $this->home_number = $row['home_number'];
    //             $this->city = $row['city'];
    //             $this->post_code = $row['post_code'];
    //             $this->id_province = $row['id_province'];
    //             $this->id_country = $row['id_country'];
    //         }
    //     }
    // }    

    function getName()
    {
        return $this->name;
    }

    function validationToRegistration()
    {
        $name = filter_var(substr($this->name, 0, 16), FILTER_SANITIZE_FULL_SPECIAL_CHARS); 
        $surname = filter_var(substr($this->surname, 0, 16), FILTER_SANITIZE_FULL_SPECIAL_CHARS); 
        $email = filter_var($this->email, FILTER_SANITIZE_EMAIL);
        $password = filter_var(substr($this->password, 0, 512), FILTER_SANITIZE_FULL_SPECIAL_CHARS);    
        $phone = filter_var($this->phone, FILTER_SANITIZE_NUMBER_INT);    
        $company = filter_var(substr($this->company, 0, 16), FILTER_SANITIZE_FULL_SPECIAL_CHARS);      
        $street = filter_var(substr($this->street, 0, 32), FILTER_SANITIZE_FULL_SPECIAL_CHARS);      
        $street_number = filter_var(substr($this->street_number, 0, 6), FILTER_SANITIZE_FULL_SPECIAL_CHARS);       
        $home_number = filter_var($this->home_number, FILTER_SANITIZE_NUMBER_INT);  
        $city = filter_var(substr($this->city, 0, 32), FILTER_SANITIZE_FULL_SPECIAL_CHARS);   
        $post_code = filter_var($this->post_code, FILTER_SANITIZE_NUMBER_INT);    
        $id_province = filter_var($this->id_province, FILTER_SANITIZE_NUMBER_INT);
        $id_country = filter_var($this->id_country, FILTER_SANITIZE_NUMBER_INT);

        if($this->name != $name)
        {
            $this->validate_error = "Niepoprawna wartość w polu IMIĘ (max 16 znaków)";
            return false;
        }
        if($this->surname != $surname)
        {
            $this->validate_error = "Niepoprawna wartość w polu NAZWISKO (max 16 znaków)";
            return false;
        }
        if($this->email != $email)
        {
            $this->validate_error = "Niepoprawna wartość w polu EMAIL";
            return false;
        }
        if($this->password != $password)
        {
            $this->validate_error = "Niepoprawna wartość w polu HASŁO";
            return false;
        }
        if($this->phone != $phone)
        {
            $this->validate_error = "Niepoprawna wartość w polu NUMER TELEFONU (max 16 znaków)";
            return false;
        }
        if($this->company != $company)
        {
            $this->validate_error = "Niepoprawna wartość w polu COMPANY (max 16 znaków)";
            return false;
        }
        if($this->street != $street)
        {
            $this->validate_error = "Niepoprawna wartość w polu ULICA (max 32 znaki)";
            return false;
        }
        if($this->street_number != $street_number)
        {
            $this->validate_error = "Niepoprawna wartość w polu NUMER ULICY";
            return false;
        }
        if($this->home_number != $home_number)
        {
            $this->validate_error = "Niepoprawna wartość w polu NUMER MIESZKANIA";
            return false;
        }
        if(strcmp($this->city, $city) != 0)
        {
            $this->validate_error = "Niepoprawna wartość w polu MIASTO (max 32 znaki): ".$this->city;
            return false;
        }
        if($this->post_code != $post_code)
        {
            $this->validate_error = "Niepoprawna wartość w polu KOD POCZTOWY (XX-XXX)";
            return false;
        }
        if($this->id_province != $id_province)
        {
            $this->validate_error = "Niepoprawna wartość w polu WOJEWÓDZTWO (Wybierz z listy)";
            return false;
        }
        if($this->id_country != $id_country)
        {
            $this->validate_error = "Niepoprawna wartość w polu KRAJ (pole nieaktywne)";
            return false;
        }

        $this->validate_error = "";
        return true;
    }

    function register()
    {
        $this->error = "";
        $sql = 'INSERT INTO som_users (
                name, 
                email, 
                pass, 
                phone, 
                company, 
                street, 
                street_number, 
                home_number,
                city,
                post_code, 
                id_province
            ) 
            VALUES ('
                .'"'.$this->name.'", '
                .'"'.$this->email.'", '
                .'"'.$this->password.'", '
                .'"'.$this->phone.'", '
                .'"'.$this->company.'", '
                .'"'.$this->street.'", '
                .'"'.$this->street_number.'", '
                .$this->home_number.', '
                .'"'.$this->city.'", '
                .$this->post_code.', '
                .$this->id_province.')';

        try
        {
            if(!$result = DB::query($sql))
            {
                throw new Exception("Nie można zarejestrować użytkownika - skontaktuj się z Administratorem", 1);
            }
        }
        catch(Exception $e)
        {
            $this->error = $e->getMessage();
            return false;
        }
    }

    function update()
    {
        $this->error = "";
        $sql = 'UPDATE som_users SET 
                name = "'.$this->name.'", 
                surname = "'.$this->surname.'", 
                email = "'.$this->email.'",
                phone = "'.$this->phone.'", 
                company = "'.$this->company.'", 
                street = "'.$this->street.'", 
                street_number ="'.$this->street_number.'", 
                home_number = '.$this->home_number.',
                city = "'.$this->city.'",
                post_code = '.$this->post_code.', 
                id_province ='.$this->id_province.' WHERE id_user ='.$_SESSION['id_user'];

                // $_SESSION['error']=$sql;
        try
        {
            if(!$result = DB::query($sql))
            {
                throw new Exception("Nie można zaktualizować danych użytkownika - skontaktuj się z Administratorem", 1);
            }
        }
        catch(Exception $e)
        {
            $this->error = $e->getMessage();
            return false;
        }
    }

    function getAllUserData()
    {
        echo 
        "name: ".$this->name."<br>".
        "surname: ".$this->surname."<br>".
        "email: ".$this->email."<br>".
        "password: ".$this->password."<br>".
        "phone: ".$this->phone."<br>".
        "company: ".$this->company."<br>".
        "street: ".$this->street."<br>".
        "street_number: ".$this->street_number."<br>".
        "home_number: ".$this->home_number."<br>".
        "city: ".$this->city."<br>".
        "post_code: ".$this->post_code."<br>".
        "id_province: ".$this->id_province."<br>".
        "id_country: ".$this->id_country;
    }

}


?>