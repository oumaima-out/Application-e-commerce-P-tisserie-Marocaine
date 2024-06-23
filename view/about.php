<?php

include "../dao/daoUtilisateur.php";

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
    <title>A propos</title>
    <!-- logo -->
    <link rel="icon" href="view/img/logo.png">
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


    <style>
        body {
            margin: 0;
            padding: 0;
        }

        #section1 {
            background-image: url('img/about.jpg');
            background-size: cover; /* Ajuste la taille de l'image pour couvrir toute la section */
            background-position: center; /* Centre l'image */
            height: 400px; /* Vous pouvez ajuster cette valeur en pixels ou en pourcentage selon vos besoins */
            width: 100%; /* La section occupera toute la largeur de l'écran */
            display: flex;
            justify-content: center;
            align-items: center;
            color: #ffffff; /* Couleur du texte sur l'image */
            text-align: center;
            font-size: 24px;
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
        <div class="offcanvas__cart">
            <div class="offcanvas__cart__links">
                <a href="#" class="search-switch"><img src="img/icon/search.png" alt=""></a>
                <a href="#"><img src="img/icon/heart.png" alt=""></a>
            </div>
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
                <li>USD <span class="arrow_carrot-down"></span>
                    <ul>
                        <li>EUR</li>
                        <li>USD</li>
                    </ul>
                </li>
                <li>ENG <span class="arrow_carrot-down"></span>
                    <ul>
                        <li>Spanish</li>
                        <li>ENG</li>
                    </ul>
                </li>
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
                            <li><a href="../index.php">Accueil</a></li>
                            <li class="active"><a href="about.php">A propos </a></li>
                            <li><a href="contact.php">Contact</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- Header Section End -->

    <!-- Breadcrumb Begin -->
    
    <!-- Breadcrumb End -->

    <!-- About Section Begin -->
    <section class="about spad">
        <div class="container">
   
            <div class="row" id="section1">
                <div class="col-lg-5" >
                    <div class="section-title">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="about__text">
                        <div class="section-title mt-5">
                            <h2 >Maison créatrice d'émotions</h2>
                        </div>
                        <p>HLOU'INest une patisserie marocaine qui a commencé en tant que petite entreprise familiale à Casablanca. Les propriétaires sont le Dr Iyad Sultan et le Dr Sereen Sharabati, soutenus par une équipe de 25 employés."</p>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    
                        
                    
                </div>
            </div>
        </div>
    </section>
    <!-- About Section End -->

    <!-- Testimonial Section Begin -->
    <section class="testimonial spad">
        <div class="container">
            
            <div class="row">
                <div class="col-lg-6 text-center">
                    <div class="section-title">
                        <span></span>
                        <h2>Notre parcours</h2>
                        <p>
                            Depuis que notre début HLOU'IN, nous sommmes engagés d'assurer à nos clients un paradis sucré. Chaque visite est une expérience gustative exceptionnelle, et nous ne pouvons pas assez vanter les délices qui sortent de notre  pâtisserie.

Les gâteaux exquis, les macarons fondants et les pâtisseries délicates ne sont que quelques-unes des raisons pour lesquelles nos clients sont devenus fidèles à notre patisserie. La créativité et la passion de notre équipe  se reflètent dans chaque dessert unique.

L'attention aux détails et la qualité des ingrédients utilisés sont ce qui nous distingue vraiment. Chaque création est une œuvre d'art comestible, et nous sommes toujours à la découvrir des nouvelles saveurs et des créations saisonnières pour nos clients.

Le service client exceptionnel et l'atmosphère accueillante font de chaque visite un plaisir. Notre Pâtisserie ne livre pas seulement des desserts délicieux, mais aussi des moments de bonheur sucré.
                        </p>
                    </div>
                </div>
                <div class="col-lg-6 text-center">
                    <img src="img/chef.jpg">
                </div>
            </div>
           
        </div>
    </section>
    <!-- Team Section End -->

    <!-- Footer Section Begin -->
    <footer class="footer set-bg" data-setbg="img/footer-bg.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="footer__widget">
                    <h6>HEURES DE TRAVAIL</h6>
                        <ul>
                            <li>LUNDI - VENDREDI: 08:00  – 20:30 </li>
                            <li>SAMEDI: 10:00  – 16:30 </li>
                            <li>DIMANCHE: 10:00  – 16:30 </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="footer__about">
                        <div class="footer__logo">
                            <a href="#"><img src="img/footer-logo.png" alt=""></a>
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
                        <p class="copyright__text text-white"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                          Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | BY <i class="fa fa-heart" aria-hidden="true"></i>  <a href="https://colorlib.com" target="_blank">2GI GIRLS EHTP</a>
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
</body>

</html>