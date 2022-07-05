<?php session_start();
include( 'connexion_bdd.php' );
if (!empty($_SESSION)) {
    echo $_SESSION['nom'];
    echo $_SESSION['prenom']; 
    echo $_SESSION['id'];
    echo "vous êtes bien connecté.";   
} else {
    header('Location: login.php');
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

<div class = 'presentation'>
<h1>GBAF</h1>
<h3>Présentation de GBAF</h3>
<p>
Le GBAF est le représentant de la profession bancaire et des assureurs sur tous les axes de la réglementation financière française. Sa mission est de promouvoir lactivité bancaire à l’échelle nationale. C’est aussi un interlocuteur privilégié des pouvoirs publics.
Aujourd’hui, il n’existe pas de base de données pour chercher ces informations de manière fiable et rapide ou pour donner son avis sur les partenaires et acteurs du secteur bancaire, tels que les associations ou les financeurs solidaires.
Pour remédier à cela, le GBAF souhaite proposer aux salariés des grands groupes français un point d’entrée unique, répertoriant un grand nombre d’informations sur les partenaires et acteurs du groupe ainsi que sur les produits et services bancaires et financiers.
Chaque salarié pourra ainsi poster un commentaire et donner son avis.
</p>
</div>

<section class = 'partenaire'>
<h3>Les partenaires</h3>
<div class = 'acteur'>
<?php
$requete = $db->prepare( 'SELECT * FROM acteur' );
$requete->execute();
$listeActeurs = $requete->fetchAll();

foreach ( $listeActeurs as $acteur )
{
    ?>
    <img class = 'logo' src = "img/<?php echo $acteur['logo']; ?>">
    <p><div class = 'nom_acteur'><?php echo $acteur[ 'acteur' ];
    ?></div></p>
    <p><div class = 'descritpion'>
    <?php
    $description = substr( $acteur[ 'description' ], 0, 100 ).'...';
    echo $description;
    ?>
    <a href = "acteur.php?id=<?php echo $acteur['id_acteur'];?> & nom=<?php echo $acteur['acteur'];?>">Lire la suite</a> </div></p>
   
    <?php
}
?>
</div>
</section>
<a name="deconnexion" href = "deconnexion.php">Se déconnecter</a>
<footer>
<?php include( 'footer.php' );?>
</footer>
</body>
</html>