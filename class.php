<?php
session_start();

include("db.php");

class Client {
    public $prenom;
    public $nom;
    public $adresse;
    public $telephone;

    public function __construct($prenom, $nom, $adresse, $telephone) {
        $this->prenom = $prenom;
        $this->nom = $nom;
        $this->adresse = $adresse;
        $this->telephone = $telephone;
    }
}

class CompteBancaire {
    public $numeroCompte;
    public $solde;

    public function __construct($numeroCompte) {
        $this->numeroCompte = $numeroCompte;
        $this->loadSoldeFromDatabase();
    }

    private function loadSoldeFromDatabase() {
        global $con;
        $query = "SELECT solde FROM client WHERE numero_compte = '$this->numeroCompte'";
        $result = mysqli_query($con, $query);
        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $this->solde = $row['solde'];
        } else {
            $this->solde = 0;
        }
    }

    private function updateSoldeInDatabase() {
        global $con;
        $query = "UPDATE client SET solde = $this->solde WHERE numero_compte = '$this->numeroCompte'";
        mysqli_query($con, $query);
    }

    public function deposer($montant) {
        $this->solde += $montant;
        $this->updateSoldeInDatabase();
        echo "<script type='text/javascript'> alert('Dépôt de $montant FCFA effectué sur le compte $this->numeroCompte.<br> Nouveau solde : {$this->solde} FCFA')</script>";

    }

    public function retirer($montant) {
        if ($this->solde >= $montant) {
            $this->solde -= $montant;
            $this->updateSoldeInDatabase();
            echo "<script type='text/javascript'> alert('Retrait de $montant FCFA effectué sur le compte $this->numeroCompte. Nouveau solde : {$this->solde} FCFA')</script>";

        } else {
            echo "<script type='text/javascript'> alert('Solde insuffisant sur le compte $this->numeroCompte. Impossible de faire un retrait de : $montant FCFA')</script>";
        }
    }

    public function virement($montant, $compte_destinataire) {
        if ($this->solde >= $montant) {
            $this->solde -= $montant;
            $compte_destinataire->deposer($montant);
            $this->updateSoldeInDatabase();
            echo "<script type='text/javascript'> alert('Solde insuffisant sur le compte $this->numeroCompte. Impossible de faire le virement de $montant FCFA')</script>";
        } else {
            echo "<script type='text/javascript'> alert('Virement de $montant FCFA effectué depuis le compte $this->numeroCompte vers le compte $compte_destinataire->numeroCompte. Nouveau solde : {$this->solde} FCFA')</script>";
            }
    }

    public function afficherSolde() {
        echo "Solde actuel sur le compte $this->numeroCompte : {$this->solde} FCFA<br>";
    }
}

class OperationBancaire {
    public function depot($compte, $montant) {
        $compte->deposer($montant);
    }

    public function retrait($compte, $montant) {
        $compte->retirer($montant);
    }

    public function virement($compteSource, $compteDestination, $montant) {
        $compteSource->virement($montant, $compteDestination);
    }
}

class CreationCompteBancaire {
    public static function handleCreation($con) {

        if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST["btn_submit"])) {
            $prenom = $_POST['prenom'];
            $nom = $_POST['nom'];
            $adresse = $_POST['adresse'];
            $telephone = $_POST['telephone'];
            $solde_initial = $_POST['solde'];


            if (!empty($prenom) && !empty($nom) && !empty($adresse) && !empty($telephone) && !empty($solde_initial) && is_numeric($telephone) && is_numeric($solde_initial)) {

                $numeroCompte = self::generateNumeroCompte();


                $query = "INSERT INTO client (prenom, nom, adresse, telephone, solde, numero_compte) VALUES ('$prenom', '$nom', '$adresse', '$telephone', '$solde_initial', '$numeroCompte')";
                mysqli_query($con, $query);

                echo "<script type='text/javascript'> alert('Le compte bancaire a été créé avec succès')</script>";
            } else {
                echo "<script type='text/javascript'> alert('Veuillez renseigner des informations valides!')</script>";
            }
        }
    }

    private static function generateNumeroCompte() {
        $numeroCompte = '';
        for ($i = 0; $i < 12; $i++) { 
                $numeroCompte .= rand(0, 9);
        }
        return $numeroCompte;
    }
}

class TransactionsBancaires {
    public static function handleTransactions($con) {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            if (isset($_POST["numero_compte"])) {
                $numero_compte = trim($_POST["numero_compte"]);
            } else {
                echo "Le numéro de compte est requis.<br>";
                return;
            }


            if (isset($_POST["montant"])) {
                $montant = trim($_POST["montant"]);
            } else {
                echo "Le montant est requis.<br>";
                return;
            }


            if (isset($_POST["virement"]) && isset($_POST["numero_destinataire"])) {
                $numero_destinataire = trim($_POST["numero_destinataire"]);
            } else {
                if (isset($_POST["virement"])) {
                    echo "Le numéro de compte destinataire est requis pour un virement.<br>";
                    return;
                }
            }


            if (isset($numero_compte) && isset($montant)) {
                $compte = new CompteBancaire($numero_compte);

                if (isset($_POST["depot"])) {
                    $compte->deposer($montant);
                } elseif (isset($_POST["retrait"])) {
                    $compte->retirer($montant);
                } elseif (isset($_POST["virement"]) && isset($numero_destinataire)) {
                    if (empty($numero_destinataire)) {
                        echo "Le numéro de compte destinataire est requis pour un virement.<br>";
                        return;
                    }
                    $compte_destinataire = new CompteBancaire($numero_destinataire);
                    $compte->virement($montant, $compte_destinataire);
                }
            }
        }
    }
}



CreationCompteBancaire::handleCreation($con);


TransactionsBancaires::handleTransactions($con);
?>
