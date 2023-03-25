<!DOCTYPE HTML>
<html>
<head>
    <title>Administrer les joueurs</title>
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
            <li><a href="administrerJoueurs.php" class="active">Administrer les joueurs</a></li>
            <li><a href="administrerMatchs.php" >Administrer les matchs</a></li>
            <li><a href="Statistiques.php">Statistiques</a></li>
        </ul>
    </nav>
</body>
</html>
<?php 

  include ('connexion.php');

?>

<br> <a href="ajoutJoueur.php" class = "bouton"> Ajouter un joueur </a> <br><br><h1>Liste des joueurs</h1><br>    


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

        $requete = $linkpdo->query('SELECT num_licence, photo, nom, prenom, taille, poids, statut, poste_prefere, commentaires FROM joueur');
        //$requete->execute();

        while ($joueurs = $requete->fetch()) { 
    ?>
        <tr>
            <td>    <?php
                echo $joueurs[0];
            ?>

        </td>
        <td>    <?php
    $img_path = $joueurs[1];
    if(file_exists($img_path)){
echo '<img src="'.$img_path.'" style="max-width: 200px; max-height: 100px;">';

    }else{
        echo "l'image n'existe pas";
    }
?>



    </td>
    <td>    <?php 
        echo $joueurs[2];
    ?>

</td>
<td>    <?php 
    echo $joueurs[3];
?>
</td>
<td>    <?php 
    echo $joueurs[4];
?>
</td>
<td>    <?php 
    echo $joueurs[5];
?>
</td>
<td>    <?php 
    echo $joueurs[6];
?>
</td>
<td>    <?php 
    echo $joueurs[7];
?>
</td>
<td>    <?php 
    echo $joueurs[8];
?>
</td>
    
    <td class = "actions">  
        <a href="modifierJoueur.php?id=<?php echo $joueurs[0]?>" class = "bouton"> Modifier </a> <br><br>
        <a href="supprimerJoueur.php?id=<?php echo $joueurs[0]?>" class = "bouton"> Supprimer </a> <br><br>
</td>
</tr>
<?php 
}
$requete->closeCursor(); 
?>
</table>
</html>