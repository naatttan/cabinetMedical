<?php 
if(!session_id()){session_start();}
if(isset($_POST['deconnecter'])){ session_destroy(); unset($_SESSION['loggedUser']);}
include '../connectionBD.php'; 
?>



<?php 
extract($_POST);
if(isset($enregistrerRdvBtn)): ?>

<?php 
$rdvEnCours = false;

$q = $db->prepare("SELECT * FROM rdv 
WHERE medecin_RDV = :medecinrdv");
			$q->execute([':medecinrdv'=> intval($cmedecin_rdv)]);
			$rdvs = $q->fetchAll(PDO::FETCH_ASSOC);

$dateHeureRdvC = $cdate_rdv.' '.$cheure_rdv.':00';
$timeRdvC = strtotime($dateHeureRdvC);
foreach($rdvs as $r){
    $dateHeureR = $r['date_RDV'].' '.$r['heure_RDV'].':00';
    $timeRFini = strtotime($dateHeureR) + ($r['duree_RDV']*60);  
    if(($timeRdvC < $timeRFini && $timeRdvC > strtotime($dateHeureR)-($cduree_rdv*60))){
        $rdvEnCours = true;
    }
}

if($rdvEnCours){
    //header('Location: creerRdv.php');
    echo "Le medecin que vous avez selectionné est déja en rendez vous à cet horaire";
    echo '<form method="post" action="../../gestionUsagers.php"> 
                <button type="submit">Retour</button>
                </form>';
}else{
header('Location: ../../index.php');
$q = $db->prepare("INSERT INTO rdv(date_RDV, heure_RDV, duree_RDV, objet_RDV, medecin_RDV, usager_RDV) 
VALUES (:daterdv, :heurerdv, :dureerdv, :objetrdv, :medecinrdv, :usagerrdv);");
			$q->execute([':daterdv' => $cdate_rdv,
                        ':heurerdv' => $cheure_rdv,
                        ':dureerdv' => $cduree_rdv,
                        ':objetrdv' => $cobjet_rdv,
                        ':medecinrdv'=> intval($cmedecin_rdv),
                        ':usagerrdv'=> intval($cusager_rdv) ]);
}
?>

<?php endif; ?>