<?php 
if(!session_id()){session_start();}
if(isset($_POST['deconnecter'])){ session_destroy(); unset($_SESSION['loggedUser']);}
include '../connectionBD.php'; 
?>



<?php 
extract($_POST);
print_r($_POST);
if(isset($enregistrerUserBtn)): ?>

<?php 

if(!isset($clieuNaissance_usager)){
    $clieuNaissance_usager = 'Null';
}


try{
$q = $db->prepare("UPDATE usager 
            SET nom_usager = :nom_usager, 
                prenom_usager = :prenom_usager, 
                adresse_usager = :adresse_usager, 
                ville_usager = :ville_usager, 
                codePostal_usager = :codePostal_usager, 
                dateNaissance_usager = :dateNaissance_usager, 
                lieuNaissance_usager = :lieuNaissance_usager, 
                numSecu_usager = :numSecu_usager, 
                telephone_usager = :telephone_usager,
                civilite_usager = :civilite_usager,
                medecinReferent_usager = :medecin_usager
            WHERE usager.id_usager = :id_usager ; ");


$q->execute([':nom_usager'=> $cnom_usager,
            ':prenom_usager'=> $cprenom_usager,
            ':adresse_usager'=> $cadresse_usager,
            ':ville_usager'=> $cville_usager,
            ':codePostal_usager'=> $ccodePostal_usager,
            ':dateNaissance_usager'=> $cdateNaissance_usager,
            ':lieuNaissance_usager'=> $clieuNaissance_usager,
            ':numSecu_usager'=> $cnumSecu_usager,
            ':telephone_usager'=> $ctelephone_usager,
            ':civilite_usager' => $ccivilite_usager,
            ':medecin_usager'=> intval($cmedecin_usager),
            ':id_usager' => $_POST['id_usager']]);
}catch(PDOException $e){
    die("erreur");
}
?>


<?php header('Location: ../../gestionUsagers.php') ?>
<?php endif; ?>