<?php
if(isset($_POST['boutonIntegrer'])) { // formulaire soumis

    //compteur a des fins d'affichages
    $nb_communes = 0;
    $nb_communes_ajoutees = 0;
    $nb_communes_deja_existante = 0;

    $nomR = $_POST['nomR'];// recuperation des valeurs saisies

	$communes = TriCommunes($connexion, $nomR); //selection des communes de Auvergne-Rhone-Alpes

	foreach ($communes as $ligne) //pour chaque commune (lignes de la requete precedente)
    {   
        $nb_communes = $nb_communes + 1; 

        $code_commune = $ligne['code_commune_INSEE'] ; //on prend le code commune 
        $verification = CommuneExistante($connexion, $code_commune); //et on regarde si elle existe deja dans la base
        foreach ($verification as $val)
            if($val['COUNT(*)'] == 0) //si elle n'existe pas encore 
		    {
                $insertion = insertCommune($connexion, $ligne); //on l'insert dans la BD
                if($insertion == TRUE) 
                {
                    $nb_communes_ajoutees = $nb_communes_ajoutees + 1;
                   // echo "La commune '". $ligne['nom_commune_complet'] ."' a été ajoutée.</br>";
                }
                else {
                    echo "Probleme lors de l'insertion de la commune '". $ligne['nom_commune_complet'] ."' </br>";
                }
            }
            else { 
                $nb_communes_deja_existante = $nb_communes_deja_existante + 1;
                //echo "La commune '". $ligne['nom_commune_complet'] ."' existe deja dans la base </br>";
            }
		
    } 
    $message = "Nombre de communes ajoutées : $nb_communes_ajoutees / $nb_communes </br> Nombre de communes déjà existantes dans la base : $nb_communes_deja_existante / $nb_communes </br>";
}

?>