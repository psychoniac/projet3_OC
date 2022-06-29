<?php //on se connecte a la BDD 
	include('connexion_bdd.php');
	//on check qu_un utilisateur est connecte et que les variable existe et ne sont pas null
	if (!empty($_GET['t']) && !empty($_SESSION['username']) && !empty($_GET['id']))
		{
		//on protege nos variables
		$id_acteur = $_GET['id'];
		$userConnect = $_SESSION['username'];
		$likeDislike = $_GET['t'];
		//on verifie si lid acteur et lid user on deja un vote
		$requete = $db->prepare('SELECT vote FROM vote WHERE id_acteur = $id_acteur,id_user = $id_user');
		$requete->execute(array($id_acteur,$id_user));
		$voteExist = $requete->rowcount();
		//si le vote n'existe pas
		if ($voteExist == 0){
			if ($likeDislike == 1) {
				$like = $db->prepare('INSERT INTO vote(id_user,id_acteur,vote) VALUES ("$userConnect","$id_acteur","$likeDislike")');
				$like->execute(array('id_user' => '$userConnect','id_acteur' => 'id_acteur','vote' => '$likeDislike'));
			}
			elseif ($likeDislike == 0) {
				$dislike = $db->prepare('INSERT INTO vote(id_user,id_acteur,vote) VALUES ("$userConnect","$id_acteur","$likeDislike")');
				$dislike->execute(array('id_user' => '$userConnect','id_acteur' => 'id_acteur','vote' => '$likeDislike'));
			}
			header('Location: acteur.php');

		}
	}?>
	 
	
	
	 
