<?php
include __DIR__ . "/../model/utilisateur.php";


class DaoUtilisateur
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
    public function save(Utilisateur $utilisateur)
    {
        $stm = $this->dbh->prepare("INSERT INTO utilisateur (nom,prenom,email,tel,genre,mdp,ville,role) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stm->bindValue(1, $utilisateur->getNom());
        $stm->bindValue(2, $utilisateur->getPrenom());
        $stm->bindValue(3, $utilisateur->getEmail());
        $stm->bindValue(4, $utilisateur->getGenre());
        $stm->bindValue(5, $utilisateur->getTel() );
        $stm->bindValue(6, $utilisateur->getMdp() );
        $stm->bindValue(7, $utilisateur->getVille() );
        $stm->bindValue(8, $utilisateur->getRole());
        echo $stm->queryString;
        print_r($stm->debugDumpParams());
        $stm->execute();
        $utilisateurId = $this->dbh->lastInsertId();

var_dump($utilisateurId);
        $utilisateur->setId($utilisateurId);
    }

    public function findUtilisateur($email, $mdp)
    {
        $stm = $this->dbh->prepare("SELECT * FROM utilisateur WHERE email=? AND mdp=?");
        $stm->bindValue(1, $email);
        $stm->bindValue(2, $mdp);
        $stm->execute();
        $utilisateur = null;
        $result = $stm->fetch(PDO::FETCH_ASSOC);
        if (!empty($result)) {
            $utilisateur = new Utilisateur(
                $result['nom'],
                $result['prenom'],
                $result['email'],
                $result['tel'],
                $result['genre'],
                $result['mdp'],
                $result['ville'],
                $result['role'],
                $result['id']
            );
        }
        return $utilisateur;
    }
    
    public function findUtilisateurById($id)
    {
        $stm = $this->dbh->prepare("SELECT * FROM utilisateur WHERE id=?");
        $stm->bindValue(1, $id);
        $stm->execute();
        $utilisateur = null;
        $result = $stm->fetch(PDO::FETCH_ASSOC);
        if (!empty($result)) {
            $utilisateur = new Utilisateur($result['id'],$result['nom'],$result['prenom'],$result['email'],$result['tel'],$result['genre'], $result['mdp'], $result['ville'],$result['role']);
        }
        
        return $utilisateur;
    }
    public function findUtilisateurByIdAv($id)
{
    try {
        $stm = $this->dbh->prepare("SELECT * FROM utilisateur WHERE id=?");
        $stm->bindValue(1, $id);
        $stm->execute();

        if ($stm->rowCount() > 0) {
            $result = $stm->fetch(PDO::FETCH_ASSOC);
            $utilisateur = new Utilisateur($result['id'],
                $result['nom'],
                $result['prenom'],
                $result['email'],
                $result['tel'],
                $result['genre'],
                $result['mdp'],
                $result['ville'],
                $result['role']
            );
            return $utilisateur;
        } else {
            // Handle the case where no user is found with the given ID
            return null;
        }
    } catch (PDOException $e) {
        // Handle any exceptions that might occur during the query execution
        echo "Error: " . $e->getMessage();
        return null;
    }
}


    public function countUsers()
    {
        $stm = $this->dbh->prepare("SELECT COUNT(*) as total FROM utilisateur WHERE role = 'client'");
        $stm->execute();
        $result = $stm->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }



}

?>

