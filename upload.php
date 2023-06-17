<?php
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "Le fichier est une image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo " Le fichier n'est pas une image.";
        $uploadOk = 0;
    }
}


// Check si le fichier existe deja

if(file_exists($target_file)) {
    echo " Désoler le fichier existe deja.";
    $uploadOk = 0;
}

// Check la taille du fichier

if($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Désoler, la taille du fichier est trop large";
    $uploadOk = 0;
}

// Autoriser certain format de fichier

if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
    echo "Désoler, que JPG, JPEG, PNG & GIF peuvent etre autorisé.";
    $uploadOk = 0;
} 

// Check si $uploadOk est mis a 0 par une Erreur

if($uploadOk == 0) {
    echo " Désoler, votre fichier n'a pas été poster";
} else {
    if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    echo "Le fichier " . htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])) . " à bien été publié";
    } else {
        echo "Désoler, il y a eu une erreur dans la publication du fichier";
    }
}


?>