<?php
include('class.php');
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="style.css" rel="stylesheet">
    <title>VEVO</title>
</head>
<body>

    <h2>Création de Compte Bancaire</h2>
    <form method="post">
        <label for="prenom">Prénom :</label>
        <input type="text" id="prenom" name="prenom" required><br>
        
        <label for="nom">Nom :</label>
        <input type="text"  name="nom" required><br>
        
        <label for="adresse">Adresse :</label>
        <input type="text"  name="adresse" required><br>
        
        <label for="telephone">Numéro de Téléphone :</label>
        <input type="number"  name="telephone" required><br>

        <label for="solde">Solde Initial :</label>
        <input type="number"  name="solde" value="0.00" required><br>
        
        <input type="submit" name="btn_submit" value="Créer Compte">
    </form>
    <form method="GET" action="index.php">
        <input type="submit" value="Retour à la page d'accueil">
    </form>
</body>
</html>
