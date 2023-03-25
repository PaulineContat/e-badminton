<form action="supprimerJoueur.php?id=<?php echo $_GET['id']; ?>" method="post">

  <label><b>Confirmer la suppression d'un joueur</b></label>
  <button type="submit" name="submit"> Supprimer </button>
  <button type="submit" name="annuler"> Annuler </button>

</form>

<?php

include ('connexion.php');
if(isset($_GET['id']) && !empty($_GET['id'])) {

  $id = $_GET['id'];
  $res = $linkpdo->prepare('DELETE FROM joueur WHERE num_licence=:id');

  if(isset($_POST["submit"])){
    $res->execute(array('id'=>$id));
    header('Location: administrerJoueurs.php');
  } else {
    if(isset($_POST["annuler"])){
      echo "vous avez annulé.";
      header('Location: administrerJoueurs.php');
    }  
  }

} else {
  echo 'Pas d\'id trouvé';
}

?>