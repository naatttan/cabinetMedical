<?php 
if(!session_id()){session_start();}
if(isset($_POST['deconnecter'])){ session_destroy(); unset($_SESSION['loggedUser']);}
include '../connectionBD.php'; 
?>

<?php header('Location: ../../gestionMedecins.php'); ?>

<?php 
extract($_POST);
if(isset($id)): ?>

<?php 

$q = $db->prepare("DELETE FROM medecin WHERE id_medecin = :id");
$q->execute([':id'=> $id]);
?>

<?php endif; ?>