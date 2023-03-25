<!DOCTYPE HTML>
<html>
<head>
  <title>Ajouter un joueur</title>
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
     <!--if(is_writable('C:/xampp/htdocs/thephpproject/photos')) {
    echo "Le dossier photo est accessible en écriture";
} else {
    echo "Le dossier images n'est pas accessible en écriture";
}-->
<form action="ajoutJoueur.php" method="post" enctype="multipart/form-data">

     <label for="num_licence">numero de licence : </label>
     <input type="number" name="num_licence" id="num_licence" required/> <br><br>

     <label for="photo_saisi">Photo : </label>
     <input type="file" name="photo_saisi" enctype="multipart/form-data"
     id="photo_saisi" required/> <br><br>


     <label for="nom_saisi">Nom : </label>
     <input type="text" name="nom_saisi" id="nom_saisi" required/><br><br>

     <label for="prenom_saisi">Prenom : </label>
     <input type="text" name="prenom_saisi" id="prenom_saisi" required/> <br><br>

     <label for="date_naissance_saisie">Date de naissance : </label>
     <input type="datetime-local" name="date_naissance_saisie" id="date_naissance_saisie" required/> <br><br>

     <label for="telephone">Téléphone : </label>
     <input type="number" name="telephone" id="telephone" required/> <br><br>

     <label for="taille_saisie">Taille (en cm) : </label>
     <input type="number" name="taille_saisie" id="taille_saisie" required/> <br><br>

     <label for="poids_saisi">Poids (en kg) : </label>
     <input type="poids_saisi" name="poids_saisi" id="poids_saisi" required/> <br><br>
     
     <label for="statut_saisi">Statut :</label>
     <select name="statut_saisi" id = "statut_saisi" required><br>
          <option value="Actif">Actif</option>
          <option value="Blesse">Blessé</option>
          <option value="Suspendu">Suspendu</option>
          <option value="Absent">Absent</option>
     </select>

     

     <label for="poste_prefere_saisi">Poste préféré : </label>
     <select name ="poste_prefere_saisi"  id = "poste_prefere_saisi" required>
          <option value="Droit"> Droit</option>
          <option value="Gauche"> Gauche</option>
     </select>
     <br>
     

     <label for="commentaires_saisi">Commentaires : </label>
     <input type="text" name="commentaires_saisi" id="commentaires_saisi"/> <br><br>

     <button class = "bouton" type="submit" name = "submit">Confirmer</button>
     
</form>
</html>

<?php

include ('connexion.php');
     if(isset($_POST["num_licence"])  && isset($_FILES['photo_saisi']) && isset($_POST["nom_saisi"]) && isset($_POST["prenom_saisi"]) 
          && isset($_POST["date_naissance_saisie"]) && isset($_POST["telephone"]) && isset($_POST["taille_saisie"]) && isset($_POST["poids_saisi"]) 
          && isset($_POST["statut_saisi"]) && isset($_POST["poste_prefere_saisi"])) {


          $num_licence=$_POST['num_licence'];
          
     $nom = $_POST['nom_saisi'];
     $prenom = $_POST['prenom_saisi'];
     $date_naissance = $_POST['date_naissance_saisie'];
     $telephone = $_POST['telephone'];
     $taille = $_POST['taille_saisie'];
     $poids= $_POST['poids_saisi'];
     $statut= $_POST['statut_saisi'];
     $poste_prefere= $_POST['poste_prefere_saisi'];
     $commentaires=$_POST['commentaires_saisi'];

     $image = $_FILES['photo_saisi'];
     $imageName = $_FILES['photo_saisi']['name'];
     $imageTmpName = $_FILES['photo_saisi']['tmp_name'];
     $imageSize = $_FILES['photo_saisi']['size'];
     $imageError = $_FILES['photo_saisi']['error'];
     $imageType = $_FILES['photo_saisi']['type'];

     $imageExt = explode('.', $imageName);
     $imageActualExt = strtolower(end($imageExt));

     $allowed = array('jpg', 'jpeg', 'png');
     if (in_array($imageActualExt, $allowed)) {
       if ($imageError === 0) {
        if ($imageSize < 1000000) {
         $imageNameNew = uniqid('', true).".".$imageActualExt;
         $imageDestination = "photos/".$imageNameNew;
                     //move_uploaded_file($imageTmpName, $imageDestination);
         if(move_uploaded_file($imageTmpName, $imageDestination)) {  
          echo "Fichier téléchargé avec succès!";  
     } else{  
         echo "Le fichier n'a pas été téléchargé";  
    }  
                     // Insérer l'image dans la table joueur
    $req = $linkpdo->prepare("INSERT INTO joueur(num_licence,photo,nom, prenom, date_naissance, 
     telephone, taille, poids, statut, poste_prefere, commentaires) VALUES(:num_licence, :photo, :nom, :prenom, :date_naissance, :telephone, :taille, :poids, :statut, :poste_prefere, :commentaires)");

    $req->bindParam(':num_licence', $num_licence);
    $req->bindParam(':photo', $imageDestination);
    $req->bindParam(':nom', $nom);
    $req->bindParam(':prenom', $prenom);
    $req->bindParam(':date_naissance', $date_naissance);
    $req->bindParam(':telephone', $telephone);
    $req->bindParam(':taille', $taille);
    $req->bindParam(':poids', $poids);
    $req->bindParam(':statut', $statut);
    $req->bindParam(':poste_prefere', $poste_prefere);
    $req->bindParam(':commentaires', $commentaires);

    $req->execute();
     echo "Ajouté avec succès.";
} else {
    echo "Votre fichier est trop grand.";
}
} else {
   echo "Il y a eu une erreur lors de l'upload.";
}
} else {
  echo "Vous ne pouvez pas uploader ce type de fichier.";
}
}


if(isset($_POST['submit'])){

     header("location: administrerJoueurs.php");
}
?>