<?php
session_start();
if (!isset($_POST['nom'])) {
    $_SESSION['error'] = "Tous les champs sont requis";
    header('Location: ../views/html/achete.php?id=' . $_POST['trottinette_id']);
    exit;
}

// Stockage en session
$_SESSION['achat'] = [
    'nom' => htmlspecialchars($_POST['nom']),
    'adresse' => htmlspecialchars($_POST['adresse']),
    'telephone' => htmlspecialchars($_POST['telephone']),
    'trottinette_id' =>  htmlspecialchars($_POST['trottinette_id']),
    'quantite' => 1 
];

header('Location:../controllers/CmdTrotionlyController.php');
exit;


require_once "../views/html/achete.php";

?>