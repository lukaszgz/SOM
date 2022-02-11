<?php
require_once('../scripts/db.php');
require_once('../parts/head.php');
require_once('../parts/nav.php');
require_once('../class/user.php');
?>

<section>
    <div class="container mt-3">
        <h1 class="h1">Twoje ogłoszenia</h1>

        
<?php

if(isset($_SESSION['id_user']))
{
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
    u.city FROM som_ad a 
    JOIN som_marks ma ON a.id_mark=ma.id_mark 
    JOIN som_models mo ON a.id_model=mo.id_model 
    JOIN som_fuel f ON a.id_fuel=f.id_fuel 
    JOIN som_users u ON a.id_user=u.id_user
    JOIN som_type t ON a.id_type_car=t.id_type WHERE a.id_user = ".$_SESSION['id_user'] ;
    if($result = DB::query($sql))
    {
      if($result -> num_rows>0)
      {
        while (($row = $result -> fetch_assoc()) !== null)
        {
            $gear = ($row['id_gear_type'])? "Automatyczna" : "Manualna";

            $x = $i = rand(0,50);
            $y = $i = rand($x+100,1000);
    
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
                            <div class="col">
                              <small class="text-muted text-center"><i class="fas fa-phone-alt"></i><span> '.$x.'</span></small>
                            </div>
                            <div class="col text-center">
                              <small class="text-muted"><i class="fas fa-desktop"></i><span> '.$y.'</span></small>
                            </div>
                            <div class="col text-right">
                            <small class="text-muted"><i class="fas fa-history" data-toggle="tooltip" data-placement="top" title="Data dodania"></i> '.$row['date_add'].'</small>
                            </div>
                          </div>
                        </div>
                    </div>
                    <div>
                    <a href="edit_add.php?id_ad='.$row['id_ad'].'">
                        <button type="button" class="btn btn-secondary btn-sm btn-block">Edytuj ogłoszenie</button>
                        </a>
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
                <p class="lead">Aktualnie nie posiadasz żadnych ogłoszeń.</p>
            </div>
            </div>
            </div>
            ';
        }
    }
}
else
{
    // $_SESSION['info'] = "Aktualizacja danych przebiegła pomyślnie ".$user->getName();
    header('Location: '.$_SERVER['HTTP_REFERER']);
    exit();
}

?>
    </div>
</section>

<?php
require_once('../parts/footer.php');
require_once('../parts/scripts.php');
?>
