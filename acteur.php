<?php session_start();
 include( 'connexion_bdd.php' );
 if (isset($_SESSION)) {
    echo $_SESSION['nom'];
    echo $_SESSION['prenom'];    
}



?>

<!DOCTYPE html>
<html>

<head>
<meta charset = 'utf-8' />
<link rel = 'stylesheet' href = 'style.css'>
<title>Acteur</title>
</head>

<body>
<?php include( 'en_tete.php' );
?>

<h2>Les partenaires</h2>
<?php if ( isset( $_GET[ 'id' ] ) ) : ?>

<?php
    $requeteSQL = 'SELECT * FROM acteur WHERE id_acteur = :id';
    $requete = $db->prepare( $requeteSQL );
    $acteurselect = $requete->execute( [ 'id' => $_GET[ 'id' ] ] );
    $acteur = $requete->fetch();
?>
<?php if (!empty( $acteur ) ) : ?>

        <img class = 'logo_acteur' src = "img/<?php echo $acteur['logo']; ?>"></br>
        <div class = 'nom_acteur2'>
            <?php	echo $acteur[ 'acteur' ];?></br>
        </div>
        <div class = 'description'>
            <?php echo $acteur[ 'description' ]; ?>
        </div>
        <a href = 'like_dislike.php?vote=1&acteurId=<?php echo $_GET['id']; ?>&user=<?php echo $_SESSION['username']; ?>' >Like</a>
        <a href = 'like_dislike.php?vote=0&acteurId=<?php echo $_GET['id']; ?>&user=<?php echo $_SESSION['username']; ?>' >Dislike</a>
        <form method = 'post' action = 'acteur.php'>
        <textarea name = 'commentaire' name = 'commentaire' rows = '5' cols = '250'></textarea>
        <input type = 'submit' name = 'envoyer'>
        </form>
        </section>

<?php endif; ?>
<?php endif; ?>



<?php echo date( 'l \l\e jS' );
echo $_SESSION[ 'username' ];
?>
</br>
<?php echo 'peut poster un commentaire';
?>

<form method = 'post' action = 'acteur.php'>
<textarea name = 'commentaire' name = 'commentaire' rows = '5' cols = '250'></textarea>
<input type = 'submit' name = 'envoyer'>
</form>
</section>

<?php //on verifie que l'utilisateur est bien connecté via $_SESSION['id'],et que $_post envoyer et commentaire sont bien défini
		//if (isset($_SESSION['username']) && !empty($_POST['envoyer']) && !empty('commentaire')) {
		 //	$commentaire = $_POST['commentaire' ];
//	$requete = prepare()
//}

?>

</body>

</html>