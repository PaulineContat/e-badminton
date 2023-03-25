<?php

include ('connexion.php');
if(isset($_GET['id']) && !empty($_GET['id'])) {

    $id = $_GET['id'];
    $res = $linkpdo->prepare('SELECT * FROM rencontre WHERE id_rencontre=:id');
    $res->execute(array('id'=>$id));
    $data = $res->fetch(PDO::FETCH_ASSOC);

    $temps = $data['date_heure'];
    if($data['domicile']=='n'){
        $ville = $data['ville'];
        $cp = $data['code_postal'];
    } else {
        $ville = "";
        $cp = "";
    }
    $adversaire = $data['equipe_adverse'];

} else {

    if /*((       isset($_POST["nvDateHeure"])
            &&  isset($_POST["nvEquipeAd"])
            &&  isset($_POST["nvVille"])
            &&  isset($_POST["nvCp"])
        )&&(
                !empty($_POST["nvDateHeure"])
            &&  !empty($_POST["nvVille"])
            &&  !empty($_POST["nvCp"])
            &&  !empty($_POST["nvEquipeAd"])
        ))*/(!empty($_POST)) {

        $id = $_POST['id'];
        $domicile='n';
        $ville=$_POST["nvVille"];
        $cp=$_POST["nvCp"];

        if(!empty($_POST['nvDateHeure'])){
          $temps = $_POST["nvDateHeure"];
        } else {
          $temps = $_POST["dateHeure"];
        }

        $adversaire = $_POST["nvEquipeAd"];

        $requete = $linkpdo->prepare("UPDATE rencontre SET domicile = :domicile, ville = :ville, code_postal = :cp, date_heure = :temps, equipe_adverse = :adversaire WHERE id_rencontre = :id");
        $requete->bindValue('domicile', $domicile, PDO::PARAM_STR);
        $requete->bindValue('ville', $ville, PDO::PARAM_STR);
        $requete->bindValue('cp', $cp, PDO::PARAM_INT);
        $requete->bindValue('temps', $temps, PDO::PARAM_STR);
        $requete->bindValue('adversaire', $adversaire, PDO::PARAM_STR);
        $requete->bindValue('id', $id, PDO::PARAM_INT);
        
        if(isset($_POST["submit"])){
            $requete->execute();
            header('Location: administrerMatchs.php');
        }  
    }
}

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
<form action="modifierRencontreAutre.php?" method="post">

  <label><b>Ville</b></label>
  <input type="text" name="nvVille" value = "<?php echo $ville; ?>" required></br></br>

  <label><b>Code postal</b></label>
  <input type="number" name="nvCp" value = "<?php echo $cp; ?>" required></br></br>

  <label><b>Date et heure d'origine</b> <?php echo date('Y-m-d\TH:i', strtotime($temps))//.'h'.date('m - d/m/y', strtotime($temps)); ?></label></br></br>
  <input value="<?php echo $temps; ?>" type="hidden" name="dateHeure"><br /></br>

  
  <label><b>Si vous souhaitez modifier la date et l'heure veuillez remplir ce champ :</b></label>
  <input type="datetime-local" name="nvDateHeure"></br></br>


  <label><b>Nom de l'équipe adverse</b></label>
  <input type="text" name="nvEquipeAd" value = "<?php echo $adversaire; ?>" required></br>

  <input value="<?php echo $id; ?>" type="hidden" name="id" ><br />

  <button type="submit" name="submit"> Modifier </button>

</form>