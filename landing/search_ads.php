<?php
require_once('../scripts/db.php');
require_once('../parts/head.php');
require_once('../parts/nav.php');

require_once('../scripts/cars.php');
require_once('../scripts/type_cars.php');
require_once('../scripts/fuel.php');
require_once('../scripts/colors.php');
require_once('../scripts/color_type.php');
require_once('../scripts/equipment.php');
require_once('../scripts/countries.php');
?>

<section class="content">
    <div class="container-fluid mt-3">
        <div class="row">
            <div class="col-2 d-none d-md-block">
                <!-- Categy list -->
                <div class="list-group">
                    <?php
$sql = 'SELECT * FROM som_marks order by mark_name';
if(isset($_GET['id_mark']) && $_GET['id_mark']>0 && $result = DB::query($sql))
{
  $get_id_mark = $_GET['id_mark'];
  $get_id_model = (isset($_GET['id_model']))? $_GET['id_model'] : 0;

  $sql_model = 'SELECT m.id_mark, m.mark_name, mo.id_model, mo.model_name FROM som_marks m JOIN som_models mo ON m.id_mark=mo.id_mark WHERE m.id_mark = '.$_GET['id_mark'].' order by mo.model_name';
  if($result_model = DB::query($sql_model))
  {
    while (($row = $result -> fetch_assoc()) !== null)
    {
      if($row['id_mark'] == $get_id_mark)
      {
        echo '<a href="search_ads.php?id_mark='.$row['id_mark'].'" class="list-group-item list-group-item-action py-1" value="'.$row['id_mark'].'"><strong>'.$row['mark_name'].'</strong></a>';
        if($result_model->num_rows>0)
        {
          while (($row_model = $result_model -> fetch_assoc()) !== null)
          {
            // echo '<a href="search_ads.php?id_model='.$row_model['id_model'].'" class="list-group-item list-group-item-action py-1 bg-light pl-5" value="'.$row_model['id_model'].'"><small>'.$row_model['model_name'].'</small></a>';
            $list_element_model = '<a href="search_ads.php?id_mark='.$row['id_mark'].'&id_model='.$row_model['id_model'].'" class="list-group-item list-group-item-action py-1 bg-light pl-5" value="'.$row_model['id_model'].'"><small>'.$row_model['model_name'].'</small></a>';
            $list_element_model_bold = '<a href="search_ads.php?id_mark='.$row['id_mark'].'&id_model='.$row_model['id_model'].'" class="list-group-item list-group-item-action py-1 bg-light pl-5" value="'.$row_model['id_model'].'"><small><strong>'.$row_model['model_name'].'</strong></small></a>';
            echo ($row_model['id_model'] == $get_id_model)? $list_element_model_bold : $list_element_model;
          }
        }
      }
      else
      {
        echo '<a href="search_ads.php?id_mark='.$row['id_mark'].'" class="list-group-item list-group-item-action py-1" value="'.$row['id_mark'].'">'.$row['mark_name'].'</a>';
      }
    }
  }
}
else
{
  header('Location: index.php');
	exit();
}
// $wynik -> close(); // zwolnienie pamięci
?>
                </div>
            </div>

            <div class="col-12 col-md-8">
                <div class="full-search-sec mb-3 pb-1">
                    <div class="container-fluid d-none d-md-block">
                        <form method="POST" action="#" enctype="multipart/form-data" id="filterForm">
                            <div class="form-group pt-2">
                                <!-- <p>Typ nadwozia</p> -->
                                <?php
                    foreach ($car_type as $key => $value)
                    {
                        if(isset($_GET['type']))
                        {
                            $checked = ($_GET['type'] == $key)? "checked" : "";
                        }
                        else
                        {
                            $checked = "";
                        }
                        
                        echo '<div class="custom-control custom-radio custom-control-inline">
                            <input '.$checked.' class="custom-control-input" type="radio" name="car_type" id="CarTypeRadio'.$key.'"
                            value='.$key.'>
                            <label class="custom-control-label" for="CarTypeRadio'.$key.'">'.$value.'</label>
                            </div>';
                    }
                ?>
                            </div>
                            <div class="form-row align-items-center">
                                <div class="col">
                                    <div class="input-group input-group-sm mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">Liczba drzwi</div>
                                        </div>

                                        <select name="search_count_doors" class="custom-select"
                                            id="searchSelectCountDoors">
                                            <?php 
                                                $cd = (isset($_GET['countDoors']))? $_GET['countDoors'] : "-1";
                                            ?>
                                            <option value="-1" <?php echo ($cd < 0)? "selected" : ""; ?>>Wybierz
                                            </option>
                                            <option value="0" <?php echo ($cd == 0)? "selected" : ""; ?>>2/3</option>
                                            <option value="1" <?php echo ($cd == 1)? "selected" : ""; ?>>4/5</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="input-group input-group-sm mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">Kolor</div>
                                        </div>
                                        <select name="search_color" class="custom-select" id="searchSelectColor">
                                            <?php 
                                                $color = (isset($_GET['color']))? $_GET['color'] : "-1";
                                                if($color>0)
                                                {
                                                    echo '<option value="-1" >Wybierz...</option>';
                                                }
                                                else
                                                {
                                                    echo '<option value="-1" selected >Wybierz...</option>';
                                                }           
                                                
                                                foreach ($colors as $key => $value)
                                                {
                                                    $selected = ($color == $key)? "selected" : "";
                                                    echo '<option '.$selected.' value='.$key.'>'.$value.'</option>';
                                                }
                                                
                            ?>
                                        </select>
                                    </div>
                                </div>
                                <!-- <div class="col">
                                    <div class="input-group input-group-sm mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">Typ Lakieru</div>
                                        </div>
                                        <select name="search_color_type" class="custom-select"
                                            id="searchSelectColorType">
                                            <option value="-1" selected>Wybierz...</option> -->
                                <?php
                                // foreach ($color_type as $key => $value)
                                // {
                                //     echo '<option value='.$key.'>'.$value.'</option>';
                                // }
                            ?>
                                <!-- </select> -->
                                <!-- </div> -->
                                <!-- </div> -->
                                <div class="col">
                                    <div class="input-group input-group-sm mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">Skrzynia biegów</div>
                                        </div>
                                        <select name="search_gear" class="custom-select" id="searchSelectGearType">
                                            <?php 
                                                $gear = (isset($_GET['gear']))? $_GET['gear'] : "-1";
                                            ?>
                                            <option <?php echo ($gear < 0)? "selected" : ""; ?> value="-1">Wybierz...
                                            </option>
                                            <option <?php echo ($gear == 0)? "selected" : ""; ?> value="0">Manulana
                                            </option>
                                            <option <?php echo ($gear == 1)? "selected" : ""; ?> value="1">Automatyczna
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group input-group input-group-sm mb-2">
                                        <!-- <label for="AddAdSelectCountry">Kraj pochodzenia</label> -->
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">Kraj pochodzenia</div>
                                        </div>
                                        <select name="search_first_country" class="custom-select"
                                            id="searchSelectCountry">
                                            <?php
                                            
                                            $country = (isset($_GET['country']))? $_GET['country'] : "-1";
                                            if($country>0)
                                            {
                                                echo '<option value="-1">Wybierz...</option>';
                                            }
                                            else
                                            {
                                                echo '<option value="-1" selected>Wybierz...</option>';
                                            }           
                                            foreach ($countries as $key => $value)
                                            {
                                                $selected = ($country == $key)? "selected" : "";
                                                echo '<option '.$selected.' value='.$key.'>'.$value.'</option>';
                                            }
                                           
                                            
                        ?>


                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group pt-2">
                                <!-- <p>Silnik</p> -->
                                <?php
                    foreach ($fuel as $key => $value)
                    {
                        if(isset($_GET['fuel']))
                        {
                            $checked = ($_GET['fuel'] == $key)? "checked" : "";
                        }
                        else
                        {
                            $checked = "";
                        }

                        echo '<div class="custom-control custom-radio custom-control-inline">
                        <input '.$checked.' class="custom-control-input" type="radio" name="fuel_type" id="FuelTypeRadio'.$key.'" value='.$key.'>
                        <label class="custom-control-label" for="FuelTypeRadio'.$key.'">'.$value.'</label>
                        </div>';
                    }
                ?>
                            </div>
                            <div class="form-row align-items-center">
                                <div class="col">
                                    <div class="input-group input-group-sm mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">Pojemność od</div>
                                        </div>
                                        <input name="search_engine_capacity_from" type="number" min="0" max="10000"
                                            class="form-control" id="searchAdAddEngineCapacityFrom" value="<?php echo (isset($_GET['capacityFrom']))? $_GET['capacityFrom'] : ""; ?>">
                                    </div>
                                    <div class="input-group input-group-sm mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">Pojemność do</div>
                                        </div>
                                        <input name="search_engine_capacity_from_to" type="number" min="0" max="10000"
                                            class="form-control" id="searchAdAddEngineCapacityTo" value="<?php echo (isset($_GET['capacityTo']))? $_GET['capacityTo'] : ""; ?>">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="input-group input-group-sm mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">Przebieg od (km)</div>
                                        </div>
                                        <input name="search_millage_from" type="text" class="form-control"
                                            id="searchAdAddMilageFrom" value="<?php echo (isset($_GET['millageFrom']))? $_GET['millageFrom'] : ""; ?>">
                                    </div>
                                    <div class="input-group input-group-sm mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">Przebieg do (km)</div>
                                        </div>
                                        <input name="search_millage_from_to" type="text" class="form-control"
                                            id="searchAdAddMilageTo" value="<?php echo (isset($_GET['millageFromTo']))? $_GET['millageFromTo'] : ""; ?>">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="input-group input-group-sm mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">Moc od (km)</div>
                                        </div>
                                        <input name="search_power_from" type="text" class="form-control"
                                            id="searchEnginePowerFrom" value="<?php echo (isset($_GET['powerFrom']))? $_GET['powerFrom'] : ""; ?>">
                                    </div>
                                    <div class="input-group input-group-sm mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">Moc do (km)</div>
                                        </div>
                                        <input name="search_power_to" type="text" class="form-control"
                                            id="searchEnginePowerTo" value="<?php echo (isset($_GET['powerFromTo']))? $_GET['powerFromTo'] : ""; ?>">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group input-group input-group-sm mb-2">
                                        <!-- <label for="AddAdAddYear">Rok Produkcji</label> -->
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">Rok produkcji od</div>
                                        </div>
                                        <input name="search_year_from" type="number" min="1900" max="2100"
                                            class="form-control" id="searchYearFrom" value="<?php echo (isset($_GET['yearFrom']))? $_GET['yearFrom'] : ""; ?>">
                                    </div>
                                    <div class="form-group input-group input-group-sm mb-2">
                                        <!-- <label for="AddAdAddYear">Rok Produkcji</label> -->
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">Rok produkcji do</div>
                                        </div>
                                        <input name="search_year_to" type="number" min="1900" max="2100"
                                            class="form-control" id="searchYearTo" value="<?php echo (isset($_GET['yearFromTo']))? $_GET['yearFromTo'] : ""; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="form-row align-items-center mb-2">

                                <!-- <p>Opcje dodatkowe</p> -->
                                <div class="col">
                                    <!-- <div class="form-group"> -->

                                    <div class="custom-control custom-checkbox">
                                        <input <?php echo (isset($_GET['poland'])? "checked" : "") ?>
                                            name="search_option_poland" type="checkbox" class="custom-control-input"
                                            id="searchOptionPoland">
                                        <label class="custom-control-label" for="searchOptionPoland">Zarejestrowany w
                                            Polsce</label>
                                    </div>
                                    <!-- </div> -->
                                </div>
                                <div class="col">
                                    <div class="custom-control custom-checkbox">
                                        <input <?php echo (isset($_GET['crashed'])? "checked" : "") ?>
                                            name="search_option_crashed" type="checkbox" class="custom-control-input"
                                            id="searchOptionCrashed">
                                        <label class="custom-control-label"
                                            for="searchOptionCrashed">Bezwypadkowy</label>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="custom-control custom-checkbox">
                                        <input <?php echo (isset($_GET['ASO'])? "checked" : "") ?>
                                            name="search_option_aso" type="checkbox" class="custom-control-input"
                                            id="searchOptionASO">
                                        <label class="custom-control-label" for="searchOptionASO">Serwisowany w
                                            ASO</label>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="custom-control custom-checkbox">
                                        <input <?php echo (isset($_GET['UK'])? "checked" : "") ?>
                                            name="search_option_UK" type="checkbox" class="custom-control-input"
                                            id="searchOptionUK">
                                        <label class="custom-control-label" for="searchOptionUK"
                                            title="Kierownica po prawej stronie">
                                            (Anglik)</label>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="custom-control custom-checkbox">
                                        <input <?php echo (isset($_GET['new'])? "checked" : "") ?>
                                            name="search_option_new_car" type="checkbox" class="custom-control-input"
                                            id="searchOptionNewCar">
                                        <label class="custom-control-label" for="searchOptionNewCar">Pojazd jest
                                            Nowy</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row align-items-center">
                                <div class="col">
                                    <div class="form-group input-group input-group-sm mb-2">
                                        <!-- <label for="AddAdAddPrice">Cena</label> -->
                                        <!-- <div class="input-group"> -->
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">Cena od</div>
                                        </div>
                                        <input name="search_price_from" type="number" class="form-control"
                                            id="searchPriceFrom" value="<?php echo (isset($_GET['priceFrom']))? $_GET['priceFrom'] : ""; ?>">
                                        <div class="input-group-append">
                                            <span class="input-group-text">PLN</span>
                                        </div>
                                        <!-- </div> -->
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group input-group input-group-sm mb-2">
                                        <!-- <label for="AddAdAddPrice">Cena</label> -->
                                        <!-- <div class="input-group"> -->
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">Cena do</div>
                                        </div>
                                        <input name="search_price_to" type="number" class="form-control"
                                            id="searchPriceTo" value="<?php echo (isset($_GET['priceFromTo']))? $_GET['priceFromTo'] : ""; ?>">
                                        <div class="input-group-append">
                                            <span class="input-group-text">PLN</span>
                                        </div>
                                        <!-- </div> -->
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group input-group input-group-sm mb-2">
                                        <button type="button" id="clearBTN" class="btn btn-sm btn-block btn-primary">Wyczyść
                                            filtry</button>
                                    </div>
                                </div>
                            </div>

                            <!-- <div class="form-check">
                <input name="ad_conditions" required type="checkbox" class="form-check-input" id="addAdRegulamin">
                <label class="form-check-label" for="addAdRegulamin">Akceptuje regulamin</label>
            </div> -->
                            <!-- <button type="submit" class="btn btn-primary">Szukaj</button> -->
                        </form>
                    </div>
                </div>
                <!-- SORTOWANIE -->

                <?php
                $pos = strrpos($_SERVER['REQUEST_URI'], "&sort=");
                $pos = ($pos === false)? 10000 : $pos;
                $url1 = substr($_SERVER['REQUEST_URI'], 0, $pos);
                $url2 = substr($_SERVER['REQUEST_URI'], $pos+7, 1000);
                $url = $url1.$url2; 
                // echo $_SERVER['REQUEST_URI'];
                // echo " URL: ".$url;
                // echo " pos: ".$pos;
                ?>

                <div class="full-sort-sec p-1 bg-white">
                    <nav class="nav nav-pills nav-justified" id="sortNav">
                        <a class="btn-light nav-item nav-link" id="sortDateDesc"
                            href="<?php echo $url."&sort=1"; ?>">Najnowsze</a>
                        <a class="btn-light nav-item nav-link" id="sortDateAsc"
                            href="<?php echo $url."&sort=2"; ?>">Najstarsze</a>
                        <a class="btn-light nav-item nav-link" id="sortPriceDesc"
                            href="<?php echo $url."&sort=3"; ?>">Najtańsze</a>
                        <a class="btn-light nav-item nav-link" id="sortPriceAsc"
                            href="<?php echo $url."&sort=4"; ?>">Najdroższe</a>
                    </nav>
                </div>

                <div class="row" id="row_with_ads">

                    <?php

