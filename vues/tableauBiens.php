<?php
// PARTIE DONNES ---------------------------------------------------------
// inclusion de la méthode de dialogue avec la BD
require_once '../persistance/dialogueBD.php';
try {
    // on crée un objet référant la classe DialogueBD
    $undlg = new DialogueBD();
    $mesBiens = $undlg->getTousLesBiens();
} catch (Exception $e) {
    $erreur = $e->getMessage();
}
?>
<!-- PARTIE AFFICHAGE --------------------------------------------------- -->
<!DOCTYPE html>
<html>
<head>
    <?php require_once("menu.html"); ?>
    <meta charset="UTF-8" />
    <link href="../lib/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link rel="stylesheet" href="../lib/css/design.css" />
    <title>Tableau des employés</title>
</head>
<body>
<?php
if (isset($msgErreur)) {
    echo "Erreur : $msgErreur";
}
?>
<h1>Tableau des employés</h1>
<table class="table table-bordered table-striped">
    <thead>
    <tr>
        <th>Type de bien</th>
        <th>Adresse</th>
        <th>Ville</th>
        <th>Prix</th>
        <th>Statut</th>
        <th>Taille</th>
        <th>Modifier</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $lignes="";
    foreach ($mesBiens as $bien) {
        { // On parcourt la collection
            $lignes .= "<tr>\n"; // On construit une ligne <tr>
            $lignes .= "<td> $bien[NOMTYPE]</td>\n"; // On construit un <td>
            $lignes .= "<td> $bien[ADRESSE]</td>\n";
            $lignes .= "<td> $bien[VILLE]</td>\n";
            $lignes .= "<td> $bien[PRIX]</td>\n";
            $lignes .= "<td> $bien[NOMSTATUT]</td>\n";
            $lignes .= "<td> $bien[TAILLE]</td>\n";
            $lignes .= "<td><a  href=\"../Admin/update.php?id="   .        $bien['IDBIEN']      .       "\">Modifier</a></td>\n";
            $lignes .= "</tr>\n";
        }
    }
    echo utf8_encode($lignes); // On affiche tous les <tr>
    ?>
    </tbody>
</table>

</body>
</html>