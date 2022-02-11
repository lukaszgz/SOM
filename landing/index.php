<?php
require_once('../scripts/db.php');
require_once('../parts/head.php');
require_once('../parts/nav.php');
?>
<section>
    <div id="carouselExampleFade" class="carousel slide carousel-fade" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="..\img\bg-collapse.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="..\img\bg-collapse-2.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="..\img\bg-collapse-3.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="..\img\bg-collapse-4.jpg" class="d-block w-100" alt="...">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleFade" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Poprzedni</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleFade" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Następny</span>
        </a>
    </div>
</section>
<section class="search-sec">
    <div class="container">
        <form action="search_ads.php" method="get" novalidate="novalidate">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-12 p-0">
                            <select name="id_mark" class="form-control search-slt" id="SearchMarkSelect">
                                <option class="label" value="0">MARKA (wszystkie)</option>
                                <?php
$sql = 'SELECT * FROM som_marks order by mark_name';
$result = DB::query($sql);
while (($mark = $result -> fetch_assoc()) !== null){
    echo '<option value="'.$mark['id_mark'].'">'.$mark['mark_name'].'</option>';
}
// $wynik -> close(); // zwolnienie pamięci
?>
                            </select>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12 p-0">
                            <select name="id_model" class="form-control search-slt" id="SearchModelSelect">
                                <option class="label" value="0">MODEL (wszystkie)</option>
                            </select>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12 p-0">
                            <button type="submit" class="btn btn-danger wrn-btn">Szukaj</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
<section class="content">
    <div class="container-fluid">
        <div class="row">

            <div class="col-2 d-none d-md-block">

<!-- Categy list -->
<div id="CategyList">
                    <?php
$sql = 'SELECT * FROM som_marks order by mark_name';
$result = DB::query($sql);
while (($mark = $result -> fetch_assoc()) !== null){
    echo '<a href="search_ads.php?id_mark='.$mark['id_mark'].'" class="list-group-item list-group-item-action py-1" value="'.$mark['id_mark'].'">'.$mark['mark_name'].'</a>';
}
// $wynik -> close(); // zwolnienie pamięci
?>

  
</div>


                
            </div>

            <div class="col-12 col-md-8">


                <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3">

<?php
$sql = "SELECT 
a.id_ad,
ma.mark_name, 
mo.model_name, 
a.title, 
a.id_gear_type, 
f.fuel_name, 
a.year, 
a.engine_capacity, 
a.price, 
a.mileage,
a.date_add, 
a.images,
a.premium,
u.city FROM som_ad a 
JOIN som_marks ma ON a.id_mark=ma.id_mark 
JOIN som_models mo ON a.id_model=mo.id_model 
JOIN som_fuel f ON a.id_fuel=f.id_fuel 
JOIN som_users u ON a.id_user=u.id_user WHERE a.premium = 1";

$result = DB::query($sql);

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
<div class="col mb-4">
                        <div class="card h-100">
                            <div class="card-photo h-50">
                            <h3 class="h3 center alert alert-dark p-0">'.$row['price'].' PLN</h3>
                                <img src="'.$imageURL.'"
                                class="card-img-top img-fluid" alt="Zdjęcie">
                                
                            </div>
                            <hr>
                            <div class="card-body py-1 px-2">
                                <a href="ad.php?id_ad='.$row['id_ad'].'" class="stretched-link">
                                    <h5 class="card-title center mb-1">
                                        '.$row['mark_name']." ".$row['model_name'].'
                                    </h5>
                                </a>
                                <div class="card-my-title">
                                <p class="card-text mb-1">'.trim($row['title']).'</p>
                                </div>
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
                            <div class="card-footer center p-0">
                                <small class="text-muted"><i class="fas fa-history" data-toggle="tooltip"
                                        data-placement="top" title="Data dodania"></i> '.$row['city'].' '.$row['date_add'].'</small>
                            </div>
                        </div> 
                    </div>
';
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
                    <img class="card-img" src="..\img\umowa.jpg" alt="Umowa kupna-sprzedaży"/>
                    <hr class="my-4">
                    <p>Gotowy wzór umowy kupna-sprzedaży samochodu do pobrania!</p>
                    <a class="btn btn-primary btn-lg" href="#" role="button">Pobierz</a>
                </div>

            </div>
        </div>

    </div>
</section>

