<?php 
if(!session_id()){session_start();}
if(isset($_POST['deconnecter'])){ session_destroy(); unset($_SESSION['loggedusager']);}
include 'cabinetMedical/connectionBD.php'; 
?>


<!DOCTYPE html>
	<html>
   		 <head>
        		<meta charset="utf-8" />
				<link rel="stylesheet" href="css/stylesheet.css" />
        		<title>Statistique</title>
   		 </head>
			
   		 <body>
				
        <?php if(isset($_SESSION['loggedUser'])): ?>

            <?php include('cabinetMedical/header.php') ?>

				<table class="customers">
            <caption>
                <strong>Statistiques des usagers</strong>
            </caption>
            <thead>
                <tr>
                    <th>Tranche d'âge</th>
                    <th>Nombre d'hommes</th>
                    <th>Nombre de femmes</th>
                </tr>
            </thead> 
			<tbody>
				<tr>
                    <td>Moins de 25 ans</td>
					<td><?php
					$resultmoins25ansH = $db->query("SELECT COUNT(*) as Moins25F FROM usager WHERE DATEDIFF(NOW(), dateNaissance_usager) < 25*365.25 AND civilite_usager = 'Monsieur'");
					$nbmoinsM=$resultmoins25ansH->fetchColumn(); 
                    echo $nbmoinsM;
					?></td>
					<td><?php
					$resultmoins25ansF = $db->query("SELECT COUNT(*) as Moins25F FROM usager WHERE DATEDIFF(NOW(), dateNaissance_usager) < 25*365.25 AND civilite_usager = 'Madame'");
					$nbmoinsF=$resultmoins25ansF->fetchColumn(); 
                    echo $nbmoinsF;
					?>
					</td>
                </tr>
				<tr>
                    <td>Entre 25 et 50 ans</td>
					<td>
					<?php
					$resulentreH = $db->query("SELECT COUNT(*) as Moins25F FROM usager WHERE DATEDIFF(NOW(), dateNaissance_usager)  > 25*365.25 AND DATEDIFF(NOW(), dateNaissance_usager) < 50*365.25 AND civilite_usager = 'Monsieur'");
					$nbentreH=$resulentreH->fetchColumn(); 
                    echo $nbentreH;
					?></td>
					<td>
					<?php
					$resulentreF = $db->query("SELECT COUNT(*) as Moins25F FROM usager WHERE DATEDIFF(NOW(), dateNaissance_usager)  > 25*365.25 AND DATEDIFF(NOW(), dateNaissance_usager) < 50*365.25 AND civilite_usager = 'Madame'");
					$nbentreF=$resulentreF->fetchColumn(); 
                    echo $nbentreF;
					?></td>
                </tr>
				<tr>
                    <td>Plus de 50 ans</td>
					<td><?php
					$resultPlus25ansH = $db->query("SELECT COUNT(*) as Moins25F FROM usager WHERE DATEDIFF(NOW(), dateNaissance_usager) > 50*365.25 AND civilite_usager = 'Monsieur'");
					$nbmplusM=$resultPlus25ansH->fetchColumn(); 
                    echo $nbmplusM;
					?></td>
					<td><?php
					$resultPlus25ansF = $db->query("SELECT COUNT(*) as Moins25F FROM usager WHERE DATEDIFF(NOW(), dateNaissance_usager) > 50*365.25 AND civilite_usager = 'Madame'");
					$nbmplusF=$resultPlus25ansF->fetchColumn(); 
                    echo $nbmplusF;
					?>
					</td>
                </tr>
			</tbody>
		</table>

        <br/><br/>

        <table class="customers">
            <caption>
                <strong>Statistiques des medecins </strong>
            </caption>
            <thead>
                <tr>
                    <th>Nom medecin</th>
					<th>Prenom medecin</th>
                    <th>Nombre heure effectuer</th>
   
                </tr>
			</thead>
			<tbody>
				<?php 
					$resNomDr2 = $db->query("SELECT * FROM medecin ORDER By id_medecin");
					while($resultat = $resNomDr2->fetch()){
				?>
				<tr>
					<td>
						<?php 
							echo $resultat['nom_medecin'];
						?>
					</td>
					<td>
						<?php
							echo $resultat['prenom_medecin'];
						?>
					</td>
					<td>
						<?php
							$nombreheure=0;
							$idMedecinForeign=$resultat['id_medecin'];
							$resultatrequete=$db->prepare("SELECT SUM(duree_RDV) as NB FROM rdv WHERE medecin_RDV=:id");
							$resultatrequete -> bindParam(':id',$idMedecinForeign);
							$resultatrequete-> execute();
							$sauvegarde=$resultatrequete->fetch();
							echo $sauvegarde['NB']/3600;
						}
						?>
					</td>
				</tr>
			</tbody>

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