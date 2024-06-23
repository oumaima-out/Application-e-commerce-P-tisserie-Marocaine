<?php
include "../model/commandeProduit.php";

class DaoCommandeProduit
{

    private $dbh;

    public function __construct()
    {
        try {
            $this->dbh = new PDO('mysql:host=localhost;dbname=patisserie', "root", "");
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage() . "<br/>";
            die();
        }
    }

    public function insererCommandeProduit(CommandeProduit $commandeProduit)
    {
        $stm = $this->dbh->prepare("INSERT INTO commande_produit(quantite, id_Produit, numCommande_Commande) VALUES (?, ?, ?)");

        $stm->bindValue(1, $commandeProduit->getQuantite());
        $stm->bindValue(2, $commandeProduit->getIdProduit());
        $stm->bindValue(3, $commandeProduit->getNumCommande());

        $stm->execute();
    }

    // public function findCommande($email, $mdp)
    // {
    //     $utilisateur = null;
    //     $stm = $this->dbh->prepare("SELECT * FROM commande");
    //     $stm->execute();

    //     $result = $stm->fetch(PDO::FETCH_ASSOC);
    //     if (!empty($result)) {
    //         $commande = new Commande(
    //             $result['numCommande'],
    //             $result['dateCreation'],
    //             $result['dateLivraison'],
    //             $result['etat'],
    //             $result['villeLivraison']
    //         );
    //     }
    //     return $commande;
    // }

}

?>

