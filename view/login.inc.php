<?php //Login- und Fehlermanagement Komponente wird integriert
require_once('helpers/loginmanagement.inc.php');
?>

<!-- Seiteninhalt-->
<br>
<h2>Benutzer anmelden</h2>
<p>Bitte geben Sie zur Identifikation die E-Mail sowie Passwort an.</p>
<br>
<?php
//Falls Fehler entstehen wird das dem Benutzer mitgeteilt
DisplayError($error);
DisplayMessage($message); ?>
<div class="col-lg-4">
    <form method="post" action="">
        <div class="form-group">
            <label for="inputEmail">E-Mail</label>
            <input name="email" type="email" class="form-control" id="inputEmail" placeholder="E-Mail">
        </div>
        <br>
        <div class="form-group">
            <label for="inputPassword">Passwort</label>
            <input name="password" type="password" class="form-control" id="inputPassword" placeholder="Passwort">
        </div>
        <br>

        <button type="submit" class="btn btn-primary">Einloggen</button>
    </form>
</div>
</div>
<?php for ($i = 0; $i < 11; $i++) {
    echo "<br>";
} ?>