<?php 
if(!session_id()){session_start();}
if(isset($_POST['deconnecter'])){ session_destroy(); unset($_SESSION['loggedUser']);}
include 'cabinetMedical/connectionBD.php'; 
?>

<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="css/stylesheet.css" />
        <title>Planning</title>
    </head>


    <body>

    <?php if(!isset($_SESSION['loggedUser'])): ?>
            <?php include 'cabinetMedical/connection.php'; ?> 
    <?php endif; ?>

    <?php if(isset($_SESSION['loggedUser'])): ?>

        <?php 
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
        <?php include('cabinetMedical/header.php') ?>
    
        <h1>Planning </h1>
        
        <form method="post" >
        <select name="recherche" class="login">
            <option value="" >Tous</options>
            <?php foreach($medecins as $medecinC){
                    $id_medecin = $medecinC['id_medecin'];
                    echo '<option value="'.$id_medecin.'" >'.$medecinC['nom_medecin'].'</option>';
            }  
            ?>
            
        </select>   
        <input class="btn" type="submit" name="rechercher" id="rechercher" value="Rechercher" >
        </form>


        <?php
            $recherche = "";
            if(isset($_POST['recherche'])){
                $recherche = $_POST['recherche'];
            }
            $requete = "SELECT * FROM rdv 
            WHERE medecin_RDV LIKE '%$recherche%'
            ORDER BY date_RDV DESC, heure_RDV DESC;";

            $q = $db->prepare($requete);
			$q->execute();
			$rdvs = $q->fetchAll(PDO::FETCH_ASSOC);
        ?>

        <div class='boxAffichage'>

            <table class="customers">

                <tr > 
                    <th><strong>Date</strong></th>
                    <th><strong>Heure</strong></th>
                    <th><strong>Duree</strong></th>
                    <th><strong>Objet</strong></th>
                    <th><strong>Medecin</strong></th>
                    <th><strong>Usager</strong></th>
                </tr>


				<?php
                    foreach($rdvs as $rdvC){
                        echo '<tr>';

                        echo '<td>',$rdvC['date_RDV'], '</td>';
                        echo '<td>',$rdvC['heure_RDV'], '</td>';
                        echo '<td>',$rdvC['duree_RDV'], '</td>';
                        echo '<td>',$rdvC['objet_RDV'], '</td>';
                        echo '<td>'.searchForIdMedecin($rdvC['medecin_RDV'], $medecins)['nom_medecin'].'</td>';
                        echo '<td>'.searchForIdUsager($rdvC['usager_RDV'], $usagers)['nom_usager'].'</td>';
                        $id = $rdvC['id_RDV'];
                        echo '<td>' ,
                            '<form method="post" action="cabinetMedical/gestionUsagers/scriptSupprimerRdv.php"> 
                                <button class="btn2" type="submit" name="id" value="',$id,'">Supprimer</button>
                            </form>';

                        echo '<form method="post" action="cabinetMedical/gestionUsagers/modifierRdv.php">',
                            '<button class="btn2" name="id" value="',$id,'">Modifier</button>
                            </form>', '</td>';  

                        echo "</tr>";
                    }

                ?>
            </table>
		</div>

        <div class='box'>
					<form method="post" action="gestionUsagers.php">
                        <input class="btn" type="submit" name="pageAccueil" id="pageAccueilBtn" value="Ajouter un RDV" ><br/>
					</form>
		</div>

        <?php endif; ?>
    </body>
</html>