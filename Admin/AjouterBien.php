<?php
// PARTIE DONNES ---------------------------------------------------------
// inclusion de la méthode de dialogue avec la BD
require_once '../persistance/dialogueBD.php';
try {
    // on crée un objet référant la classe DialogueBD
    $undlg = new DialogueBD();
    $lesAgents = $undlg->getTousLesAgent();
    $lesTypes = $undlg->getTousLesType();
    $lesStatuts = $undlg->getTousLesStatut();
    $imageError = $image = "";
    if (isset($_POST['idbien']) && isset($_POST['typedubien']) && isset($_POST['adresse']) && isset($_POST['ville'])  && isset($_POST['prix']) && isset($_POST['taille']) && isset($_POST['statutdubien']) && isset($_POST['agentquipost']))   {
        $filename = $_FILES["image"]["name"];
        $tempname = $_FILES["image"]["tmp_name"];
        $couverture = "../images/".$filename;
        if (move_uploaded_file($tempname, $couverture)) {

            $msg = "Image uploaded successfully";
        }else{

            $msg = "Failed to upload image";

        }
        $id = $_POST['idbien'];
        $type = $_POST['typedubien'];
        $adresse = $_POST['adresse'];
        $ville = $_POST['ville'];
        $prix = $_POST['prix'];
        $taille = $_POST['taille'];
        $statut = $_POST['statutdubien'];
        $agent = $_POST['agentquipost'];
        //$couverture = " ";
        $OK = $undlg->ajouterBien($id, $type, $statut, $agent, $ville, $adresse,$prix,$taille,$couverture);
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
<h1>Ajout d'un bien</h1>
<form class="formulaire" action="AjouterBien.php" method="post" enctype="multipart/form-data">
    <ul>
        <li>
            <label for="IdBien">Id du bien :</label>
            <input type="number" name="idbien" id="IdBien" required />
        </li>
        <li>
            <label for="TypeBien">Type du bien :</label>
            <select name="typedubien" id="TypeBien">
                <?php
                foreach ($lesTypes as $ligne) {
                    $code = $ligne['IDTYPE'];
                    $designation = $ligne['NOMTYPE'];
                    echo "<option value=$code>$designation</option>";
                }
                ?>
            </select>
        </li>
        <li>
            <label for="AdresseBien">Adresse :</label>
            <input type="text" name="adresse" id="AdresseBien" required />
        </li>
        <li>
            <label for="VilleBien">Ville :</label>
            <input type="text" name="ville" id="VilleBien" required />
        </li>
        <li>
            <label for="PrixBien">Prix :</label>
            <input type="number" name="prix" id="PrixBien" required />
        </li>
        <li>
            <label for="TailleBien">Taille :</label>
            <input type="number" name="taille" id="TailleBien" required />
        </li>
        <li>
            <label for="StatutBien">Statut du bien :</label>
            <select name="statutdubien" id="StatutBien">
                <?php
                foreach ($lesStatuts as $ligne) {
                    $code = $ligne['IDSTATUT'];
                    $designation = $ligne['NOMSTATUT'];
                    echo "<option value=$code>$designation</option>";
                }
                ?>
            </select>
        </li>
        <li>
            <label for="AgentPost">Agent :</label>
            <select name="agentquipost" id="AgentPost">
                <?php
                foreach ($lesAgents as $ligne) {
                    $code = $ligne['IDAGENT'];
                    $designation = $ligne['NOM']." ".$ligne['PRENOM'];
                    echo "<option value=$code>$designation</option>";
                }
                ?>
            </select>
        </li>
        <div class="form-group">
            <label for="images">Sélectionner une image:</label>
            <input type="file" id="image" name="image">
            <span class="help-inline"><?php echo $imageError;?></span>
        </div>
        <li><input type="submit" value="Ajouter le bien"></li>
    </ul>
</form>
</body>
</html>
