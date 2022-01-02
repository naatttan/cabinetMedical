<h1> Modifier Usager </h1>

<?php 
if(isset($id)): ?>

<?php 

$q = $db->prepare("Select * FROM usager WHERE id_usager = :id");
$q->execute([':id'=> $id]);
$usager = $q->fetch(PDO::FETCH_ASSOC);
extract($usager);
print_r($usager);
?>

<?php
$q2 = $db->prepare("SELECT medecin.id_medecin, medecin.nom_medecin FROM medecin; ");
$q2->execute();
$medecins = $q2->fetchAll(PDO::FETCH_ASSOC);
print_r($medecins);

function searchForId($id, $array) {
    foreach ($array as $key) {
        if ($key['id_medecin'] == $id) {
            return $key;
        }
    }
 }

?>

<form method="post" action="../gestionUsagers/scriptModifierUsager.php" class='boxUsager'>

	<p>Nom : <input class="login" type="text" name="cnom_usager" id="cnomUsager" placeholder="Nom" required <?php echo 'value="'.$nom_usager.'"' ?>  ><br/></p>
    <p>Prenom : <input class="login" type="text" name="cprenom_usager" id="cprenomUsager" placeholder="Prenom" <?php echo 'value="'.$prenom_usager.'"' ?> required><br/></p>
    <p>Adresse : <input class="login" type="text" name="cadresse_usager" id="cadresse_usager" placeholder="Adresse" <?php echo 'value="'.$adresse_usager.'"' ?> required><br/></p>
    <p>Ville : <input class="login" type="text" name="cville_usager" id="cville_usager" placeholder="Ville" <?php echo 'value="'.$ville_usager.'"' ?> required><br/></p>
    <p>Code Postal : <input class="login" type="text" name="ccodePostal_usager" id="ccodePostal_usager" placeholder="Code Postal" pattern="[0-9]{5}" <?php echo 'value="'.$codePostal_usager.'"' ?> required><br/></p>
    <p>Date de naissance : <input class="login" type="date" name="cdateNaissance_usager" id="cdateNaissance_usager" placeholder="Date de naissance" <?php echo 'value="'.$dateNaissance_usager.'"' ?>><br/></p>
    <p>Lieu de naissance : <input class="login" type="text" name="clieuNaissance_usager" id="clieuNaissance_usager" placeholder="Lieu de naissance" <?php echo 'value="'.$lieuNaissance_usager.'"' ?> ><br/></p>
    <p>Numéro de sécu : <input class="login" type="text" name="cnumSecu_usager" id="cnumSecu_usager" placeholder="Numéro de sécurité sociale" pattern="[0-9]{15}" <?php echo 'value="'.$numSecu_usager.'"' ?> required><br/></p>
    <p>Téléphone : <input class="login" type="tel" name="ctelephone_usager" id="ctelephone_usager" placeholder="Numéro de téléphone" pattern="[0-9]{10}" <?php echo 'value="'.$telephone_usager.'"' ?> required><br/></p>
    <input type = "hidden" name="id_usager" <?php echo 'value="'.$id.'"' ?>>

    <select name="ccivilite_usager" class="login">
        <option value="Monsieur" >Monsieur</options>
        <option value="Madame" >Madame</options>
    </select>

    <select name="cmedecin_usager" class="login">
    <?php if($medecinReferent_usager != 0){
        echo '<option value="'.$medecinReferent_usager.'" >'.searchForId($medecinReferent_usager, $medecins)['nom_medecin'].'</options>';
    } ?>
    <option value="0" >Aucun</options>
    <?php foreach($medecins as $medecinC){
            $id_medecin = $medecinC['id_medecin'];
            echo '<option value="'.$id_medecin.'" >'.$medecinC['nom_medecin'].'</option>';
    }  
    ?>
    </select>

	<input class="btn" type="submit" name="enregistrerUserBtn" id="enregistrerUser" value="Enregistrer" ><br/>
</form>

<?php endif; ?>