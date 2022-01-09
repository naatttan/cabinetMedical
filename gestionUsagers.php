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
        <title>Gestion des usagers</title>
    </head>


    <body>

    <?php if(isset($_SESSION['loggedUser'])): ?>

        <?php include('cabinetMedical/header.php') ?>
    
        <h1>Gestion des usagers </h1>
        
    <div class="searchBar">
    <p>
        <form method="post">
            <input class="searchBar" type="search" name="recherche" id="recherche">
            <input class="btn" type="submit" name="rechercher" id="rechercher" value="Rechercher" >
        </form>
    </p>
    </div>    


        <?php
            $recherche = "";
            if(isset($_POST['recherche'])){
                $recherche = $_POST['recherche'];
            }
            $requete = "SELECT * FROM usager 
            WHERE nom_usager LIKE '%$recherche%' 
            OR prenom_usager LIKE '%$recherche%' 
            OR adresse_usager LIKE '%$recherche%' 
            OR ville_usager LIKE '%$recherche%';";

            $q = $db->prepare($requete);
			$q->execute();
			$usagers = $q->fetchAll(PDO::FETCH_ASSOC);
        ?>

        <?php
        $q2 = $db->prepare("SELECT medecin.id_medecin, medecin.nom_medecin FROM medecin; ");
        $q2->execute();
        $medecins = $q2->fetchAll(PDO::FETCH_ASSOC);

        function searchForId($id, $array) {
            foreach ($array as $key) {
                if ($key['id_medecin'] == $id) {
                    return $key;
                }
            }
        }

        ?>

        <div class='boxAffichage'>

            <table class="customers">

                <tr > 
                    <th><strong>Civilité</strong></th>
                    <th><strong>Nom</strong></th>
                    <th><strong>Prenom</strong></th>
                    <th><strong>Telephone</strong></th>
                    <th><strong>Adresse</strong></th>
                    <th><strong>Ville</strong></th>
                    <th><strong>Code Postal</strong></th>
                    <th><strong>Date de naissance</strong></th>
                    <th><strong>Lieu de naissance</strong></th>
                    <th><strong>Numéro de securité sociale</strong></th>                   
                    <th><strong>Medecin referent</strong></th>
                </tr>


				<?php
                    foreach($usagers as $usagerC){
                        echo '<tr>';
                            echo '<td>'.$usagerC['civilite_usager'].'</td>';
                            echo '<td>'.$usagerC['nom_usager'].'</td>';
                            echo '<td>'.$usagerC['prenom_usager'].'</td>';
                            echo '<td>'.$usagerC['telephone_usager'].'</td>';
                            echo '<td>'.$usagerC['adresse_usager'].'</td>';
                            echo '<td>'.$usagerC['ville_usager'].'</td>';
                            echo '<td>'.$usagerC['codePostal_usager'].'</td>';
                            echo '<td type="date">'.$usagerC['dateNaissance_usager'].'</td>';
                            echo '<td>'.$usagerC['lieuNaissance_usager'].'</td>';
                            echo '<td>'.$usagerC['numSecu_usager'].'</td>';
                            echo '<td>'.searchForId($usagerC['medecinReferent_usager'], $medecins)['nom_medecin'].'</td>';

                            $id = $usagerC['id_usager'];                            
                            echo '<td>' ,
                                '<form method="post" action="cabinetMedical/gestionUsagers/scriptSupprimerUsager.php"> 
                                    <button class="btn2" type="submit" name="id" value="',$id,'">Supprimer</button>
                                </form>';
                            echo '<form method="post" action="cabinetMedical/gestionUsagers/modifierUsager.php">',
                                '<button class="btn2" name="id" value="',$id,'">Modifier</button>
                                </form>';  
                            echo '<form method="post" action="cabinetMedical/gestionUsagers/creerRdv.php"> 
                                <button class="btn2" type="submit" name="id_usager1" value="',$id,'">Creer un rendez-vous</button>
                                </form>',
                                '</td>';
                        echo "</tr>";
                    }

                ?>
            </table>
		</div>

        <div class='box'>
					<form method="post" action="cabinetMedical/gestionUsagers/ajoutUsager.php">
                        <input class="btn" type="submit" name="pageAccueil" id="pageAccueilBtn" value="Ajouter un usager" ><br/>
					</form>
		</div>


        <?php else: ?>

            <div class='box'>
					<h1>Vous n'avez pas accès à cette page </h1>
                    <form method="post" action="index.php">
						<input class="btn" type="submit" name="pageAccueil" id="pageAccueilBtn" value="Se connecter" ><br/>
					</form>
		    </div>
        <?php endif; ?>
    </body>
</html>