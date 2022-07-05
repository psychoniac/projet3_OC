<?php session_start();
 include( 'connexion_bdd.php' );
 if (!empty($_SESSION)) {
        echo $_SESSION['nom'];
        echo $_SESSION['prenom']; 
        echo "vous êtes bien connecté."; 
} else {
            header('Location: login.php');
         }  
//on se place dans le formulaire 
if (isset($_POST['envoyer'])) {
    //on verifie que $_GET['id] n'est pas vide 
    if (!empty($_GET['id'])) {
        $id_user = htmlspecialchars($_SESSION['id']);
        $id_acteur = htmlspecialchars($_GET['id']);
            
        //on verifie que le commentaire n'est pas vide 
            if (!empty($_POST['commentaire'])) {
            //on renomme les variables 
            $commentaire = htmlspecialchars($_POST['commentaire']);
            //on effectue la requete qui va inserer le commentaire
            $requete = $db->prepare('INSERT INTO post(id_user,id_acteur,post) VALUES (:id_user,:id_acteur,:post)');
            $requete->execute(array(
                'id_user' => $id_user,
                'id_acteur' => $id_acteur,
                'post' => $commentaire));
                if (isset($requete)) {
                    echo "votre commentaire est bien enregistré";
                }
            } else {
                echo "tous les champs doivent etre rempli";}
    } else {
        header('Location: home.php');
    }            
              
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
<img class="logo_gbaf" src="img/logo.png" alt="logo couleur de la société" width="160" height="160" title="logo de l'entreprise">
</header>
<section name="bloc_acteur">
<h1>Les partenaires</h1>
<?php if (!empty($_GET[ 'id' ])) {
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
    $reqSql = 'SELECT p.post, p.date_add, a.acteur, ac.username  FROM post p INNER JOIN acteur a ON a.id_acteur = p.id_acteur INNER JOIN account ac ON ac.id_user = p.id_user WHERE p.id_acteur = :id_acteur';
    $requete = $db->prepare($reqSql);
    $requete->execute(['id_acteur' => $_GET['id']]);
    $listePost = $requete->fetchAll();
    foreach ($listePost as $post) 
    {
        $date = new \DateTime($post['date_add']);
        $date = $date->format('d/m/Y H\hi');
        echo $date;
        echo $post['acteur'];
        echo $post['username'];
    }

    
   // var_dump($Post);
   // if (!empty($Post)) {


//    }
//}

   }}?>
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

</section>
<footer>
<article class="contact">
<h3>Contact</h3>
<ul>
    <li><p>Adresse: .......</p></li>
    <li><p>Téléphone:......</p></li>
    <li><p>E-mail:.........</p></li>
</ul>
</article>
	
<article class="bouton_reseaux">
<h3>Nos réseaux</h3>
<ul>
    <li><a href="https://twitter.com/share">Tweeter</a></li>
    <li><a href="mailto:jlnko@hotmail.fr">Contactez-moi</a></li>
    <li><a href="https://facebook.com/share">Facebook</a></li>
</ul>
</article>
	
<h4 class="copyright">Copyright: GBAF Année 2022</h4>
</footer>
</body>
</html>
