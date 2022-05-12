<?php
// PARTIE DONNES ---------------------------------------------------------
// inclusion de la méthode de dialogue avec la BD
require_once '../persistance/dialogueBD.php';
try {
    // on crée un objet référant la classe DialogueBD
    $undlg = new DialogueBD();
    $lesClients = $undlg->getTousLesClients();
    $lesBiens = $undlg->getTousLesBiens();

    if (isset($_POST['idbien']) && isset($_POST['idclient']))   {
        $idbien = $_POST['idbien'];
        $idclient = $_POST['idclient'];

        $OK = $undlg->ajouterVisite($idclient, $idbien);
    }
} catch (Exception $e) {
    $erreur = $e->getMessage();
}
?>
<!-- PARTIE AFFICHAGE --------------------------------------------------- -->
<!DOCTYPE html>
<html>
<head>
    <?php require_once("../vues/menu.html"); ?>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="../lib/css/design.css" />
    <title>Ajout d'un bien</title>
</head>
<body>
<br><br><br><br>
<h1>Ajout d'une visite</h1>
<form class="formulaire" action="AjouterVisite.php" method="post">
    <ul>
        <li>
            <label for="IdBien">Bien visité :</label>
            <select name="idbien" id="IdBien">
                <?php
                foreach ($lesBiens as $ligne) {
                    $code = $ligne['IDBIEN'];
                    $designation = $ligne['ADRESSE'].", ".$ligne['VILLE'] ;
                    echo "<option value=$code>$designation</option>";
                }
                ?>
            </select>
        </li>
        <li>
            <label for="ClientVisite">Client :</label>
            <select name="idclient" id="ClientVisite">
                <?php
                foreach ($lesClients as $ligne) {
                    $code = $ligne['IDCLIENT'];
                    $designation = $ligne['PRENOMCLIENT'] ." ". $ligne['NOMCLIENT'];
                    echo "<option value=$code>$designation</option>";
                }
                ?>
            </select>
        </li>
        <li><input type="submit" value="Ajouter la visite"></li>
    </ul>
</form>
</body>
</html>
