<?php 
if(!session_id()){session_start();}
if(isset($_POST['deconnecter'])){ session_destroy(); unset($_SESSION['loggedUser']);}
include '../connectionBD.php'; 
?>

<?php header('Location: ../../gestionUsagers.php') ?>

<?php 
extract($_POST);
print_r($_POST);
if(isset($enregistrerUserBtn)): ?>

<?php 

if(!isset($clieuNaissance_usager)){
    $clieuNaissance_usager = 'Null';
}



$q = $db->prepare("INSERT INTO usager( nom_usager, prenom_usager, adresse_usager, ville_usager, codePostal_usager, dateNaissance_usager, lieuNaissance_usager, numSecu_usager, telephone_usager, civilite_usager, medecinReferent_usager) 
VALUES (:nom_usager,:prenom_usager,:adresse_usager,:ville_usager,:codePostal_usager,:dateNaissance_usager,:lieuNaissance_usager,:numSecu_usager,:telephone_usager, :civilite_usager, :medecin_user);");
			$q->execute([':nom_usager'=> $cnom_usager,
                        ':prenom_usager'=> $cprenom_usager,
                        ':adresse_usager'=> $cadresse_usager,
                        ':ville_usager'=> $cville_usager,
                        ':codePostal_usager'=> $ccodePostal_usager,
                        ':dateNaissance_usager'=> $cdateNaissance_usager,
                        ':lieuNaissance_usager'=> $clieuNaissance_usager,
                        ':numSecu_usager'=> $cnumSecu_usager,
                        ':telephone_usager'=> $ctelephone_usager,
                        ':civilite_usager'=>$ccivilite_usager,
                        ':medecin_user'=> intval($cmedecin_usager)]);
?>

<?php endif; ?>