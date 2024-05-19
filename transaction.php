<?php
include('class.php');
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="style.css" rel="stylesheet">
    <title>VEVO - Transactions Bancaires</title>
</head>
<body>
    <h1>Bienvenue sur VEVO</h1>

    <?php
    if (isset($_SESSION['error'])) {
        echo "<div class='message error'>{$_SESSION['error']}</div>";
        unset($_SESSION['error']); 
       }
    if (isset($_SESSION['success'])) {
        echo "<div class='message success'>{$_SESSION['success']}</div>";
        unset($_SESSION['success']); 
       }
    ?>

    <h2>Effectuer une transaction</h2>
    <form method="POST" action="class.php">
        <label for="numero_compte">Numéro de compte :</label>
        <input type="text" id="numero_compte" name="numero_compte" required>

        <label for="montant">Montant :</label>
        <input type="text" id="montant" name="montant" required>

        <label for="numero_destinataire">Numéro de compte destinataire (pour les virements) :</label>
        <input type="text" id="numero_destinataire" name="numero_destinataire"><br><br>

        <input type="submit" name="depot" value="Déposer"><br><br>
        <input type="submit" name="retrait" value="Retirer"><br><br>
        <input type="submit" name="virement" value="Virement">
    </form>

    <form method="GET" action="index.php">
        <input type="submit" value="Retour à la page d'accueil">
    </form>
</body>
</html>
