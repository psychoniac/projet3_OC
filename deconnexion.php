<?php session_start();
include('connexion_bdd.php');
 if (!empty($_SESSION)) {
    echo $_SESSION['nom'];
    echo $_SESSION['prenom'];
    echo "vous êtes bien connecté.";
    if (isset($_POST['deconnexion'])) {
        session_destroy();
        echo "vous n'êtes plus conecté";
    } 
} else {
    header(Location: "login.php");
}?>


<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <title>Projet3</title>
    <link rel='stylesheet' href='style.css'>
</head>
<body>
<form>
<input type="submit" name="deconnexion">Deconnexion</button>
</form>
</body>
</html>