$sql = "SELECT 
a.id_ad,
ma.mark_name, 
mo.model_name,
a.id_type_car,
a.count_doors,
a.id_color,
a.title, 
a.id_gear_type, 
f.fuel_name, 
a.year, 
a.engine_capacity, 
a.price, 
a.mileage,
a.date_add, 
a.images,
a.id_country_of_origin,
a.pl_registration,
a.crashed,
a.ASO,
a.england,
a.new_car,
a.engine_capacity,
a.horsepower,
u.city FROM som_ad a 
JOIN som_marks ma ON a.id_mark=ma.id_mark 
JOIN som_models mo ON a.id_model=mo.id_model 
JOIN som_fuel f ON a.id_fuel=f.id_fuel 
JOIN som_users u ON a.id_user=u.id_user
JOIN som_type t ON a.id_type_car=t.id_type WHERE a.id_mark = ".$get_id_mark." ";

if($get_id_model>0)
{
  $sql .= "AND a.id_model = ".$get_id_model." ";
}

$sql .= (isset($_GET['type'])? "AND a.id_type_car=".$_GET['type']." " : "");
$sql .= (isset($_GET['fuel'])? "AND a.id_fuel=".$_GET['fuel']." " : "");
$sql .= (isset($_GET['countDoors'])? "AND a.count_doors=".$_GET['countDoors']." " : "");
$sql .= (isset($_GET['color'])? "AND a.id_color=".$_GET['color']." " : "");
$sql .= (isset($_GET['gear'])? "AND a.id_gear_type=".$_GET['gear']." " : "");
$sql .= (isset($_GET['country'])? "AND a.id_country_of_origin=".$_GET['country']." " : "");
$sql .= (isset($_GET['poland'])? "AND a.pl_registration=".$_GET['poland']." " : "");
$sql .= (isset($_GET['crashed'])? "AND a.crashed=".$_GET['crashed']." " : "");
$sql .= (isset($_GET['ASO'])? "AND a.ASO=".$_GET['ASO']." " : "");
$sql .= (isset($_GET['UK'])? "AND a.england=".$_GET['UK']." " : "");
$sql .= (isset($_GET['new'])? "AND a.new_car=".$_GET['new']." " : "");

