<?php 

if(isset($_POST['boutonValider'])) { // formulaire soumis

	$nomService = $_POST['nomService']; // recuperation des valeurs saisies
    $description = $_POST['description'];
    $periode = $_POST['periode'];
    $tarif = $_POST['tarif'];
    $nomC = $_POST['nomC'];
	$verification = ServiceExistant($connexion, $nomService, $nomC);

	foreach ($verification as $i)
		if($i['COUNT(*)'] == 0) { // pas de service avec ce nom, insertion
			$insertion = insertService($connexion, $nomService, $description, $periode, $tarif, $nomC);
			if($insertion == TRUE) {
				$message = "Le service $nomService a bien été ajouté !";
			}
			else {
				$message = "Erreur lors de l'insertion du service $nomService.";
			}
		}
		else {
			$message = "Un service existe déjà avec ce nom ($nomService) ";
		}
	}


?>