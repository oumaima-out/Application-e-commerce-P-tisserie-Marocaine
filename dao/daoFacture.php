<?php
include "../model/commande.php";
include "../model/commandeProduit.php";
include "../model/produit.php";
class daoFacture
{
    private $dbh;
    public function __construct()
     {
        try{
            $this->dbh =new PDO ('mysql:host=localhost;dbname=patisserie',"root","");

        }catch (PDOOException $e){
            printf("Erreur !:" .$e->getMessage(). "<br/>");
            die();
        }
     }

     function __destruct(){
        $this->dbh=null; 
     }
     function Facturation($numCom) {
        try {
            $sql = "SELECT * FROM commande_produit AS CP 
                    JOIN commande AS C ON CP.numCommande_Commande = C.numCommande  
                    JOIN produit AS P ON CP.id_Produit = P.id
                    WHERE C.numCommande = :numCom"; 
            $sth = $this->dbh->prepare($sql);
            $sth->bindParam(':numCom', $numCom, PDO::PARAM_INT);
            $sth->execute();
    
            $result = $sth->fetchAll(PDO::FETCH_CLASS);
            return $result;
        } catch (PDOException $e) {
            echo "Erreur !: " . $e->getMessage() . "<br/>";
            return false;
        }
    }
    }
?>
       
     

    