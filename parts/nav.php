<?php
// session_start();
// $_SESSION['error'] = "test";
if(isset($_SESSION['error']))
{
    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
        '.$_SESSION['error'].'
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div>';

    unset($_SESSION['error']);
}

// $_SESSION['info'] = "test";
if(isset($_SESSION['info']))
{
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        '.$_SESSION['info'].'
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div>';

    unset($_SESSION['info']);
}

?>
<nav class="navbar sticky-top navbar-expand-lg navbar-light bg-white border-bottom">
    <a class="navbar-brand" href="index.php"><img class="img-fluid" width="40" height="40" src="../img/logo-removebg-preview.png"></img></a>
    <button
        class="navbar-toggler"
        type="button"
        data-toggle="collapse"
        data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent"
        aria-expanded="false"
        aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
<?php
if(isset($_SESSION['user_login']))
{
    require_once('../parts/nav_user_part.php');
}
else
{
    require_once('../parts/nav_form_login.php');
}                      
?>
        </ul>
        <!-- <form class="form-inline my-2 my-lg-0"> -->
        <!-- <input class="form-control mr-sm-2" type="search" placeholder="Search"
        aria-label="Search"> -->
<?php
if(!isset($_SESSION['user_login']))
{
    // echo '<a href="logout.php" class="nav-link logout" href="registration.php">Zarejestruj się</a>';
    echo '<button type="button" class="btn btn-outline-secondary" data-toggle="modal" data-target="#exampleModal">
    Zarejestruj się j dodaj ogłoszenie
  </button>';
} 
else
{
    echo
    '
    <a href="add_ad.php">
        <button class="btn btn-sm btn-outline-success my-2 my-sm-0" type="button">Dodaj ogłoszenie</button>
    </a>
    ';
}

?>
        
        <!-- </form> -->
    </div>
</nav>