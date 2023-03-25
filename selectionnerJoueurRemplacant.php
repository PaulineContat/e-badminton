<?php

	include ('connexion.php');

	$num_licence = $_GET['num_licence'];
	$id_rencontre = $_GET['id_rencontre'];

	$selec = $linkpdo->prepare('INSERT INTO participer(num_licence, id_rencontre, estTitulaire) VALUES (:num_licence, :id_rencontre, 0)');
	$selec->bindValue('num_licence', $num_licence, PDO::PARAM_INT);
	$selec->bindValue('id_rencontre', $id_rencontre, PDO::PARAM_INT);
	$selec->execute();
	
	header("Location: administrerJoueursDUnMatch.php?id_rencontre=$id_rencontre");
?>