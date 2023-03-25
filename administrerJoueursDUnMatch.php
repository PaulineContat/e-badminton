<!DOCTYPE HTML>
<html>
<head>
	<title>Administrer les joueurs d'un match</title>
	<meta charset="utf-8">
	<!-- importer le fichier de style -->
	<link rel="stylesheet" href="AdminMatchs.css" media="screen" type="text/css" />
	<link rel="stylesheet" href="menu.css" media="screen" type="text/css" />

</head>
<body>
	<header><img src="bad.png" alt="Logo e-Badminton" style="float:left;width:50px;height:50px;">
		<h1>e-Badminton, votre gestionnaire d'équipe</h1>
	</header>
	<nav class="menu">
		<ul>
			<li><a href="principale.php">Accueil</a></li>
			<li><a href="administrerJoueurs.php">Administrer les joueurs</a></li>
			<li><a href="administrerMatchs.php" class="active">Administrer les matchs</a></li>
			<li><a href="Statistiques.php">Statistiques</a></li>
		</ul>
	</nav>
	<?php 
		include ('connexion.php');

		$titulaire=array(); //variable stockant les titulaires, ne fonctionne pas
		$remplacant = array(); //variable pour stocker le joueur sélectionné en tant que remplaçant

		$id_rencontre = $_GET['id_rencontre'];
		$date = $linkpdo->prepare("SELECT date_heure FROM rencontre WHERE rencontre.id_rencontre = :id_rencontre;");
		$date->bindValue('id_rencontre', $id_rencontre, PDO::PARAM_INT);
		$date->execute();
		$date_h = $date->fetch();
		$date_rencontre = $date_h[0];
	?>
<br><h1>Choisissez les joueurs pour le match du <?php echo $date_rencontre; ?></h1><br>

<table class="tftable" border="1" style="width:100%">
	<tr>
		<th>Numéro Licence</th>
		<th>Photo</th>
		<th>Nom</th> 
		<th>Prénom</th> 
		<th>Taille</th>
		<th>Poids</th>
		<th>Statut</th>
		<th>Poste préféré</th>
		<th>Commentaires</th>
		<th>Actions</th>
	</tr>

	<?php
		$date_actuelle = date("Y-m-d");

		$requete = $linkpdo->prepare('SELECT num_licence, photo, nom, prenom, taille, poids, statut, poste_prefere, commentaires FROM joueur WHERE num_licence NOT IN (SELECT num_licence FROM participer WHERE id_rencontre = :id_rencontre) AND statut = "actif";');

		$requete->bindValue('id_rencontre', $id_rencontre, PDO::PARAM_INT);
		$requete->execute();

		while ($joueurs = $requete->fetch()) { 
	?>
		<tr>
			<td>	<?php
				echo $joueurs[0];
			?>

		</td>
		<td>	<?php
			echo $joueurs[1];
		?>

	</td>
	<td>	<?php 
		echo $joueurs[2];
	?>

</td>
<td> 	<?php 
	echo $joueurs[3];
?>
</td>
<td> 	<?php 
	echo $joueurs[4];
?>
</td>
<td> 	<?php 
	echo $joueurs[5];
?>
</td>
<td> 	<?php 
	echo $joueurs[6];
?>
</td>
<td> 	<?php 
	echo $joueurs[7];
?>
</td>
<td> 	<?php 
	echo $joueurs[8];
?>
</td>
<td>	<?php 
	if($date_rencontre>$date_actuelle) { //on vérifie si la rencontre est pas encore passée
	echo '<a class="bouton" href="selectionnerJoueurTitulaire.php?num_licence='.$joueurs[0].'&id_rencontre='.$id_rencontre.'">
	Sélectionner en tant que titulaire</a><br><br>
	<a class="bouton" href="selectionnerJoueurRemplacant.php?num_licence='.$joueurs[0].'&id_rencontre='.$id_rencontre.'">
	Sélectionner en tant que remplaçant</a><br>';
}
?>
</td>
</tr>
<?php 
}
$requete->closeCursor(); 
?>

</table><br>


<?php 
	
	/* if (empty($titulaires)) {
		echo "le tableau est vide";
	} else {
		echo "le tableau contient des éléments";
	} 
	foreach($titulaires as $titulaire){
		echo "<td>.$titulaire[0].</td>";
		echo "<td>.$titulaire[1].</td>";
		echo "<td>.$titulaire[2].</td>";
	}
	if (count($titulaires) == 2 && $remplacant != null) {
?> 
	<form action="validerSelection.php" method="post">
		<input type="submit" value="Valider la sélection">
	</form>
<?php
	}*/
?>

<table class="tftable" border="1" style="width:100%">
	<tr>
		<th>Numéro Licence</th>
		<th>Photo</th>
		<th>Nom</th> 
		<th>Prénom</th> 
		<th>Taille</th>
		<th>Poids</th>
		<th>Statut</th>
		<th>Poste préféré</th>
		<th>Commentaires</th>
		<th>Titulaire ou remplaçant</th>
		<th>Actions</th>
	</tr>

	<?php
		$requete = $linkpdo->prepare('SELECT joueur.num_licence, joueur.photo, joueur.nom, joueur.prenom, joueur.taille, joueur.poids, joueur.statut, joueur.poste_prefere, joueur.commentaires, participer.estTitulaire FROM joueur, participer WHERE joueur.num_licence = participer.num_licence AND participer.id_rencontre = :id_rencontre AND statut = "actif";');
		$requete->bindValue('id_rencontre', $id_rencontre, PDO::PARAM_INT);
		$requete->execute();

		while ($joueurs = $requete->fetch()) { ?>
		<tr>
			<td>	<?php
				echo $joueurs[0];
			?>

		</td>
		<td>	<?php
			echo $joueurs[1];
		?>

	</td>
	<td>	<?php 
		echo $joueurs[2];
	?>

</td>
<td> 	<?php 
	echo $joueurs[3];
?>
</td>
<td> 	<?php 
	echo $joueurs[4];
?>
</td>
<td> 	<?php 
	echo $joueurs[5];
?>
</td>
<td> 	<?php 
	echo $joueurs[6];
?>
</td>
<td> 	<?php 
	echo $joueurs[7];
?>
</td>
<td> 	<?php 
	echo $joueurs[8];
?>
</td>
<br>
<td> 	<?php 
	if ($joueurs[9]==1){
		echo "Titulaire";
	} else {
		echo "Remplaçant";
	}
?>
</td>
<br>
</td>
<td> 	
<?php 
	if($date_rencontre>$date_actuelle) { //on vérifie si la rencontre est pas encore passée
		echo "<a class='bouton' href='deselectionnerJoueur.php?num_licence=".$joueurs[0]."&id_rencontre=".$id_rencontre."'>Déselectionner</a><br></br>";
	}

	if($date_rencontre<$date_actuelle){ //on vérifie si la rencontre est passée
		echo "<a class='bouton' href='saisirNote.php?num_licence=".$joueurs[0]."&id_rencontre=".$id_rencontre."'>Evaluer le joueur</a><br>";
	}
?>

</td>
</tr>
<?php 
}
$requete->closeCursor();   


?>
</table>
</body>
</html>