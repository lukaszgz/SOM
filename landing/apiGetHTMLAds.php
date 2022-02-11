<?php
session_start();
require_once('../scripts/db.php');

$get_id_mark = (isset($_GET['id_mark']))? $_GET['id_mark'] : 0;
$get_id_model = (isset($_GET['id_model']) != "")? $_GET['id_model'] : 0;
$html = "";

if(isset($_GET['noCrashed']))
{
    switch ($_GET['noCrashed']) {
        case 1:
            $condition = "AND crashed = 1";
            break;
        case 2:
            $condition = "AND crashed = 1";
            break;
        case 3:
            $condition = "AND crashed = 1";
            break;
        case 4:
            $condition = "AND crashed = 1";
            break;
        
        default:
            $condition = "";
            break;
    }
}

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
JOIN som_type t ON a.id_type_car=t.id_type WHERE a.id_mark = ".$get_id_mark." ";

if($get_id_model>0)
{
  $sql .= "AND a.id_model = ".$get_id_model." ";
}

$sql .= $condition;

$html = $sql;

// echo "<pre>";
// print_r($_POST);
// echo "</pre>";

if($result = DB::query($sql))
{
  $html = "";
  if($result -> num_rows>0)
  {
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
        $html .= 
        '
            <div class="col-12 mt-3">
                <div class="card">
                    <div class="card-horizontal">
                  
                        <div class="img-square-wrapper img-in-horizontal-card">
                        
                            <img height="50" class="img-fluid img-thumbnail" src="'.$imageURL.'" alt="obraz">
                            <h5 class="h5 center alert alert-dark p-0 m-0">'.$row['price'].' PLN</h2>
                            
                        </div>
                        
                        <div class="card-body pt-1">
                        <div class="text-right">Dodaj do obserwowanych <i class="far fa-star star ml-1" data-toggle="tooltip" data-placement="top" title="Obserwój"></i></div>
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
      $html = "";
      $html = 
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
    // echo $html;
  }
  else
  {
    $html .= " Nie udało się wykonać zapytania!";
    // header('Location: index.php');
    // exit();
  }

  echo $html;

?>