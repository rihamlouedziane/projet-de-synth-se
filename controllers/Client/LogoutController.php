<?php
// Démarrer la session si ce n'est pas déjà fait
session_start();

// 1. Supprimer toutes les variables de session
$_SESSION = array();

// 2. Supprimer le cookie de session si utilisé
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}


session_destroy();


header("Location: LoginController.php");
exit();
?>
