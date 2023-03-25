<?php

include ('connexion.php');
if(isset($_GET['id']) && !empty($_GET['id'])) {

    $num_licence = $_GET['id'];
    $res = $linkpdo->prepare('SELECT * FROM joueur WHERE num_licence=:id');
    $res->execute(array('id'=>$num_licence));
    $data = $res->fetch(PDO::FETCH_ASSOC);

    $nom = $data['nom'];
    $prenom = $data['prenom'];
    $date_naissance = $data['date_naissance'];
    $telephone = $data['telephone'];
    $taille = $data['taille'];
    $poids = $data['poids'];
    $statut = $data['statut'];
    $poste_prefere = $data['poste_prefere'];
    $commentaires = $data['commentaires'];


} else {

    if (!empty($_POST)) {

        $num_licence = $_POST['num_licence'];
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $date_naissance = $_POST['date_naissance'];
        $telephone = $_POST['telephone'];
        $taille = $_POST['taille'];
        $poids = $_POST['poids'];
        $statut = $_POST['statut'];
        $poste_prefere = $_POST['poste_prefere'];
        $commentaires = $_POST['commentaires'];

        $stmt = $linkpdo->prepare("UPDATE joueur SET nom=:nom, prenom=:prenom, date_naissance=:date_naissance, telephone=:telephone, taille=:taille, poids=:poids, statut=:statut, poste_prefere=:poste_prefere, commentaires=:commentaires WHERE num_licence = :num_licence");


        $stmt->bindParam('num_licence', $num_licence, PDO::PARAM_INT);
  $stmt->bindParam('nom', $nom);
  $stmt->bindParam('prenom', $prenom);
  $stmt->bindParam('date_naissance', $date_naissance);
  $stmt->bindParam('telephone', $telephone);
  $stmt->bindParam('taille', $taille);
  $stmt->bindParam('poids', $poids);
  $stmt->bindParam('statut', $statut);
  $stmt->bindParam('poste_prefere', $poste_prefere);
  $stmt->bindParam('commentaires', $commentaires);
        
        if(isset($_POST["submit"])){
            $stmt->execute();
            header('Location: administrerJoueurs.php');
        }  
    }
}

?>

<!DOCTYPE HTML>
<html>
<head>
  <title>Modifier un joueur</title>
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
      <li><a href="administrerMatchs.php">Administrer les matchs</a></li>
      <li><a href="Statistiques.php">Statistiques</a></li>
    </ul>
  </nav>
  <br><br>
<form action="modifierJoueur.php?" method="post">

      <input value="<?php echo $num_licence; ?>" type="hidden" name="num_licence" ><br />

     <label for="nom_saisi">Nom : </label>
     <input type="text" name="nom" value = "<?php echo $nom; ?>" required/><br><br>

     <label for="prenom_saisi">Prenom : </label>
     <input type="text" name="prenom" value = "<?php echo $prenom; ?>" required/> <br><br>

     <label for="date_naissance_saisie">Date de naissance : </label>
     <input type="datetime-local" name="date_naissance" value = "<?php echo $date_naissance; ?>" required/> <br><br>

     <label for="telephone">Téléphone : </label>
     <input type="number" name="telephone"  value = "<?php echo $telephone; ?>" required/> <br><br>

     <label for="taille_saisie">Taille (en cm) : </label>
     <input type="number" name="taille" value = "<?php echo $taille; ?>" required/> <br><br>

     <label for="poids_saisi">Poids (en kg) : </label>
     <input type="number" name="poids" value = "<?php echo $poids; ?>" required/> <br><br>
     
    <label for="statut">Statut : </label>
     <select name="statut" value = "<?php echo $statut; ?>" required><br>
          <option value="Actif" <?php echo $statut; ?>>Actif</option>
          <option value="Blesse" <?php echo $statut; ?>>Blessé</option>
          <option value="Suspendu" <?php echo $statut; ?>>Suspendu</option>
          <option value="Absent" <?php echo $statut; ?>>Absent</option>
     </select><br><br>


     <label for="poste_prefere_saisi">Poste préféré : </label>
     <select name ="poste_prefere" value = "<?php echo $poste_prefere; ?>"required>
          <option value="Droit" <?php echo $poste_prefere; ?>> Droit</option>
          <option value="Gauche" <?php echo $poste_prefere; ?>> Gauche</option>
     </select>
     <br><br>
     

     <label for="commentaires_saisi">Commentaires : </label>
     <input type="text" name="commentaires" value = "<?php echo $commentaires; ?>"/> <br><br>

  <button type="submit" name="submit"> Modifier </button>

</form>
</body>
</html>