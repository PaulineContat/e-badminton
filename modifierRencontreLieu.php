<?php
   $id=$_GET['id'];
?>

<!DOCTYPE HTML>
<html>
<head>
  <title>Modifier une rencontre</title>
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
<html>
<head>
  <title>Modifier une rencontre</title>
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
<form action ="modifierRencontreLieu.php?id=<?php echo $_GET['id']; ?>" method ="post">
  <fieldset>
    <legend>Choisissez si la rencontre aura lieu au domicile ou ailleurs :</legend>
    <div>
      <input type="radio" id="choixLieu1" name="lieu" value="domicile">
      <label for="choixLieu1">Domicile</label>

      <input type="radio" id="choixLieu2" name="lieu" value="autre">
      <label for="choixLieu2">Autre</label>
      <input value="<?php echo $id; ?>" type="hidden" name="id" ><br />

      <button type="submit" name = "submit">Suivant</button>
   </div>
</fieldset>
</form>

<?php 

   if(!empty($_GET['id'])){
       
      $id=$_GET['id'];

      if(isset($_POST['submit']) && !empty($_POST['lieu'])){
         $lieu=$_POST['lieu'];
         if($lieu=='domicile'){
            header("Location:modifierRencontreDomicile.php?id=".$id."");
         } else {
            if ($lieu=='autre') {
             header("Location: modifierRencontreAutre.php?id=".$id."");
          } else {
             header('Location: administrerMatchs.php');
          }
       }
   }
   } else {
      //$id=$_GET['id'];
      echo "something went wrong".$id;
   }

?>