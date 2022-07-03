<?php if (!isset($_SESSION['id'])) {
    header('Location: login.php'); }
    else {
        session_start();
    }?>

<?php    if (isset($_POST['deconnexion'])) {
        session_destroy();
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <title>projet3</title>
    <link rel='stylesheet' type='text/css' media='screen' href='style.css'>
</head>
<body>
   
    <button name="deconnexion">Deconnexion</button>
    
</body>
</html>