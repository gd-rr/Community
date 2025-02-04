<?php

//recuperation nb instances d'une table 
$messageNbInstances = " ";
if(isset($_POST['boutonValider'])) { // formulaire soumis
$nomTable = $_POST['nomTable']; //recuperation valeur saisie
$nb = countInstances($connexion, $nomTable);
if($nb <= 0)
    $messageNbInstances = "Aucune table nommée <strong>$nomTable</strong> n'a été trouvé dans la base de données !";
else
    $messageNbInstances = "Actuellement il y a <strong>$nb</strong> instances dans la table <strong>$nomTable</strong>.";
}

//recuperation des Enfants et des Ecoles
$messageEnfantEcole = " ";
$enfantEcole = getEnfantEcole($connexion) ;
if($enfantEcole == null || count($enfantEcole) == 0) {
	$messageEnfantEcole .= "Aucun enfant n'a été trouvée dans la base de données !";
}

//recuperation des enfants et des cantines pour le 01-01-2024
$messageEnfantCantine = " ";
$enfantCantine = getEnfantCantine($connexion) ;
if($enfantCantine == null || count($enfantCantine) == 0) {
	$messageEnfantCantine .= "Aucun enfant n'a été trouvée dans la base de données !";
}

// Paires d'enfant de même nom et prenom mais ecole differentes A MODIFIER
$messagePairesEnfants = " ";
$pairesEnfants = getPairesEnfants($connexion) ;
if($pairesEnfants == null || count($pairesEnfants) == 0) {
	$messagePairesEnfants .= "Aucune paires d'enfants n'a été trouvée dans la base de données !";
}

//Top 3 departement avec le plus de commune 
$messageTop3Dep = " ";
$top3Dep = getTop3Dep($connexion) ;
if($top3Dep== null || count($top3Dep) == 0) {
	$messageTop3Dep .= "Aucun département n'a été trouvée dans la base de données !";
}

/*Top 3 services les plus demandes par les citoyen 
$messageTop3Dem = " ";
$nbDemUnion = getnbDemUnion($connexion) ;
$nbDemResto = getnbDemResto($connexion) ;
$nbDemSig = getnbDemSig($connexion) ;
$nbDemEta = getnbDemEta($connexion) ;
$nbDemElec = getnbDemElec($connexion) ;
$nbDemSco = getnbDemSco($connexion) ;
$arrayTop3Dem = array($nbDemUnion, $nbDemResto, $nbDemSig, $nbDemEta, $nbDemElec, $nbDemSco);
$arrayTop3Dem = asort($arrayTop3Dem);

A MODIFIER
*/

/*Top 3 services les plus proposées par les communes
$messageTop3Dep = " ";
$top3Dep = getTop3Dep($connexion) ;
if($top3Dep== null || count($top3Dep) == 0) {
	$messageTop3Dep .= "Aucun.e département n'a été trouvée dans la base de données !";
}
A MODIFIER
*/

//Top 3 communes realisant le plus d'union 
$messageTop3Union= " ";
$top3Union = getTop3Union($connexion) ;
if($top3Union== null || count($top3Union) == 0) {
	$messageTop3Union .= "Aucun service d'union n'a été trouvée dans la base de données !";
}

?>

