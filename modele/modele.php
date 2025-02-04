<?php

// connexion à la BD, retourne un lien de connexion
function getConnexionBD() {
	$connexion = mysqli_connect(SERVEUR, UTILISATRICE, MOTDEPASSE, BDD);
	if (mysqli_connect_errno()) {
	    printf("Échec de la connexion : %s\n", mysqli_connect_error());
	    exit();
	}
	mysqli_query($connexion,'SET NAMES UTF8'); // noms en UTF8
	return $connexion;
}

// déconnexion de la BD
function deconnectBD($connexion) {
	mysqli_close($connexion);
}

//Fonctionalités Statistiques

// nombre d'instances d'une table $nomTable
function countInstances($connexion, $nomTable) {
	$requete = "SELECT COUNT(*) AS nb FROM $nomTable";
	$res = mysqli_query($connexion, $requete);
	if($res != FALSE) {
		$row = mysqli_fetch_assoc($res);
		return $row['nb'];
	}
	return -1;  // valeur négative si erreur de requête (ex, $nomTable contient une valeur qui n'est pas une table)
}

// retourne les enfants et leurs écoles 
function getEnfantEcole($connexion) {
	$requete = "SELECT DISTINCT nomE, prenomE, nomL FROM ENFANT f JOIN ECOLE e ON f.adresseEC = e.adresseEC JOIN LIEU l ON e.idl = l.idl";
	$res = mysqli_query($connexion, $requete);
	$enfantEcole = mysqli_fetch_all($res, MYSQLI_ASSOC);
	return $enfantEcole;
}

// retourne les enfants et leurs cantines
function getEnfantCantine($connexion) {
	$requete = "SELECT DISTINCT nomE, prenomE, nomCA FROM MANGE m JOIN CANTINE c ON m.adresseCA = c.adresseCA WHERE YEAR(dateFin) = '2024'";
	$res = mysqli_query($connexion, $requete);
	$enfantCantine = mysqli_fetch_all($res, MYSQLI_ASSOC);
	return $enfantCantine;
}

//retourne les paires d'enfants de meme nom et meme prenom mais ecole differentes
function getPairesEnfants($connexion) {
	$requete = "SELECT E1.nomE AS nom1, E1.PrenomE AS prenom1, E2.nomE AS nom2, E2.PrenomE AS prenom2
	FROM ENFANT E1 JOIN ENFANT E2 ON E1.nomE = E2.nomE AND E1.prenomE = E2.prenomE
	WHERE E1.adresseEC != E2.adresseEC
    GROUP BY E1.nomE";
	$res = mysqli_query($connexion, $requete);
	$pairesEnfants = mysqli_fetch_all($res, MYSQLI_ASSOC);
	return $pairesEnfants;
}


//retourne un classement des 3 dep avec le plus de commune 
function getTop3Dep($connexion){
	$requete = "SELECT nomD, COUNT(*) AS nombres_communes FROM DEPARTEMENT NATURAL JOIN COMMUNE GROUP BY code_INSEED ORDER BY nombres_communes DESC LIMIT 3 ";
	$res = mysqli_query($connexion, $requete);
	$top3Dep = mysqli_fetch_all($res, MYSQLI_ASSOC);
	return $top3Dep;
}

/*retourne le nb de demande d'une table
function getnbDemUnion($connexion){
	$requete = "SELECT libelle AS UNION_CIVILE, COUNT(*) AS nombres_demandes FROM UNION_CIVILE";
	$res = mysqli_query($connexion, $requete);
	$nbDemUnion = mysqli_fetch_all($res, MYSQLI_ASSOC);
	return $nbDemUnion;
}

function getnbDemResto($connexion){
	$requete = "SELECT libelle AS RESTAURATION, COUNT(*) AS nombres_demandes FROM RESTAURATION";
	$res = mysqli_query($connexion, $requete);
	$nbDemResto = mysqli_fetch_all($res, MYSQLI_ASSOC);
	return $nbDemResto;
}

function getnbDemSig($connexion){
	$requete = "SELECT libelle AS SIGNALEMENT, COUNT(*) AS nombres_demandes FROM SIGNALEMENT";
	$res = mysqli_query($connexion, $requete);
	$nbDemSig = mysqli_fetch_all($res, MYSQLI_ASSOC);
	return $nbDemSig;
}

function getnbDemEta($connexion){
	$requete = "SELECT libelle AS ETAT_CIVILE, COUNT(*) AS nombres_demandes FROM ETAT_CIVIL";
	$res = mysqli_query($connexion, $requete);
	$nbDemEta = mysqli_fetch_all($res, MYSQLI_ASSOC);
	return $nbDemEta;
}

function getnbDemElec($connexion){
	$requete = "SELECT libelle AS ELECTION, COUNT(*) AS nombres_demandes FROM ELECTION";
	$res = mysqli_query($connexion, $requete);
	$nbDemElec = mysqli_fetch_all($res, MYSQLI_ASSOC);
	return $nbDemElec;
}

function getnbDemSco($connexion){
	$requete = "SELECT libelle AS SCOLAIRE, COUNT(*) AS nombres_demandes FROM SCOLAIRE";
	$res = mysqli_query($connexion, $requete);
	$nbDemSco = mysqli_fetch_all($res, MYSQLI_ASSOC);
	return $nbDemSco;
}
*/

