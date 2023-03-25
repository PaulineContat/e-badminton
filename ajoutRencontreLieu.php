<!DOCTYPE HTML>
<html>
<head>
  <title>Ajouter une rencontre : Lieu</title>
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
<form action ="ajoutRencontreLieu.php" method ="post">
  <fieldset>
    <legend>Veuillez remplir les champs pour enregistrer une rencontre :</legend>
    <div>
      <input type="radio" id="choixLieu1" name="lieu" value="domicile">
      <label for="choixLieu1">Domicile</label>

      <input type="radio" id="choixLieu2" name="lieu" value="autre">
      <label for="choixLieu2">Autre</label>
    </div>

    <button type="submit" name = "submit">Suivant</button>

  </fieldset>
</form>
</body>
</html>

<?php 

if(isset($_POST['submit'])){
  if(!empty($_POST['lieu'])){
    $lieu=$_POST['lieu'];
    if($lieu=='domicile'){
      header('Location: ajoutRencontreDomicile.php');
    } else {
      if ($lieu=='autre') {
        header('Location: ajoutRencontreAutre.php');
      } else {
        header('Location: administrerMatchs.php');
      }
    }
  }
}
?>
