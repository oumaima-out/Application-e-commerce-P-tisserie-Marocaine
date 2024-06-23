<?php
include "../dao/daoProduit.php";
$dao = new DaoProduit();
$result = $dao->listProduits();
$listeProd = "";

if (!empty($result) > 0) {
    //while($row = $result->fetch_assoc()) {
    //retourner chaque ligne ~ tableau
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {

        $listeProd .= "<tr>
            <td>
										<span >
											<input type=\"checkbox\" id=\"checkbox1\" name=\"options[]\" value=\"1\">
											<label for=\"checkbox1\"></label>
										</span>
									</td>
                                    <td> <img src=\"../view/" . $row["image"] . "\" alt=\"product\"></td>                    
            <td>" . $row["nom"] . "</td>
            <td>" . $row["categorie"] . "</td>
            <td>" . $row["prix"] . "</td>
            <td>
										<a href=\"#editProdModal" . $row["id"] . "\" class=\"edit\" data-toggle=\"modal\"><i class=\"material-icons\" data-toggle=\"tooltip\" title=\"Edit\">&#xE254;</i></a>
										<a href=\"#deleteEmployeeModal" . $row["id"] . "\" class=\"delete\" data-toggle=\"modal\"><i class=\"material-icons\" data-toggle=\"tooltip\" title=\"Delete\">&#xE872;</i></a>
									</td>
           
        </tr>";

        $listeProd .= '<div id="editProdModal' . $row["id"] . '" class="modal fade">
<div class="modal-dialog">
    <div class="modal-content">
        <form method="post"
        action="../controller/produitController.php?id=' . $row["id"] . '&action=modifier">
            <div class="modal-header">						
                <h4 class="modal-title">Modifier Produit</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
    <div style="display: flex; ">
            <div class="form-group "style="margin-right: 10px;">
               <label>Image</label>
               <input type="file" class="form-control" id="recipient-name"  accept=".jpg,.png,.jpeg" name="new_product_img" placeholder="Choisir image" >
        </div>
        <div class="form-group">
               <label>Nom</label>
               <input type="text" class="form-control" name="new_product_name"  value="' . $row["nom"] . '"required>
        </div>
     </div>
     <div style="display: flex; ">
            <div class="form-group" style="margin-right: 10px;">
               <label>Catégorie</label>
               <select name="new_product_category" class="form-control">
    <option ' . ($row["categorie"] == "GateauBeldi" ? 'selected' : '') . '>GateauBeldi</option>
    <option ' . ($row["categorie"] == "GateauAuMiel" ? 'selected' : '') . '>GateauAuMiel</option>
    <option ' . ($row["categorie"] == "Fekkas" ? 'selected' : '') . '>Fekkas</option>
    <option ' . ($row["categorie"] == "DattesEtSellou" ? 'selected' : '') . '>DattesEtSellou</option>
    <option ' . ($row["categorie"] == "COMPOSITIONS" ? 'selected' : '') . '>COMPOSITIONS</option>
</select>

              
        </div>
        <div class="form-group">
               <label>Prix</label>
               <input type="text" class="form-control" name="new_product_price"  value="' . $row["prix"] . '"required>
        </div>
     </div>	
     <div style="display: flex; ">
            <div class="form-group" style="margin-right: 10px;">
               <label>Description</label>
               <textarea class="form-control" name="new_product_description">' . $row["description"] . '</textarea>

        </div>
        <div class="form-group">
               <label>Ingrédients</label>
               <textarea class="form-control" name="new_product_Ingredients">' . $row["ingredients"] . '</textarea>
        </div>
     </div>	
     <div style="display: flex; ">
            <div class="form-group"  style="margin-right: 10px;">
               <label>Allergie</label>
               <textarea class="form-control" name="new_product_allergie" >' . $row["allergie"] . '</textarea>
        </div>
        <div class="form-group">
               <label>Conservation</label>
               <textarea class="form-control" name="new_product_conservation" >' . $row["conservation"] . '</textarea>
        </div>
     </div>	
     			
            </div>
            <div class="modal-footer">
                <input type="button" class="btn btn-default cancel-button" data-dismiss="modal" value="Annuler">
                <input type="submit" class="btn   confirm-add-button" value="Confirmer">
            </div>
        </form>
    </div>
</div>
</div>';
        $listeProd .= '<div id="deleteEmployeeModal' . $row["id"] . '" class="modal fade">
<div class="modal-dialog">
    <div class="modal-content">
        <form method="post"
        action="../controller/produitController.php?id=' . $row["id"] . '&action=supprimer">
            <div class="modal-header">						
                <h4 class="modal-title">Supprimer produit</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">					
                <p>"Êtes-vous sûr de vouloir supprimer ces enregistrements ?"</p>
                <!-- <p class="text-warning"><small>This action cannot be undone.</small></p> -->
            </div>
            <div class="modal-footer">
                <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                <input type="submit" class="btn btn-danger" value="Delete">
            </div>
        </form>
    </div>
</div>
</div>';
    }
}
// <td> <img src=\"img/shop/" . $row["image"] . " alt="product"></td> 
echo $listeProd;
// js/R-editProdMoal.js?id=" . $row["id"] . "