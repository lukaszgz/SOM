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

<section>
    <div class="container">
        <form method="post" action="script_add_ad.php" enctype="multipart/form-data">
            <div class="form-group">
                <label for="AddAdAddTitle">Tytuł ogłoszenia</label>
                <input required type="text" class="form-control" id="AddAdAddTitle" name="ad_title" aria-describedby="Title_add_ad" placeholder="Wprowadź tytuł ogłoszenia">
                <small id="Title_add_ad" class="form-text text-muted">Tytuł zostanie wyświetlony na liście wszystkich ogłoszeń (maksymalnie 128 znaków).</small>
            </div>
            <div class="form-group">
                <label for="AddAdAddDescription">Opis</label>
                <textarea value="testowy opis" name="ad_desc" class="form-control rounded-0" id="AddAdAddDescription" rows="10"></textarea>
            </div>
            <div class="form-row">
                <div class="col">
                    <label for="AddAdSelectMark">Marka</label>
                    <select name="ad_mark" id="AddAdSelectMark" class="form-control">
                        <option value="-1" selected>Wybierz...</option>
                        <?php
                            foreach ($marks as $key => $value)
                            {
                                echo '<option value="'.$key.'">'.$value.'</option>';
                            }
                        ?>
                    </select>
                </div>
                <div class="col">
                    <label for="AddAdSelectModel">Model</label>
                    <select name="ad_model" id="AddAdSelectModel" class="form-control">
                        <option value="-1" selected class="label">Wybierz...</option>
                        <!-- <option>...</option> -->
                    </select>
                </div>
            </div>
            <div class="form-group pt-2">
                <p>Typ nadwozia</p>
                <?php
                    foreach ($car_type as $key => $value)
                    {
                        echo '<div class="custom-control custom-radio custom-control-inline">
                            <input class="custom-control-input" type="radio" name="car_type" id="CarTypeRadio'.$key.'"
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
                            <option value="-1" selected>Wybierz</option>
                            <option value="0">2/3</option>
                            <option value="1">4/5</option>
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
                                    echo '<option value='.$key.'>'.$value.'</option>';
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
                                    echo '<option value='.$key.'>'.$value.'</option>';
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
                        <input name="ad_count_seats" type="number" min="1" max="60" class="form-control" id="AddAdAddCountSeats">
                    </div>
                </div>
            </div>
            <div class="form-group pt-2">
                <p>Silnik</p>
                <?php
                    foreach ($fuel as $key => $value)
                    {
                        echo '<div class="custom-control custom-radio custom-control-inline">
                        <input class="custom-control-input" type="radio" name="fuel_type" id="FuelTypeRadio'.$key.'" value='.$key.'>
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
                        <input required name="ad_engine_capacity" type="number" min="0" max="10000" class="form-control" id="AddAdAddEngineCapacity">
                    </div>
                </div>
                <div class="col">
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text">Przebieg (km)</div>
                        </div>
                        <input required name="ad_millage" type="text" class="form-control" id="AddAdAddMilage">
                    </div>
                </div>
                <div class="col">
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text">Moc (km)</div>
                        </div>
                        <input name="ad_power" type="text" class="form-control" id="AddAdAddEnginePower">
                    </div>
                </div>
                <div class="col">
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text">Skrzynia biegów</div>
                        </div>
                        <select name="ad_gear" class="custom-select" id="AddAdSelectGearType">
                            <option value="-1" selected>Wybierz...</option>
                            <option value="0">Manulana</option>
                            <option value="1">Automatyczna</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row mb-5">
                <div class="col">
                    <p>Wyposażenie (opcjonalnie)</p>
                    <div class="test">
                        <?php
                            foreach ($equipment as $key => $value)
                            {
                                echo '<div class="custom-control custom-checkbox">';
                                echo '<input name="ad_equipment_'.$key.'" type="checkbox" class="custom-control-input" id="AddAdCheckEquipment'.$key.'">';
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
                            <input name="ad_option_poland" type="checkbox" class="custom-control-input" id="AddAdCheckOptionPoland">
                            <label class="custom-control-label" for="AddAdCheckOptionPoland">Zarejestrowany w Polsce</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input name="ad_option_crashed" type="checkbox" class="custom-control-input" id="AddAdCheckOptionCrashed">
                            <label class="custom-control-label" for="AddAdCheckOptionCrashed">Bezwypadkowy</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input name="ad_option_aso" type="checkbox" class="custom-control-input" id="AddAdCheckOptionASO">
                            <label class="custom-control-label" for="AddAdCheckOptionASO">Serwisowany w ASO</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input name="ad_option_UK" type="checkbox" class="custom-control-input" id="AddAdCheckOptionUK">
                            <label class="custom-control-label" for="AddAdCheckOptionUK">Kierownica po prawej stronie (Anglik)</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input name="ad_option_new_car" type="checkbox" class="custom-control-input" id="AddAdCheckOptionNewCar">
                            <label class="custom-control-label" for="AddAdCheckOptionNewCar">Pojazd jest Nowy</label>
                        </div>
                    </div>
                    <input name="images[]" multiple="" id="photos" type="file">
                    <label class="lb" for="photos">
                        <span class="btn btn-primary">Dodaj zdjęcia</span>
                    </label>
                    <div id="gallery-thumbnails">
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
                        </div>
                        <div class="photo-thumbnails w-25 float-left p-1">
                            <img src="..\img\empty.png" alt="empty photo" class="img-thumbnail img-fluid p-3">
                        </div>
                    </div>
                    <div class="form-group mb-2">
                        <label for="AddAdSelectCountry">Kraj pochodzenia</label>
                        <select name="ad_first_country" class="custom-select" id="AddAdSelectCountry">
                            <option value="-1" selected>Wybierz...</option>
                            <?php
                                foreach ($countries as $key => $value)
                                {
                                    echo '<option value='.$key.'>'.$value.'</option>';
                                }
                            ?>
                        </select>
                    </div>
                    <div class="form-group mb-2">
                        <label for="AddAdAddYear">Rok Produkcji</label>
                        <input required name="ad_year" type="number" min="1900" max="2100" class="form-control" id="AddAdAddYear">
                    </div>
                    <div class="form-group mb-2">
                        <label for="AddAdAddVIN">Numer VIN</label>
                        <input maxlength = 17 minlength=17 name="ad_vin" type="text" class="form-control" id="AddAdAddVIN" placeholder="opcjonalnie">
                    </div>
                    <div class="form-group mb-2">
                        <label for="AddAdAddUserName">Sprzedający</label>
                        <input name="ad_user_name" type="text" class="form-control" id="AddAdAddUserName" placeholder="Imię / Firma">
                    </div>
                    <div class="form-group mb-2">
                        <label for="AddAdAddPrice">Cena</label>
                        <div class="input-group">
                            <input required name="ad_price" type="number" class="form-control" id="AddAdAddPrice" placeholder="0">
                            <div class="input-group-append">
                                <span class="input-group-text">PLN</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-check">
                <input  name="ad_conditions" required type="checkbox" class="form-check-input" id="addAdRegulamin">
                <label class="form-check-label" for="addAdRegulamin">Akceptuje regulamin</label>
            </div>
            <button type="submit" class="btn btn-primary">Dodaj ogłoszenie</button>
        </form>
    </div>
</section>

<?php
require_once('../parts/footer.php');
require_once('../parts/scripts.php');
?>