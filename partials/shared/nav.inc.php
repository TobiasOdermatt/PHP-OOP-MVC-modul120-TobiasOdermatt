<?php 
//Wichtig
//Links = viewName, muss den PHP Files entsprechen
//Rechts = Anzeigename
$NavBarwithSession = [
    "viewBook" => "Bücher",
    "viewCustomer" => "Kunden",
    "logout" => "Ausloggen"
];

$NavBarwithoutSession = [
    "login" => "Einloggen",
];

    function showNavItemswithSession($NavBarwithSession,$view){
        foreach ($NavBarwithSession as $key => $value) {
            if($view == $key) {
            //Ist der Benutzer auf der aktuelle Seite, so wird der Text in der Nav Fett angezeig
                ?><li class="nav-item"><a class="nav-link active" href="./index.php?view=<?php echo $key?>"><?php echo $value?></a></li><?php
            }else{
            ?> <li class="nav-item"><a class="nav-link" href="./index.php?view=<?php echo $key?>"><?php echo $value?></a></li><?php
          }}
    }
    function showNavItemswithoutSession($NavBarwithoutSession,$view){
        foreach ($NavBarwithoutSession as $key => $value) {
            //Ist der Benutzer auf der aktuelle Seite, so wird der Text in der Nav Fett angezeigt
            if($view == $key) {
                ?><li class="nav-item"><a class="nav-link active" href="./index.php?view=<?php echo $key?>"><?php echo $value?></a></li> <?php
            }else{
            ?> <li class="nav-item"><a class="nav-link" href="./index.php?view=<?php echo $key?>"><?php echo $value?></a></li><?php
          }}
    }
    require_once('helpers/session.inc.php');
    ?>

     <!-- Responsive navbar-->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container px-5">
                 <!-- Home ist auf allen Seiten gleich -->
                <a class="navbar-brand" href="<?php $root?>index.php">Home</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <?php if($userisloggedIn){
                        //Je nachdem ob der Benutzer eingeloggt ist, bekommt er andere NavItems
                        showNavItemswithSession($NavBarwithSession,$view);}else{showNavItemswithoutSession($NavBarwithoutSession,$view);}
                    ?>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container px-4 px-lg-5">