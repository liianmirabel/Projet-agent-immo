<?php
// PARTIE DONNES ---------------------------------------------------------
// inclusion de la méthode de dialogue avec la BD
require_once '../persistance/dialogueBD.php';
try {
    // on crée un objet référant la classe DialogueBD
    $undlg = new DialogueBD();
    $mesClients = $undlg->getTousLesClients();
    if (isset($_POST['idclient']) && isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['num']))   {
        $id = $_POST['idclient'];
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $num = $_POST['num'];

        $OK = $undlg->ajouterClient($id, $nom,$prenom,$num);
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
    <title>Ajout d'un client</title>
</head>
<body>
<br><br><br><br>
<h1>Ajout d'un client</h1>
<form class="formulaire" action="GererClient.php" method="post">
    <ul>
        <li>
            <label for="IdClient">Id du client :</label>
            <input type="number" name="idclient" id="IdClient" required />
        </li>
        <li>
            <label for="NomClient">Nom :</label>
            <input type="text" name="nom" id="NomClient" required />
        </li>
        <li>
            <label for="PrenomClient">Prenom :</label>
            <input type="text" name="prenom" id="PrenomClient" required />
        </li>
        <li>
            <label for="NumClient">Numero du client :</label>
            <input type="number" name="num" id="NumClient" required />
        </li>
        <li><input type="submit" value="Ajouter le client"></li>
    </ul>
</form>

<h1>Tableau des Clients</h1>
<table class="table table-bordered table-striped">
    <thead>
    <tr>
        <th>ID client</th>
        <th>Nom Client</th>
        <th>Prenom Client</th>
        <th>Num Client</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $lignes="";
    foreach ($mesClients as $client) {
        { // On parcourt la collection
            $lignes .= "<tr>\n"; // On construit une ligne <tr>
            $lignes .= "<td> $client[IDCLIENT]</td>\n"; // On construit un <td>
            $lignes .= "<td> $client[NOMCLIENT]</td>\n";
            $lignes .= "<td> $client[PRENOMCLIENT]</td>\n";
            $lignes .= "<td> $client[NUMCLIENT]</td>\n";
            $lignes .= "</tr>\n";
        }
    }
    echo utf8_encode($lignes); // On affiche tous les <tr>
    ?>
    </tbody>
</table>
</body>
</html>
