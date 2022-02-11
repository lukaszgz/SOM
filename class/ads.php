<?php
require_once('../scripts/db.php');

$mysqli;

class Ads{

    protected $id_ad;
    protected $id_mark;
    protected $id_model;
    protected $id_type_car;
    protected $id_fuel;
    protected $price;
    protected $mileage;
    protected $year;
    protected $VIN;
    protected $title;
    protected $horsepower;
    protected $id_gear_type;
    protected $id_som_car_kind;
    protected $id_color;
    protected $count_doors;
    protected $id_color_type;
    protected $crashed;
    protected $new_car;
    protected $equipment;
    protected $ASO;
    protected $description;
    protected $salesman_name;
    protected $id_user;
    protected $engine_capacity;
    protected $drive_4x4;
    protected $england;
    protected $id_country_of_origin;
    protected $pl_registration;
    protected $date_upd;
    protected $date_add;
    protected $active;
    protected $active_days;

    protected $photos = array();

    public $validate_error;
    public $error=0;

    function __construct()
    {
        $sql = "SELECT * FROM som_ad";
        $result = DB::query($sql);
        if($result)
        {
            while (($ad = $result -> fetch_assoc()) !== null)
            {
                $this->id_ad = $ad['id_ad'];
                $this->id_mark = $ad['id_mark'];
                $this->id_model = $ad['id_model'];
                $this->id_type_car = $ad['id_type_car'];
                $this->id_fuel = $ad['id_fuel'];
                $this->price = $ad['price'];
                $this->mileage = $ad['mileage'];
                $this->year = $ad['year'];
                $this->VIN = $ad['VIN'];
                $this->title = $ad['title'];
                $this->horsepower = $ad['horsepower'];
                $this->id_gear_type = $ad['id_gear_type'];
                $this->id_som_car_kind = $ad['id_som_car_kind'];
                $this->id_color = $ad['id_color'];
                $this->count_doors = $ad['count_doors'];
                $this->id_color_type = $ad['id_color_type'];
                $this->crashed = $ad['crashed'];
                $this->new_car = $ad['new_car'];
                $this->equipment = $ad['equipment'];
                $this->ASO = $ad['ASO'];
                $this->description = $ad['description'];
                $this->salesman_name = $ad['salesman_name'];
                $this->id_user = $ad['id_user'];
                $this->engine_capacity = $ad['engine_capacity'];
                $this->drive_4x4 = $ad['drive_4x4'];
                $this->england = $ad['england'];
                $this->id_country_of_origin = $ad['id_country_of_origin'];
                $this->pl_registration = $ad['pl_registration'];
                $this->date_upd = $ad['date_upd'];
                $this->date_add = $ad['date_add'];
                $this->active = $ad['active'];
                $this->active_days = $ad['active_days'];       
                $this->photos = trim($ad['images']); 
            }
            if($this->photos)
            {
                $this->photos = explode(" ", $this->photos);
            }
        }
        else
        {
            return false;
        }
    }    

    function __construct1($id)
    {
        $sql = "SELECT * FROM som_ad WHERE id_ad = " .$id;
        $result = DB::query($sql);
        if($result)
        {
            while (($ad = $result -> fetch_assoc()) !== null)
            {
                $this->id_ad = $ad['id_ad'];
                $this->id_mark = $ad['id_mark'];
                $this->id_model = $ad['id_model'];
                $this->id_type_car = $ad['id_type_car'];
                $this->id_fuel = $ad['id_fuel'];
                $this->price = $ad['price'];
                $this->mileage = $ad['mileage'];
                $this->year = $ad['year'];
                $this->VIN = $ad['VIN'];
                $this->title = $ad['title'];
                $this->horsepower = $ad['horsepower'];
                $this->id_gear_type = $ad['id_gear_type'];
                $this->id_som_car_kind = $ad['id_som_car_kind'];
                $this->id_color = $ad['id_color'];
                $this->count_doors = $ad['count_doors'];
                $this->id_color_type = $ad['id_color_type'];
                $this->crashed = $ad['crashed'];
                $this->new_car = $ad['new_car'];
                $this->equipment = $ad['equipment'];
                $this->ASO = $ad['ASO'];
                $this->description = $ad['description'];
                $this->salesman_name = $ad['salesman_name'];
                $this->id_user = $ad['id_user'];
                $this->engine_capacity = $ad['engine_capacity'];
                $this->drive_4x4 = $ad['drive_4x4'];
                $this->england = $ad['england'];
                $this->id_country_of_origin = $ad['id_country_of_origin'];
                $this->pl_registration = $ad['pl_registration'];
                $this->date_upd = $ad['date_upd'];
                $this->date_add = $ad['date_add'];
                $this->active = $ad['active'];
                $this->active_days = $ad['active_days'];       
                $this->photos = trim($ad['images']); 
            }
            if($this->photos)
            {
                $this->photos = explode(" ", $this->photos);
            }
        }
        else
        {
            return false;
        }
    }    

    
    // function register()
    // {
    //     $this->error = "";
    //     $sql = 'INSERT INTO som_users (
    //             name, 
    //             email, 
    //             pass, 
    //             phone, 
    //             company, 
    //             street, 
    //             street_number, 
    //             home_number,
    //             city,
    //             post_code, 
    //             id_province
    //         ) 
    //         VALUES ('
    //             .'"'.$this->name.'", '
    //             .'"'.$this->email.'", '
    //             .'"'.$this->password.'", '
    //             .'"'.$this->phone.'", '
    //             .'"'.$this->company.'", '
    //             .'"'.$this->street.'", '
    //             .'"'.$this->street_number.'", '
    //             .$this->home_number.', '
    //             .'"'.$this->city.'", '
    //             .$this->post_code.', '
    //             .$this->id_province.')';

