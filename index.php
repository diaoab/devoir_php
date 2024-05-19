<?php
session_start();
include("db.php");

$query = "SELECT prenom, nom, adresse, telephone, solde, numero_compte FROM client";

if (isset($_POST['search_submit'])) {
    $search = mysqli_real_escape_string($con, $_POST['search']);
    $query .= " WHERE numero_compte LIKE '%$search%' OR nom LIKE '%$search%'";
}

$result = mysqli_query($con, $query);

// Stocker le résultat de la requête dans une variable de session
$_SESSION['result'] = $result;

mysqli_close($con);
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VEVO</title>
    <link href="style.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="content">
            <div class="account-list">
                <center><h2>Liste des Comptes Bancaires</h2>
                <?php
                if (mysqli_num_rows($result) > 0) {
                    echo "<table>";
                    echo "<tr><th>Prénom</th><th>Nom</th><th>Adresse</th><th>Téléphone</th><th>Solde</th><th>Numéro de compte</th></tr>";
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['prenom'] . "</td>";
                        echo "<td>" . $row['nom'] . "</td>";
                        echo "<td>" . $row['adresse'] . "</td>";
                        echo "<td>" . $row['telephone'] . "</td>";
                        echo "<td>" . $row['solde'] . "</td>";
                        echo "<td>" . $row['numero_compte'] . "</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                } else {
                    echo "Aucun compte bancaire trouvé.";
                }
                ?>
            </div>

            <div class="search-account">
               <br><br><br> <h2>Rechercher un Compte Bancaire</h2>
                <form method="post" action="">
                    <label for="search">Renseigner le numéro <br>de compte ou le nom </label>
                    <input type="text" id="search" name="search" required>
                    <button type="submit" name="search_submit">Rechercher</button>
                </form><br> 
                <center><h2>Actions</h2>
                
                <button onclick="window.location.href='creation_compte.php'">Créer un nouveau Compte</button>
               <br><br><button onclick="window.location.href='transaction.php'">Effectuer des Opérations</button>
            
            </div>
        </div>

        <div class="actions">
            
        </div>
    </div>
</body>
</html>
