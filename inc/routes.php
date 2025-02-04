<?php

/*
** Il est possible d'automatiser le routing, notamment en cherchant directement le fichier controleur et le fichier vue.
** ex, pour page=afficher : verification de l'existence des fichiers controleurs/controleurAfficher.php et vues/vueAfficher.php
** Cela impose un nommage strict des fichiers.
*/

$routes = array(
    'statistique' => array('controleur' => 'controleurStatistique', 'vue' => 'vuesStatistique'),
	'ajouter' => array('controleur' => 'controleurAjouter', 'vue' => 'vuesAjouter'),
	'integrer' => array('controleur' => 'controleurIntegrer', 'vue' => 'vuesIntegrer'),
	'generer' => array('controleur' => 'controleurGenerer', 'vue' => 'vuesGenerer') 
);


// fichiers statiques
$pathHeader = 'static/header.php';
$pathMenu = 'static/menu.php';
$pathFooter = 'static/footer.php';
$controleurAccueil = 'controleurAccueil';
$vueAccueil = 'vuesAccueil';
?>