$sql .= (isset($_GET['capacityFrom'])? "AND a.engine_capacity>=".$_GET['capacityFrom']." " : "");
$sql .= (isset($_GET['capacityTo'])? "AND a.engine_capacity<=".$_GET['capacityTo']." " : "");

$sql .= (isset($_GET['millageFrom'])? "AND a.mileage>=".$_GET['millageFrom']." " : "");
$sql .= (isset($_GET['millageFromTo'])? "AND a.mileage<=".$_GET['millageFromTo']." " : "");

$sql .= (isset($_GET['powerFrom'])? "AND a.horsepower>=".$_GET['powerFrom']." " : "");
$sql .= (isset($_GET['powerFromTo'])? "AND a.horsepower<=".$_GET['powerFromTo']." " : "");

$sql .= (isset($_GET['yearFrom'])? "AND a.year>=".$_GET['yearFrom']." " : "");
$sql .= (isset($_GET['yearFromTo'])? "AND a.year<=".$_GET['yearFromTo']." " : "");

$sql .= (isset($_GET['priceFrom'])? "AND a.price>=".$_GET['priceFrom']." " : "");
$sql .= (isset($_GET['priceFromTo'])? "AND a.price<=".$_GET['priceFromTo']." " : "");

$order = "";

if(isset($_GET['sort']))
{
    switch ($_GET['sort']) {
        case 1:
            $order = "ORDER BY a.date_add desc";
            break;
        case 2:
            $order = "ORDER BY a.date_add asc";
            break;
        case 3:
            $order = "ORDER BY a.price asc";
            break;
        case 4:
            $order = "ORDER BY a.price desc";
            break;
        
        default:
            $order = "ORDER BY a.date_add desc";
            break;
    }
}

