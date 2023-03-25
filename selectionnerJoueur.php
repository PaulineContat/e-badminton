<?php
	include('connexion.php');
	$id_rencontre = $_GET('id_rencontre');
	
	$selec = $linkpdo->prepare("INSERT INTO participer(num_licence, id_rencontre, estTitulaire) VALUES :num_licence, :id_rencontre, :estTitulaire");
	$selec->execute();
	header('location:administrerJoueursDUnMatch.php?id_rencontre=$id_rencontre');
?>