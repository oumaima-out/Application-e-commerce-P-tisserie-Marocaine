<?php
include "../dao/daoProduit.php";
$action = $_GET['action'];
$dao = new DaoProduit();
switch ($action) {
    case 'ajouter':
        $nom = $_POST['product_name'];
        $categorie = $_POST['product_category'];
        // chemin de l'image
        $image ="img/produit/". $_POST['product_img'];
        // $chemin="../img/produit/".$categorie."/".$image;
        $prix = $_POST['product_price'];
        $description = $_POST['product_description'];
        $ingredients = $_POST['product_Ingredients'];
        $allergie = $_POST['product_allergie'];

        $conservation = $_POST['product_conservation'];

        if (isset($nom, $categorie, $image, $prix, $description, $ingredients, $allergie, $conservation)) {
            $produit = new Produit($nom, $categorie, $image, $prix, $description, $ingredients, $allergie, $conservation);
            $dao->InsererProduit($produit);
            header('location: ../adminhub/liste-produits.php?msg=le produit "' . $nom . '" est ajouté avec succès');
        }
        break;
    case 'modifier':
        $id=$_GET["id"];
        $imgP=($dao->findProduct($id))->getImage();
       // $imgP=$_GET["id"];
        $nom = $_POST['new_product_name'];
        $categorie = $_POST['new_product_category'];
        if(!empty($_POST['new_product_img'])){
            $image = "img/produit/".$_POST['new_product_img'];
        }
        else  $image=$imgP;
        $prix = $_POST['new_product_price'];
        $description = $_POST['new_product_description'];
        $ingredients = $_POST['new_product_Ingredients'];
        $allergie = $_POST['new_product_allergie'];
        $conservation = $_POST['new_product_conservation'];
        if (isset($nom, $categorie, $image, $prix, $description, $ingredients, $allergie, $conservation)) {
            $NewProduit = new Produit($nom, $categorie, $image, $prix, $description, $ingredients, $allergie, $conservation);
            $dao->modifierProduit($NewProduit,$id);
            header('location: ../adminhub/liste-produits.php?msg=le produit "' . $nom . '" est modifié avec succès');
        }
        break;
    case 'supprimer':
        $id=$_GET["id"];
        $dao->supprimerProduit($id);
        header('location: ../adminhub/liste-produits.php?msg=le produit  est supprimé avec succès');
}
