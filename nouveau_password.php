<?php 
	include('connexion_bdd.php');
	session_start();
if (isset($_SESSION)) {
    echo $_SESSION['nom'];
    echo $_SESSION['prenom'];    
}
?>







	//on va traiter le formulaire ici
	//on check qu'aucun utilisateur est connecté, on check les variables du formulaire
	if (!isset($_SESSION['id']) && !empty($_POST['changer_password']) && !empty($_POST['nouveau_password']) && !empty($_POST['confirm_password'])){
		// code...
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
