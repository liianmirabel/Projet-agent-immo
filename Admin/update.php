<?php
// PARTIE DONNES ---------------------------------------------------------
// inclusion de la méthode de dialogue avec la BD
require_once '../persistance/dialogueBD.php';
require_once '../vues/menu.html';
try {
    // on crée un objet référant la classe DialogueBD
    $undlg = new DialogueBD();
    if(!empty($_GET['id']))
    {
        $id = $_GET['id'];
    }
    $monBien = $undlg->getUnBien($id);
    $mesStatut = $undlg->getTousLesStatut();
    if (isset($_POST['statutdubien']) && isset($_POST['idbien']))  {
        $idbien = $_POST['idbien'];
        $statutbien = $_POST['statutdubien'];
        $OK = $undlg->ModifBien($statutbien,$idbien);
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
    <title>Modifier le bien</title>
</head>
<body>
<br><br><br><br>
<form class="formulaire" action="update.php" method="post" enctype="multipart/form-data">
    <ul>
        <li>
            <label for="IdBien">Id du bien :</label>
            <input type="number" name="idbien" id="IdBien" value="<?php echo $id;?>" required />
        </li>
        <li>
            <label for="StatutBien">Statut du bien :</label>
            <select name="statutdubien" id="StatutBien">
                <?php
                foreach ($mesStatut as $ligne) {
                    $code = $ligne['IDSTATUT'];
                    $designation = $ligne['NOMSTATUT'];
                    echo "<option value=$code>$designation</option>";
                }
                ?>
            </select>
        </li>
        <li><input type="submit" value="Modifier le bien"></li>
    </ul>
</form>
</body>
</html>


