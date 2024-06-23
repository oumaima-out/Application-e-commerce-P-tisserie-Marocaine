<?php
include "../model/commande.php";
include "../model/produit.php";
include "../model/commandeProduit.php";


class DaoCommande
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
    public function insererCommande(Commande $commande)
    {
        $stm = $this->dbh->prepare("INSERT INTO commande(adresse ,dateCreation, etat, villeLivraison, dateLivraison,id_user) VALUES (?, ?, ?, ?, ?, ?)");

        $stm->bindValue(1, $commande->getAdresse());
        $stm->bindValue(2, $commande->getDateCreation());
        $stm->bindValue(3, $commande->getEtat());
        $stm->bindValue(4, $commande->getVilleLivraison());
        $stm->bindValue(5, $commande->getDateLivraison());
        $stm->bindValue(6, $commande->getIdUser());

        $stm->execute();
        $idCommande = $this->dbh->lastInsertId();
        return $idCommande;
    }

    public function afficherComTimeline($idUser)
    {
        $stm = $this->dbh->prepare("SELECT * FROM  commande WHERE etat != 'Livrée' AND id_user= $idUser");
        $stm->execute();
        $result = $stm;
        return  $result;
    }

    public function insererCommandeProduit(CommandeProduit $commandeProduit)
    {
        $stm = $this->dbh->prepare("INSERT INTO commande_produit(quantite, id_Produit, numCommande_Commande) VALUES (?, ?, ?)");

        $stm->bindValue(1, $commandeProduit->getQuantite());
        $stm->bindValue(2, $commandeProduit->getIdProduit());
        $stm->bindValue(3, $commandeProduit->getNumCommande());

        $stm->execute();
    }

    public function countCommandes($jour, $etat)
    {
        $stm = $this->dbh->prepare("SELECT COUNT(*) as total FROM commande WHERE DATE(dateCreation) = ? AND commande.etat = ?; ");
        $stm->bindValue(1, $jour);
        $stm->bindValue(2, $etat);
        $stm->execute();
        $result = $stm->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }

    public function countCaisse()
    {
        $stm = $this->dbh->prepare("SELECT * 
        FROM commande
        JOIN commande_produit ON commande.numCommande = commande_produit.numCommande_Commande
        JOIN produit ON commande_produit.id_Produit = produit.id
        WHERE commande.etat = 'Livrée';");
        $stm->execute();
        $results = $stm->fetchAll(PDO::FETCH_ASSOC); // Utiliser fetchAll pour récupérer toutes les lignes

        $caisse = 0;
        foreach ($results as $row) {
            $caisse += ($row['prix'] * $row['quantite']);
        }
        return $caisse;
    }

    public function countVente($mois, $jour)
    {
        $stm = $this->dbh->prepare("SELECT * 
        FROM commande
        JOIN commande_produit ON commande.numCommande = commande_produit.numCommande_Commande
        JOIN produit ON commande_produit.id_Produit = produit.id
        WHERE MONTH(commande.dateLivraison) = ? AND DAY(commande.dateLivraison) = ? AND commande.etat = 'Livrée';");

        $stm->bindValue(1, $mois);
        $stm->bindValue(2, $jour);
        $stm->execute();
        $results = $stm->fetchAll(PDO::FETCH_ASSOC);
        $vente = 0;
        foreach ($results as $row) {
            $vente += ($row['prix'] * $row['quantite']);
        }
        return $vente;
    }

    public function countLast3Days()
    {
        $liste = [];
        $jour  = intval(date('d'));
        $moisPrecedent = intval(date('m')) - 1;
        if ($moisPrecedent === 0) {
            $moisPrecedent = 12;
        }
        $nombreJours = cal_days_in_month(CAL_GREGORIAN, $moisPrecedent, date('Y'));
        if ($jour == 1) {

            $liste = [1, $nombreJours, $nombreJours - 1];
        } elseif ($jour == 2) {
            $liste = [1, 2, $nombreJours];
        } else {
            $liste = [$jour, $jour - 1, $jour - 2];
        }
        return $liste;
    }


    public function listeCommandes()
    {
        $stm = $this->dbh->prepare("SELECT * FROM Commande");
        $stm->execute();
        $result = $stm;
        return  $result;
    }

    public function liste_Prod_Commande($numCommande)
    {
        $stm = $this->dbh->prepare("SELECT * 
                                FROM commande 
                                JOIN commande_produit ON commande.numCommande = commande_produit.numCommande_Commande
                                JOIN produit ON commande_produit.id_Produit = produit.id 
                                WHERE commande.numCommande = :numCommande");

        $stm->bindParam(':numCommande', $numCommande, PDO::PARAM_INT);
        $stm->execute();
        return $stm;
    }

    public function liste_Prod($numCommande, $etatsAutorises = array('A')) {
        // Assurez-vous que $etatsAutorises est un tableau
        if (!is_array($etatsAutorises)) {
            $etatsAutorises = array($etatsAutorises);
        }
    
        // Utilisez implode pour générer la partie IN de la requête SQL
        $etatsCondition = implode("','", $etatsAutorises);
    
        // Modification de la requête pour inclure la condition sur l'état
        $query = "SELECT * 
                  FROM commande 
                  JOIN commande_produit ON commande.numCommande = commande_produit.numCommande_Commande
                  JOIN produit ON commande_produit.id_Produit = produit.id 
                  WHERE commande.numCommande = :numCommande AND etat IN ('$etatsCondition')";
    
        $stm = $this->dbh->prepare($query);
        $stm->bindParam(':numCommande', $numCommande, PDO::PARAM_INT);
        $stm->execute();
    
        return $stm;
    }

    public function Prix_Commande($numCommande)
    {
        $stm = $this->dbh->prepare("SELECT * 
                                FROM commande 
                                JOIN commande_produit ON commande.numCommande = commande_produit.numCommande_Commande
                                JOIN produit ON commande_produit.id_Produit = produit.id 
                                WHERE commande.numCommande = :numCommande");

        $stm->bindParam(':numCommande', $numCommande, PDO::PARAM_INT);
        $stm->execute();
        $results = $stm->fetchAll(PDO::FETCH_ASSOC);
        $Prix_Commande = 0;
        foreach ($results as $row) {
            $Prix_Commande += ($row['prix'] * $row['quantite']);
        }
        return  $Prix_Commande;
    }



    public function getAll($orderBy = null, $idUser)
    {
        if ($orderBy === 'Total') {
            $query = "SELECT *, (SELECT SUM(prix * quantite) FROM commande_produit JOIN produit ON commande_produit.id_Produit = produit.id WHERE numCommande_Commande = commande.numCommande) AS Prix_Commande FROM commande WHERE id_user = $idUser AND etat = 'Livrée' ORDER BY Prix_Commande DESC";
        } else {
            $query = "SELECT * FROM commande WHERE etat = 'Livrée' AND id_user = $idUser ";
            if ($orderBy === 'dateLivraison') {
                $query .= " ORDER BY dateLivraison DESC";
            } elseif ($orderBy === 'dateCreation') {
                $query .= " ORDER BY dateCreation DESC";
            }
        }

        $stm = $this->dbh->prepare($query);
        $stm->execute();
        $results = $stm->fetchAll(PDO::FETCH_ASSOC);

        return $results;
    }

    public function filter($dateC, $dateL, $etat)
    {
        // Start building the SQL query
        $sql = "SELECT * FROM commande WHERE 1";

        // Check and add filters for creation date
        if (!empty($dateC)) {
            $sql .= " AND dateCreation = :dateC";
        }

        // Check and add filters for delivery date
        if (!empty($dateL)) {
            $sql .= " AND dateLivraison = :dateL";
        }

        // Check and add filters for state
        if (!empty($etat)) {
            $sql .= " AND etat = :etat";
        }

        // Prepare the SQL statement
        $stmt = $this->dbh->prepare($sql);

        // Bind parameters if they are set
        if (!empty($dateC)) {
            $stmt->bindParam(':dateC', $dateC);
        }

        if (!empty($dateL)) {
            $stmt->bindParam(':dateL', $dateL);
        }

        if (!empty($etat)) {
            $stmt->bindParam(':etat', $etat);
        }

        // Execute the query
        $stmt->execute();

        // Fetch and return the results
        return $stmt;
    }

    public function Modifier_Status($numCommande, $status)
    {

        $stm = $this->dbh->prepare("UPDATE commande SET etat = :status WHERE numCommande = :numCommande");
        $stm->bindParam(':numCommande', $numCommande, PDO::PARAM_INT);
        $stm->bindParam(':status', $status, PDO::PARAM_STR);
        $stm->execute();
    }
}
