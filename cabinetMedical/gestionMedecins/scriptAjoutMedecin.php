<?php 
if(!session_id()){session_start();}
if(isset($_POST['deconnecter'])){ session_destroy(); unset($_SESSION['loggedUser']);}
include '../connectionBD.php'; 
?>

<?php header('Location: ../../gestionMedecins.php') ?>

<?php 
extract($_POST);
print_r($_POST);
if(isset($enregistrerMedecinBtn)): ?>

<?php 

$q = $db->prepare("INSERT INTO medecin(civilite_medecin, prenom_medecin, nom_medecin) 
VALUES ( :civilite_medecin , :prenom_medecin , :nom_medecin );");
			$q->execute([':civilite_medecin'=>$ccivilite_medecin,
                        ':prenom_medecin'=> $cprenom_medecin,
                        ':nom_medecin'=> $cnom_medecin]);
?>

<?php endif; ?>