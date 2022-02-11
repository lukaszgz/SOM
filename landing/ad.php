<?php
require_once('../scripts/db.php');
require_once('../scripts/equipment.php');
require_once('../parts/head.php');
require_once('../parts/nav.php');
require_once('../class/ads.php');
?>

<?php
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
WHERE a.id_ad=".$_GET['id_ad'];

if ($result = DB::query($sql))
{
    $row = $result -> fetch_assoc();

    $gear = ($row['id_gear_type'])? "Automatyczna" : "Manualna";

    // echo "test";
    if(!is_null($row['images']) && strlen($row['images'])>1)
    {
        $images = explode(" ", trim($row['images']));

        $imageURL0 = '../img/'.$row['id_ad'].'/'.$images[0];

        $imagesURL = "";
        foreach ($images as $key => $value) {
            $imagesURL .= '<img class="img-fluid mx-auto my-1 col-12"
            src="../img/'.$row['id_ad'].'/'.$value.'"
            alt="Zdjęcie"> ';
        }
    }
    else
    {   
        $imageURL0 = '../img/empty.png';
        $imagesURL = '<img class="img-fluid mx-auto my-1 col-12"
        src="../img/empty.png"
        alt="Zdjęcie"> ';
    }
} 
else
{
    $_SESSION['error'] = $sql;
    header('Location: index.php');
	exit();
}  
?>

<div class="container">
    <div class="head section">
        <div class="mb-3">
            <h1 class="title h3 my-1"><?php echo $row['title'] ?></h1>
            <?php
                        if($row['crashed'])
                        {
                            echo '<span class="badge badge-info"> BEZWYPADKOWY </span>';
                        }
                        ?>
        </div>
        <div class="row mb-3">
            <div class="col-lg-6">
                <div class="part">
                    <img class="img-fluid" src="<?php echo $imageURL0 ?>" alt="Zdjęcie">
                </div>
                <div class="my-3">
                    <h2 class="markAndModel h1"><?php echo $row['mark_name']." ".$row['model_name'] ?>
                        <span class="badge badge-secondary"><?php echo $row['price'] ?> PLN </span></h1>

                </div>
            </div>
            <div class="col-lg-6">
                <div class="row part">
                    <div class="col-6">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <span>Stan:
                                </span><?php echo ($row['new_car'])? "Nowy" : "Używany" ?></li>
                            <li class="list-group-item">
                                <span>Rok produkcji:
                                </span><?php echo $row['year'] ?></li>
                            <li class="list-group-item">
                                <span>Przebieg:
                                </span><?php echo $row['mileage'] ?></li>
                            <li class="list-group-item">
                                <span>Silnik:
                                </span><?php echo $row['fuel_name'] ?></li>
                            <li class="list-group-item">
                                <span>Pojemność:
                                </span><?php echo $row['engine_capacity'] ?></li>
                            <li class="list-group-item">
                                <span>Moc (km):
                                </span><?php echo $row['horsepower'] ?></li>
                            <li class="list-group-item">
                                <span>Zarejestrowany w PL:
                                </span><?php echo ($row['pl_registration'])? "Tak" : "Nie" ?></li>
                            <li class="list-group-item">
                                <span>VIN:
                                </span><?php echo $row['VIN'] ?></li>
                        </ul>
                    </div>
                    <div class="col-6">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <span>Skrzynia:
                                </span><?php echo $gear ?></li>
                            <li class="list-group-item">
                                <span>Kolor:
                                </span><?php echo $row['color_name'] ?></li>
                            <li class="list-group-item">
                                <span>Typ lakieru:
                                </span><?php echo ($row['color_type_name'])?></li>
                            <li class="list-group-item">
                                <span>Nadwozie:
                                </span><?php echo $row['name_type'] ?></li>
                            <li class="list-group-item">
                                <span>Liczba drzwi:
                                </span><?php echo ($row['count_doors'])? "4/5" : "2/3" ?></li>
                            <li class="list-group-item">
                                <span>Liczba miejsc:
                                </span><?php echo ($row['count_seats']>0)?$row['count_seats']:"-" ?></li>
                            <li class="list-group-item">
                                <span>Nabęd 4x4:
                                </span><?php echo ($row['drive_4x4'])? "Tak" : "Nie" ?></li>
                            <li class="list-group-item">
                                <span>Kraj pochodzenia:
                                </span><?php echo $row['name_country'] ?></li>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col text-center">
                <a href=<?php echo "https://www.google.pl/maps/place/".$row['city'] ?> target="_blank"><button
                        type="button" class="btn btn-dark btn-sm btn-block m-1"><?php echo $row['city'] ?></button></a>
            </div>
            <div class="col text-center">
                <button type="button" class="btn btn-dark btn-sm btn-block m-1">Tel: <?php echo $row['phone'] ?></button>
                <!-- <a href="#" class="badge badge-dark"><?php echo $row['phone'] ?></a> -->
            </div>
            <div class="col text-center">
                <button type="button" class="btn btn-dark btn-sm btn-block m-1">Obserwój</button>
                <!-- <a href="#" class="badge badge-dark">Obserwój</a> -->
            </div>
        </div>
    </div>

    <div class="equipment section">
        <div class="mb-3">
            <h3 class="h5">Wyposażenie</h3>
        </div>
        <div class="row">
            <div class="col equipment">
                <?php
                $equipment_ad = explode(" ", trim($row['equipment']));
                // echo print_r($equipment_ad);
                $equipment_text = "";
                foreach ($equipment as $key => $value)
                {
                    
                    foreach ($equipment_ad as $k => $v) 
                    {
                        if($key == $v)
                        {
                            // echo "key = ".$key." v=".$v;
                            $equipment_text .= $value.", ";
                        }
                    }
                }
                echo $equipment_text;
                ?>
            </div>
        </div>
    </div>
    <div class="description section">
        <div class="mb-3">
            <h3 class="h5">Opis</h3>
        </div>
        <div class="row">
            <div class="col description-long"><?php echo $row['description'] ?></div>
        </div>
    </div>
    <div class="photos section">
        <div class="row">
            <!-- <div class="col-12 photos"> -->
            <?php echo $imagesURL ?>
            <!-- </div> -->
        </div>
    </div>
    <div class="other_ads section">
        <div class="mb-3">
            <h3 class="h5">Oferty sponsorowane</h3>
        </div>
        <div class="card-deck">
            
                <?php
                showPremiumAds(3);
                ?>
            
        </div>
    </div>
</div>


</div>

<?php
require_once('../parts/footer.php');
require_once('../parts/scripts.php');
?>