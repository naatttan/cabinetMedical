<?php
$q = $db->prepare("Select * FROM rdv WHERE id_RDV = :id");
$q->execute([':id'=> $id]);
$rdv = $q->fetch(PDO::FETCH_ASSOC);
extract($rdv);

$q2 = $db->prepare("SELECT medecin.id_medecin, medecin.nom_medecin FROM medecin; ");
$q2->execute();
$medecins = $q2->fetchAll(PDO::FETCH_ASSOC);

$q3 = $db->prepare("SELECT id_usager, nom_usager FROM usager; ");
$q3->execute();
$usagers = $q3->fetchAll(PDO::FETCH_ASSOC);

        function searchForIdMedecin($id, $array) {
            foreach ($array as $key) {
                if ($key['id_medecin'] == $id) {
                return $key;
                }
            }
        } 
        function searchForIdUsager($id, $array) {
            foreach ($array as $key) {
                if ($key['id_usager'] == $id) {
                return $key;
                }
            }
        }

?>

<h1> Modifier Rendez-vous </h1>

<form method="post" action="../gestionUsagers/scriptModifierRdv.php" class='boxUsager'>

    <p>Medecin <select name="cmedecin_rdv" class="login">
        <?php
            echo '<option value="'.$medecin_RDV.'" >'.searchForIdMedecin($medecin_RDV, $medecins)['nom_medecin'].'</options>';
        ?>
        <?php foreach($medecins as $medecinC){
                $id_medecin = $medecinC['id_medecin'];
                echo '<option value="'.$id_medecin.'" >'.$medecinC['nom_medecin'].'</option>';
        }  
        ?>
    </select></p>

    <p>Usager <select name="cusager_rdv" class="login">
        <?php
            echo '<option value="'.$usager_RDV.'" >'.searchForIdUsager($usager_RDV, $usagers)['nom_usager'].'</options>';
        ?>
        <?php foreach($usagers as $usagerC){
                echo '<option value="'.$usagerC['id_usager'].'" >'.$usagerC['nom_usager'].'</option>';
        }  
        ?>
    </select></p>

	<p>Date <input class="login" type="date" name="cdate_rdv" id="cdateRdv" placeholder="Date" <?php echo 'value="'.$date_RDV.'"' ?> required ><br/></p>
    <p>Heure <input  class="login" type="time" name="cheure_rdv" id="cheureRdv" placeholder="Heure" <?php echo 'value="'.$heure_RDV.'"' ?> required><br/></p>
    <p>Durée <input class="login" type="number" name="cduree_rdv" id="cdureeRdv" placeholder="Duree" <?php echo 'value="'.$duree_RDV.'"' ?> min="0"  required><br/></p>
   <!-- <p>Objet <input class="login" type="textarea" cols="40" rows="5" name="cobjet_rdv" id="cobjetRdv" placeholder="Objet" required><br/></p> -->
    <p>Objet <textarea cols="40" rows="5" name="cobjet_rdv"  placeholder="Objet du rendez-vous" required> <?php echo $objet_RDV ?> </textarea></p> <br>
    <input type="hidden" name="idRdv" <?php echo 'value="'.$id.'"' ?> >

	<input class="btn" type="submit" name="enregistrerRdvBtn" id="enregistrerRdv" value="Enregistrer" ><br/>
</form>
