<?php 
if(!session_id()){session_start();}
if(isset($_POST['deconnecter'])){ session_destroy(); unset($_SESSION['loggedUser']);}
include '../connectionBD.php'; 
?>



<?php 
extract($_POST);
print_r($_POST);
echo($id_medecin);
echo($cnom_medecin);
echo 'wewwww';
if(isset($enregistrerMedecinBtn)): ?>

<?php 


try{
$q = $db->prepare("UPDATE medecin 
            SET nom_medecin = :nom_medecin, 
                prenom_medecin = :prenom_medecin, 
                civilite_medecin = :civilite_medecin
            WHERE medecin.id_medecin = :id_medecin ; ");


$q->execute([':nom_medecin'=> $cnom_medecin,
            ':prenom_medecin'=> $cprenom_medecin,
            ':civilite_medecin' => $ccivilite_medecin,
            ':id_medecin' => $_POST['id_medecin']]);
}catch(PDOException $e){
    die("erreur");
}
?>


<?php header('Location: ../../gestionMedecins.php') ?>
<?php endif; ?>