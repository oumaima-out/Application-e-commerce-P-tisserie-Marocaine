<?php
include "../dao/daoCommande.php";

//include "../dao/daoCommandeProduit.php";

$action = $_GET['action'];
$daoC = new DaoCommande();



switch ($action) {   
    case 'insertionCommande':
        session_start();
        $villeLivraison = $_POST['ville'];
        $adresse = $_POST['adresse'];
        $dateCreation = date("Y-m-d H:i:s");
        $dateLivraison = "";
        $etat = "en attente";
        if (isset($_SESSION['id'])) {
        $id= $_SESSION['id'];
        echo $id;

     }
       
        if (isset($villeLivraison, $adresse)) {
                $commande = new Commande($dateCreation, $dateLivraison, $etat, $villeLivraison, $adresse,$id);
                $numCommandee = $daoC->insererCommande($commande);
        }

        
        $idOfProduitt = $_SESSION['idOfProductt'];
        $quantite = $_POST['quantite'];

        if (isset($idOfProduitt, $quantite, $numCommandee)) {
            $commandeProduit = new CommandeProduit($quantite,$idOfProduitt,$numCommandee);
            $daoC->insererCommandeProduit($commandeProduit);
            $_SESSION['commandeId']=$numCommandee;
            header('location: controlleFacture.php');  
        }
        // else header('location: ../view/detailProduit.php');   

        break;
    case 'confirmationPanier' :
        session_start();
        $villeLivraison = $_POST['ville'];
        $adresse = $_POST['adresse'];
        $dateCreation = date("Y-m-d H:i:s");
        $dateLivraison = "";
        $etat = "en attente";
        if (isset($_SESSION['id'])) {
            $idUtilisateur = $_SESSION['id'];
        }
      
        
        if (isset($villeLivraison, $adresse)) {
                $commande = new Commande($dateCreation, $dateLivraison, $etat, $villeLivraison, $adresse, $idUtilisateur);
                $numCommandee = $daoC->insererCommande($commande);
        }
        $villeLivraison = $_POST['ville'];
        $adresse = $_POST['adresse'];

        $donneesSupplementaires = $_POST['donneesSupplementaires'];

    // Décoder la chaîne JSON en tableau PHP
    $cartItems = json_decode($donneesSupplementaires, true);
    
    // Parcourir le tableau et extraire les valeurs d'ID et de quantité
    foreach ($cartItems as $item) {
        $idOfProduit = $item['id'];
        $quantite = $item['quantity'];
        $commandeProduit = new CommandeProduit($quantite,$idOfProduit,$numCommandee);
        $daoC->insererCommandeProduit($commandeProduit);
        $_SESSION['commandeId']=$numCommandee;
        header('location: controlleFacture.php');  
    }
    break;

    case 'modifier_Status':
        $id=$_GET["numCommande"];
        $status = $_POST['status'];
        if (isset($status)) {
            $daoC->Modifier_Status($id,$status);
            header('location: ../adminhub/liste-commandes.php?msg=le status de la commande "' . $id. '" est modifié avec succès');
        }
        break;

}
