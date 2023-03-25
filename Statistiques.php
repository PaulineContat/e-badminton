<html>
<head>
	<title>Statistiques</title>
	<meta charset="utf-8">
	<!-- importer le fichier de style -->
	<link rel="stylesheet" href="menu.css" media="screen" type="text/css" />
	<link rel="stylesheet" href="AdminMatchs.css" media="screen" type="text/css" />

</head>
<body>
	<header><img src="bad.png" alt="Logo e-Badminton" style="float:left;width:50px;height:50px;">
		<h1>e-Badminton, votre gestionnaire d'équipe</h1>
	</header>
	<nav class="menu">
		<ul>
			<li><a href="principale.php">Accueil</a></li>
			<li><a href="administrerJoueurs.php">Administrer les joueurs</a></li>
			<li><a href="administrerMatchs.php">Administrer les matchs</a></li>
			<li><a href="Statistiques.php" class="active">Statistiques</a></li>
		</ul>
	</nav>
</body>
</html>

<?php

include("connexion.php");

$matchsGagnes = "SELECT COUNT(*) FROM rencontre r WHERE r.score_equipe > r.score_equipe_adverse";
$matchsPerdus = "SELECT COUNT(*) FROM rencontre r WHERE r.score_equipe < r.score_equipe_adverse";
$matchsNuls = "SELECT COUNT(*) FROM rencontre r WHERE r.score_equipe = r.score_equipe_adverse";

$resGagnes = $linkpdo->query($matchsGagnes);
$resPerdus = $linkpdo->query($matchsPerdus);
$resNuls = $linkpdo->query($matchsNuls);

$totalGagnes = $resGagnes->fetchColumn();
$totalPerdus = $resPerdus->fetchColumn();
$totalNuls = $resNuls->fetchColumn();

$totalMatchs = $totalGagnes + $totalPerdus + $totalNuls;

if ($totalMatchs != 0) {
    $pourcentGagnes = ($totalGagnes / $totalMatchs) * 100;
    $pourcentPerdus = ($totalPerdus / $totalMatchs) * 100;
    $pourcentNuls = ($totalNuls / $totalMatchs) * 100;



echo "<br>Nombre total de matchs : ".$totalMatchs."<br><br>";
echo "Nombre total de matchs gagnés: " . $totalGagnes . " (" . round($pourcentGagnes, 2) . "%)<br><br>";
echo "Nombre total de matchs perdus: " . $totalPerdus . " (" . round($pourcentPerdus, 2) . "%)<br><br>";
echo "Nombre total de matchs nuls: " . $totalNuls . " (" . round($pourcentNuls, 2) . "%)<br><br>";

$players = array();
$query = "SELECT j.num_licence, j.nom, j.prenom, j.statut, j.poste_prefere, 
                COUNT(CASE WHEN p.estTitulaire = 1 THEN 1 END) as total_titularisations,
                COUNT(CASE WHEN p.estTitulaire = 0 THEN 1 END) as total_remplacements,
                AVG(p.note) as moyenne_notes,
                SUM(CASE WHEN r.score_equipe > r.score_equipe_adverse THEN 1 ELSE 0 END) / COUNT(p.id_rencontre) * 100 as pourcentage_gagnes
            FROM joueur j 
            JOIN participer p ON p.num_licence = j.num_licence
            JOIN rencontre r ON r.id_rencontre = p.id_rencontre
            GROUP BY j.num_licence";
$stmt = $linkpdo->query($query);

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $players[] = $row;
}
?>
<table class="tftable" border="1" style="width:100%">
    <tr>
        <th>Numéro de licence</th>
        <th>Nom</th>
        <th>Prénom</th>
        <th>Statut actuel</th>
        <th>Poste préféré</th>
        <th>Titularisations</th>
        <th>Remplacements</th>
        <th>Moyenne des évaluations</th>
        <th>Pourcentage de matchs gagnés</th>
    </tr>
    <?php foreach($players as $player) { ?>
        <tr>
            <td><?php echo $player['num_licence']; ?></td>
            <td><?php echo $player['nom']; ?></td>
            <td><?php echo $player['prenom']; ?></td>
            <td><?php echo $player['statut']; ?></td>
            <td><?php echo $player['poste_prefere']; ?></td>
            <td><?php echo $player['total_titularisations']; ?></td>
            <td><?php echo $player['total_remplacements']; ?></td>
            <td><?php echo round($player['moyenne_notes'], 2); ?></td>
            <td><?php echo round($player['pourcentage_gagnes'], 2); ?>%</td>
        </tr>
    <?php } ?>
</table>
<?php } else { ?>
    <br>
    <div class="error-message">Pas de matchs</div>
<?php 
}
?>