<?php
 include "dao/daoProduit.php";
include "dao/daoUtilisateur.php";
include "dao/daoAvis.php";
$daov = new DaoAvis();
$dao = new DaoProduit();
$daoU=new DaoUtilisateur();
$allProducts = $dao->listProduits();
$allAvis = $daov->findAllAvis();
session_start();
?>
<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Cake Template">
    <meta name="keywords" content="Cake, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>HLOU'IN</title>

    <!-- logo -->
    <link rel="icon" href="view/img/logo.png">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <!-- Css Styles -->
    <link rel="stylesheet" href="view/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="view/css/flaticon.css" type="text/css">
    <link rel="stylesheet" href="view/css/barfiller.css" type="text/css">
    <link rel="stylesheet" href="view/css/magnific-popup.css" type="text/css">
    <link rel="stylesheet" href="view/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="view/css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="view/css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="view/css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="view/css/slicknav.min.css" type="text/css">

    <link rel="stylesheet" href="view/css/styleTotale.css" type="text/css">
    <link rel="stylesheet" href="view/stylePanier.css" type="text/css">

    <style>
        .custom-border {
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 0px;
            padding: 10px;
            width: 150px;
        }

        .custom-border-2 {
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 0px;
            padding: 10px;
            width: 350px;
        }
    </style>

