<?php
session_start();

if(isset($_POST['username']) && isset($_POST['password'])) {
    include ('connexion.php');
    $username = $_POST['username'];
    $password = $_POST['password'];
    //mysqli_real_escape_string($linkpdo,htmlspecialchars($_POST['username'])); 
    if(!empty($username) && !empty($password )) {
        //$query = 'SELECT count(*) FROM utilisateurs WHERE identifiant = :id AND mdp = ?';
        //$sql="SELECT count(*) FROM utilisateurs WHERE identifiant = ? //AND mdp = ?";
        $requete = $linkpdo->prepare('SELECT count(*) FROM utilisateurs WHERE identifiant = :id AND mdp = :mdp');
        $requete->bindValue('id', $username, PDO::PARAM_STR);
        $requete->bindValue('mdp', $password, PDO::PARAM_STR);//$password);
        $requete->execute();
        $reponse = $requete->fetch();
        /*$exec_requete = $linkpdo->query($requete);
        $reponse = $exec_requete->fetch_array();*/
        $count = $reponse['count(*)'];
        if($count!=0) { // nom d'utilisateur et mot de passe correctes
            $_SESSION['username'] = $username;
            header('Location: principale.php');
        } else {
            header('Location: index.php?erreur=1');
        }
    } else {
        header('Location: index.php?erreur=2');
    }
} else {
    header('Location: index.php');
}
//mysqli_close($db);
?>