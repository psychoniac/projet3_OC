<?php include('connexion_bdd.php'); ?>
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
<?php if (isset($_POST['envoyer']) && !empty($_POST['username']) && !empty($_POST['question']) && !empty($_POST['reponse'])) {
		$username = $_POST['username'];
		$question = $_POST['question'];
		$reponse = $_POST['reponse'];
		//on verifie que le username du formulaire existe dans la bdd
		$requete = $db->prepare('SELECT * FROM account WHERE username = ?');
		$requete->execute(array('username'));
		$usernameexist = $requete->rowcount();
		//si le username existe on va verifier que la question et la reponse du formulaire correspond a la question et la reponse de la bdd
			if ($usernameexist == 1) {
				//on va chercher la question et la reponse qui corresponde a username
				$requete2 = $db->prepare('SELECT question FROM account WHERE username = $username');
				$requete2->execute(array('username'));
				$questionSecrete = $requete2->rowcount();
				$requete3 = $db->prepare('SELECT reponse FROM account WHERE username = $username');
				$requete3->execute(array('username'));
				$reponse = $requete3->rowcount();
				//si la question et la reponse du formulaire sont egal a la question et la reponse de la bdd on affiche le mot de passe
				if ($questionSecrete == $question AND $reponseSecrete == $reponse) {
					$requete4 = $db->prepare('SELECT password FROM account WHERE username = $username');
					$requete4->execute(array('username'));
					$password = $requete4->rowcount();
					echo $password;
				} else {
					echo 'un champ est vide';
				}
			} else {
				echo 'le username est absent dans la bdd';
			}
		} else {
			'la question ou la reponse sont inexacte';
		}
?>
