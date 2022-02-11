<li class="nav-item dropdown">
        <a
            class="nav-link dropdown-toggle"
            href="#"
            id="navbarDropdown"
            role="button"
            data-toggle="dropdown"
            aria-haspopup="true"
            aria-expanded="false">
            <?php
            echo $_SESSION['name']." ".$_SESSION['surname']; 
            ?>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="user_my_ads.php?id_user=<?php echo $_SESSION['id_user'] ?>">Ogłoszenia</a>
            <!-- <a class="dropdown-item" href="#">Wiadomości</a> -->
            <!-- <a class="dropdown-item" href="#">Obserwowane</a> -->
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="user_page.php">Ustawienia</a>
            <a class="dropdown-item" href="logout.php">Wyloguj</a>
        </div>
    </li>