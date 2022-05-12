<?php
// PARTIE DONNES ---------------------------------------------------------
// inclusion de la méthode de dialogue avec la BD

$imageError = $image = "";
//$image              = $_FILES["image"];
//var_dump($image);
//$imagePath          = '../images/'. basename($image);
//$imageExtension     = pathinfo($imagePath,PATHINFO_EXTENSION);

$filename = $_FILES["image"]["name"];
$tempname = $_FILES["image"]["tmp_name"];
$folder = "../images/".$filename;
if (move_uploaded_file($tempname, $folder)) {

    $msg = "Image uploaded successfully";

}else{

    $msg = "Failed to upload image";

}
?>
<!-- PARTIE AFFICHAGE --------------------------------------------------- -->
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="../lib/css/design.css" />
    <title>Ajout d'un bien</title>
</head>
<body>
<br><br><br><br>
<h1>Ajout d'un bien</h1>
<form class="formulaire" action="testimage.php" method="post" enctype="multipart/form-data">
    <ul>
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
