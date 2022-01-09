<?php 
if(!session_id()){session_start();}
if(isset($_POST['deconnecter'])){ session_destroy(); unset($_SESSION['loggedUser']);}
include '../connectionBD.php'; 
?>

<?php header('Location: ../../index.php'); ?>

<?php 
extract($_POST);
if(isset($id)): ?>

<?php 

$q = $db->prepare("DELETE FROM rdv WHERE id_RDV = :id");
$q->execute([':id'=> $id]);
?>

<?php endif; ?>