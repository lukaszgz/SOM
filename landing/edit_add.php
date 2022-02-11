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

<?php
if(isset($_SESSION['id_user']) && isset($_GET['id_ad']))
{
    $sql = "SELECT 
    a.id_ad,
    a.id_mark,
    a.id_model,
    a.id_type_car,
    a.id_fuel,
    a.VIN,
    a.id_color,
    a.id_color_type,
    ma.mark_name, 
    mo.model_name, 
    a.title, 
    a.description,
    a.id_gear_type, 
    f.fuel_name, 
    a.year, 
    a.engine_capacity, 
    a.price, 
    a.mileage,
    a.date_add, 
    a.images,
    a.new_car,
    a.horsepower,
    a.pl_registration,
    a.crashed,
    a.england,
    a.new_car,
    a.ASO,
    c.color_name,
    ct.color_type_name,
    t.name_type,
    a.count_doors,
    a.count_seats,
    a.id_country_of_origin,
    a.drive_4x4,
    a.images,
    a.salesman_name,
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
    WHERE a.id_user = ".$_SESSION['id_user']." AND a.id_ad = ".$_GET['id_ad'];

    if($result = DB::query($sql))
    {
      if($result -> num_rows>0)
      {
        $row = $result -> fetch_assoc();
      }
    }
}
else
{
    header('Location: '.$_SERVER['HTTP_REFERER']);
    exit();
}
?>

