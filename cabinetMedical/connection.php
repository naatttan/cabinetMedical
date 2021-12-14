	<?php
	//verification champs de saisie
	if(isset($_POST['formlogin']) && isset($_POST['cmdp']) && isset($_POST['cidentifiant'])):
	?>	

		<?php
		extract($_POST);

		//extraction valeurs bdd
		if(!empty($cidentifiant) && !empty($cmdp))
		{
			$q = $db->prepare("SELECT * FROM secretaire WHERE login = :identifiant ;");
			$q->execute(['identifiant' => $cidentifiant]);
			$result = $q->fetch();
		}else{
			echo"Veuillez completer l'ensemble des champs";
		}
	
		//validation
		if ( $cidentifiant === $result['login'] && $cmdp === $result['password'] && !empty($result) ) {
			$_SESSION['loggedUser'] = [
				'identifiant' => $cidentifiant
			];
		} else {
			
			echo " Vous n'avez pas l'autorisation de vous connecter";
			include('formulaires/formulaireLogin.php');
		}
		?>

<!------------------------------------------------------------------------------------------------------------->

	<?php else: ?>	
			<?php if(!isset($_SESSION['loggedUser']['identifiant'])){include('formulaires/formulaireLogin.php');} ?>		
	<?php endif; ?>

