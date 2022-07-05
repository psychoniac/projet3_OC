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
	//$passwordhach = password_hash($password, PASSWORD_DEFAULT);
	//var_dump($password);
	//$passwordTest = password_verify($passwordhach,$usernameExist['password']);
	//on va faire une requete pour savoir si le username est présent dans la base
	$requete = $db->prepare('SELECT * FROM account WHERE username = ?');
	$requete->execute(array($username));
	$usernameExist = $requete->fetch();
	//var_dump($usernameExist['password']);
		//si le username existe 
		if ($usernameExist !== false) {
			//on verifie le password
			if ($usernameExist['password'] == $password) { 
				$_SESSION['nom'] = $usernameExist['nom'];
				$_SESSION['prenom'] = $usernameExist['prenom'];
				$_SESSION['id'] = $usernameExist['id_user'];
				header("Location: home.php");
			} else {
				echo "le password n'est pas bon";
			}
		} else {
			echo "le username n'est pas bon";
		}
	} else {
		echo "tous les champs doivent etre rempli";	
		}
	}
?>

<!DOCTYPE html>

<html>
<head>
		<meta charset="utf-8" />
		<link rel="stylesheet" href="style.css">
		<title>Projet3</title>
</head>

<body>
<div class="container">
<div class="en_tete">
<img class="logo_gbaf" src="img/logo.png" alt="logo couleur de la société" width="150px" height="150px"  title="logo de l'entreprise">
</div>
<div class="corps_page">
<h1>Se connecter :</h1>
</br>
</br>
<form class='login' method="post" action="login.php">
		<label for="identifiant">Mon identifiant</label>
		<input type="text" name="identifiant" label="identifiant" id="identifiant">
		<label for="password">Mot de passe</label>
		<input type="password" name="password" id="password">
		<input type="submit" name="envoyer" label="Envoyer">
</form>
</br>
</br>
<a href="question_secrete.php">Mot de passe oublié...</a>
</br>
</div>
	
<div class="footer">
	<div class=contact>
<h3>Contact</h3>
<ul>
<li><p>Adresse: .......</p></li>
<li><p>Téléphone:......</p></li>
<li><p>E-mail:.........</p></li>
</ul>
</div>
<div class=nos_reseaux>
<h3>Nos réseaux</h3>
<ul>
<li><a href="https://twitter.com/share">Tweeter</a></li>
<li><a href="mailto:jlnko@hotmail.fr">Contactez-moi</a></li>
<li><a href="https://facebook.com/share">Facebook</a></li>
</ul>
</div>
<div class="copyright">Copyright: GBAF Année 2022</div>
</div>

</div>
</div>

</body>
</html>
