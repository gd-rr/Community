<?php

$messageGen = " ";
$nbCom = 0;
$arrayMess = array();
$arrayMois = array();
$arrayServ = array();
$lengthTab = 0;
if(isset($_POST['boutonValiderPeriode'])) { // formulaire soumis
    $nomDep = $_POST['nomDep']; //recuperation valeur saisie
    $nbCom = rand(5, 20);
    $listeCom = getIDC($connexion, $nomDep, $nbCom);
    $totalPeriode = $_POST['nbMoisMax'];
    $tmpPeriode = 0;
    foreach($listeCom as $IDC) {
        $nbMoisAlea = rand(3, 6);
        $nbServiceAlea = rand(3, 5);
        $tmpPeriode = $tmpPeriode + $nbMoisAlea;
        if ($tmpPeriode <= $totalPeriode && $lengthTab < $nbCom) {
            $tmpIDC = $IDC['idC'];
            $ajout = inserePeriode($connexion, $tmpIDC, $nbMoisAlea, $nbServiceAlea);
            if ($ajout == true){
                $arrayIdc[] = $tmpIDC;
            $arrayMois[] = $nbMoisAlea;
            $arrayServ[] = $nbServiceAlea;
            $lengthTab = $lengthTab + 1;
            }
        }
        else {
            $messageGen = "Erreur : </br> - Il se peut qu'il n'y ait pas assez de communes dans la base de données. </br> - Il se peut que la période totale voulue soit depassée. </br> - Il se peut que les communes selectionnées aient déjà obtenu une période d'essai gratuite. ";
        }
    }
}
?>