<?php

try {
    $conn = new PDO('mysql:host=localhost;dbname=essai;charset=utf8;', 'root', '');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erreur de connexion à la base de données : " . $e->getMessage();
    exit();
}

$erreur_message = "";

if (isset($_POST['submit'])) {
    $nom = htmlspecialchars($_POST['nom']);
    $mot_de_passe = $_POST['mot_de_passe'];

    $sql = "SELECT * FROM Admin WHERE Nom = ? AND mot_de_passe = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$nom, $mot_de_passe]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        echo "Connexion réussie pour l'utilisateur : " . $user['Nom'];
        header("Location: formulaireclient.php");
        exit();
    } else {
        $erreur_message = "Nom d'utilisateur ou mot de passe incorrect";
    }
}

$conn = null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="connexion.css">
    <title> Connexion </title>
</head>
<body>
    <div class="container">
        <h2>Connexion Secrétaire</h2>
       
        <?php if (!empty($erreur_message)) : ?>
            <p style="color: red;"><?php echo $erreur_message; ?></p>
        <?php endif; ?>
        
        <form action="" method="post" >
            <label for="nom">Nom d'utilisateur:</label>
            <input type="text" name="nom" id="nom" placeholder="Saisir le nom d'utilisateur" required>
            
            <label for="mot_de_passe">Mot de passe :</label>
            <input type="password" name="mot_de_passe" id="mot_de_passe"  placeholder="Saisir le Mot de passe" required>
            
            <button type="submit" name="submit">Connexion</button>
        </form>
    </div>
</body>
</html>
