<?php session_start();
	include('connexion_bdd.php');
	if (isset($_POST['inscription']))
	{		
		//on vérifie si l'un des champ est vide 
		if (!empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['question']) && !empty($_POST['reponse']))
		{
			$nom = htmlspecialchars($_POST['nom']);
			$prenom = htmlspecialchars($_POST['prenom']);
			$username = htmlspecialchars($_POST['username']);
			$password = htmlspecialchars($_POST['password']);
			$question = htmlspecialchars($_POST['question']);
			$reponse = htmlspecialchars($_POST['reponse']);
			//on hache le password
			$passwordhach = password_hash($password, PASSWORD_DEFAULT);


			//on teste si le username est deja présent dans la bdd
			$requete = $db->prepare('SELECT * FROM account WHERE username = ?');
			$requete->execute(array($username));
			$usernameexist = $requete->fetch();
     	
			//si le username n'existe pas on insere les données dans la base
			if ($usernameexist == false) {		   			
				$requete = $db->prepare('INSERT INTO account(nom,prenom,username,password,question,reponse) VALUES	(:nom,:prenom,:username,:password,:question,:reponse)');
				$requete->execute(array(
					'nom' => $nom, 
					'prenom' => $prenom,
					'username' => $username,
					'password' => $passwordhach,
					'question' => $question,
					'reponse' => $reponse
				));
				if (isset($requete)) {
					echo "vous êtes bien inscrit";
				}
			} else {
				echo "le user existe deja";
			}
		} else {
		echo "tous les champs doivent etre rempli";
		}	
	}
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="style.css">
	<title>Site openclassroom</title>
</head>

<body>

	<?php include('en_tete.php'); ?>

	<h1>Inscription</h1>

	<form method=post action="inscription.php">
		<fieldset>
			<legend>Identité</legend>
				<label for="nom">Nom</label>
				<input type="text" name="nom" id="nom">
				<label for="prenom">Prénom</label>
				<input type="text" name="prenom" id="prenom">
		</fieldset>
			<legend>Id de connexion</legend>
				<label for="username">Pseudo</label>
				<input type="text" name="username" id="username">
				<label for="password">Mot de passe</label>
				<input type="password" name="password" id="password">
		</fieldset>
		
			<legend>Oublie id connexion</legend>
			<label for="question">Question secrète</label>
			<select name="question" id="question">
				<option value="Quel est le nom de votre premier animal de compagnie?">Quel est le nom de votre premier animal de compagnie?</option>
				<option value="Quel est le prénom de votre mère?">Quel est le prénom de votre mère?</option>
				<option value="Quel est votre sport favori?">Quel est votre sport favori?</option>
			</select> 
			<label for="reponse">Réponse à la question secrète</label>
			<input type="text" name="reponse" id="reponse">
			<input type="submit" name="inscription" label="inscription">
	</form>

	<?php include('footer.php'); ?>
</body>
</html>