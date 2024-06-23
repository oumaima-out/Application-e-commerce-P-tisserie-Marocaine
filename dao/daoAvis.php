<?php
include __DIR__ . "/../model/avis.php";
class DaoAvis
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
    public function insererAvis(Avis $avis)
    {
        // Assurez-vous que votre requête correspond au nombre de colonnes dans la table
        $stm = $this->dbh->prepare("INSERT INTO avis (contenu, dateCreation, id_Utilisateur, id_Produit) VALUES (?, ?, ?, ?)");
    
        $stm->bindValue(1, $avis->getContenu());
        $stm->bindValue(2, $avis->getDateCreation());
        $stm->bindValue(3, $avis->getId_Utilisateur());
        $stm->bindValue(4, $avis->getId_Produit());
    
        $stm->execute();
    }
    

    public function findAvis($id)
    {
        $avis = null;
        $stm = $this->dbh->prepare("SELECT * FROM avis WHERE id = ?");
        $stm->bindValue(1, $id);
        $stm->execute();

        $result = $stm->fetch(PDO::FETCH_ASSOC);
        if (!empty($result)) {
            $avis = new Avis(
                $result['contenu'],
                $result['dateCreation'],
                $result['id_Utilisateur'],
                $result['id_Produit']
                
            );
        }
        return $avis;
    }

    public function findAvisByProduit($id)
    {
        $avis = null;
        $stm = $this->dbh->prepare("SELECT * FROM avis WHERE id_Produit = ?");
        $stm->bindValue(1, $id);
        $stm->execute();

        $result = $stm->fetch(PDO::FETCH_ASSOC);
        if (!empty($result)) {
            $avis = new Avis(
                $result['contenu'],
                $result['dateCreation'],
                $result['id_Utilisateur'],
                $result['id_Produit']
            );
        }
        return $avis;
    }

    public function findAvisByUtilisateur($id)
    {
        $avis = null;
        $stm = $this->dbh->prepare("SELECT * FROM avis WHERE id_Utilisateur = ?");
        $stm->bindValue(1, $id);
        $stm->execute();
        $result = $stm->fetch(PDO::FETCH_ASSOC);
        if (!empty($result)) {
            $avis = new Avis(
                $result['contenu'],
                $result['dateCreation'],
                $result['id_Utilisateur'],
                $result['id_Produit']
            );
        }
        return $avis;
    }
    public function findAllAvis(){
        $stm = $this->dbh->prepare("SELECT * FROM avis");
        $stm->execute();
        $result=$stm;
        return  $result;

    }


   
    public function deleteAvis($id)
    {
        $stm = $this->dbh->prepare("DELETE FROM avis WHERE id = ?");
        $stm->bindValue(1, $id);
        $stm->execute();
    }
}