    //     try
    //     {
    //         if(!$result = DB::query($sql))
    //         {
    //             throw new Exception("Nie można zarejestrować użytkownika - skontaktuj się z Administratorem", 1);
    //         }
    //     }
    //     catch(Exception $e)
    //     {
    //         $this->error = $e->getMessage();
    //         return false;
    //     }
    // }

    function getAllAdData()
    {
        echo 
        'id_mark '.$this->id_mark.'</br>'.
        'id_model '.$this->id_model.'</br>'.
        'id_type_car '.$this->id_type_car.'</br>'.
        'id_fuel '.$this->id_fuel.'</br>'.
        'price '.$this->price.'</br>'.
        'mileage '.$this->mileage.'</br>'.
        'year '.$this->year.'</br>'.
        'VIN '.$this->VIN.'</br>'.
        'title '.$this->title.'</br>'.
        'horsepower '.$this->horsepower.'</br>'.
        'id_gear_type '.$this->id_gear_type.'</br>'.
        'id_som_car_kind '.$this->id_som_car_kind.'</br>'.
        'id_color '.$this->id_color.'</br>'.
        'count_doors '.$this->count_doors.'</br>'.
        'id_color_type '.$this->id_color_type.'</br>'.
        'crashed '.$this->crashed.'</br>'.
        'new_car '.$this->new_car.'</br>'.
        'equipment '.$this->equipment.'</br>'.
        'ASO '.$this->ASO.'</br>'.
        'description '.$this->description.'</br>'.
        'salesman_name '.$this->salesman_name.'</br>'.
        'id_user '.$this->id_user.'</br>'.
        'engine_capacity '.$this->engine_capacity.'</br>'.
        'drive_4x4 '.$this->drive_4x4.'</br>'.
        'england '.$this->england.'</br>'.
        'id_country_of_origin '.$this->id_country_of_origin.'</br>'.
        'pl_registration '.$this->pl_registration.'</br>'.
        'date_upd '.$this->date_upd.'</br>'.
        'date_add '.$this->date_add.'</br>'.
        'active '.$this->active.'</br>'.
        'active_days '.$this->active_days;
    }

}

