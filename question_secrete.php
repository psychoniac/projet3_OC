<?php if (isset($_POST['envoyer'] && !empty($_POST['reponse']) && !empty($_POST['question'])){
	$reponse = htmlspecialchars($_POST['reponse']);
	$question = htmlspecialchars($_POST['question']);
	$requete = INSERT INTO 

}





<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Mot de passe oublier//Question secrete</title>
</head>
<body>
	<h1>Mot de passe oublié</h1>
	<form method=post action="question_secrete.php">
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