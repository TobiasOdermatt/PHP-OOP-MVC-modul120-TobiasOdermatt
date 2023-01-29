<?php
$error = "";
$message = "";
//Header mit Seiteninformation
include 'partials/shared/header.inc.php';
//Standartmässig ist die Seite auf Home
$view = "Home";
//Falls der Seite, View Parameter bekommt
if ($_SERVER["REQUEST_METHOD"] == "GET" || $_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_GET["view"])) {
        $view = (strlen($_GET["view"]) > 10 || strpos($_GET["view"], '.') !== false) ? "Home" : $_GET["view"];
    }
}
//Navigationsleiste
$root = ".";
include 'partials/shared/nav.inc.php';
include 'helpers/errormanagement.inc.php';

//Lädt die View die als Parameter mitgegeben wurde
if ($view == "Home") {
    include 'view/index.inc.php';
} else {
    if (is_file('view/' . $view . '.inc.php')) {
        include 'view/' . $view . '.inc.php';
    } else {
        DisplayError("Diese Seite wurde nicht gefunden.");
        include 'view/index.inc.php';
    }
}
//Footerzeile
include 'partials/shared/footer.inc.php';