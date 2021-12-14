<h1> Ajout Usager </h1>
<form method="post" class='boxUsager'>

	<p>Nom : <input class="login" type="text" name="cnomUsager" id="cnomUsager" placeholder="Nom" required><br/></p>
    <p>Prenom : <input class="login" type="text" name="cprenomUsager" id="cprenomUsager" placeholder="Prenom" required><br/></p>
    <p>Adresse : <input class="login" type="text" name="cadresse_usager" id="cadresse_usager" placeholder="Adresse" required><br/></p>
    <p>Ville : <input class="login" type="text" name="cville_usager" id="cville_usager" placeholder="Ville" required><br/></p>
    <p>Code Postal : <input class="login" type="text" name="ccodePostal_usager" id="ccodePostal_usager" placeholder="Code Postal" required><br/></p>
    <p>Date de naissance : <input class="login" type="text" name="cdateNaissance_usager" id="cdateNaissance_usager" placeholder="Date de naissance" required><br/></p>
    <p>Lieu de naissance : <input class="login" type="text" name="clieuNaissance_usager" id="clieuNaissance_usager" placeholder="Lieu de naissance" ><br/></p>
    <p>Numéro de sécu : <input class="login" type="text" name="cnumSecu_usager" id="cnumSecu_usager" placeholder="Numéro de sécurité sociale" required><br/></p>
    <p>Téléphone : <input class="login" type="tel" name="ctelephone_usager" id="ctelephone_usager" placeholder="Numéro de téléphone" pattern="[0-9]{10}" required><br/></p>


	<input class="btn" type="submit" name="enregistrerUserBtn" id="enregistrerUser" value="Enregistrer" ><br/>
</form>