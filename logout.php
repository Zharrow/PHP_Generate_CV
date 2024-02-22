<?php
// Démarrer la session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
// Détruire toutes les variables de session.
$_SESSION = array();

// Si vous voulez détruire complètement la session, supprimez également le cookie de session.
// Note : Cela détruira la session et pas seulement les données de session !
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Finalement, détruire la session.
session_destroy();

// Rediriger vers la page de connexion/accueil
header("Location: index.php");
exit;
?>