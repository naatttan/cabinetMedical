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
        <title>Ma page test</title>
    </head>


    <body>
        <h1>Accueil </h1>


        <?php if(!isset($_SESSION['loggedUser'])): ?>
            <?php include 'cabinetMedical/connection.php'; ?> 
        <?php endif; ?>



        <?php if(isset($_SESSION['loggedUser'])): ?>
				<br/>
				<br/>
				<div class='box'>
					<p>BIENVENUE <?php echo $_SESSION['loggedUser']['identifiant']; ?> </p>

					<form method="post">
						<input class="btn" type="submit" name="deconnecter" id="deconnecterBtn" value="Deconnecter" ><br/>
					</form>
				</div>

                <div class='box'>
					<form method="post" action="gestionUsagers.php">
						<input class="btn" type="submit" name="pageGestionUsagers" id="pageGestionUsagersBtn" value="Gestion des usagers" ><br/>
					</form>
				</div>
        <?php endif; ?>
	    

        

    </body>
</html>