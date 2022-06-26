<?php
	// Fehlermeldung oder Nachricht ausgeben
    function DisplayMessage($message){
				if(!empty($message)){
					echo "<div class=\"alert alert-success\" role=\"alert\">" . $message . "</div>";
				} }

    function DisplayError($error){
                if(!empty($error)){
					echo "<div class=\"alert alert-danger\" role=\"alert\">" . $error . "</div>";
				}}


	if($_SERVER['REQUEST_METHOD'] == 'GET'){
					if(!empty($_GET["logout"])){
						if($_GET["logout"] == "success"){
							DisplayMessage("Der Benutzer wurde erfolgreich ausgeloggt.");
						}
					}

					if(!empty($_GET["login"])){
						if($_GET["login"] == "success"){
							DisplayMessage("Der Benutzer wurde erfolgreich eingeloggt.");
						}
					}
				}
?>