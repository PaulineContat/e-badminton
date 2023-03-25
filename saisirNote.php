<?php
include('connexion.php');

if(!empty($_GET)){

	$id_rencontre=$_GET['id_rencontre'];
	$num_licence=$_GET['num_licence'];

	$res = $linkpdo->prepare('SELECT note FROM participer WHERE id_rencontre=:id_rencontre AND num_licence = :num_licence');
	$res->bindValue('id_rencontre', $id_rencontre, PDO::PARAM_INT);
	$res->bindValue('num_licence', $num_licence, PDO::PARAM_INT);
	$res->execute();
	if($data = $res->fetch()){
		$note = $data['note'];
	} else {
  		echo 'Vous n\'avez pas encore évalué ce joueur';
	}	

} elseif(!empty($_POST)) {

	$id_rencontre=$_POST['id_rencontre'];
	$num_licence=$_POST['num_licence'];
	$note = $_POST['note'];

	$requete = $linkpdo->prepare('UPDATE participer SET note = :note WHERE id_rencontre = :id_rencontre AND num_licence = :num_licence');
	$requete->bindValue('note', $note, PDO::PARAM_INT);
	$requete->bindValue('id_rencontre', $id_rencontre, PDO::PARAM_STR);
	$requete->bindValue('num_licence', $num_licence, PDO::PARAM_INT);

	$requete->execute();

	if(isset($_POST['submit'])){
		header('Location: administrerMatchs.php');
	}
}
?>

<form action='saisirNote.php' method='post'>

	<input type="hidden" name="id_rencontre" value="<?php echo $id_rencontre;?>">
	<input type="hidden" name="num_licence" value="<?php echo $num_licence;?>">

	<label><b>Entrez la note du joueur</b></label>
	<input type='number' name='note' value='<?php echo $note; ?>' required></br>

	<button type="submit" name ="submit">Enregistrer</button>

</form>