</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Offcanvas Menu Begin -->
    <div class="offcanvas-menu-overlay"></div>
    <div class="offcanvas-menu-wrapper">

        <div class="offcanvas__logo">
            <a href="./index.html"><img src="view/img/logo.png" alt=""></a>
        </div>
        <div id="mobile-menu-wrap"></div>
        <div class="offcanvas__option">
            <ul>
                <li><a href="#">Sign in</a> <span class="arrow_carrot-down"></span></li>
            </ul>
        </div>
    </div>
    <!-- Offcanvas Menu End -->

    <!-- Header Section Begin -->
    <header class="header">
        <div class="header__top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="header__top__inner">
                            <div class="header__top__left">
                                <?php
                            
                             if (isset($_SESSION["utilisateur"])) {
                                    $utilisateur = $_SESSION['utilisateur'];
                                   // Check if the user is logged in
                                   // If the user is logged in, display the "Se déconnecter" button
                                    if ($utilisateur != null) {
                                        echo '
                                            <ul>
                                                <li>Bienvenue ' . $utilisateur->getPrenom() . '</li>
                                            <li><a href="controller/utilisateurController.php?action=deconnexion">Se déconnecter</a></li>
                                            </ul>';
                                    } 
                                } else {
                                    // If the user is not logged in, display the "Se connecter" button
                                    echo '
                                        <ul>
                                            <li><a href="view/connexion.php">Se connecter</a> </li>
                                        </ul>';
                                }
                                ?>
                            </div>
                            <div class="header__logo">
                                <a href="./index.html"><img src="view/img/logo.png" alt=""></a>
                            </div>

                            <div class="header__top__right">
                                <div class="header__top__right__cart">
                                    <a href="#" data-toggle="modal" data-target="#myModal"><img
                                            src="view/img/icon/cart.png" alt=""> <span class="cart-count">0</span></a>
                                    <p>Mon panier</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="canvas__open"><i class="fa fa-bars"></i></div>
            </div>
        </div>
    </header>
    <!-- Header Section End -->

    <!-- Hero Section Begin -->
    <section class="hero">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <nav class="hero__menu mobile-menu">
                        <ul>
                            <li class="active"><a href="../index.php">Accueil</a></li>
                            <li><a href="view/about.php">A propos</a></li>

                            <li><a href="view/contact.php">Contact</a></li>
                            <li><a href="view/commandesClient.php">Mes commandes</a></li>

                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <div class="hero__item set-bg">

            <div class="video-container">

                <video class="back_video" autoplay loop muted playsinline>
                    <source src="view/img/hero/hero-1.mp4" type="video/mp4">
                    Votre navigateur ne prend pas en charge la balise vidéo.
                </video>

            </div>



            <div class="container"
                style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 2; "">
                <div class=" row d-flex justify-content-center">
                <div class="col-lg-8">
                    <div class="hero__text">
                        <h2>Savourez la douceur de la tradition marocaine à chaque bouchée !</h2>
                        <a href="#product-section" class="primary-btn">nos produits</a>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>


    <!-- Hero Section End -->



    <!-- Categories Section Begin -->
    <div class="categories about spad">
        <div class="container">
            <div class="row">

                <div class="categories__slider owl-carousel">
                    <div class="categories__item" data-category="GateauBeldi">
                        <div class="categories__item__icon">

                            <span class="flaticon-029-cupcake-3"></span>
                            <h5>Gateaux beldi</h5>

                        </div>
                    </div>
                    <div class="categories__item" data-category="GateauAuMiel">
                        <div class="categories__item__icon">
                            <span class="flaticon-034-chocolate-roll"></span>
                            <h5>Gateaux au meil</h5>
                        </div>
                    </div>
                    <div class="categories__item" data-category="Fekkas">
                        <div class="categories__item__icon">
                            <span class="flaticon-005-pancake"></span>
                            <h5>Fekkas</h5>
                        </div>
                    </div>
                    <div class="categories__item" data-category="DattesEtSellou">
                        <div class="categories__item__icon">
                            <span class="flaticon-030-cupcake-2"></span>
                            <h5>Dattes et sellou</h5>
                        </div>
                    </div>
                    <div class="categories__item" data-category="COMPOSITIONS">
                        <div class="categories__item__icon">
                            <span class="flaticon-006-macarons"></span>
                            <h5>COMPOSITIONS</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Categories Section End -->

    <!-- Product Section Begin -->
    <section id="product-section" class="product spad general-product">
        <div class="container">
            <div class="row">
                <?php
                // Deserialize $allProducts from the URL parameter
                // Assuming you have fetched the product data from the database and stored it in an array called $allProducts
                while($product=$allProducts->fetch(PDO::FETCH_ASSOC)) {
                    $image = $product['image'];
                    $name = $product['nom'];
                    $price = $product['prix'];
                    $category = $product['categorie'];
                    $idOfProduit = $product['id'];
        
                    if ($category == "GateauBeldi" && $image == "img/produit/Corne_de_gazelle_classique.jpg") {
                        echo '
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="product__item">
                                <div class="product__item__pic set-bg" data-setbg="view/' . $image . '">
                                    <div class="product__label">
                                        <span>' . $name . '</span>
                                    </div>
                                </div>
                                <div class="product__item__text">
                                    <h6><a href="#">' . $name . '</a></h6>
                                    <div class="product__item__price">' . $price . ' MAD pour 1Kg</div>
                                    <div class="cart_add">
                                    <a href="view/detailProduit.php?idOfProduit=' . $idOfProduit . '">Commander</a>&nbsp;&nbsp;&nbsp;
                                    <a href="#" class="addToCart" data-id="' . $idOfProduit . '" data-image="'.$image.'"  data-name="'.$name.'" data-price="'.$price.'" data-category="'.$category.'" data-quantité="1" data-priceUnitaire="'.$price.'">Ajouter</a>


                                    </div>
                                </div>
                            </div>
                        </div>';
                    }
            
                if ($category == "GateauAuMiel" && $image == "img/produit/1.jpg") {
                    echo '
                    <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="product__item">
                    <div class="product__item__pic set-bg" data-setbg="view/' . $image . '">
                    <div class="product__label">
                    <span>' . $name . '</span>
                    </div>
                    </div>
                    <div class="product__item__text">
                    <h6><a href="#">' . $name . '</a></h6>
                    <div class="product__item__price p-1 ml-5">' . $price . ' MAD pour 1Kg</div>
                        <div class="cart_add">
                        <a href="view/detailProduit.php?idOfProduit=' . $idOfProduit . '">Commander</a>&nbsp;&nbsp;&nbsp;
                        <a href="#" class="addToCart" data-id="' . $idOfProduit . '" data-image="'.$image.'"  data-name="'.$name.'" data-price="'.$price.'" data-category="'.$category.'" data-quantité="1" data-priceUnitaire="'.$price.'">Ajouter</a>
                        

                       
                   </div>
                   </div>
                   </div>
                   </div>';
                }
                if ($category == "Fekkas" && $image == "img/produit/fekkas1.jpg") {
                    echo '
                    <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="product__item">
                    <div class="product__item__pic set-bg" data-setbg="view/' . $image . '">
                    <div class="product__label">
                    <span>' . $name . '</span>
                    </div>
                    </div>
                    <div class="product__item__text">
                    <h6><a href="#">' . $name . '</a></h6>
                    <div class="product__item__price p-1 ml-5">' . $price . ' MAD pour 1Kg</div>
                        <div class="cart_add">
                        <a href="view/detailProduit.php?idOfProduit=' . $idOfProduit . '">Commander</a>&nbsp;&nbsp;&nbsp;
                        <a href="#" class="addToCart" data-id="' . $idOfProduit . '" data-image="'.$image.'"  data-name="'.$name.'" data-price="'.$price.'" data-category="'.$category.'" data-quantité="1" data-priceUnitaire="'.$price.'">Ajouter</a>
                        </div>
                   </div>
                   </div>
                   </div>';
                }
                if ($category == "DattesEtSellou" && $image == "img/produit/d1.jpg") {
                    echo '
                    <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="product__item">
                    <div class="product__item__pic set-bg" data-setbg="view/' . $image . '">
                    <div class="product__label">
                    <span>' . $name . '</span>
                    </div>
                    </div>
                    <div class="product__item__text">
                    <h6><a href="#">' . $name . '</a></h6>
                    <div class="product__item__price p-1 ml-5">' . $price . ' MAD pour 1Kg</div>
                        <div class="cart_add">
                        <a href="view/detailProduit.php?idOfProduit=' . $idOfProduit . '">Commander</a>&nbsp;&nbsp;&nbsp;
                        <a href="#" class="addToCart" data-id="' . $idOfProduit . '" data-image="'.$image.'"  data-name="'.$name.'" data-price="'.$price.'" data-category="'.$category.'" data-quantité="1" data-priceUnitaire="'.$price.'">Ajouter</a>
                        </div>
                   </div>
                   </div>
                   </div>';
                }
                if ($category == "COMPOSITIONS" && $image == "img/produit/c1.jpg") {
                    echo '
                    <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="product__item">
                    <div class="product__item__pic set-bg" data-setbg="view/' . $image . '">
                    <div class="product__label">
                    <span>' . $name . '</span>
                    </div>
                    </div>
                    <div class="product__item__text">
                    <h6><a href="#">' . $name . '</a></h6>
                    <div class="product__item__price p-1 ml-5">' . $price . ' MAD pour 1Kg</div>
                        <div class="cart_add">
                        <a href="view/detailProduit.php?idOfProduit=' . $idOfProduit . '">Commander</a>&nbsp;&nbsp;&nbsp;
                        <a href="#" class="addToCart" data-id="' . $idOfProduit . '" data-image="'.$image.'"  data-name="'.$name.'" data-price="'.$price.'" data-category="'.$category.'" data-quantité="1" data-priceUnitaire="'.$price.'">Ajouter</a>
                        </div>
                   </div>
                   </div>
                   </div>';
                }
                
            }
       
