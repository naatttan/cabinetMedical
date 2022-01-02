<?php 
if(!session_id()){session_start();}
if(isset($_POST['deconnecter'])){ session_destroy(); unset($_SESSION['loggedUser']);}
include '../connectionBD.php'; 
?>

<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="../../css/stylesheet.css" />
        <title>Modifier Medecin</title>
    </head>

    <?php 
    extract($_POST);?>

    <body>
        <?php if(isset($_SESSION['loggedUser'])): ?>
            


        
            <?php  include('../formulaires/formulaireModifierMedecin.php'); ?>

            


            <div class='box'>
                        <form method="post" action="../../index.php">
                            <input class="btn" type="submit" name="pageAccueil" id="pageAccueilBtn" value="Accueil" ><br/>
                        </form>
            </div>
            
            

            
        <?php else: ?>

            <div class='box'>
                    <h1>Vous n'avez pas accès à cette page </h1>
                    <form method="post" action="../../index.php">
                        <input class="btn" type="submit" name="pageAccueil" id="pageAccueilBtn" value="Se connecter" ><br/>
                    </form>
            </div>
        <?php endif; ?>

    </body>
</html>