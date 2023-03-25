<?php 
include ('connexion.php');
$id_rencontre = $_GET['id_rencontre'];
foreach ($titulaires as $titulaire) {
    $requete = $linkpdo->prepare('INSERT INTO participer (id_rencontre, num_licence, role) VALUES (:id_rencontre, :num_licence, "titulaire")');
    $requete->bindValue('id_rencontre', $id_rencontre, PDO::PARAM_INT);
    $requete->bindValue('num_licence', $titulaire['num_licence'], PDO::PARAM_INT);
    $requete->execute();
}
$requete = $linkpdo->prepare('INSERT INTO participer (id_rencontre, num_licence, role) VALUES (:id_rencontre, :num_licence, "remplacant")');
$requete->bindValue('id