<section>
    <div class="container">
        <form method="post" action="script_add_ad.php" enctype="multipart/form-data">
            <input type="text" name="id_ad" value="<?php echo $_GET['id_ad']; ?>" hidden>
            <div class="form-group">
                <label for="AddAdAddTitle">Tytuł ogłoszenia</label>
                <input value="<?php echo $row['title'] ?>" required type="text" class="form-control" id="AddAdAddTitle" name="ad_title" aria-describedby="Title_add_ad" placeholder="Wprowadź tytuł ogłoszenia">
                <small id="Title_add_ad" class="form-text text-muted">Tytuł zostanie wyświetlony na liście wszystkich ogłoszeń (maksymalnie 128 znaków).</small>
            </div>
            <div class="form-group">
                <label for="AddAdAddDescription">Opis</label>
                <textarea name="ad_desc" class="form-control rounded-0" id="AddAdAddDescription" rows="10"><?php echo $row['description'] ?></textarea>
            </div>
            <div class="form-row">
                <div class="col">
                    <label for="AddAdSelectMark">Marka</label>
                    <select name="ad_mark" id="AddAdSelectMark" class="form-control">
                        <option value="-1">Wybierz...</option>
                        <?php
                            foreach ($marks as $key => $value)
                            {
                                $selected = ($key == $row['id_mark'])? "selected" : "";
                                echo '<option '.$selected.' value="'.$key.'">'.$value.'</option>';
                            }
                        ?>
                    </select>
                </div>
                <div class="col">
                    <label for="AddAdSelectModel">Model</label>
                    <select name="ad_model" id="AddAdSelectModel" class="form-control">
                        <option value="-1" class="label">Wybierz...</option>
                        <?php
                            foreach ($models as $key => $value)
                            {
                                $selected = ($key == $row['id_model'])? "selected" : "";
                                echo '<option '.$selected.' value="'.$key.'">'.$value.'</option>';
                            }
                        ?>
                        <!-- <option>...</option> -->
                    </select>
                </div>
            </div>
            <div class="form-group pt-2">
                <p>Typ nadwozia</p>
                <?php
                    foreach ($car_type as $key => $value)
                    {
                        $checked = ($key == $row['id_type_car'])? "checked" : "";

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
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text">Liczba drzwi</div>
                        </div>
                        <select name="ad_count_doors" class="custom-select" id="AddAdSelectCountDoors">
                            <?php
                            if($row['count_doors'] == 0)
                            {
                                echo '<option selected value="0">2/3</option>
                                    <option value="1">4/5</option>';
                            }
                            else
                            {
                                echo '<option value="0">2/3</option>
                                    <option selected value="1">4/5</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col">
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text">Kolor</div>
                        </div>
                        <select name="ad_Color" class="custom-select" id="AddAdSelectColor">
                            <option value="-1" selected>Wybierz...</option>
                            <?php
                                foreach ($colors as $key => $value)
                                {
                                    $selected = ($key == $row['id_color'])? "selected" : "";
                                    echo '<option '.$selected.' value='.$key.'>'.$value.'</option>';
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col">
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text">Typ Lakieru</div>
                        </div>
                        <select name="ad_color_type" class="custom-select" id="AddAdSelectColorType">
                            <option value="-1" selected>Wybierz...</option>
                            <?php
                                foreach ($color_type as $key => $value)
                                {
                                    $selected = ($key == $row['id_color_type'])? "selected" : "";
                                    echo '<option '.$selected.' value='.$key.'>'.$value.'</option>';
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col">
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text">Ilość miejsc</div>
                        </div>
                        <input value="<?php echo $row['count_seats'] ?>" name="ad_count_seats" type="number" min="1" max="60" class="form-control" id="AddAdAddCountSeats">
                    </div>
                </div>
            </div>
            <div class="form-group pt-2">
                <p>Silnik</p>
                <?php
                    foreach ($fuel as $key => $value)
                    {
                        $checked = ($key == $row['id_fuel'])? "checked" : "";
                        echo '<div class="custom-control custom-radio custom-control-inline">
                        <input '.$checked.' class="custom-control-input" type="radio" name="fuel_type" id="FuelTypeRadio'.$key.'" value='.$key.'>
                        <label class="custom-control-label" for="FuelTypeRadio'.$key.'">'.$value.'</label>
                        </div>';
                    }
                ?>
            </div>
            <div class="form-row align-items-center">
                <div class="col">
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text">Pojemność</div>
                        </div>
                        <input required name="ad_engine_capacity" type="number" min="0" max="10000" class="form-control" id="AddAdAddEngineCapacity" value="<?php echo $row['engine_capacity'] ?>">
                    </div>
                </div>
                <div class="col">
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text">Przebieg (km)</div>
                        </div>
                        <input required name="ad_millage" type="text" class="form-control" id="AddAdAddMilage" value="<?php echo $row['mileage'] ?>">
                    </div>
                </div>
                <div class="col">
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text">Moc (km)</div>
                        </div>
                        <input value="<?php echo $row['horsepower'] ?>" name="ad_power" type="text" class="form-control" id="AddAdAddEnginePower">
                    </div>
                </div>
                <div class="col">
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text">Skrzynia biegów</div>
                        </div>
                        <select name="ad_gear" class="custom-select" id="AddAdSelectGearType">
                        <?php
                            if($row['id_gear_type'] == 0)
                            {
                                echo '<option selected value="0">Manulana</option>
                                <option value="1">Automatyczna</option>';
                            }
                            else
                            {
                                echo '<option value="0">Manulana</option>
                                <option selected value="1">Automatyczna</option>';
                            }
                            ?>
                            
                            
                            
                        </select>
                    </div>
                </div>
            </div>
            <div class="row mb-5">
                <div class="col">
                    <p>Wyposażenie (opcjonalnie)</p>
                    <div>
                        <?php

                            $equipment_ad = explode(" ", trim($row['equipment']));
                            // echo print_r($equipment_ad);

                            foreach ($equipment as $key => $value)
                            {
                                $checked = "";
                                foreach ($equipment_ad as $k => $v) 
                                {
                                    if($key == $v)
                                    {
                                        // echo "key = ".$key." v=".$v;
                                        $checked = "checked";
                                    }
                                }
                                echo '<div class="custom-control custom-checkbox">';
                                echo '<input '.$checked.' name="ad_equipment_'.$key.'" type="checkbox" class="custom-control-input" id="AddAdCheckEquipment'.$key.'">';
                                echo '<label class="custom-control-label" for="AddAdCheckEquipment'.$key.'">'.$value.'</label>';
                                echo '</div>';
                            }
                        ?>
                    </div>
                </div>
                <div class="col">
                    <p>Opcje dodatkowe</p>
                    <div class="form-group">
                        <div class="custom-control custom-checkbox">
                            <input <?php echo ($row['pl_registration'])? "checked" : ""; ?> name="ad_option_poland" type="checkbox" class="custom-control-input" id="AddAdCheckOptionPoland">
                            <label class="custom-control-label" for="AddAdCheckOptionPoland">Zarejestrowany w Polsce</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input <?php echo ($row['crashed'])? "checked" : ""; ?> name="ad_option_crashed" type="checkbox" class="custom-control-input" id="AddAdCheckOptionCrashed">
                            <label class="custom-control-label" for="AddAdCheckOptionCrashed">Bezwypadkowy</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input <?php echo ($row['ASO'])? "checked" : ""; ?> name="ad_option_aso" type="checkbox" class="custom-control-input" id="AddAdCheckOptionASO">
                            <label class="custom-control-label" for="AddAdCheckOptionASO">Serwisowany w ASO</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input <?php echo ($row['england'])? "checked" : ""; ?> name="ad_option_UK" type="checkbox" class="custom-control-input" id="AddAdCheckOptionUK">
                            <label class="custom-control-label" for="AddAdCheckOptionUK">Kierownica po prawej stronie (Anglik)</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input <?php echo ($row['new_car'])? "checked" : ""; ?> name="ad_option_new_car" type="checkbox" class="custom-control-input" id="AddAdCheckOptionNewCar">
                            <label class="custom-control-label" for="AddAdCheckOptionNewCar">Pojazd jest Nowy</label>
                        </div>
                    </div>
                    <input name="images[]" multiple="" id="photos" type="file">
                    <!-- <label class="lb" for="photos"> -->
                        <!-- <span class="btn btn-primary">Zmień zdjęcia</span> -->
                    <!-- </label> -->
                    <div id="gallery-thumbnails">
                        <?php
                        if(trim($row['images']) != "")
                        {
                            $img_array = explode(" ",trim($row['images']));
                            // echo trim($row['images']);
                            foreach ($img_array as $key => $value) 
                            {
                                $value = "../img/".$value;
                                echo
                                '<div class="photo-thumbnails w-25 d-inline-block p-1"><img src="'.$value.'" alt="empty photo" class="img-thumbnail img-fluid p-3"></div>
                                ';
                            }
                        }
                       
                        ?>
                        <!-- <div class="photo-thumbnails w-25 float-left p-1">
                            <img src="..\img\empty.png" alt="empty photo" class="img-thumbnail img-fluid p-3">
                        </div>
                        <div class="photo-thumbnails w-25 float-left p-1">
                            <img src="..\img\empty.png" alt="empty photo" class="img-thumbnail img-fluid p-3">
                        </div>
                        <div class="photo-thumbnails w-25 float-left p-1">
                            <img src="..\img\empty.png" alt="empty photo" class="img-thumbnail img-fluid p-3">
                        </div>
                        <div class="photo-thumbnails w-25 float-left p-1">
                            <img src="..\img\empty.png" alt="empty photo" class="img-thumbnail img-fluid p-3">
                        </div>
                        <div class="photo-thumbnails w-25 float-left p-1">
                            <img src="..\img\empty.png" alt="empty photo" class="img-thumbnail img-fluid p-3">
                        </div>
                        <div class="photo-thumbnails w-25 float-left p-1">
                            <img src="..\img\empty.png" alt="empty photo" class="img-thumbnail img-fluid p-3">
                        </div>
                        <div class="photo-thumbnails w-25 float-left p-1">
                            <img src="..\img\empty.png" alt="empty photo" class="img-thumbnail img-fluid p-3">
                        </div>
                        <div class="photo-thumbnails w-25 float-left p-1">
                            <img src="..\img\empty.png" alt="empty photo" class="img-thumbnail img-fluid p-3">
                        </div> -->
                    </div>
                    <div class="form-group mb-2">
                        <label for="AddAdSelectCountry">Kraj pochodzenia</label>
                        <select name="ad_first_country" class="custom-select" id="AddAdSelectCountry">
                            <option value="-1" selected>Wybierz...</option>
                            <?php
                                foreach ($countries as $key => $value)
                                {
                                    $selected = ($key == $row['id_country_of_origin'])? "selected" : "";
                                    echo '<option '.$selected.' value='.$key.'>'.$value.'</option>';
                                }
                            ?>
                        </select>
                    </div>
                    <div class="form-group mb-2">
                        <label for="AddAdAddYear">Rok Produkcji</label>
                        <input required name="ad_year" type="number" min="1900" max="2100" class="form-control" id="AddAdAddYear"
                            value="<?php echo $row['year'] ?>">
                    </div>
                    <div class="form-group mb-2">
                        <label for="AddAdAddVIN">Numer VIN</label>
                        <input maxlength = 17 minlength=17 value="<?php echo $row['VIN'] ?>" name="ad_vin" type="text" class="form-control" id="AddAdAddVIN" placeholder="opcjonalnie">
                    </div>
                    <div class="form-group mb-2">
                        <label for="AddAdAddUserName">Sprzedający</label>
                        <input value="<?php echo $row['salesman_name'] ?>" name="ad_user_name" type="text" class="form-control" id="AddAdAddUserName" placeholder="Imię / Firma">
                    </div>
                    <div class="form-group mb-2">
                        <label for="AddAdAddPrice">Cena</label>
                        <div class="input-group">
                            <input required name="ad_price" type="number" class="form-control" id="AddAdAddPrice" placeholder="0" value="<?php echo $row['price'] ?>">
                            <div class="input-group-append">
                                <span class="input-group-text">PLN</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="form-check">
                <input  name="ad_conditions" required type="checkbox" class="form-check-input" id="addAdRegulamin">
                <label class="form-check-label" for="addAdRegulamin">Akceptuje regulamin</label>
            </div> -->
            <button type="submit" class="btn btn-primary">Aktualizuj ogłoszenie</button>
        </form>
    </div>
</section>

<?php
require_once('../parts/footer.php');
require_once('../parts/scripts.php');
?>