$sql .= $order;

// echo $sql; 

// echo "<pre>";
// print_r($_POST);
// echo "</pre>";

if($result = DB::query($sql))
{
  if($result -> num_rows>0)
  {
    echo '<div class="container-fluid pt-1 text-right"><h6>Wyników: <span class="badge badge-secondary">'.$result -> num_rows.'</span></h6></div>';

    while (($row = $result -> fetch_assoc()) !== null)
    {
        $gear = ($row['id_gear_type'])? "Automatyczna" : "Manualna";

        // echo "test";
        if(!is_null($row['images']) && strlen($row['images'])>1)
        {
            $images = explode(" ", trim($row['images']));
            $imageURL = "../img/".$row['id_ad']."/".$images[0];
        }
        else
        {
            $imageURL = "../img/empty.png";
        }
        echo 
        '
            <div class="col-12 mt-3">
                <div class="card">
                    <div class="card-horizontal">
                  
                        <div class="img-square-wrapper img-in-horizontal-card">
                        
                            <img height="50" class="img-fluid img-thumbnail" src="'.$imageURL.'" alt="obraz">
                            <h5 class="h5 center alert alert-dark p-0 m-0">'.$row['price'].' PLN</h2>
                            
                        </div>
                        
                        <div class="card-body pt-1">
                        
                        <a href="ad.php?id_ad='.$row['id_ad'].'" class="stretched-link">
                            <h5 class="card-title">'.trim($row['title']).'</h4>
                            </a>
                            <p class="card-text">'.$row['mark_name']." ".$row['model_name'].'</p>

                            <table class="table mb-0">
                                        <tr>
                                            <td scope="col"> <i class="fas fa-gas-pump" data-toggle="tooltip"
                                                    data-placement="top" title="Rodzaj paliwa"></i> <span>'.$row['fuel_name'].'</span>
                                            </td>
                                            <td scope="col"> <i class="fas fa-heading" data-toggle="tooltip"
                                                    data-placement="top" title="Skrzynia biegów"></i>
                                                <span>'.$gear.'</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td scope="col"> <i class="far fa-calendar-alt" data-toggle="tooltip"
                                                    data-placement="top" title="Rok produkcji"></i> <span>'.$row['year'].'</span>
                                            </td>
                                            <td scope="col"> <i class="fas fa-tachometer-alt" data-toggle="tooltip"
                                                    data-placement="top" title="Przebieg"></i> <span>'.$row['mileage'].'</span>
                                            </td>
                                        </tr>
                              </table>    
                        </div>
                    </div>
                    
                    <div class="card-footer p-0 px-1">
                      <div class="row">
                        <div class="col">
                          <small class="text-muted"><i class="fas fa-map-marker-alt mr-1"></i><span>'.$row['city'].'</span></small>
                        </div>
                        <div class="col text-right">
                        <small class="text-muted"><i class="fas fa-history" data-toggle="tooltip" data-placement="top" title="Data dodania"></i> '.$row['date_add'].'</small>
                        </div>
                      </div>
                    </div>
                </div>
            </div>
      ';
      }   
    }
    else
    {
      echo 
      '
      <div class="col-12 mt-3">
      <div class="jumbotron">
      <div class="container">
        <h1 class="display-4">Brak ogłoszeń</h1>
        <p class="lead">Zmień kryteria wyszukiwania i zobacz dostępne ogłoszenia.</p>
      </div>
      </div>
      </div>
      ';
    }
  }
  else
  {
    header('Location: index.php');
    exit();
  }

