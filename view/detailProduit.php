<?php
include "../dao/daoProduit.php";
include "../dao/daoUtilisateur.php";
include "../dao/daoAvis.php";
$daoProduit = new DaoProduit();
$daoAvis = new DaoAvis();

$idOfProduit = isset($_GET['idOfProduit']) ? $_GET['idOfProduit'] : "";
$produit = $daoProduit->findProduct($idOfProduit);
$categoryOfProduct = $produit->getCategorie();
$produits = $daoProduit->ProductsOfCategory($categoryOfProduct,$idOfProduit);
session_start();
$_SESSION['idOfProductt']=$idOfProduit;
$daoAvis = new DaoAvis();

?>

<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Cake Template">
    <meta name="keywords" content="Cake, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>produit detail</title>
    <!-- logo -->
    <link rel="icon" href="img/logo.png">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700;800;900&display=swap"
    rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&display=swap"
    rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/flaticon.css" type="text/css">
    <link rel="stylesheet" href="css/barfiller.css" type="text/css">
    <link rel="stylesheet" href="css/magnific-popup.css" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="css/styleTotale.css" type="text/css"> 
    <link rel="stylesheet" href="stylePanier.css" type="text/css">
 
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Offcanvas Menu Begin -->
    <div class="offcanvas-menu-overlay"></div>
    <div class="offcanvas-menu-wrapper">
        <div class="offcanvas__cart">
           <div class="offcanvas__cart__item">
                <a href="#"><img src="img/icon/cart.png" alt=""> <span>0</span></a>
                <div class="cart__price">Cart: <span>$0.00</span></div>
            </div>
        </div>
        <div class="offcanvas__logo">
            <a href="./index.html"><img src="img/logo.png" alt=""></a>
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
                             if (isset($_SESSION['utilisateur'])) {
                                    $utilisateur = $_SESSION['utilisateur'];
                                    $id=$_SESSION['id'];
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
                                <a href="./index.html"><img src="img/logo.png" alt=""></a>
                            </div>

                            <div class="header__top__right">
                                <div class="header__top__right__cart">
                                    <a href="#" data-toggle="modal" data-target="#myModalForPanier"><img
                                            src="img/icon/cart.png" alt=""> <span class="cart-count">0</span></a>
                                    <p>Mon panier</p>
                                </div>
                            </div>

                            <div class="header__top__right">
                                <div class="header__top__right__cart">
                                 <!--   <a href="#"><img src="img/icon/cart.png" alt=""> <span>0</span></a>
                                    <div class="cart__price">Cart: <span>$0.00</span></div>-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="canvas__open"><i class="fa fa-bars"></i></div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <nav class="header__menu mobile-menu">
                        <ul>
                            <li ><a href="../index.php">Accueil</a></li>
                            <li><a href="about.php">A propos </a></li>
                            <li><a href="contact.php">Contact</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- Header Section End -->

    <!-- Shop Details Section Begin -->
    <section class="product-details spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="product__details__img">

                        <div class="product__details__big__img"> 
                            <?php
                                if (isset($produit)) {
                                $imageProduit = $produit->getImage();
                                }
                            ?>
                            <img class="big_img" src="<?php echo $imageProduit; ?>" alt=""> 
                        </div>

                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="product__details__text">
                        
                        <div class="product__label">
                            <?php
                                if (isset($produit)) {
                                echo $produit->getCategorie();
                                }
                            ?>
                        </div>

                        <h2>
                            <?php
                                if (isset($produit)) {
                                echo $produit->getNom();
                                }
                            ?>
                        </h2>

                        <h6 style="border-bottom: 1px solid #724502;">
                            <?php
                                if (isset($produit)) {
                                echo $produit->getPrix();
                                }
                            ?> MAD pour 1Kg
                        </h6>

                        <p>
                            <?php
                                if (isset($produit)) {
                                echo $produit->getDescription();
                                }
                            ?>
                        </p>
                        <div class="product__details__option mt-5 mb-0">
                            <p>Quantité: <span>(en Kg)</span></p>

                            <div class="quantity">
                                <div class="pro-qty">
                                    <input type="text" value="2" id="qq">
                                </div>
                            </div>
                            
                            <button type="button" class="primary-btn" data-toggle="modal" data-target="#myModal">Acheter</button>

                            <!-- Nouveau bouton ajouté ici -->
                            <div class="nouveau-bouton-container">
                                <?php 
                                    $idOfProduit=$produit->getId();
                                    $image=$produit->getImage();
                                    $name=$produit->getNom();
                                    $price=$produit->getPrix();
                                    $category=$produit->getCategorie();
                                ?>

                                <button type="button" class="btn mt-2 p-2 addToCart" style="background: #dbd5c4; border: none; width:170px;" id="nouveauBouton" data-id="<?php echo $idOfProduit; ?>" data-image="<?php echo $image; ?>"  data-name="<?php echo $name; ?>" data-price="<?php echo $price; ?>" data-category="<?php echo $category; ?>" data-quantité="1" data-priceUnitaire="<?php echo $price; ?>">Ajouter au panier</button>
                           
                            </div>

                        </div>

                    </div>
                </div>
            </div>
            <div class="product__details__tab">
                <div class="col-lg-12">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link font-weight-bold" data-toggle="tab" href="#tabs-2" role="tab">Informations supplémentaires</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link font-weight-bold" data-toggle="tab" href="#tabs-3" role="tab">Avis(1)</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tabs-2" role="tabpanel">
                            <div class="row d-flex justify-content-center">
                                <div class="col-lg-8">
                                    <table class="table">
                                        <tbody>
                                          <tr>
                                            <th style="color:rgb(145, 107, 58)">Ingrédients</th>

                                            <td>
                                                <?php
                                                if (isset($produit)) {
                                                echo $produit->getIngredients();
                                                }
                                                ?>
                                          </td>
                                          
                                          </tr>
                                          <tr>
                                            <th style="color:rgb(145, 107, 58)">Méthode de conservation</th>

                                            <td>
                                                <?php
                                                if (isset($produit)) {
                                                echo $produit->getConservation();
                                                }
                                                ?>
                                            </td>

                                          </tr>
                                        </tbody>
                                      </table>
                                </div>
                            </div>
                        </div>

                            <div class="tab-pane" id="tabs-3" role="tabpanel">  
                                <div class="row d-flex justify-content-center">
                                    <div class="col-lg-8">
                                        <!-- Afficher les avis existants ici -->

                                        <!-- Formulaire pour ajouter un nouvel avis -->
                                        <?php
                                        // Vérifier si l'utilisateur est connecté
                                        if (isset($_SESSION['utilisateur'])) {
                                            echo '
                                                <form action="" method="post">
                                                    <div class="form-group mt-3">
                                                        <label for="comment">Donner votre avis :</label>
                                                        <textarea class="form-control" rows="5" id="comment" name="contenu" required></textarea>
                                                    </div>
                                                    <input type="hidden" name="idProduit" value="' . $idOfProduit . '">
                                                    <button type="submit" class="border-0 p-1" style="background-color: rgb(209, 193, 141);">Envoyer</button>
                                                </form>
                                            ';
                                            // Vérifier si le formulaire est soumis
                                            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                                 // Récupérer les données du formulaire
                                                $contenu = $_POST["contenu"];
                                                $idProduit = $_POST["idProduit"];
                                                $nomUtilisateur = $_SESSION['utilisateur']->getNom();
                                                // Créer une instance de DaoAvis
                                                $daoAvis = new DaoAvis();
                                                // Créer une instance de la classe Avis
                                                $avis = new Avis($contenu, date("Y-m-d H:i:s"), $id, $idProduit);
                                                // Appeler la méthode insertAvis
                                                $daoAvis->insererAvis($avis);
                                            
                                            }} 

                                          
                                        } else {
                                            echo '<p>Connectez-vous pour laisser un avis.</p>';
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>


                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shop Details Section End -->

    <!-- Related Products Section Begin --> 
    <section class="related-products spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="section-title mb-5 mt-4"> 
                        <h2>Vous aimerez aussi ces produits</h2>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="related__products__slider owl-carousel">

                    <?php foreach ($produits as $produitC) : 
                        if (isset($produitC)) {
                            $imageProduitC = $produitC->getImage();
                            $categorieProduitC = $produitC->getCategorie();
                            $nomProduitC = $produitC->getNom();
                            $prixProduitC = $produitC->getPrix();
                            $idProduitC = $produitC->getId();
                        }
                    ?>   
                    <div class="col-lg-3">
                        <div class="product__item">
                            <div class="product__item__pic set-bg" data-setbg="<?php echo $imageProduitC; ?>">
                                <div class="product__label">
                                    <span><?php echo $categorieProduitC; ?></span>
                                </div>
                            </div>
                            <div class="product__item__text">
                                <h6><a href="detailProduit.php?idOfProduit=<?php echo $idProduitC;?>"><?php echo $nomProduitC; ?></a></h6>
                                <div class="product__item__price p-1 ml-5"><?php echo $prixProduitC;?> MAD pour 1Kg</div>
                                <div class="cart_add">
                                    <a href="detailProduit.php?idOfProduit=<?php echo $idProduitC;?>">Acheter</a>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                    
                </div>
            </div>
        </div>
    </section>
    <!-- Related Products Section End -->

    <!-- Footer Section Begin -->
    <footer class="footer set-bg" data-setbg="img/footer-bg.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="footer__widget">
                        <h6>WORKING HOURS</h6>
                        <ul>
                            <li>Monday - Friday: 08:00 am – 08:30 pm</li>
                            <li>Saturday: 10:00 am – 16:30 pm</li>
                            <li>Sunday: 10:00 am – 16:30 pm</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="footer__about">
                        <div class="footer__logo">
                            <a href="#"><img src="img/footer-logo.png" alt=""></a>
                        </div>
                        <p>Lorem ipsum dolor amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                        labore dolore magna aliqua.</p>
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
                        <p>Get latest updates and offers.</p>
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
                        <p class="copyright__text text-white"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                          Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
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
</div>

<!-- The Modal -->
<div class="modal fade" id="myModal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title container" style="color:rgb(160, 110, 3); font-weight: 600; font-size:30px; text-align:center;">Ma commande</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
        <form action="../controller/commandeController.php?action=insertionCommande" method="post">

            <div class="row container">
            <div class="col-lg-12 product__details__text" style="margin-top:15px;">
                        <h4 style="color: rgb(92, 64, 4); font-weight: 550; margin-bottom: 12px;">
                            <?php
                                if (isset($produit)) {
                                echo $produit->getNom();
                                }
                            ?>
                        </h4>

                        <h6 style=" padding-bottom: 15px; margin-bottom: 10px; font-size: 15px; font-weight: 500; border-bottom: 1px solid #724502; width:260px;">
                            <?php
                                if (isset($produit)) {
                                echo $produit->getPrix();
                                }
                            ?> MAD pour 1Kg
                        </h6>
                </div>
                <div class="col-lg-6 mt-3" style="padding-left:10px;">
                        <div class="product__details__big__img"> 
                            <?php
                                if (isset($produit)) {
                                $imageProduit = $produit->getImage();
                                }
                            ?>
                            <img class="big_img" src="<?php echo $imageProduit; ?>" alt=""> 
                        </div>
                </div>
                <div class="col-lg-6">
                    <div class="product__details__text">
                        <style>
                            /* Ajoutez des styles CSS personnalisés ici */
                            .custom-border {
                                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Couleur et épaisseur de la bordure */
                            border-radius: 0px; /* Rayon de la bordure pour rendre le coin arrondi */
                            padding: 10px; /* Espace à l'intérieur de la bordure */
                            width:150px;
                            }
                            .custom-border-2 {
                                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Couleur et épaisseur de la bordure */
                            border-radius: 0px; /* Rayon de la bordure pour rendre le coin arrondi */
                            padding: 10px; /* Espace à l'intérieur de la bordure */
                            width:350px;
                            }
                        </style>
                            <div class="product__details__option row">
                                    <div class="col-md-6">
                                        <p>Quantité: <span>(en Kg)</span></p>

                                        <div class="quantity" style="box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
                                            <div class="pro-qty">
                                                <input type="text" id="myInput" name="quantite">
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <p>Prix Total:</p>
                                        <label for="myInput" class="custom-border" style="text-align:center;"></label>
                                    </div>
                                    <div class="col-md-12 mt-4">
                                        <p>Saisissez la ville de livraison:</p>
                                        <input type="text" name="ville" class="custom-border-2" placeholder="ville" required style="border:none;">
                                    </div>
                                    <div class="col-md-12 mt-4">
                                        <p>Saisissez votre address:</p>
                                        <input type="text" name="adresse" style="border:none;" class="custom-border-2" placeholder="adresse" required data-prix="<?php echo $produit->getPrix(); ?>">
                                    </div>
                            </div>
                    </div>
                </div>
            </div>
            </div>
                <!-- Modal footer -->
            <div class="modal-footer container" style="justify-content: space-between;">
            <button type="button" class="btn" style="background: #dbd5c4; border: none; width:150px;" data-dismiss="modal">Annuler</button>
            <form method="post" action="../controller/controlleFacture.php">
                <button type="submit" class="btn btn-secondary" style="background: rgb(221, 189, 85); border: none; width:150px;">valider</button>
            </form>
        </div>
        </form>
      </div>
    </div>
  </div>
  
</div>

    <!-- The Modal -->
    <div class="modal fade" id="myModalForPanier">
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
                            <form style="padding: 2vh 0;" action="../controller/commandeController.php?action=confirmationPanier" method="post" onsubmit="prepareFormData()">
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

<!-- Assurez-vous que jQuery est inclus avant ce script -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>
    $(document).ready(function () {    
        var proQty = $('.pro-qty');
        var myInput = $('#myInput');
        var labelTotalPrice = $('.custom-border'); // Déplacez ceci à la portée globale
        var prixProduit = <?php echo $produit->getPrix(); ?>;

        proQty.prepend('<span class="dec qtybtn">-</span>');
        proQty.append('<span class="inc qtybtn">+</span>');

        proQty.on('click', '.qtybtn', function () {
            var $button = $(this);
            var oldValue = parseFloat(myInput.val());

            if ($button.hasClass('inc')) {
                var newVal = oldValue + 1;
            } else {
                if (oldValue > 0) {
                    var newVal = oldValue - 1;
                } else {
                    newVal = 0;
                }
            }

            $button.parent().find('input').val(newVal);
            myInput.val(newVal);
            updateTotalPrice();
    });

        function updateTotalPrice() {
            var quantity = parseFloat(myInput.val());
            var totalPrice = quantity * prixProduit;
            labelTotalPrice.text(totalPrice.toFixed(2) + ' MAD');
        }

        // Lorsque le bouton "Commander" est cliqué
        $('.primary-btn').on('click', function () {
            // Récupérez la valeur de l'input
            var valeurInput = $('#qq').val();

            // Stockez la valeur dans le stockage local
            localStorage.setItem('inputValue', valeurInput);

            // Mettez à jour la valeur de l'input dans le modèle
            myInput.val(valeurInput);

            // Appelez la fonction pour mettre à jour le prix total
            updateTotalPrice();
        });

        // Récupérez la valeur depuis le stockage local
        var inputValue = localStorage.getItem('inputValue') || 0;
        $('#myInput').val(inputValue);

        // Appelez la fonction pour mettre à jour le prix total au chargement initial
        updateTotalPrice();
    });
</script>


</script>
    <!-- Js Plugins -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.nice-select.min.js"></script>
    <script src="js/jquery.barfiller.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/jquery.slicknav.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.nicescroll.min.js"></script>
    <script src="js/main.js"></script>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <script rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" type="text/css"></script>
    <script rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js" type="text/css"></script>

    <script src="js/panier.js"></script>

</body>

</html>




