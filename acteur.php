<?php session_start();
 include( 'connexion_bdd.php' );
 if (isset($_SESSION)) {
        echo $_SESSION['nom'];
        echo $_SESSION['prenom'];  
        echo $_SESSION['id']; }  ?>
<?php     
    //on verifie qu'un user est bien connecter et qu'un acteur a ete selectionner 
    if (isset($_SESSION['id'])) {
        if (!empty($_GET['id'])) {
        $id_user = htmlspecialchars($_SESSION['id']);
        $id_acteur = htmlspecialchars($_GET['id']);
            //on verifie que l'on a clique sur envoyer
            if (isset($_POST['envoyer'])) {
                //on verifie que le commentaire n'est pas vide 
                if (!empty($_POST['commentaire'])) {
                //on renomme les variables 
                $id_user = $_SESSION['id'];
                //on nomme les variables que l'on va utiliser
                $commentaire = $_POST['commentaire'];
                //on effectue la requete qui va inserer le commentaire
                $requete = $db->prepare('INSERT INTO post(id_user,id_acteur,post) VALUES (:id_user,:id_acteur,:post)');
                $requete->execute(array(
                'id_user' => $id_user,
                'id_acteur' => $id_acteur,
                'post' => $commentaire));
                } else {
                    echo "tous les champs doivent etre rempli";}
            }    
        } else {
            echo "l'acteur n'a pas ete choisi";}
    } else {
        echo "aucun user connecté";
    }
    
?>

<!DOCTYPE html>
<html>
<head>
<meta charset = 'utf-8' />
<link rel = 'stylesheet' href = 'style.css'>
<title>Projet 3</title>
</head>
<body>
<header>
<?php include( 'en_tete.php' );?>
</header>
<section name="bloc_acteur">
<h1>Les partenaires</h1>
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
        <div name="lien_likeDislike">
        <a href = 'like_dislike.php?vote=1&acteurId=<?php echo $_GET['id']; ?>&user=<?php echo $_SESSION['username']; ?>' >Like</a>
        <a href = 'like_dislike.php?vote=0&acteurId=<?php echo $_GET['id']; ?>&user=<?php echo $_SESSION['username']; ?>' >Dislike</a>
        </div>

<div name="formulaire_commentaire">
<?php //parti commentaire
echo $_SESSION[ 'nom' ];
echo 'peut poster un commentaire'; ?>
<form method = 'post' action = 'acteur.php'>
<textarea name = 'commentaire' name = 'commentaire' rows = '5' cols = '250'></textarea>
<input type = 'submit' name = 'envoyer'>
</form>
</div>
<?php } } ?>
</section>
<footer>
<?php include('footer.php'); ?>
</footer>
</body>
</html>
