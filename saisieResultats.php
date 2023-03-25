<!DOCTYPE HTML>
<html>
<head>
	<title>Saisir des résultats</title>
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

<?php
include('connexion.php');

if(!empty($_GET)){

	$id=$_GET['id'];
	$res = $linkpdo->prepare('SELECT * FROM rencontre WHERE id_rencontre=:id');
	$res->execute(array('id'=>$id));
	$data = $res->fetch(PDO::FETCH_ASSOC);
	
	$score_equipe = $data['score_equipe'];
	$score_equipe_adverse = $data['score_equipe_adverse'];

} elseif(!empty($_POST)) {

	echo("post pas empty");
	$id=$_POST['id'];
	$score_equipe=$_POST['score_equipe'];
	$score_equipe_adverse=$_POST['score_equipe_adverse'];

	$requete = $linkpdo->prepare('UPDATE rencontre SET score_equipe = :score_equipe, score_equipe_adverse = :score_equipe_adverse WHERE id_rencontre = :id');
	$requete->bindValue('score_equipe', $score_equipe, PDO::PARAM_INT);
	$requete->bindValue('score_equipe_adverse', $score_equipe_adverse, PDO::PARAM_INT);
	$requete->bindValue('id', $id, PDO::PARAM_INT);

	$requete->execute();

	if(isset($_POST['submit'])){
		header('Location: administrerMatchs.php');
	}
}
?>

<form action='saisieResultats.php' method='post'>

	<input type="hidden" name="id" value="<?php echo $id;?>">

	<label><b>Entrez le score de votre équipe</b></label>
	<input type='number' name='score_equipe' value='<?php echo $score_equipe; ?>' min="0" max="5" required><br>

	<label><b>Entrez le score de l'équipe adverse</b></label>
	<input type='number' name='score_equipe_adverse' value='<?php echo $score_equipe_adverse; ?>' min="0" max="5" required><br>

	<button type="submit" name ="submit">Enregistrer</button>

</form>
</body>
</html>