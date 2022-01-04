<?php
$q = $db->prepare("Select * FROM usager WHERE id_usager = :id");
$q->execute([':id'=> $id_usager1]);
$usager = $q->fetch(PDO::FETCH_ASSOC);
extract($usager);
print_r($usager);

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

<h1> Rendez vous pour <?php echo $civilite_usager, ' ', $nom_usager, ' ', $prenom_usager; ?> </h1>

<form method="post" action="../gestionUsagers/scriptCreerRdv.php" class='boxUsager'>

    <p>Medecin <select name="cmedecin_rdv" class="login">
        <?php if($medecinReferent_usager != 0){
            echo '<option value="'.$medecinReferent_usager.'" >'.searchForId($medecinReferent_usager, $medecins)['nom_medecin'].'</options>';
        } ?>
        <?php foreach($medecins as $medecinC){
                $id_medecin = $medecinC['id_medecin'];
                echo '<option value="'.$id_medecin.'" >'.$medecinC['nom_medecin'].'</option>';
        }  
        ?>
    </select></p>

	<p>Date <input class="login" type="date" name="cdate_rdv" id="cdateRdv" placeholder="Date" required ><br/></p>
    <p>Heure <input  class="login" type="time" name="cheure_rdv" id="cheureRdv" placeholder="Heure" required><br/></p>
    <p>Durée <input class="login" type="number" name="cduree_rdv" id="cdureeRdv" placeholder="Duree" value="15" min="0"  required><br/></p>
   <!-- <p>Objet <input class="login" type="textarea" cols="40" rows="5" name="cobjet_rdv" id="cobjetRdv" placeholder="Objet" required><br/></p> -->
    <p>Objet <textarea cols="40" rows="5" name="cobjet_rdv" placeholder="Objet du rendez-vous" required></textarea></p> <br>
    <input type = "hidden" name="cusager_rdv" <?php echo 'value="'.$id_usager1.'"' ?>>


	<input class="btn" type="submit" name="enregistrerRdvBtn" id="enregistrerRdv" value="Enregistrer" ><br/>
</form>
