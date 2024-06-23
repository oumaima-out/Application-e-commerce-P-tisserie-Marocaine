<?php

include "../dao/daoFacture.php";

$dao = new daoFacture();

    session_start();
    if (isset($_SESSION['utilisateur'])) {
        if (isset($_SESSION['commandeId'])) {
            $idFacture = $_SESSION['commandeId'];
            echo $idFacture;
            $facture = $dao->Facturation($idFacture);
            foreach ($facture as $commandeProduit) {
                echo '<td class="col-md-6">' . $commandeProduit->nom . '</td>';
                echo '<td class="col-md-3">' . $commandeProduit->quantité . '</td>';
                echo '<td class="col-md-3">' . $commandeProduit->quantité * $commandeProduit->prix . '</td>';
            }
            if ($facture) {
                
                
                $_SESSION['facture'] = $facture;
               
    
                
              header("Location: ../view/invoice.php");
               exit();
            } else {
                echo "Facture not found for command ID: $idFacture";
         }
        }
        else {
            echo "Error: \$idFacture is null.";
        }
    
       
    } else {
        // Utilisateur non connecté, rediriger vers la page de connexion
        header("Location: ../view/connexion.php?factureV=Vcommande");
        exit();
    }
    

    
     
?>