<!-- modal register user -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
      <input type="email" class="form-control" id="inputEmailRegister" name="inputEmailRegister" placeholder="Email" value="<?php echo ( isset($_SESSION['inputEmailRegister']) )? $_SESSION['inputEmailRegister']:""; ?>">
    </div>
    <div class="form-group col-md-6">
      <label for="inputPasswordRegister">Hasło</label>
      <input type="password" class="form-control" id="inputPasswordRegister" name="inputPasswordRegister" placeholder="Hasło">
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputNameRegister">Imie</label>
      <input type="text" class="form-control" id="inputNameRegister" name="inputNameRegister" placeholder="Imię" value="<?php echo ( isset($_SESSION['inputNameRegister']) )? $_SESSION['inputNameRegister']:""; ?>">
    </div>
    <div class="form-group col-md-6">
      <label for="inputPasswordRegister2">Potwierdź hasło</label>
      <input type="password" class="form-control" id="inputPasswordRegister2" name="inputPasswordRegister2" placeholder="Hasło">
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputPhoneRegister">Telefon</label>
      <input type="text" class="form-control" id="inputPhoneRegister" name="inputPhoneRegister" placeholder="XXX-XXX-XXX" value="<?php echo ( isset($_SESSION['inputPhoneRegister']) )? $_SESSION['inputPhoneRegister']:""; ?>">
    </div>
    <div class="form-group col-md-6">
      <label for="inputCompanyRegister">Nazwa firmy</label>
      <input type="text" class="form-control" id="inputCompanyRegister" name="inputCompanyRegister" placeholder="Firma" value="<?php echo ( isset($_SESSION['inputCompanyRegister']) )? $_SESSION['inputCompanyRegister']:""; ?>">
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-8">
      <label for="inputStreetNameRegister">Ulica</label>
      <input type="text" class="form-control" id="inputStreetNameRegister" name="inputStreetNameRegister" placeholder="Ulica" value="<?php echo ( isset($_SESSION['inputStreetNameRegister']) )? $_SESSION['inputStreetNameRegister']:""; ?>">
    </div>
    <div class="form-group col-md-2">
      <label for="inputStreetNumberRegister">Numer</label>
      <input type="text" class="form-control" id="inputStreetNumberRegister" name="inputStreetNumberRegister" value="<?php echo ( isset($_SESSION['inputStreetNumberRegister']) )? $_SESSION['inputStreetNumberRegister']:""; ?>">
    </div>
    <div class="form-group col-md-2">
      <label for="inputHomeNumberRegister">Mieszkanie</label>
      <input type="number" class="form-control" id="inputHomeNumberRegister" name="inputHomeNumberRegister" value="<?php echo ( isset($_SESSION['inputHomeNumberRegister']) )? $_SESSION['inputHomeNumberRegister']:""; ?>">
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputCityRegister">Miasto</label>
      <input type="text" class="form-control" id="inputCityRegister" name="inputCityRegister" value="<?php echo ( isset($_SESSION['inputCityRegister']) )? $_SESSION['inputCityRegister']:""; ?>">
    </div>
    <div class="form-group col-md-3">
      <label for="inputProvinceRegister">Województwo</label>
      <select id="inputProvinceRegister" class="form-control" name="inputProvinceRegister">
        <option selected>Wybierz...</option>
<?php
$sql = 'SELECT * FROM som_province order by name_province';
$result = DB::query($sql);
while (($province = $result -> fetch_assoc()) !== null){

    $selected = (isset($_SESSION['inputProvinceRegister']) && $_SESSION['inputProvinceRegister']>0)? "selected" : "";
    if($province['id_province'] == $_SESSION['inputProvinceRegister'])
    {
        echo '<option '.$selected.' value="'.$province['id_province'].'">'.$province['name_province'].'</option>';
    }
    else
    {
        echo '<option value="'.$province['id_province'].'">'.$province['name_province'].'</option>';
    }
    
}
// $wynik -> close(); // zwolnienie pamięci
?>
      </select>
    </div>
    <div class="form-group col-md-3">
      <label for="inputZipCodeRegister">Kod</label>
      <input placeholder="XXXXX" type="number" class="form-control" id="inputZipCodeRegister" name="inputZipCodeRegister" value="<?php echo ( isset($_SESSION['inputZipCodeRegister']) )? $_SESSION['inputZipCodeRegister']:""; ?>">
    </div>
  </div>
  <div class="form-group">
    <div class="form-check">
      <input class="form-check-input" type="checkbox" id="HumanCheckRegister" name="HumanCheckRegister">
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