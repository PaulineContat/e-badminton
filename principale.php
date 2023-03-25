<html>
<head>
    <title>Gestionnaire d'équipe de Badminton</title>
   <meta charset="utf-8">
   <!-- importer le fichier de style -->
   <link rel="stylesheet" href="accueil.css" media="screen" type="text/css" />
   <link rel="stylesheet" href="menu.css" media="screen" type="text/css" />

</head>
<body>
    <header><img src="bad.png" alt="Logo e-Badminton" style="float:left;width:50px;height:50px;">
        <h1>e-Badminton, votre gestionnaire d'équipe</h1>
    </header>
    <nav class="menu">
      <ul>
        <li><a href="principale.php" class="active">Accueil</a></li>
        <li><a href="administrerJoueurs.php">Administrer les joueurs</a></li>
        <li><a href="administrerMatchs.php">Administrer les matchs</a></li>
        <li><a href="Statistiques.php">Statistiques</a></li>
      </ul>
    </nav>
   <section>
       <!-- tester si l'utilisateur est connecté -->
       <?php
           session_start();
           if($_SESSION['username'] !== ""){
               $user = $_SESSION['username'];
               // afficher un message
               echo "<h1 id='welcome'> Bonjour ".$user.", bienvenue sur e-Badminton.</h1>";
           }
       ?>
       
       
   </section>
</body>
</html>