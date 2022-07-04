<?php session_start();
 include( 'connexion_bdd.php' );
 if (isset($_SESSION)) {
        echo $_SESSION['nom'];
        echo $_SESSION['prenom']; 
        echo "vous êtes bien connecté."; 
         } else {
            header('Location: login.php');
         }  
//on se place dans le formulaire 
if (isset($_POST['envoyer'])) {
    //on verifie la selection d'un acteur
    if (isset($_GET['id'])) {
        $id_user = htmlspecialchars($_SESSION['id']);
        $id_acteur = htmlspecialchars($_GET['id']);
            
        //on verifie que le commentaire n'est pas vide 
        if (!empty($_POST['commentaire'])) {
            //on renomme les variables 
            $commentaire = $_POST['commentaire'];
            //on effectue la requete qui va inserer le commentaire
            $requete = $db->prepare('INSERT INTO post(id_user,id_acteur,post) VALUES (:id_user,:id_acteur,:post)');
            $requete->execute(array(
                'id_user' => $id_user,
                'id_acteur' => $id_acteur,
                'post' => $commentaire));
        } else {
                echo "tous les champs doivent etre rempli";}
                
    } else {
            echo "l'acteur n'a pas ete choisi";}            
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
        $acteurList = $requete->execute( [ 'id' => $_GET[ 'id' ] ] );
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
        <a href = 'like_dislike.php?vote=1&acteurId=<?php echo $_GET['id']; ?>&user=<?php echo $_SESSION['id']; ?>' >Like</a>
        <a href = 'like_dislike.php?vote=0&acteurId=<?php echo $_GET['id']; ?>&user=<?php echo $_SESSION['id']; ?>' >Dislike</a>
        </div>

<div class="affichage des commentaires">
<?php //partie affichage des commentaires
//on verifie qu'un id_acteur est bien defini
//if (isset($_GET['id'])) {
  //  $reqSql = 'SELECT acteur.id_acteur,post.id_acteur FROM acteur INNER JOIN post ON id_acteur = post.acteur_id';
    //$requete = $db->prepare($reqSql);
    //$listePost = $requete->execute(['id_acteur' => $_GET['id']]);
    // = $listePost->fetch();
   // var_dump($Post);
   // if (!empty($Post)) {


//    }
//}

?>
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
