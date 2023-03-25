<!DOCTYPE HTML>
<html>
<head>
  <title>Ajouter une rencontre : autre</title>
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
  <form action="ajoutRencontreAutre.php" method="post">

  <label><b>Ville</b></label>
  <input type="text" placeholder="Entrer la ville" name="ville" required><br><br>

  <label><b>Code postal</b></label>
  <input type="text" placeholder="Entrer le code postal" name="cp" required><br><br>

  <label><b>Date et heure</b></label>
  <input type="datetime-local" name="dateHeure" required><br><br>


  <label><b>Nom de l'équipe adverse</b></label>
  <input type="text" name="equipeAd" required><br><br>

  <button type="submit" name="submit"> Enregistrer </button>

</form>
</body>
</html>


<?php

if(isset($_POST["ville"]) && isset($_POST["cp"]) && isset($_POST["dateHeure"]) && isset($_POST["equipeAd"])){

  if(!empty($_POST["ville"]) && !empty($_POST["cp"]) && !empty($_POST["dateHeure"]) && !empty($_POST["equipeAd"])){

    $domicile = 'n';
    $ville = $_POST["ville"];
    $cp = $_POST["cp"];
    $temps = $_POST["dateHeure"];
    $adversaire = $_POST["equipeAd"];

    include ('connexion.php');

    $requete = $linkpdo->prepare("INSERT INTO rencontre(domicile, ville, code_postal, date_heure, equipe_adverse) VALUES (:domicile, :ville, :cp, :temps, :adversaire)");
    $requete->bindValue('domicile', $domicile, PDO::PARAM_STR);
    $requete->bindValue('ville', $ville, PDO::PARAM_STR);
    $requete->bindValue('cp', $cp, PDO::PARAM_STR);
    $requete->bindValue('temps', $temps, PDO::PARAM_STR);
    $requete->bindValue('adversaire', $adversaire, PDO::PARAM_STR);
    $requete->execute();
    
    if(isset($_POST["submit"])){
      header('Location: administrerMatchs.php');
    }

  } else {
    echo 'champs vides';
  }

} else {
  
}

?>