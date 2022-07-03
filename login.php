<?php 
session_start(); 
		
include('connexion_bdd.php'); 
if (isset($_POST['envoyer'])) {
	if (!empty($_POST['identifiant']) && !empty($_POST['password'])) {
	$username = $_POST['identifiant'];
	//$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
	$password = $_POST['password'];
	$requeteSQL = ('SELECT * FROM account WHERE username = ? and password = ?');
	$requete = $db->prepare($requeteSQL);
	$requete->execute(array($username,$password));
	$resultat = $requete->fetch();
		if ($resultat) { 
		$_SESSION['username'] = $resultat['username'];
		header("Location: home.php",true,301);
		} else {
			echo "mot de passe ou username invalide";		
		} 
	} else {
		echo "un des champs est vide";
	}
}
?>

<!DOCTYPE html>

<html>
<head>
		<meta charset="utf-8" />
		<link rel="stylesheet" href="style.css">
		<title>login</title>
</head>

<body>
<?php include('en_tete.php'); ?>
	<h1>Se connecter :</h1>
	<form class='login' method="post" action="login.php">
		<label for="identifiant">Mon identifiant</label>
		<input type="text" name="identifiant" label="identifiant" id="identifiant">
		<label for="password">Mot de passe</label>
		<input type="password" name="password" id="password">
		<input type="submit" name="envoyer" label="Envoyer">
	</form>
	<a href="question_secrete.php">Mot de passe oublié...</a>
<?php include('footer.php'); ?>
</body>
</html>
