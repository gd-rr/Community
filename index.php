<?php

    // index.php fait office de controleur frontal
    session_start(); // démarre ou reprend une session
    ini_set('display_errors', 1); // affiche les erreurs (au cas où)
    ini_set('display_startup_errors', 1); // affiche les erreurs (au cas où)
    error_reporting(E_ALL); // affiche les erreurs (au cas où)
    require('inc/routes.php'); // fichiers de routes
    require('inc/includes.php'); // inclut des informations du site (nom, slogan)
    require('inc/config-bd.php'); // fichier de configuration d'accès à la BD
    require_once('modele/modele.php'); // inclut le fichier modele

    $connexion = getConnexionBD(); // connexion à la BD (fonction dans modele car utilise mysqli)

?>

<!DOCTYPE html>
 <html>
 <head>
    <meta charset="utf-8" />
    <!-- le titre du document, qui apparait dans l'onglet du navigateur $nomSite dans includes.php-->
    <title><?= $nomSite ?></title>
    <!-- lie le style CSS externe -->
    <link href="<?= $styleCSS ?>" rel="stylesheet" media="all" type="text/css">
    <!-- ajoute une image favicon (dans l'onglet du navigateur) -->
    <link rel="shortcut icon" type="image/x-icon" href="img/LogoCom.png" />
</head>
<body>
<?php include($pathHeader); ?>
    <div id="divCentral">
        <?php include($pathMenu); ?>
        <main>
            <?php
                $controleur = $controleurAccueil; // par défaut, on charge la page d'accueil
                $vue = $vueAccueil; // par défaut, on charge la page d'accueil
                if(isset($_GET['page'])) {
                    $nomPage = $_GET['page'];
                    if(isset($routes[$nomPage])) { // si la page existe dans le tableau des routes, on la charge
                        $controleur = $routes[$nomPage]['controleur'];
                        $vue = $routes[$nomPage]['vue'];
                    }
                }
                include('controleurs/' . $controleur . '.php');
                include('vues/' . $vue .  '.php');
            ?>
        </main>
    </div>

    <?php include($pathFooter); ?>
</body>
</html>