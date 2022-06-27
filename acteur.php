<?php session_start(); ?>
<?php 
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
?>
<?php include('connexion_bdd.php'); ?>

<!DOCTYPE html>
<html>

<head>
		<meta charset="utf-8" />
		<link rel="stylesheet" href="style.css">
		<title>Acteur</title>
</head>

<body>
	<?php include('en_tete.php'); ?>
	
	<h2>Les partenaires</h2>
	<?php 
		if (isset($_GET['id'])) 
		{	
			$requeteSQL = "SELECT * FROM acteur WHERE id_acteur = :id";
			$requete = $db->prepare($requeteSQL);
			$acteurselect = $requete->execute(['id' => $_GET['id']]);
			$acteur = $requete->fetch();
		
			if (empty($acteur)); }?>
				<img class="logo_acteur" src="img/<?php echo $acteur['logo']; ?>"></br>
			
				<div class='nom_acteur2'>
				<?php			
				echo $acteur['acteur'];?></br>
				</div>

				<div class='description'>
				<?php
				echo $acteur['description'];?>
				</div>
			</br>
		<a href="like_dislike.php?vote=1 & id<?php echo $_GET['id']; ?> & user=<?php echo $_SESSION['username']; ?>">Like</a>	
	</br>
		<a href="like_dislike.php?vote=0 & id<?php echo $_GET['id']; ?> & user=<?php echo $_SESSION['username']; ?>">Dislike</a>	
		
		

</body>

</html>