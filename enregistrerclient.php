<?php

$conn = new PDO('mysql:host=localhost;dbname=essai;charset=utf8;', 'root', ''); 

if (isset($_POST['submit'])) {
    $nom = htmlspecialchars($_POST['nom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $mot_de_passe = password_hash($_POST['mot_de_passe'], PASSWORD_DEFAULT); 

    $sql = "INSERT INTO clients (nom, prenom, mot_de_passe) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt->execute(array($nom, $prenom, $mot_de_passe))) {
        echo "Enregistrement réussi";
    } else {
        echo "Erreur d'enregistrement : " . $stmt->error;
    }

    $conn = null;
}
?>
