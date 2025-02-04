<!-- nombre d'instances de 3 tables ( a completer ici une seule ???)-->
<h2>Rechercher le nombre d'instances</h2>

<form method="post" action="#">
<label for="nomTable">Nom de la Table : </label>
	<input type="text" name="nomTable" id="nomTable" placeholder="CITOYEN" required />
	<br/><br/>
	<input type="submit" name="boutonValider" value="Statistique"/>
</form>

<p><?= $messageNbInstances ?> </br></p>

<!-- liste de chaque enfants et de son ecole actuelle-->
<h2>Liste de chaque enfants et de son école actuelle :</h2>

<p><?= $messageEnfantEcole ?> </p>
<ul>
<?php foreach($enfantEcole as $enfantEcole) { ?>
	<li><?= $enfantEcole['nomE'] ?> <?= $enfantEcole['prenomE'] ?> est scolarisé.e dans l'établissement : <?= $enfantEcole['nomL'] ?></li>
<?php } ?>
</ul>

<!-- liste de chaque enfants et de sa cantine le 01-01-2024-->
<h2>Liste de chaque enfants et de sa cantine le 01-01-2024 :</h2>

<p><?= $messageEnfantCantine ?> </p>
<ul>
<?php foreach($enfantCantine as $enfantCantine) { ?>
	<li><?= $enfantCantine['nomE'] ?> <?= $enfantCantine['prenomE'] ?> mange dans l'établissement : <?= $enfantCantine['nomCA'] ?></li>
<?php } ?>
</ul>


<!-- Paires d'enfant de même nom et prenom mais ecole differentes A MODIFIER-->
<h2>Liste de paires d'enfants mais avec une école différentes:</h2>

<p><?= $messageEnfantCantine ?> </p>
<ul>
<?php foreach($pairesEnfants as $pairesEnfants) { ?>
	<li><?= $pairesEnfants['nom1'] ?> <?= $pairesEnfants['prenom1'] ?> et <?= $pairesEnfants['nom2'] ?> <?= $pairesEnfants['prenom2'] ?> forment une paire d'enfants.</li>
<?php } ?>
</ul>

<!-- Top 3 departement avec le plus de commune -->
<h2>Liste des trois premiers départements ayant le plus de communes :</h2>

<p><?= $messageTop3Dep ?> </p>
<ul>
<?php foreach($top3Dep as $top3Dep) { ?>
	<li>Le département <?= $top3Dep['nomD'] ?> compte <?= $top3Dep['nombres_communes'] ?> communes dans la base de donnée.</li>
<?php } ?>
</ul>

<!-- Top 3 services les plus demandes par les citoyens A MODIFIER
<h2>Liste des trois premiers services les plus demandées par les citoyens :</h2>

<p><?= $messageTop3Dem ?> </p>
<ul>
<?php for ($i = 1; $i <= 3; $i++) {
		foreach($arrayTop3Dem as &$top3Dep) { ?>
			<li>Le service <?= $top3Dem['libelle'] ?> contient <?= $top3Dem['nombres_communes'] ?> demandes dans la base de donnée.</li>
<?php 	} 
	} ?>
</ul>
-->


<!-- Top 3 services les plus propose par les communes A MODIFIER 
<h2>Liste des trois premiers services les plus proposées par les communes:</h2>

<p><?= $messageTop3Prop ?> </p>
<ul>
<?php foreach($top3Dem as $top3Dem) { ?>
	<li>Le service <?= $top3Dem['libelle'] ?> compte <?= $top3Dem['nombres_demandes'] ?> demandes dans la base de donnée.</li>
<?php } ?>
</ul>
-->

 <!--Top 3 communes realisant le plus d'union -->
<h2>Liste des trois premières communes réalisant le plus d'union :</h2>

<p><?= $messageTop3Union ?> </p>
<ul>
<?php foreach($top3Union as $top3Union) { ?>
	<li>Le service <?= $top3Union['libelle'] ?> a réalisé <?= $top3Union['nombres_union'] ?> unions inscrites dans la base de donnée.</li>
<?php } ?>
</ul>



