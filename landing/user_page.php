<?php
require_once('../scripts/db.php');
require_once('../parts/head.php');
require_once('../parts/nav.php');
require_once('../class/user.php');
?>

<section>
    <div class="container mt-3">
        <h1 class="h1">Twoje dane</h1>
        <?php

$sql = "Select * from som_users WHERE id_user =".$_SESSION['id_user'];
if ($result = DB::query($sql))
{
    if($result->num_rows>0)
    {
        $row = $result->fetch_assoc();

        $db_name = $row['name'];
        $db_surname = $row['surname'];
        $db_email = $row['email'];
        $db_phone = $row['phone'];
        $db_company = $row['company'];
        $db_street = $row['street'];
        $db_password = $row['pass'];
        $db_street_number = $row['street_number'];
        $db_home_number = $row['home_number'];
        $db_city = $row['city'];
        $db_post_code = $row['post_code'];
        $db_id_province = $row['id_province'];
        $db_id_country = $row['id_country'];

        // echo
        // '
        // <table class="table">
        // <tbody>
        // <tr>
        //     <th>Imię</th><td>'.$db_name.'</td>
        // <tr>
        // <tr>
        //     <th>Nazwisko</th><td>'.$db_surname.'</td>
        // <tr>
        // <tr>
        //     <th>Email</th><td>'.$db_email.'</td>
        // <tr>
        // <tr>
        //     <th>Firma</th><td>'.$db_company.'</td>
        // <tr>
        // <tr>
        //     <th>Ulica</th><td>'.$db_street.' '.$db_street_number.''.$db_home_number.'</td>
        // <tr>
        // <tr>
        //     <th>Miasto</th><td>'.$db_city.' ('.$db_post_code.')</td>
        // <tr>
        // <tr>
        //     <th>Województwo</th><td>'.$db_id_province.'</td>
        // <tr>
        // <tr>
        //     <th>Kraj</th><td>'.$db_id_country.'</td>
        // <tr>
        // </tbody>
        // </table>
        // ';
    }
}

?>
        <form action="update_user_script.php" method="POST">
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="inputEmailEdit">Email</label>
                    <input type="email" class="form-control" id="inputEmailEdit" name="inputEmailEdit"
                        placeholder="Email" value="<?php echo $db_email ?>"
                        value=<?php ( isset($_SESSION['inputEmailEdit']) )? $_SESSION['inputEmailEdit']:"xxx"; ?>>
                </div>
                <!-- <div class="form-group col-md-6">
                    <label for="inputPasswordEdit">Zmień hasło</label>
                    <input type="password" class="form-control" id="inputPasswordEdit" name="inputPasswordEdit"
                        placeholder="Hasło" value="">
                </div> -->
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputNameEdit">Imie</label>
                    <input type="text" class="form-control" id="inputNameEdit" name="inputNameEdit" placeholder="Imię"
                        value=<?php echo $db_name ?>>
                </div>
                <div class="form-group col-md-6">
                    <label for="inputSurnameEdit">Nazwisko</label>
                    <input type="text" class="form-control" id="inputSurnameEdit" name="inputSurnameEdit"
                        placeholder="Nazwisko"
                        value=<?php echo $db_surname ?>>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputPhoneEdit">Telefon</label>
                    <input type="text" class="form-control" id="inputPhoneEdit" name="inputPhoneEdit"
                        placeholder="XXX-XXX-XXX" value="<?php echo $db_phone ?>">
                </div>
                <div class="form-group col-md-6">
                    <label for="inputCompanyEdit">Nazwa firmy</label>
                    <input type="text" class="form-control" id="inputCompanyEdit" name="inputCompanyEdit"
                        placeholder="Firma" value="<?php echo $db_company ?>">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-8">
                    <label for="inputStreetNameEdit">Ulica</label>
                    <input type="text" class="form-control" id="inputStreetNameEdit" name="inputStreetNameEdit"
                        placeholder="Ulica" value="<?php echo $db_street ?>">
                </div>
                <div class="form-group col-md-2">
                    <label for="inputStreetNumberEdit">Numer</label>
                    <input type="text" class="form-control" id="inputStreetNumberEdit" name="inputStreetNumberEdit" value="<?php echo $db_street_number ?>">
                </div>
                <div class="form-group col-md-2">
                    <label for="inputHomeNumberEdit">Mieszkanie</label>
                    <input type="number" class="form-control" id="inputHomeNumberEdit" name="inputHomeNumberEdit" value="<?php echo $db_home_number ?>">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputCityEdit">Miasto</label>
                    <input type="text" class="form-control" id="inputCityEdit" name="inputCityEdit"
                        placeholder="Miasto" value="<?php echo $db_city ?>">
                </div>
                <div class="form-group col-md-3">
                    <label for="inputProvinceEdit">Województwo</label>
                    <select id="inputProvinceEdit" class="form-control" name="inputProvinceEdit">
                        <option value="0" >Wybierz...</option>
                        <?php
$sql = 'SELECT * FROM som_province order by name_province';
$result = DB::query($sql);
while (($province = $result -> fetch_assoc()) !== null){
    $selected = ($province['id_province'] == $db_id_province)? "selected" : "";
    echo '<option '.$selected.' value="'.$province['id_province'].'">'.$province['name_province'].'</option>';
}
// $wynik -> close(); // zwolnienie pamięci
?>
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label for="inputZipCodeEdit">Kod pocztowy</label>
                    <input type="number" class="form-control" id="inputZipCodeEdit" name="inputZipCodeEdit"
                        placeholder="XXXXX" value="<?php echo $db_post_code ?>">
                </div>
            </div>

            <!-- <button type="submit" class="btn btn-primary">Sign in</button> -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Wyjdź</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Zrestartuj hasło</button>
                <button type="submit" class="btn btn-primary">Zapisz zmiany</button>
            </div>
        </form>

    </div>
</section>

<?php
require_once('../parts/footer.php');
require_once('../parts/scripts.php');
?>