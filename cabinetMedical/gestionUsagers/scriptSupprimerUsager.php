<?php 
if(!session_id()){session_start();}
if(isset($_POST['deconnecter'])){ session_destroy(); unset($_SESSION['loggedUser']);}
include '../connectionBD.php'; 
?>

<?php header('Location: ../../gestionUsagers.php'); ?>

<?php 
extract($_POST);
if(isset($id)): ?>

<?php 

$q = $db->prepare("DELETE FROM usager WHERE id_usager = :id");
$q->execute([':id'=> $id]);
?>

<?php endif; ?>