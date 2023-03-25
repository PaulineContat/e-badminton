
<!DOCTYPE HTML>
<html>
<head>
	<title>Administrer les matchs</title>
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
	<br><br>
	
<a href="ajoutRencontreLieu.php" class = "bouton"> Ajouter un match </a> <br><br><h1>Les matchs passés ou à venir :</h1><br>	

	<table class="tftable" border="1" style="width:100%">
		<tr>
			<th>Date</th>
			<th>Lieu</th> 
			<th>Equipe Adverse</th> 
			<th>Joueurs</th>
			<th>Résultats</th>
			<th>Actions</th>
		</tr>

		<?php
	//if(isset($username)){
		include ('connexion.php');
		$dateActuelle = date("Y-m-d H:i:s");
		function getJoueurs($id){
			include ('connexion.php');
			$requete = $linkpdo->query("SELECT nom, prenom FROM joueur, participer WHERE joueur.num_licence = participer.num_licence AND participer.id_rencontre = '".$id."'");
			$joueurs=[];
			while ($joueur = $requete->fetch()) {
				$joueurs[] = $joueur[0]." ".$joueur[1];
			}
			return $joueurs;
		}

		function getResultats($id){
			include ('connexion.php');
			$requete = $linkpdo->query("SELECT score_equipe, score_equipe_adverse FROM rencontre, participer WHERE rencontre.id_rencontre = '".$id."'");
			$resultats=[];
			while ($score = $requete->fetch()) {
				$resultats[] = $score[0].":".$score[1];
				break;
			}
			return $resultats;
		}

		$requete = $linkpdo->query('SELECT * FROM rencontre');

		while ($rencontre = $requete->fetch()) { 
			?>
			<tr>
				<td>	<?php
				echo $rencontre[4];
				?>

			</td>
			<td>	<?php 
			if ($rencontre[1]=='o'){
				echo "Domicile";
			} else {
				echo $rencontre[2].$rencontre[3];
			}
			?>

		</td>
		<td> 	<?php 
		echo $rencontre["equipe_adverse"];
		?>
	</td>
	<td> 	<?php 
	$joueurs = getJoueurs($rencontre[0]);
	foreach ($joueurs as $joueur) {
		echo $joueur;
		?> 
		<br/>
		<?php
	}
	?>
</td>
<td>
	<?php 
		$resultats = getResultats($rencontre[0]);
		foreach ($resultats as $resultat) {
			$resultat = explode(':', $resultat);
			$equipe = $resultat[0];
			$equipe_adverse = $resultat[1];
			?> 
			<span style="font-weight:bold">Equipe:</span> <?php echo $equipe; ?> <br>
			<span style="font-weight:bold">Equipe Adverse:</span> <?php echo $equipe_adverse; ?>
			<?php
		}
	?>
</td>

<td class = "actions"> 	
	<a href="modifierRencontreLieu.php?id=<?php echo $rencontre[0]?>" class = "bouton"> Modifier </a> <br><br>
	<a href="supprimerRencontre.php?id=<?php echo $rencontre[0]?>" class = "bouton"> Supprimer </a> <br><br>
	<a href="administrerJoueursDUnMatch.php?id_rencontre=<?php echo $rencontre[0]?>" class = "bouton"> Administrer les joueurs </a> <br><br>
	
 

<?php if ($dateActuelle > $rencontre[4]) {
    echo '<a href="saisieResultats.php?id='.$rencontre[0].'&score_equipe='.$rencontre['score_equipe'].'&score_equipe_adverse='.$rencontre['score_equipe_adverse'].'" class="bouton">Ajouter ou modifier les résultats du match</a><br>';
} else {
    echo "Vous ne pouvez pas encore noter ce match";
} ?>


	
</td>
</tr>
<?php 
}
$requete->closeCursor();   
?>

</table>
</body>
</html>