?>

                </div>
            </div>

            <div class="col-md-2 d-sm-none d-md-block">

                <div class="jumbotron p-3 text-center">
                    <h1 class="display-4">Witaj!</h1>
                    <p class="lead">Chcesz sprzedać swój samochód?</p>
                    <hr class="my-4">
                    <p>Podpowiemy Ci jak to zrobić!</p>
                    <a class="btn btn-primary btn-lg" href="#" role="button">Sprawdź</a>
                </div>

                <div class="jumbotron p-3 text-center">
                    <h1 class="display-4">Szukasz</h1>
                    <p class="lead">Samochodu?</p>
                    <hr class="my-4">
                    <p>Podpowiemy Ci jak analizować oferty oraz na co zwróćić szczególną uwagę przed zakupem!</p>
                    <a class="btn btn-primary btn-lg" href="#" role="button">Sprawdź</a>
                </div>

                <div class="jumbotron p-3 text-center">
                    <h1 class="display-4">Umowa</h1>
                    <p class="lead">Kupna - Sprzedaży</p>
                    <img class="card-img" src="..\img\umowa.jpg" alt="Umowa kupna-sprzedaży" />
                    <hr class="my-4">
                    <p>Gotowy wzór umowy kupna-sprzedaży samochodu do pobrania!</p>
                    <a class="btn btn-primary btn-lg" href="#" role="button">Pobierz</a>
                </div>

            </div>
        </div>

    </div>
