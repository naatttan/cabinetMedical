<?php 
if(!session_id()){session_start();}
if(isset($_POST['deconnecter'])){ session_destroy(); unset($_SESSION['loggedUser']);}
include 'cabinetMedical/connectionBD.php'; 
?>

<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <!-- <link rel="stylesheet" href="css/stylesheet.css" /> -->
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
            <input class="btn" type="submit" name="rechercher" id="rechercher" value="R" >
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

        <div class='boxAffichage'>

            <table>

                <tr > 
                    <td>num_usager</td>
                    <td>Nom</td>
                    <td>Prenom</td>
                    <td>Adresse</td>
                    <td>Ville</td>
                    <td>Code Postal</td>
                    <td>Date de naissance</td>
                    <td>Lieu de naissance</td>
                    <td>Numéro de securité sociale</td>
                    <td>Telephone</td>
                    <td>Medecin referent</td>
                </tr>


				<?php
                    foreach($usagers as $usagerC){
                        echo '<tr>';
                        foreach($usagerC as $valeurC)
                            echo '<td>',$valeurC, '</td>';
                        $id = $usagerC['id_usager'];
                        echo '<td>' ,
                            '<form method="post" action="cabinetMedical/gestionUsagers/scriptSupprimerUsager.php"> 
                                <button class="btn2" type="submit" name="id" value="',$id,'">Supprimer</button>
                            </form>';

                        echo '<form method="post" action="cabinetMedical/gestionUsagers/modifierUsager.php">',
                            '<button class="btn2" name="id" value="',$id,'">Modifier</button>
                            </form>', '</td>';  

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


        <div class='box'>
					<form method="post" action="index.php">
						<input class="btn" type="submit" name="pageAccueil" id="pageAccueilBtn" value="Accueil" ><br/>
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