?>
            </div>
        </div>
    </section>
    <!-- Product Section End -->
    <!-- Product Section Begin gatteau beldi -->
    <section class="product spad category-product" id="GateauBeldi">
        <div class="container">
            <div class="row">
                <?php
            $allProducts->execute();
            while($product=$allProducts->fetch(PDO::FETCH_ASSOC)) {
                    $image = $product['image'];
                    $name = $product['nom'];
                    $price = $product['prix'];
                    $category = $product['categorie'];
                    $idOfProduit = $product['id'];
        
                    if ($category == "GateauBeldi" ) {
                        echo '
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="product__item">
                                <div class="product__item__pic set-bg" data-setbg="view/' . $image . '">
                                    <div class="product__label">
                                        <span>' . $category . '</span>
                                    </div>
                                </div>
                                <div class="product__item__text">
                                    <h6><a href="#">' . $name . '</a></h6>
                                    <div class="product__item__price p-1 ml-5">' . $price . ' MAD pour 1Kg</div>
                                    <div class="cart_add">
                                        
                                        <a href="view/detailProduit.php?idOfProduit=' . $idOfProduit . '">Commander</a>&nbsp;&nbsp;&nbsp;
                                        <a href="#" class="addToCart" data-id="' . $idOfProduit . '" data-image="'.$image.'"  data-name="'.$name.'" data-price="'.$price.'" data-category="'.$category.'" data-quantité="1" data-priceUnitaire="'.$price.'">Ajouter</a>
                                        </div>
                                </div>
                            </div>
                        </div>';
                    }}?>
            </div>
        </div>
    </section>
    <!-- Product Section Begin gatteau aux miel -->
    <section class="product spad category-product" id="GateauAuMiel">
        <div class="container">
            <div class="row">
                <?php
            $allProducts->execute();
            while($product=$allProducts->fetch(PDO::FETCH_ASSOC)) {
                    $image = $product['image'];
                    $name = $product['nom'];
                    $price = $product['prix'];
                    $category = $product['categorie'];
                    $idOfProduit = $product['id'];
        
                    if ($category == "GateauAuMiel" ) {
                        echo '
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="product__item">
                                <div class="product__item__pic set-bg" data-setbg="view/' . $image . '">
                                    <div class="product__label">
                                        <span>' . $category . '</span>
                                    </div>
                                </div>
                                <div class="product__item__text">
                                    <h6><a href="#">' . $name . '</a></h6>
                                    <div class="product__item__price p-1 ml-5">' . $price . ' MAD pour 1Kg</div>
                                    <div class="cart_add">
                                        <a href="view/detailProduit.php?idOfProduit=' . $idOfProduit . '">Commander</a>&nbsp;&nbsp;&nbsp;
                                        <a href="#" class="addToCart" data-id="' . $idOfProduit . '" data-image="'.$image.'"  data-name="'.$name.'" data-price="'.$price.'" data-category="'.$category.'" data-quantité="1" data-priceUnitaire="'.$price.'">Ajouter</a>

                                    </div>
                                </div>
                            </div>
                        </div>';
                    }}?>
            </div>
        </div>
    </section>
    <!-- Product Section End gatteau aux miel -->
    <!-- Product Section Begin Fekkas -->
    <section class="product spad category-product" id="Fekkas">
        <div class="container">
            <div class="row">
                <?php
            $allProducts->execute();
            while($product=$allProducts->fetch(PDO::FETCH_ASSOC)) {
                    $image = $product['image'];
                    $name = $product['nom'];
                    $price = $product['prix'];
                    $category = $product['categorie'];
                    $idOfProduit = $product['id'];
                    
                    if ($category == "Fekkas" ) {
                        echo '
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="product__item">
                                <div class="product__item__pic set-bg" data-setbg="view/' . $image . '">
                                    <div class="product__label">
                                        <span>' . $category . '</span>
                                    </div>
                                </div>
                                <div class="product__item__text">
                                    <h6><a href="#">' . $name . '</a></h6>
                                    <div class="product__item__price p-1 ml-5">' . $price . ' MAD pour 1Kg</div>
                                    <div class="cart_add">
                                        <a href="view/detailProduit.php?idOfProduit=' . $idOfProduit . '">Commander</a>&nbsp;&nbsp;&nbsp;
                                        <a href="#" class="addToCart" data-id="' . $idOfProduit . '" data-image="'.$image.'"  data-name="'.$name.'" data-price="'.$price.'" data-category="'.$category.'" data-quantité="1" data-priceUnitaire="'.$price.'">Ajouter</a>

                                    </div>
                                </div>
                            </div>
                        </div>';
                    }}?>
            </div>
        </div>
    </section>
    <!-- Product Section End Fekkas -->
    <!-- Product Section Begin Dattes et sellou -->
    <section class="product spad category-product" id="DattesEtSellou">
        <div class="container">
            <div class="row">
                <?php
            $allProducts->execute();
            while($product=$allProducts->fetch(PDO::FETCH_ASSOC)) {
                    $image = $product['image'];
                    $name = $product['nom'];
                    $price = $product['prix'];
                    $category = $product['categorie'];
                    $idOfProduit = $product['id'];
        
                    if ($category == "DattesEtSellou" ) {
                        echo '
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="product__item">
                                <div class="product__item__pic set-bg" data-setbg="view/' . $image . '">
                                    <div class="product__label">
                                        <span>' . $category . '</span>
                                    </div>
                                </div>
                                <div class="product__item__text">
                                    <h6><a href="#">' . $name . '</a></h6>
                                    <div class="product__item__price p-1 ml-5">' . $price . ' MAD pour 1Kg</div>
                                    <div class="cart_add">
                                        <a href="view/detailProduit.php?idOfProduit=' . $idOfProduit . '">Commander</a>&nbsp;&nbsp;&nbsp;
                                        <a href="#" class="addToCart" data-id="' . $idOfProduit . '" data-image="'.$image.'"  data-name="'.$name.'" data-price="'.$price.'" data-category="'.$category.'" data-quantité="1" data-priceUnitaire="'.$price.'">Ajouter</a>
                                        </div>
                                </div>
                            </div>
                        </div>';
                    }}?>
            </div>
        </div>
    </section>
    <!-- Product Section End Dattes et sellou -->
    <!-- Product Section Begin COMPOSITIONS -->
    <section class="product spad category-product" id="COMPOSITIONS">
        <div class="container">
            <div class="row">
                <?php
            $allProducts->execute();
            while($product=$allProducts->fetch(PDO::FETCH_ASSOC)) {
                    $image = $product['image'];
                    $name = $product['nom'];
                    $price = $product['prix'];
                    $category = $product['categorie'];
                    $idOfProduit = $product['id'];
        
                    if ($category == "COMPOSITIONS" ) {
                        echo '
                        <div class="col-lg-3 col-md-6 col-sm-6 ">
                            <div class="product__item">
                                <div class="product__item__pic set-bg" data-setbg="view/' . $image . '">
                                    <div class="product__label">
                                        <span>' . $category . '</span>
                                    </div>
                                </div>
                                <div class="product__item__text">
                                    <h6><a href="#">' . $name . '</a></h6>
                                    <div class="product__item__price p-1 ml-5">' . $price . ' MAD pour 1Kg</div>
                                    <div class="cart_add">
                                        <a href="view/detailProduit.php?idOfProduit=' . $idOfProduit . '">Commander</a>&nbsp;&nbsp;&nbsp;
                                        <a href="#" class="addToCart" data-id="' . $idOfProduit . '" data-image="'.$image.'"  data-name="'.$name.'" data-price="'.$price.'" data-category="'.$category.'" data-quantité="1" data-priceUnitaire="'.$price.'">Ajouter</a>
                                        </div>
                                </div>
                            </div>
                        </div>';
                    }}?>
            </div>
        </div>
    </section>

    <!-- Team Section Begin -->
    <section class="team spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-md-7 col-sm-7">
                    <div class="section-title">
                        <span>Notre équipe</span>
                        <h2>Excellents chefs</h2>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="team__item set-bg" data-setbg="view/img/team/team-1.jpg">
                        <div class="team__item__text">
                            <h6>Mohamed Sediki</h6>
                            <span>Decorateur</span>
                            <div class="team__item__social">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-instagram"></i></a>
                                <a href="#"><i class="fa fa-youtube-play"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="team__item set-bg" data-setbg="view/img/team/team-2.jpg">
                        <div class="team__item__text">
                            <h6>Meryem Zahidi</h6>
                            <span>Decorateur</span>
                            <div class="team__item__social">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-instagram"></i></a>
                                <a href="#"><i class="fa fa-youtube-play"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="team__item set-bg" data-setbg="view/img/team/team-3.jpg">
                        <div class="team__item__text">
                            <h6>Omar Hassani</h6>
                            <span>Decorateur</span>
                            <div class="team__item__social">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-instagram"></i></a>
                                <a href="#"><i class="fa fa-youtube-play"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="team__item set-bg" data-setbg="view/img/team/team-4.jpg">
                        <div class="team__item__text">
                            <h6>Haitam Lbyed</h6>
                            <span>Decorateur</span>
                            <div class="team__item__social">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-instagram"></i></a>
                                <a href="#"><i class="fa fa-youtube-play"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Team Section End -->

    <!-- Testimonial Section Begin -->
    <section class="testimonial spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="section-title">
                        <span>Témoignages</span>
                        <h2>Nos clients ont dit</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="testimonial__slider owl-carousel">
                    <?php
        while ($avis = $allAvis->fetch(PDO::FETCH_ASSOC)) {
            $commentaire = $avis['contenu'];
            $prenom = $daoU->findUtilisateurById($avis['id_Utilisateur'])->getPrenom();
            $ville = $daoU->findUtilisateurById($avis['id_Utilisateur'])->getVille();

            echo '
                <div class="col-lg-6">
                    <div class="testimonial__item">
                        <div class="testimonial__author">
                            <div class="testimonial__author__text">
                                <h5>' . $prenom . '</h5>
                                <span>' . $ville . '</span>
                            </div>
                        </div>
                        <div class="rating">
                            <span class="icon_star"></span>
                            <span class="icon_star"></span>
                            <span class="icon_star"></span>
                            <span class="icon_star"></span>
                            <span class="icon_star-half_alt"></span>
                        </div>
                        <p>' . $commentaire . '</p>
                    </div>
                </div>';
        }
              ?>
                </div>
            </div>

        </div>
    </section>
    <!-- Testimonial Section End -->

    <!-- Instagram Section Begin -->
    <section class="instagram spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 p-0">
                    <div class="instagram__text">
                        <div class="section-title">
                            <span>Suis nous sur instagram
                            </span>
                            <h2> Les doux moments sont conservés comme souvenirs.</h2>
                        </div>
                        <h5><i class="fa fa-instagram"></i> @patisserie_marocaine</h5>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-6">
                            <div class="instagram__pic">
                                <img src="view/img/instagram/instagram-1.jpg" alt="">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-6">
                            <div class="instagram__pic middle__pic">
                                <img src="view/img/instagram/instagram-2.jpg" alt="">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-6">
                            <div class="instagram__pic">
                                <img src="view/img/instagram/instagram-3.jpg" alt="">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-6">
                            <div class="instagram__pic">
                                <img src="view/img/instagram/instagram-4.jpg" alt="">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-6">
                            <div class="instagram__pic middle__pic">
                                <img src="view/img/instagram/instagram-5.jpg" alt="">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-6">
                            <div class="instagram__pic">
                                <img src="view/img/instagram/instagram-3.jpg" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Instagram Section End -->

    <!-- Map Begin -->
    <div class="map">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-7">
                    <div class="map__inner">
                        <h6>Ecole Hassania des travaux publics</h6>
                        <ul>
                            <li>7 Rte d'El Jadida, Casablanca</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="map__iframe">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3325.3017524361944!2d-7.652900924589815!3d33.54553544431639!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xda62d268e15ba97%3A0xf667112bba6b818!2sEcole%20Hassania(EHTP)_!5e0!3m2!1sfr!2sma!4v1700777575167!5m2!1sfr!2sma"
                height="300" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>

        </div>
    </div>
    <!-- Map End -->

    <!-- Footer Section Begin -->
    <footer class="footer set-bg" data-setbg="view/img/footer-bg.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="footer__widget">
                        <h6>HEURES DE TRAVAIL</h6>
                        <ul>
                            <li>LUNDI - VENDREDI: 08:00 – 20:30 </li>
                            <li>SAMEDI: 10:00 – 16:30 </li>
                            <li>DIMANCHE: 10:00 – 16:30 </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="footer__about">
                        <div class="footer__logo">
                            <a href="#"><img src="view/img/footer-logo.png" alt=""></a>
                        </div>
                        <p>Découvrez l'authenticité de la pâtisserie marocaine à chaque bouchée.</p>
                        <div class="footer__social">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-instagram"></i></a>
                            <a href="#"><i class="fa fa-youtube-play"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="footer__newslatter">
                        <h6>Subscribe</h6>
                        <p>Recevez les dernières mises à jour et offres.</p>
                        <form action="#">
                            <input type="text" placeholder="Email">
                            <button type="submit"><i class="fa fa-send-o"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="copyright">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7">
                        <p class="copyright__text text-white">
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            Copyright &copy;<script>
                            document.write(new Date().getFullYear());
                            </script> All rights reserved | BY <i class="fa fa-heart" aria-hidden="true"></i> <a
                                href="https://colorlib.com" target="_blank">2GI GIRLS EHTP</a>
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        </p>
                    </div>
                    <div class="col-lg-5">
                        <div class="copyright__widget">
                            <ul>
                                <li><a href="#">Privacy Policy</a></li>
                                <li><a href="#">Terms & Conditions</a></li>
                                <li><a href="#">Site Map</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Section End -->

    <!-- Search Begin -->
    <div class="search-model">
        <div class="h-100 d-flex align-items-center justify-content-center">
            <div class="search-close-switch">+</div>
            <form class="search-model-form">
                <input type="text" id="search-input" placeholder="Search here.....">
            </form>
        </div>
    </div>
    <!-- Search End -->

    <style>
        .mainmain {
        padding: 0 2rem;
        padding: 0 2rem;
        overflow-y: auto; 
        max-height: 500px; 
        }
        .mainmain::-webkit-scrollbar {
            width: 8px; /* Largeur de la barre de défilement */
        }

        .mainmain::-webkit-scrollbar-thumb {
            background-color: #ccc; /* Couleur du bouton de défilement */
            border-radius: 4px; /* Bordure arrondie du bouton de défilement */
        }

        .mainmain::-webkit-scrollbar-track {
            background-color: #f1f1f1; /* Couleur du fond de la barre de défilement */
        }
    </style>

    <!-- The Modal -->
    <div class="modal fade" id="myModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content p-0">
                <div class="card cardPanier w-100">
                    <div class="row rowpanier">
                        <div class="col-md-8 cart pr-2 pb-5">

                            <div class="titlePanier">
                                <div class="row rowpanier mt-3">
                                    <div class="col">
                                        <h4><b>Mon panier</b></h4>
                                    </div>
                                </div>
                            </div>

                            <style>
                            .col {
                                display: flex;
                                align-items: center;
                            }

                            .border {
                                border: 1px solid #000;
                                padding: 5px 10px;
                                margin: 0 5px;
                            }
                            </style>

                            <div class="row border-top border-bottom rowpanier mainmain">
                            </div>

                        </div>
                        <div class="col-md-4 summaryPanier">
                            <div>
                                <h4 style=" margin-top: 4vh;"><b>Total</b></h4>
                            </div>
                            <hr style="margin-top: 1.25rem;">
                            <div class="row rowpanier">
                                <div class="col col-2Panier mr-5" style="padding-left:0;">Nombre de produits</div>
                                <div class="col col-2Panier text-right" id="nombreProduits">0</div>
                            </div>
                            <form style="padding: 2vh 0;" action="controller/commandeController.php?action=confirmationPanier" method="post" onsubmit="prepareFormData()">
                                <p>Vile de livraison</p>
                                <input id="code" class="inputPanier mt-0 " placeholder="Entrer la ville de livraision " name="ville" >
                                <p>Addresse</p>
                                <input id="code" class="inputPanier mt-0" placeholder="Entrer votre addresse" name="adresse">
                             <div class="row rowpanier" style="border-top: 1px solid rgba(0,0,0,.1); padding: 2vh 0;">
                                <div class="col col-2Panier">Total de la commande</div>
                                <div class="col  col-2Panier text-right" id="totalPanierComplet">0</div>
                            </div>
                            <input type="hidden" name="donneesSupplementaires" id="donneesSupplementaires">

                            <button type="submit" class="btn btnPanier" id="validerPanierBtn">Valider</button>
                            </form>
                            
                        </div>
                    </div>

                </div>




            </div>

        </div>
    </div>

    </div>

    <!-- Js Plugins -->
    <script src="view/js/jquery-3.3.1.min.js"></script>
    <script src="view/js/bootstrap.min.js"></script>
    <script src="view/js/jquery.nice-select.min.js"></script>
    <script src="view/js/jquery.barfiller.js"></script>
    <script src="view/js/jquery.magnific-popup.min.js"></script>
    <script src="view/js/jquery.slicknav.js"></script>
    <script src="view/js/owl.carousel.min.js"></script>
    <script src="view/js/jquery.nicescroll.min.js"></script>
    <script src="view/js/main.js"></script>
    <script src="view/js/object-fit-videos.js"></script>
    <script src="view/js/app.js"></script>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <script rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" type="text/css"></script>
    <script rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js" type="text/css"></script>

    <script src="view/js/indexFinal.js"></script>

</body>
</html>