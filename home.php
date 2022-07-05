<?php session_start();
include( 'connexion_bdd.php' );
if (!empty($_SESSION)) {
    echo $_SESSION['nom'];
    echo $_SESSION['prenom']; 
    
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
<div class=container>    
<header>
	<img class="logo_gbaf" src="img/logo.png" alt="logo couleur de la société" width="160" height="160" title="logo de l'entreprise">
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

<div class = 'partenaire'>
<h2>Présentation des partenaires</h2>
<?php
$requete = $db->prepare( 'SELECT * FROM acteur' );
$requete->execute();
$listeActeurs = $requete->fetchAll();

foreach ( $listeActeurs as $acteur )
{
    ?>
    <div>
    <div class='logo'>
    <img src = "img/<?php echo $acteur['logo']; ?>" width=200px height=200px>
    </div>
    <h3><?php echo $acteur[ 'acteur' ]; ?></h3>
    <div class = 'descritpion'>
    <?php $description = substr( $acteur[ 'description' ], 0, 100 ).'...';
    echo $description;
    ?>
    <a href = "acteur.php?id=<?php echo $acteur['id_acteur'];?> & nom=<?php echo $acteur['acteur'];?>">Lire la suite</a> 
    </div>
    </div>
    <?php
    
}
?>
</div>
<div class="deconnexion">
<a name="deconnexion" href = "deconnexion.php">Se déconnecter</a>
</div>
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

</div>
</body>
</html>