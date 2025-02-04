<h2>Ajouter un service</h2>

<form method="post" action="#">
	<label for="nomService">Nom du service : </label>
	<input type="text" name="nomService" id="nomService" placeholder="Scolaire" required />
    <br/><br/>
    <label for="description">Description du service : </label>
	<input type="text" name="description" id="description" placeholder="Décrivez en quelques mots le service que vous voulez ajouter" required />
	<br/><br/>
    <label for="periode">Periode d'ouverture du service : </label>
	<input type="text" name="periode" id="periode" placeholder="Juin-Septembre" required />
	<br/><br/>
    <label for="tarif">Tarif du service : </label>
	<input type="text" name="tarif" id="tarif" placeholder="Gratuit" required />
	<br/><br/>
    <label for="nomC">Nom de la commune a laquelle affecter ce service : </label>
	<input type="text" name="nomC" id="nomC" placeholder="Villeurbanne" required />
	<br/>
    <br/>
	<input type="submit" name="boutonValider" value="Ajouter"/>
</form>

<?php if(isset($message)) { ?>
	<p style="background-color: yellow;"><?= $message ?></p>
<?php } ?>

