<?php include('connexion_bdd.php');
	session_start();
	if (isset($_SESSION)) {
		echo $_SESSION['nom'];
		echo $_SESSION['prenom'];    
	}
	?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Mot de passe oublié</title>
</head>
<body>
	<h1>Mot de passe oublié</h1>
	<form method="post" action="question_secrete.php">
			<label for="username">Quel est votre identifiant?</label>
			<input type="text" name="username" id="username">
			<label for="question">Question secrète</label>
			<select name="question" id="question"> 
				<option value="Quel est le nom de votre premier animal de compagnie?">Quel est le nom de votre premier animal de compagnie?</option>
				<option value="Quel est le prénom de votre mère?">Quel est le prénom de votre mère?</option>
				<option value="Quel est votre sport favori?">Quel est votre sport favori?</option>
			</select> 
			<label for="reponse">Réponse à la question secrète</label>
			<input type="text" name="reponse" id="reponse">
			<input type="submit" name="envoyer" id="envoyer">
	</form>

</body>
</html>
<?php 
if (isset($_POST['envoyer'])) {  
	if (!empty($_POST['username']) && !empty($_POST['question']) && !empty($_POST['reponse'])) {
		$username = htmlspecialchars($_POST['username']);
		$question = htmlspecialchars($_POST['question']);
		$reponse =  htmlspecialchars($_POST['reponse']);

		//on verifie que le username du formulaire existe dans la bdd
		$requete = $db->prepare('SELECT * FROM account WHERE username = ?');
		$requete->execute(array($username));
		$usernameexist = $requete->fetch();

		//si le username existe on va verifier que la question et la reponse du formulaire correspond a la question et la reponse de la bdd
		if ($usernameexist !== false) {
			//si la question et la reponse du formulaire sont egal a la question et la reponse de la bdd 
			if ($usernameexist['question'] == $question && $usernameexist['reponse'] == $reponse) {
				header('Location: nouveau_password.php');
			} else {
				echo 'La question ou la reponse ne correspond pas aux donnees enregistre';
			}
		} else {
			echo 'le username est absent de la base';
		}
	} else {
		echo 'Un des champs est vide';
	}
}
?>
