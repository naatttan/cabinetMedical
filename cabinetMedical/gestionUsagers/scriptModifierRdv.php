<?php 
if(!session_id()){session_start();}
if(isset($_POST['deconnecter'])){ session_destroy(); unset($_SESSION['loggedUser']);}
include '../connectionBD.php'; 
?>



<?php 
extract($_POST);
print_r($_POST);
if(isset($enregistrerRdvBtn)): ?>

<?php 




try{
$q = $db->prepare("UPDATE rdv 
            SET date_RDV = :date_RDV, 
                heure_RDV = :heure_RDV, 
                duree_RDV = :duree_RDV, 
                objet_RDV = :objet_RDV, 
                medecin_RDV = :medecin_rdv, 
                usager_RDV = :usager_rdv 
            WHERE rdv.id_RDV = :id_rdv ; ");


$q->execute([':date_RDV'=> $cdate_rdv,
            ':heure_RDV'=> $cheure_rdv,
            ':duree_RDV'=> $cduree_rdv,
            ':objet_RDV'=> $cobjet_rdv,
            ':medecin_rdv'=> intval($cmedecin_rdv),
            ':usager_rdv'=> intval($cusager_rdv),
            ':id_rdv'=> $_POST['idRdv'] ]);

}catch(PDOException $e){
    die($e);
}
?>


<?php header('Location: ../../index.php') ?>
<?php endif; ?>