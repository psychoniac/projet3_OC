<?php session_start();
 include( 'connexion_bdd.php' );
 if (isset($_SESSION)) {
    echo $_SESSION['nom'];
    echo $_SESSION['prenom'];    
} else header('Location: login.php')
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
<?php if (isset($_GET[ 'id' ])) {
    $requeteSQL = 'SELECT * FROM acteur WHERE id_acteur = :id';
    $requete = $db->prepare( $requeteSQL );
    $acteurselect = $requete->execute( [ 'id' => $_GET[ 'id' ] ] );
    $acteur = $requete->fetch();
        if (!empty($acteur)) { ?>

        <img class = 'logo_acteur' src = "img/<?php echo $acteur['logo']; ?>"></br>

        <div class = 'nom_acteur2'>
        <?php	echo $acteur[ 'acteur' ];?></br>
        </div>

        <div class = 'description'>
        <?php echo $acteur[ 'description' ]; ?>
        </div>
        
        <a href = 'like_dislike.php?vote=1&acteurId=<?php echo $_GET['id']; ?>&user=<?php echo $_SESSION['username']; ?>' >Like</a>
        <a href = 'like_dislike.php?vote=0&acteurId=<?php echo $_GET['id']; ?>&user=<?php echo $_SESSION['username']; ?>' >Dislike</a>
        
<?php //parti commentaire
echo $_SESSION[ 'username' ];
echo 'peut poster un commentaire'; ?>

<form method = 'post' action = 'acteur.php'>
<textarea name = 'commentaire' name = 'commentaire' rows = '5' cols = '250'></textarea>
<input type = 'submit' name = 'envoyer'>
</form>


<?php } } ?>

</body>

</html>