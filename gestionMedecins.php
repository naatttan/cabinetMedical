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
        <title>Gestion des Medecins</title>
    </head>


    <body>

    <?php if(isset($_SESSION['loggedUser'])): ?>

        <?php include('cabinetMedical/header.php') ?>
    
        <h1>Gestion des medecins </h1>
        
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
            $requete = "SELECT * FROM medecin 
            WHERE nom_medecin LIKE '%$recherche%' 
            OR prenom_medecin LIKE '%$recherche%' ;";

            $q = $db->prepare($requete);
			$q->execute();
			$medecins = $q->fetchAll(PDO::FETCH_ASSOC);
        ?>

        <div class='boxAffichage'>

            <table class="customers">

                <tr > 
                    <th><strong>Civilite</strong></th>
                    <th><strong>Nom</strong></th>
                    <th><strong>Prenom</strong></th>
                </tr>


				<?php
                    foreach($medecins as $medecinC){
                        echo '<tr>';
                        echo '<td>',$medecinC['civilite_medecin'], '</td>';
                        echo '<td>',$medecinC['nom_medecin'], '</td>';
                        echo '<td>',$medecinC['prenom_medecin'], '</td>';
                        $id = $medecinC['id_medecin'];
                        echo '<td>' ,
                            '<form method="post" action="cabinetMedical/gestionMedecins/scriptSupprimerMedecin.php"> 
                                <button class="btn2" type="submit" name="id" value="',$id,'">Supprimer</button>
                            </form>';

                        echo '<form method="post" action="cabinetMedical/gestionMedecins/modifierMedecin.php">',
                            '<button class="btn2" name="id" value="',$id,'">Modifier</button>
                            </form>', '</td>';  

                        echo "</tr>";
                    }

                ?>
            </table>
		</div>

        <div class='box'>
					<form method="post" action="cabinetMedical/gestionMedecins/ajoutMedecin.php">
                        <input class="btn" type="submit" name="pageAccueil" id="pageAccueilBtn" value="Ajouter un Medecin" ><br/>
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