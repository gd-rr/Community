<h2>Génerer une période d'essai</h2>

<p>
Afin de faire découvrir nos fonctionnalitées nous vous proposons des périodes d'essai pour la gestion de vos services. Grace à cela, vous pouvez affecter de nouveaux services à vos communes pendant un temps donné afin qu'elles expérimentent la gestion de ce service.
</br>
</p>

<form method="post" action="#">
    <label for="nomDep">Département à inscrire :</label>
	    <input type="text" name="nomDep" id="nomDep" placeholder="Ain" required />
	<br/><br/>
    <label for="nbMoisMax">Période totale voulue :</label>
	    <input type="number" name="nbMoisMax" id="nbMoisMax" placeholder="12" required />
	<br/><br/>
    <label for="nbKm">Distance maximale :</label>
	    <input type="number" name="nbKm" id="nbKm" placeholder="5" required />
	<br/><br/>
	<input type="submit" name="boutonValiderPeriode" value="Inscrire"/>
</form>

<ul>
<?php if(isset($_POST['boutonValiderPeriode'])) { 
for ($i = 0; $i < $lengthTab; $i++) { ?>
    <li>La commune d'identifiant <?= $arrayIdc[$i] ?>  a obtenu une période d'essai de <?= $arrayMois[$i] ?> mois avec <?= $arrayServ[$i] ?> services. </li>
<?php } } ?>
</ul>

<p><?= $messageGen ?> </p>