<?php session_start();  
	//on se connecte a la BDD 
	include('connexion_bdd.php');
	//on check qu_un utilisateur est connecte et que les variable existe et ne sont pas null
	if (!empty($_GET['vote']) && !empty($_SESSION['username']) && !empty($_GET['acteurId'])) {
		//on protege nos variables
		$id_acteur = $_GET['acteurId'];
		$userConnect = $_SESSION['username'];
		$likeDislike = $_GET['vote'];

		//recuperer le iduser

		//on verifie si lid acteur et lid user on deja un vote
		$requete = $db->prepare('SELECT * FROM vote WHERE id_acteur = ?, id_user = ?');
		$requete->execute(array($id_acteur, $userConnect));
		$voteExist = $requete->rowCount();
		//si le vote n'existe pas
		if ($voteExist == 0){
			if ($likeDislike == 1 || $likeDislike == 0)  {
				$like = $db->prepare('INSERT INTO vote(id_user,id_acteur,vote) VALUES (:iduser, :id_acteur, :likeDislike)');
				$like->execute(array('iduser' => $userConnect,'id_acteur' => $id_acteur,'likeDislike' => $likeDislike));
			
			}
			
			header('Location: acteur.php');

		} else {
			//verifier que son vote est different de celui dans la bdd si il est different on le met à jour

		}
		
	}?>
	 
	
	
	 
