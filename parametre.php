<?php session_start();

include( 'en_tete.php' );

include( 'connexion_bdd.php' );
if ( isset( $_POST[ 'changement_parametre' ] ) && isset( $_SESSION[ 'username' ] ) )
 {
    //on verifie les champs du formulaire
    if ( !empty( $_POST[ 'nom' ] ) && !empty( $_POST[ 'prenom' ] ) && !empty( $_POST[ 'username' ] ) && !empty( $_POST[ 'password' ] ) && !empty( $_POST[ 'question' ] ) && !empty( $_POST[ 'reponse' ] ) )
 {
        $userlogged = htmlspecialchars( $_SESSION[ 'username' ] );
        $nom = htmlspecialchars( $_POST[ 'nom' ] );
        $prenom = htmlspecialchars( $_POST[ 'prenom' ] );
        $username = htmlspecialchars( $_POST[ 'username' ] );
        $password = htmlspecialchars( $_POST[ 'password' ] );
        $question = htmlspecialchars( $_POST[ 'question' ] );
        $reponse = htmlspecialchars( $_POST[ 'reponse' ] );
        //modifier avec password hash et password verify

        //on teste si le username est deja présent dans la base
        $requete = $db->prepare( 'SELECT username FROM account WHERE username = ?' );
        $requete->execute( array( $username ) );
        $usernameExist = $requete->rowcount();

        //si le username n'existe pas on modifie les données de la base
        if ( $usernameExist == 0 )
        {
            $requete2 = $db->prepare ("UPDATE 'account' SET 'nom'= '$nom', 'prenom' = '$prenom', 'username' = '$username', 'password' = '$password', 'question' = '$question', 'reponse' = '$reponse' WHERE 'username' = '$usernameLogged')");
			$requete2 = $db->execute(array(
				'nom' => $nom,
				'prenom' => $prenom,
				'username' => $username,
				'password' => $password,
				'question' => $question,
				'reponse' => $reponse
			));
			if (isset($requete2)){
				echo "vos changements sont bien enregistré";
			}
		}
		else{
			echo "le username existe déjà";
		} 
	else
	{
		echo "Tous les champs doivent être rempli";
	}	
 	}		
} 
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport' content = 'width = device-width, initial-scale = 1.0">
	<link rel="stylesheet' type = 'text/css' href = 'style.css">
	<title>Parametres</title>
</head> 

<body>
	<h1>Modifier mes informations</h1>
	<form method=post action="parametre.php">
		<label for="nom">Nom</label>
		<input type="text' name = 'nom' id = 'nom">
		<label for="prénom">Prénom</label>
		<input type="text' name = 'prénom">
		<label for="username">Username</label>
		<input type="text' name = 'username">
		<Label for="password">Password</label>
		<input type="password' name = 'password">
		<label for="question">Question</label>
		<select name="question' id = 'question">
			<option value="Quel est le nom de votre premier animal de compagnie?">Quel est le nom de votre premier animal de compagnie?</option>
			<option value="Quel est le prénom de votre mère?">Quel est le prénom de votre mère?</option>
			<option value="Quel est votre sport favori?">Quel est votre sport favori?</option>
</select>
<label for="reponse">Réponse</label>
<input type="text' name = 'reponse' id = 'reponse">
<input type="submit' namme = 'changement_parametre">
        </form>
        </body>
        </html>