<?php 
	include('connexion_bdd.php');
	session_start();
if (!empty($_SESSION)) {
    echo $_SESSION['nom'];
    echo $_SESSION['prenom'];    
} else {
	header('Location: login.php');
}

	//on va traiter le formulaire ici
	//on check qu'aucun utilisateur est connecté, on check les variables du formulaire
	if  (isset($_POST['changer_password'])) {
		if (!empty($_POST['nouveau_password']) && !empty($_POST['confirm_password'])) {
			$password1 = htmlspecialchars($_POST['nouveau_password']);
			$password2 = htmlspecialchars($_POST['confirm_password']);
			$userConnect = htmlspecialchars($_SESSION['id']);
			if ($password1 == $password2) {
				$passwordhach = password_hash($password1, PASSWORD_DEFAULT); 
				$requete = $db->prepare("UPDATE account SET 'password' = '$passwordhach' WHERE 'user_id' = '$userConnect'");
				$new_password = $requete->execute();
				echo "votre password a bien ete mis à jour";
			} else {
				echo "les 2 mots de passe sont différent";}	
		} else {
		echo "tous les champs doivent être rempli";
		}
	}
?>

<<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Projet3</title>
</head>

<body>
	<form method="post" action="nouveau_password.php">
		<label>Nouveau password</label>
		<input type="password" name="nouveau_password" for="password">
		<label for="confirm_password">Confirm password</label>
		<input type="password" name="confirm_password" id="confirm_password">
		<input type="submit" name="changer_password">
	</form>
</body>
</html>
