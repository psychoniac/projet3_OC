<?php 
session_start(); 
		
include('connexion_bdd.php'); 
//on verifie que la variable $_POST['envoyer'] est bien definie 
if (isset($_POST['envoyer'])) {
	//on verifie que les champs du formulaire ne sont pas vide 
	if (!empty($_POST['identifiant']) && !empty($_POST['password'])) {
	//on fait en sorte que les champs ne puisse pas contenir de code html
	$username = htmlspecialchars($_POST['identifiant']);
	$password = htmlspecialchars($_POST['password']);
	
	//on va faire une requete pour savoir si le username est présent dans la base
	$requete = $db->prepare('SELECT * FROM account WHERE username = ?');
	$requete->execute(array($username));
	$usernameExist = $requete->fetch();
		//si le username existe 
		if ($usernameExist !== false) {
			$passwordBdd = $usernameExist['password'];
			//on verifie le password
			if (password_verify($password,$passwordBdd)) {
				$_SESSION['nom'] = $usernameExist['nom'];
				$_SESSION['prenom'] = $usernameExist['prenom'];
				$_SESSION['id'] = $usernameExist['id_user'];
				header("Location: home.php");
			} else {
				echo "le mot de passe n'est pas le bon";
			}
		} else {
			echo "le username n'est pas bon";
		}
	} else {
		echo "tous les champs doivent etre rempli";	
		}
	}
?>

