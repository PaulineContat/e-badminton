<form action="supprimerRencontre.php?id=<?php echo $_GET['id']; ?>" method="post">

  <label><b>Confirmer la suppression de la rencontre</b></label>
  <button type="submit" name="submit"> Supprimer </button>
  <button type="submit" name="annuler"> Annuler </button>

</form>

<?php

include ('connexion.php');
if(isset($_GET['id']) && !empty($_GET['id'])) {

  $id = $_GET['id'];
  $res = $linkpdo->prepare('DELETE FROM rencontre WHERE id_rencontre=:id');
  //$res->execute(array('id'=>$id));

  if(isset($_POST["submit"])){
    $res->execute(array('id'=>$id));
    header('Location: administrerMatchs.php');
  } else {
    if(isset($_POST["annuler"])){
      echo "vous avez annulé.";
      header('Location: administrerMatchs.php');
    }  
  }

} else {
  echo 'Pas d\'id trouvé';
}

?>