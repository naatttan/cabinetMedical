<h1> Modifier Medecin </h1>

<?php 
if(isset($id)): ?>

<?php 

$q = $db->prepare("Select * FROM medecin WHERE id_medecin = :id");
$q->execute([':id'=> $id]);
$medecin = $q->fetch(PDO::FETCH_ASSOC);
extract($medecin);
?>

<form method="post" action="../gestionMedecins/scriptModifierMedecin.php" class='boxUsager'>
<select name="ccivilite_medecin" class="login">
        <option value="Monsieur" >Monsieur</options>
        <option value="Madame" >Madame</options>
    </select>
<p>Nom : <input class="login" type="text" name="cnom_medecin" id="cnomMedecin" placeholder="Nom" <?php echo 'value="'.$nom_medecin.'"' ?> required><br/></p>
    <p>Prenom : <input class="login" type="text" name="cprenom_medecin" id="cprenomMedecin" placeholder="Prenom" <?php echo 'value="'.$prenom_medecin.'"' ?> required><br/></p>
    
    <input type = "hidden" name="id_medecin" <?php echo 'value="'.$id.'"' ?>>

	<input class="btn" type="submit" name="enregistrerMedecinBtn" id="enregistrerMedecin" value="Enregistrer" ><br/>
</form>

<?php endif; ?>