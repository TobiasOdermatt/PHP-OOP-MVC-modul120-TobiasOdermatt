
<?php
require_once('dbContext.inc.php');
function loginsuccess($email, $benutzername, $admin)
{
	require_once('session.inc.php');
	createSession($email, $benutzername, $admin);
	header("Location: index.php?login=success");
}
//Formfelder werden validiert, wenn es zu einem Fehler kommt dann wird die Variabel $error befüllt
require_once('validate_form_server_side.inc.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	list($email, $password) = validatelogin($_POST['email'], $_POST['password']);
	if (empty($error)) {
		$stmt = $dbcontext->prepare("SELECT email, passwort FROM benutzer WHERE email = (?)");
		$stmt->bind_param("s", $email);
		$stmt->execute();
		$stmt->store_result();
		$countRows = $stmt->num_rows;
		if ($countRows >= 1) { //Wurde die Email gefunden, wird das Password überprüft
			$sql = "SELECT email,benutzername,passwort,admin from benutzer where email = '$email'";
			$result = $dbcontext->query($sql);
			$row = $result->fetch_assoc();
			$dbcontext->close();
			if (password_verify($password, $row["passwort"])) {
				$message .= "Sie wurden erfolgreich eingeloggt";
				loginsuccess($email, $row["benutzername"], $row["admin"]);
			} else {
				$error .= "Ungültige Email oder Password";
			}
		} else {
			$error .= "Ungültige Email oder Password ";
		}
	}
}
?>