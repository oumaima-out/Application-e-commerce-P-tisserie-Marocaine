
<?php
function getBadgeClass($etat)
{
    switch ($etat) {
        case 'En attente':
            return "badge badge-info";
        case 'En cours de traitement':
            return "badge badge-warning";
        case 'Traitée':
            return "badge badge-success";
        case 'En cours de livraison':
            return 'badge badge-primary';
        default:
            return "badge badge-secondary";
    }
}
?>


<?php
include "../dao/daoCommande.php";
//include "../dao/daoUtilisateur.php";
$dao = new DaoCommande();
$daoU=new DaoUtilisateur();
if(isset($_POST['dC'])||isset($_POST['dL'])){
    $listeCommandes = $dao->filter($_POST['dC'],$_POST['dL'],$_POST['status']);
}
else $listeCommandes = $dao->listeCommandes();

$LC = "";
if (!empty($listeCommandes) > 0) {
    while ($row = $listeCommandes->fetch(PDO::FETCH_ASSOC)) {
        //tableau

        $LC .= '<tr>
            <td>
										<span >
											<input type="checkbox" id="checkbox1" name="options[]" value="1">
											<label for="checkbox1"></label>
										</span>
									</td>
                                    <td> ' . $row["numCommande"] . '</td>                    
            <td>' . $row["dateCreation"] . '</td>
            <td>' . $row["dateLivraison"] . '</td>
            <td>' . $row["villeLivraison"] . '</td>
            <td><span class="' . getBadgeClass($row["etat"]) . '" >' . $row["etat"] . '</span></td>
            <td>                       
            <a href="#detailComdModal' . $row["numCommande"] . '" class="read" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Produits commandés"> &#x1F441;</i></a>
										<a href="#editStatusModal' . $row["numCommande"] . '" class="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Modifier etat">&#xE254;</i></a>
										
									</td>
           
        </tr>';

        //modal detail commande
        $LC .= '<div id="detailComdModal' . $row["numCommande"] . '" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                
                    <div class="modal-header">						
                        <h4 class="modal-title">Liste des produits</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
            <div style="display: flex; ">
            <div class="main"> ';

        $liste_Prod_Com = $dao->liste_Prod_Commande($row["numCommande"]);
        if (!empty($liste_Prod_Com) > 0) {
            while ($produit = $liste_Prod_Com->fetch(PDO::FETCH_ASSOC)) {
                $LC .= '<div class="row row-main ">
            <div class="col-3"> <img class="img-fluid" src="../view/' . $produit["image"] . '" alt="product"> </div>
            <div class="col-6">
                <div class="row d-flex">
                    <p><b>' . $produit["nom"] . '</p>
                </div>
                <div class="row d-flex">
                    <p class="text-muted">Quantité: ' . $produit["quantite"] . 'Kg</p>
                </div>
            </div>
            <div class="col d-flex justify-content-end">
                <p><b>' . $produit["prix"] . ' MAD</b></p>
            </div>

        </div>
        ';
            }
        }

        $total = $dao->Prix_Commande($row["numCommande"]);
        $LC .= '<hr>
        <div class="total">
            <div class="row">
                <div class="col"> <b> Total:</b> </div>
                <div class="col d-flex justify-content-end"> <b>' . $total . ' MAD</b> </div>
            </div>
        </div>
    </div>
                         
                    </div>
                   
               
            </div>
        </div>
        </div>
        </div>';
       
        $client=$daoU->findUtilisateurById($row['id_user']);
        $LC .= '<div id="editStatusModal' . $row["numCommande"] . '" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered justify-content-center " role="document">
        <div class="modal-content  border-0 mx-3">   
            <div class="modal-body  p-0">
                <div class="card border-0">
                    <div class="card-header pb-0  bg-white">
                        <div class="row">
                            <div class="col-10"><h5 class="font-weight-bold mt-2">ID de commande : #' . $row["numCommande"] . ' </h5> </div> 
                            <div class="col-2 my-auto"> <span class="text-right"><button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button></span></div>
                        </div>
                    </div>
                    <div class="card-body">
                    <div class="title">Client : '.$client->getPrenom() .'</div>              
                    <div class="text-muted text-center"> <i class="fas fa-envelope"></i> '.$client->getEmail().' <br>
                    <i class="fas fa-phone"></i> '.$client->getTel().'<br>
                    <i class="fas fa-map-marker-alt"></i> '.$row['adresse'].' </div>

                <div class="tracking">
              <div class="title">Progression </div>
          </div>
          <div class="progress-track">
              <ul id="progressbar">';
        $status = $row["etat"];
        if ($status == "En attente") {
            $LC .= '<li class="step0 active " id="step1">En attente</li>
               <li class="step0  text-center" id="step2">En cours de traitement</li>
               <li class="step0 text-center" id="step3">Traitée</li>
               <li class="step0 text-center" id="step4">En cours de livraison</li>
               <li class="step0 text-right" id="step5">Livrée</li>';
        } else if ($status == "En cours de traitement") {
            $LC .= '<li class="step0 active " id="step1">En attente</li>
                <li class="step0 active text-center" id="step2">En cours de traitement</li>
                <li class="step0 text-center" id="step3">Traitée</li>
                <li class="step0 text-center" id="step4">En cours de livraison</li>
                <li class="step0 text-right" id="step5">Livrée</li>';
        } else if ($status == "Traitée") {
            $LC .= '<li class="step0 active " id="step1">En attente</li>
                <li class="step0 active text-center" id="step2">En cours de traitement</li>
                <li class="step0 active text-center" id="step3">Traitée</li>
                <li class="step0 text-center" id="step4">En cours de livraison</li>
                <li class="step0 text-right" id="step5">Livrée</li>';
        } else if ($status == "En cours de livraison") {
            $LC .= '<li class="step0 active" id="step1">En attente</li>
                <li class="step0 active text-center" id="step2">En cours de traitement</li>
                <li class="step0 active text-center" id="step3">Traitée</li>
                <li class="step0 active text-center" id="step4">En cours de livraison</li>
                <li class="step0 text-right" id="step5">Livrée</li>';
        } else if ($status == "Livrée") {
            $LC .= '<li class="step0 active" id="step1">En attente</li>
                <li class="step0 active text-center" id="step2">En cours de traitement</li>
                <li class="step0 active text-center" id="step3">Traitée</li>
                <li class="step0 active text-center" id="step4">En cours de livraison</li>
                <li class="step0 active text-right" id="step5">Livrée</li>';
        }

        $LC .= '</ul>
          </div>
          <form  method="post"
          action="../controller/commandeController.php?numCommande=' . $row["numCommande"] . '&action=modifier_Status"">
                  <div class="form-group">
                    <label for="status">Modifier l\'état</label>                    
                      <select id="country" name="status" class="custom-select">
               
                
                <option value="En attente">En attente</option>
                <option value="En cours de traitement">En cours de traitement</option>
                <option value="Traitée">Traitée</option>
                <option value="En cours de livraison"> En cours de livraison</option>
                <option value="Livrée">Livrée</option>
               </select>
               <div class="row justify-content-center mt-4">
                        <div class="col-6">
                        <button type="submit" class="btn btn-outline-success btn-block font-weight-bold text-dark" >Valider</button>
                        </div>
                        </div>
                    </form>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>';
    }
}


echo $LC;
?>
