<?php
include ('connexion.php');

	$num_licence = $_GET['num_licence'];
	$id_rencontre = $_GET['id_rencontre'];


	$selec = $linkpdo->prepare('INSERT INTO participer(num_licence, id_rencontre, estTitulaire) VALUES (:num_licence, :id_rencontre, 1)');
	$selec->bindValue('num_licence', $num_licence, PDO::PARAM_INT);
	$selec->bindValue('id_rencontre', $id_rencontre, PDO::PARAM_INT);
	$selec->execute();

	/*$requete = $linkpdo->prepare('SELECT num_licence, nom, prenom FROM joueur WHERE num_licence = :num_licence');
	$requete->bindValue('num_licence', $num_licence, PDO::PARAM_INT);
	$requete->execute();
	$joueur = $requete->fetch(PDO::FETCH_ASSOC);*/

	//array_push($titulaires, $joueur);
	//print_r($titulaires);
	header("Location: administrerJoueursDUnMatch.php?id_rencontre=$id_rencontre");
?>