</section>

<!-- modal register user -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Rejestracja użytkownika</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="register.php" method="POST">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputEmailRegister">Email</label>
                            <input type="email" class="form-control" id="inputEmailRegister" name="inputEmailRegister"
                                placeholder="Email"
                                value=<?php ( isset($_SESSION['inputEmailRegister']) )? $_SESSION['inputEmailRegister']:"xxx"; ?>>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputPasswordRegister">Hasło</label>
                            <input type="password" class="form-control" id="inputPasswordRegister"
                                name="inputPasswordRegister" placeholder="Hasło">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputNameRegister">Imie</label>
                            <input type="text" class="form-control" id="inputNameRegister" name="inputNameRegister"
                                placeholder="Imię"
                                value=<?php isset($_SESSION['inputNameRegister'])? $_SESSION['inputNameRegister']:"xxx"; ?>>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputPasswordRegister2">Potwierdź hasło</label>
                            <input type="password" class="form-control" id="inputPasswordRegister2"
                                name="inputPasswordRegister2" placeholder="Hasło">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputPhoneRegister">Telefon</label>
                            <input type="text" class="form-control" id="inputPhoneRegister" name="inputPhoneRegister"
                                placeholder="XXX-XXX-XXX">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputCompanyRegister">Nazwa firmy</label>
                            <input type="text" class="form-control" id="inputCompanyRegister"
                                name="inputCompanyRegister" placeholder="Firma">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-8">
                            <label for="inputStreetNameRegister">Ulica</label>
                            <input type="text" class="form-control" id="inputStreetNameRegister"
                                name="inputStreetNameRegister" placeholder="Ulica">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="inputStreetNumberRegister">Numer</label>
                            <input type="text" class="form-control" id="inputStreetNumberRegister"
                                name="inputStreetNumberRegister">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="inputHomeNumberRegister">Mieszkanie</label>
                            <input type="number" class="form-control" id="inputHomeNumberRegister"
                                name="inputHomeNumberRegister">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputCityRegister">Miasto</label>
                            <input type="text" class="form-control" id="inputCityRegister" name="inputCityRegister">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="inputProvinceRegister">Województwo</label>
                            <select id="inputProvinceRegister" class="form-control" name="inputProvinceRegister">
                                <option selected>Wybierz...</option>
                                <?php
$sql = 'SELECT * FROM som_province order by name_province';
$result = DB::query($sql);
while (($province = $result -> fetch_assoc()) !== null){
    echo '<option value="'.$province['id_province'].'">'.$province['name_province'].'</option>';
}
// $wynik -> close(); // zwolnienie pamięci
?>
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="inputZipCodeRegister">Kod</label>
                            <input type="text" class="form-control" id="inputZipCodeRegister"
                                name="inputZipCodeRegister">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="HumanCheckRegister"
                                name="HumanCheckRegister">
                            <label class="form-check-label" for="HumanCheckRegister">
                                Nie jestem robotem
                            </label>
                        </div>
                    </div>
                    <!-- <button type="submit" class="btn btn-primary">Sign in</button> -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Zamknij</button>
                        <button type="submit" class="btn btn-primary">Zarejestruj</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<!-- end modal register user -->

<?php
require_once('../parts/footer.php');
require_once('../parts/scripts.php');
?>