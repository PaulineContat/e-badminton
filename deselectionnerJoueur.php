<?php
	include ('connexion.php');

	$num_licence = $_GET['num_licence'];
	$id_rencontre = $_GET['id_rencontre'];

	//unset($titulaires[array_search($num_licence, $titulaires)]);

	$suppr = $linkpdo->prepare('DELETE FROM participer WHERE num_licence = :num_licence AND id_rencontre = :id_rencontre');
	$suppr->bindValue('num_licence', $num_licence, PDO::PARAM_INT);
	$suppr->bindValue('id_rencontre', $id_rencontre, PDO::PARAM_INT);
	$suppr->execute();
	
	header("Location: administrerJoueursDUnMatch.php?id_rencontre=$id_rencontre");
?>