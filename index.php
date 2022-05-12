<?php
// PARTIE DONNES ---------------------------------------------------------
// inclusion de la méthode de dialogue avec la BD
session_start();
require_once 'persistance/dialogueBD.php';
try {
    // on crée un objet référant la classe DialogueBD
    $undlg = new DialogueBD();
    $mesBiens = $undlg->getTousLesBiens();
} catch (Exception $e) {
    $erreur = $e->getMessage();
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="lib/bootstrap/css/bootstrap.css" rel="stylesheet">
        <link href="lib/css/design.css" rel="stylesheet">
        <script src="lib/jquery/jquery-2.1.3.min.js"></script>
        <script src="lib/bootstrap/js/ui-bootstrap-tpls.js" type="text/javascript"></script>
        <script src="lib/bootstrap/js/bootstrap.js"></script>
        <title> Menu principal </title>

        <div class="container">
            <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-target">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="#">Menu entreprise</a>
                    </div>
                    <div class="collapse navbar-collapse" id="navbar-collapse-target">
                        <ul class="nav navbar-nav">
                            <li><a href="vues/tableauBiens.php" data-toggle="collapse" data-target=".navbar-collapse.in">Tableau des biens</a></li>
                            <li><a href="Admin/AjouterBien.php" data-toggle="collapse" data-target=".navbar-collapse.in">Ajouter un bien</a></li>
                            <li><a href="Admin/GererClient.php" data-toggle="collapse" data-target=".navbar-collapse.in">Gerer les clients</a></li>
                            <li><a href="Admin/AjouterVisite.php" data-toggle="collapse" data-target=".navbar-collapse.in">Ajouter visite</a></li>
                        </ul>
                    </div>
                </div><!--/.container-fluid -->
            </nav>
        </div>
    </head>
    <body><a class="nav-link active" href="login.php">Connexion</a>
    <br /><br />
    <center class="titre"><h1>Les biens</h1></center>
    <?php
    foreach ($mesBiens as $bien) {
        echo '<div class="col-sm-6 col-md-4">
                                <div class="thumbnail">
                                <center><h4>' . $bien['NOMTYPE']. '</h4></center>
                                        <img src="images/' . $bien['COUVERTURE'] . '" alt="..." class="image">
                                        <center><h4 class="statut">' . $bien['NOMSTATUT']. '</h4></center>
                                        <center><h4>' . $bien['PRIX']. "  €".'</h4></center>
                                        <center><h4>' . $bien['VILLE'] . '</h4></center>
                                       <center> <p>' . $bien['ADRESSE'] . '</p></center>
                                       <center> <p>' . "Appeler au 00 00 00 00 00" . '</p></center>
                                </div>
              </div>';
    }
    ?>

    </body>
    </html>