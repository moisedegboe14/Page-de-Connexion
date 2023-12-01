<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enregistrement Client</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Enregistrement Client</h2>
        <form action="enregistrerclient.php" method="post" onsubmit="afficherInfoAvantImpression(event)">
            <label for="nom">Nom :</label>
            <input type="text" name="nom" id="nom" placeholder="Saisir le nom du client" required>
            
            <label for="prenom">Prénom :</label>
            <input type="text" name="prenom" id="prenom" placeholder="Saisir le prenom du client" required>
            
            <label for="mot_de_passe">Mot de passe :</label>
            <input type="password" name="mot_de_passe" id="mot_de_passe"  placeholder="Saisir le Mot de passe du client" required>
            
            <button type="submit" name="submit">Enregistrer</button>
        </form>
    </div>



<div id="informationsClient"></div>

<script>
    function afficherInfoAvantImpression(event) {
        event.preventDefault(); 

        
        var nom = document.getElementById('nom').value;
        var prenom = document.getElementById('prenom').value;
        var motDePasse = document.getElementById('mot_de_passe').value;

        
        var informationsClient = 'Nom du client : ' + nom + '<br>Mot de passe du client : ' + motDePasse;

        
        document.querySelector('.container').style.display = 'none'; // Masque le formulaire
        document.getElementById('informationsClient').innerHTML = informationsClient;

        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'enregistrerclient.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

        // Formatage des données à envoyer
        var params = 'submit=true&nom=' + encodeURIComponent(nom) + '&prenom=' + encodeURIComponent(prenom) + '&mot_de_passe=' + encodeURIComponent(motDePasse);

        xhr.onload = function () {
            if (xhr.status == 200) {
                // Enregistrement réussi, déclenche automatiquement la fenêtre d'impression
                window.print();
                // Réaffiche le formulaire après l'impression
                document.querySelector('.container').style.display = 'block';
            } else {
                console.error('Erreur lors de l\'enregistrement : ', xhr.responseText);

                document.querySelector('.container').style.display = 'block';
            }
        };
        xhr.send(params);

            document.getElementById('nom').value = '';
            document.getElementById('prenom').value = '';
            document.getElementById('mot_de_passe').value = '';
    }
</script>

</body>
</html>