/*
//retourne un classement des 3 services les plus proposéees par les communes
function getTop3Dep($connexion){
	$requete = "SELECT nomD, COUNT(*) AS nombres_communes FROM DEPARTEMENT NATURAL JOIN COMMUNE GROUP BY code_INSEED ORDER BY nombres_communes DESC LIMIT 3 ";
	$res = mysqli_query($connexion, $requete);
	$top3Dep = mysqli_fetch_all($res, MYSQLI_ASSOC);
	return $top3Dep;
}
*/

//retourne un classement des 3 communes realisant le plsu d'union 
function getTop3Union($connexion){
	$requete = "SELECT libelle, COUNT(*) AS nombres_union FROM UNION_CIVILE GROUP BY libelle ORDER BY nombres_union DESC LIMIT 3";
	$res = mysqli_query($connexion, $requete);
	$top3Union = mysqli_fetch_all($res, MYSQLI_ASSOC);
	return $top3Union;
}

//Fonctionalites ajout service

// retourne le nombre de services du même nom pour cette commune
function ServiceExistant($connexion, $nomService, $nomC) {
	$requete = "SELECT COUNT(*) FROM COMMUNE NATURAL JOIN SERVICE WHERE libelle = '". $nomService . "' AND nomC = '". $nomC . "'";
	$res = mysqli_query($connexion, $requete);
	$services = mysqli_fetch_all($res, MYSQLI_ASSOC);
	return $services;
}

// insère un nouveau service nommée $nomService
function insertService($connexion, $nomService, $description, $periode, $tarif, $nomC) {
	$reqidC = "SELECT idC FROM COMMUNE WHERE nomC = '". $nomC . "'";
	$resreqidC = mysqli_query($connexion, $reqidC);
	foreach ($resreqidC as $ligne)
	foreach ($ligne as $idC)
	$requete = "INSERT INTO SERVICE VALUES ('". $nomService . "', '". $description . "', '". $periode . "','". $tarif . "', '". $idC . "')";
	$res = mysqli_query($connexion, $requete);
	return $res;
}

//Fonctinalites integrer communes 

// retourne les communes et leurs informations en fonction de la region choisie dans la base dataset
function TriCommunes($connexion, $nomR) {
	$requete = "SELECT * FROM dataset.Communes WHERE nom_region LIKE '". $nomR . "'";
	$res = mysqli_query($connexion, $requete);
	$communes = mysqli_fetch_all($res, MYSQLI_ASSOC);
	return $communes;
}

//retourne 0 si la commune n'existe pas dans notre base
function CommuneExistante ($connexion, $codeINSEE)
{
	//la seule donnée unique a une commune c'est son code INSEE 
	//si son code INSEE est deja dans la base alors la commune existe deja 
	$requete = "SELECT COUNT(*) FROM COMMUNE WHERE code_INSEEC = '". $codeINSEE. "'";
	$res = mysqli_query($connexion, $requete);
	$nbcommunes = mysqli_fetch_all($res, MYSQLI_ASSOC);
	return $nbcommunes;
}

//fonction pour générer l'idC suivant 
function idCsuivant ($connexion) //pour generer un nouvel idC 
{
	$req = "SELECT MAX(idC) FROM COMMUNE"; //on recupere le dernier idC (le plus grand)
	$res = mysqli_query($connexion, $req);
	$idCmax = mysqli_fetch_all($res, MYSQLI_ASSOC);
	foreach($idCmax as $idcurrent) //on accede a sa valeur 
		foreach ($idcurrent as $idsuivant)
			return $idsuivant + 1; //on retourne la valeur suivante
}

//insertion de la commune dans notres bd
function insertCommune($connexion, $ligne)
{
	$idC = idCsuivant($connexion); //on genere un idC pour notre commune
	$code_postal = $ligne['code_postal']; //on recupère ses informations 
	$nomC = str_replace("'", "-", $ligne['nom_commune_complet']);
	$codeINSEEC = $ligne['code_commune_INSEE'];
	$codeINSEED = $ligne['code_departement'];
	$latitude = $ligne['latitude'];
	$longitude = $ligne['longitude'];
	$adresse_mairie = NULL;
	//on formule la requete 
	$requete = "INSERT INTO COMMUNE VALUES ('". $idC . "', '". $code_postal . "', '". $nomC . "','". $latitude . "', '". $longitude . "', '". $codeINSEEC . "', '". $adresse_mairie . "', '". $codeINSEED . "')";
	$res = mysqli_query($connexion, $requete); //on l'insert
	return $res;
}

//Fonctionalites Periode D'essai

//retourne un nombres de communes aleatoires dans le departement fourni
function getIDC($connexion, $nomDep, $nbCom) {
	$requete = "SELECT idC FROM COMMUNE NATURAL JOIN DEPARTEMENT WHERE nomD LIKE '". $nomDep ."' LIMIT $nbCom";
	$res = mysqli_query($connexion, $requete);
	$IDC = mysqli_fetch_all($res, MYSQLI_ASSOC);
	return $IDC;
}

//creer une periode dessai dans la base 
function inserePeriode($connexion, $idC, $nbMois, $nbServ){
	$requete = "INSERT INTO PERIODE_ESSAI VALUES ( '". $idC ."', '". $nbMois ."', '". $nbServ ."')";
	$res = mysqli_query($connexion, $requete);
	return $res;
}
?>