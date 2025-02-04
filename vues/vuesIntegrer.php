<h2>Intégrer vos communes</h2>

<form method="post" action="#">
<label for="nomR " > Nom de la région dont vous voulez intégrer les communes : </label>
<input type="text" name="nomR" id="nomR" placeholder="Auvergne-Rhône-Alpes" required />
<br/>
<br/>
<input type="submit" name="boutonIntegrer" value="Intégrer"/>
</form>

<?php if(isset($message)) { ?>
	<p style="background-color: yellow;"><?= $message ?></p>
<?php } ?>