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

    <div class="header">
    <nav>
        <ul class="menu">
            <li><a href="#">PAGE 1</a></li>
            <li><a href="#">PAGE 2</a></li>
            <li><a href="#">PAGE 3</a></li>
            <li><a href="#">PAGE 4</a></li>
        </ul>
    </nav>
    </div>

    <?php if(isset($_SESSION['loggedUser'])): ?>
    
        <h1>Gestion des usagers </h1>


        <?php
            $q = $db->prepare("SELECT * FROM usager;");
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
                        echo '<td>' ,'<form method="post">
                        <input class="btn2" type="submit" name="pageAccueil" id="pageAccueilBtn" value="Modifier" ><br/>
                        <input class="btn2" type="submit" name="pageAccueil" id="pageAccueilBtn" value="Supprimer" ><br/>
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
                    <form method="post" action="test.php">
						<input class="btn" type="submit" name="pageAccueil" id="pageAccueilBtn" value="Se connecter" ><br/>
					</form>
		    </div>
        <?php endif; ?>
    </body>
</html>