function showPremiumAds($limit)
{
    $html = "";
    $html1 = "";
    if(isset($_GET['id_ad']))
    {
        $sql_temp = "SELECT id_mark, id_model FROM som_ad WHERE id_ad = ".$_GET['id_ad'];
        $res = DB::query($sql_temp);
        // $html = $res;
        if($res && $res->num_rows>0)
        {
            $row = $res -> fetch_assoc();
            $id_mark = $row['id_mark'];
            $id_model = $row['id_model'];
                    // $sql = "SELECT * FROM som_ads WHERE premium=1 AND id_model = ".$_GET['id_model'];
            $sql = "SELECT 
            a.id_ad,
            ma.mark_name, 
            mo.model_name, 
            a.title, 
            a.description,
            a.id_gear_type, 
            f.fuel_name, 
            a.year, 
            a.engine_capacity, 
            a.price, 
            a.VIN,
            a.mileage,
            a.date_add, 
            a.images,
            a.new_car,
            a.horsepower,
            pl_registration,
            c.color_name,
            ct.color_type_name,
            t.name_type,
            a.count_doors,
            a.count_seats,
            a.drive_4x4,
            a.crashed,
            a.equipment,
            ctr.name_country,
            u.phone,
            u.city FROM som_ad a 
            JOIN som_marks ma ON a.id_mark=ma.id_mark 
            JOIN som_models mo ON a.id_model=mo.id_model 
            JOIN som_fuel f ON a.id_fuel=f.id_fuel 
            JOIN som_users u ON a.id_user=u.id_user
            JOIN som_colors c ON a.id_color=c.id_color 
            JOIN som_color_type ct ON a.id_color_type=ct.id_color_type
            JOIN som_type t ON a.id_type_car=t.id_type
            JOIN som_countries ctr ON a.id_country_of_origin=ctr.id_country
            WHERE premium=1 AND a.id_model = ".$id_model." LIMIT ".$limit;

            $result = DB::query($sql);
            if($result)
            {
                if($result->num_rows>0)
                {
                    while (($r = $result -> fetch_assoc()) !== null)
                    {
                        if(!is_null($r['images']) && strlen($r['images'])>1)
                                {
                                    $images = explode(" ", trim($r['images']));

                                    $imageURL0 = '../img/'.$r['id_ad'].'/'.$images[0];
                                }
                                else
                                {   
                                    $imageURL0 = '../img/empty.png';
                                }

                        $html .= '
                        <div class="card col-sm-12 col-xl-4">
                        <h3 class="h3 center alert alert-dark p-0">'.$r['price'].' PLN</h3>
                        <img class="card-img-top" src="'.$imageURL0.'" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">'.$r['mark_name'].' '.$r['model_name'].'</h5>
                            <p class="card-text">'.$r['title'].'</p>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">Rok produkcji: <strong>'.$r['year'].'</strong></li>
                            <li class="list-group-item">Przebieg: <strong>'.$r['mileage'].'</strong></li>
                            <li class="list-group-item">Paliwo: <strong>'.$r['fuel_name'].'</strong></li>
                        </ul>
                        <div class="card-body">
                            <a href="ad.php?id_ad='.$r['id_ad'].'" class="card-link">Zobacz</a>
                        </div>
                        </div>
                        ';
                    }
                }
                else
                {
                    $sql = "SELECT 
                    a.id_ad,
                    ma.mark_name, 
                    mo.model_name, 
                    a.title, 
                    a.description,
                    a.id_gear_type, 
                    f.fuel_name, 
                    a.year, 
                    a.engine_capacity, 
                    a.price, 
                    a.VIN,
                    a.mileage,
                    a.date_add, 
                    a.images,
                    a.new_car,
                    a.horsepower,
                    pl_registration,
                    c.color_name,
                    ct.color_type_name,
                    t.name_type,
                    a.count_doors,
                    a.count_seats,
                    a.drive_4x4,
                    a.crashed,
                    a.equipment,
                    ctr.name_country,
                    u.phone,
                    u.city FROM som_ad a 
                    JOIN som_marks ma ON a.id_mark=ma.id_mark 
                    JOIN som_models mo ON a.id_model=mo.id_model 
                    JOIN som_fuel f ON a.id_fuel=f.id_fuel 
                    JOIN som_users u ON a.id_user=u.id_user
                    JOIN som_colors c ON a.id_color=c.id_color 
                    JOIN som_color_type ct ON a.id_color_type=ct.id_color_type
                    JOIN som_type t ON a.id_type_car=t.id_type
                    JOIN som_countries ctr ON a.id_country_of_origin=ctr.id_country 
                    WHERE premium=1 AND a.id_mark = ".$id_mark." LIMIT ".$limit;

                    $result = DB::query($sql);
                    if($result)
                    {
                        if($result->num_rows>0)
                        {
                            while (($r = $result -> fetch_assoc()) !== null)
                            {
                                if(!is_null($r['images']) && strlen($r['images'])>1)
                                {
                                    $images = explode(" ", trim($r['images']));

                                    $imageURL0 = '../img/'.$r['id_ad'].'/'.$images[0];
                                }
                                else
                                {   
                                    $imageURL0 = '../img/empty.png';
                                }

                                $html .= '
                                <div class="card col-4" style="width: 18rem;">
                                <h3 class="h3 center alert alert-dark p-0">'.$r['price'].' PLN</h3>
                                <img class="card-img-top" src="'.$imageURL0.'" alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title">'.$r['mark_name'].' '.$r['model_name'].'</h5>
                                    <p class="card-text">'.$r['title'].'</p>
                                </div>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">Rok produkcji: <strong>'.$r['year'].'</strong></li>
                                    <li class="list-group-item">Przebieg: <strong>'.$r['mileage'].'</strong></li>
                                    <li class="list-group-item">Paliwo: <strong>'.$r['fuel_name'].'</strong></li>
                                </ul>
                                <div class="card-body">
                                    <a href="ad.php?id_ad='.$r['id_ad'].'" class="card-link">Zobacz</a>
                                </div>
                                </div>
                                ';
                            }
                        }
                    }
                }
            }
        }
    }

    echo $html;
}
    
    


?>