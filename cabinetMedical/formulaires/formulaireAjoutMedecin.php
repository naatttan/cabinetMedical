<h1> Ajout Medecin </h1>
<form method="post" action="../gestionMedecins/scriptAjoutMedecin.php" class='boxUsager'>
    <select name="ccivilite_medecin" class="login">
        <option value="Monsieur" >Monsieur</options>
        <option value="Madame" >Madame</options>
    </select><br/>
	<p>Nom : <input class="login" type="text" name="cnom_medecin" id="cnomMedecin" placeholder="Nom" required><br/></p>
    <p>Prenom : <input class="login" type="text" name="cprenom_medecin" id="cprenomMedecin" placeholder="Prenom" required><br/></p>
    

	<input class="btn" type="submit" name="enregistrerMedecinBtn" id="enregistrerMedecin" value="Enregistrer" ><br/>
</form>