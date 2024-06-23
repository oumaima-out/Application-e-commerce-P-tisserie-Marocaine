<?php
include "../dao/daoUtilisateur.php";
include "../dao/daoCommande.php";
session_start();
if (isset($_SESSION['utilisateur'])) {
    $utilisateur = $_SESSION['utilisateur'];
    $dao = new DaoCommande();
    $allCommande = $dao->afficherComTimeline($utilisateur->getId());
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Cake Template">
    <meta name="keywords" content="Cake, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mes commandes</title>
    <!-- logo -->
    <link rel="icon" href="view/img/logo.png">
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="css/flaticon.css" type="text/css">
    <link rel="stylesheet" href="css/barfiller.css" type="text/css">
    <link rel="stylesheet" href="css/magnific-popup.css" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css"> -->
    <!-- <link rel="stylesheet" href="css/style.css" type="text/css"> -->
    <link rel="stylesheet" href="css/commandeStyle.css" type="text/css">
    <link rel="stylesheet" href="../adminhub/style/R-detailComModal.css">

    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


</head>

<body>
    <header class="header">
        <div class="header__top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="header__top__inner">
                            <div class="header__top__left">
                                <?php
                                // session_start();
                                if (isset($_SESSION['utilisateur'])) {
                                    $utilisateur = $_SESSION['utilisateur'];
                                    // Check if the user is logged in
                                    // If the user is logged in, display the "Se déconnecter" button
                                    if ($utilisateur != null) {
                                        echo '
                                            <ul>
                                                <li>Bienvenue ' . $utilisateur->getPrenom() .  '</li>
                                            <li><a href="../controller/utilisateurController.php?action=deconnexion">Se déconnecter</a></li>
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
                            <li class="active mes-commandes-submenu">
                                <a href="commandesClient.php">Mes Commandes</a>
                            </li>

                            <li><a href="about.php">A propos </a></li>
                            <li><a href="contact.php">Contact</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <section style="width:100%;">
        <div id="encours" class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="col-lg-12 d-flex justify-content-center" style="margin-bottom: 40px !important;" id="enCours">
                        <button type="button" class="button-19" role="button">
                            <a href="#history" style="color: inherit; text-decoration: none;">Historique des commandes</a>
                        </button>
                    </div>

                    <div id="commandeEnCours" class="content">
                        <?php
                        $commande = $allCommande->fetch(PDO::FETCH_ASSOC);
                        $etat = $commande['etat'];

                        if ($commande === false) {
                            echo '<h1>Aucune commande pour le moment</h1> ';
                        } else {
                            echo '<h1>Mes commandes en cours</h1> ';
                            do {

                                $liste_Prod_Com = $dao->liste_Prod($commande["numCommande"], array('En attente', 'En cours de traitement'));
                                if (!empty($liste_Prod_Com) > 0) {
                                    $LC = "";
                                    $imgPrem = ""; 
                                    $c =0;
                                    while ($produit = $liste_Prod_Com->fetch(PDO::FETCH_ASSOC)) {
                                        if ($c==0) $imgPrem= $produit["image"]; $c++;

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

                                $total = $dao->Prix_Commande($commande["numCommande"]);
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
                                echo '
                            
                       <div class="timeline-container" >
                           <figure  style="margin:20px; width: 15%;">
                               <img src="../view/' . $imgPrem . '" alt="product" class="imgProd">
                               <figcaption> Référence : ' . $commande['numCommande'] . ' </figcaption>
                           </figure>
                           <div class="swiper-container">
                               <p class="swiper-control">
                               <button type="button" class="btn btn-default btn-sm prev-slide"  id="boutModal" data-toggle="modal" data-target="#detailComdModal' . $commande["numCommande"] . '">
                               Voir détails
                           </button>
                               </p>
                               <div class="swiper-wrapper timeline">
                               <div class="swiper-slide">
                               <div class="status" >
                                   <span id="trait" class="' . (($etat === 'En attente' || $etat === 'En cours de traitement') ? 'en-cours' : '') . ' ">En cours de traitement</span>
                               </div>
                           </div>
                           <div class="swiper-slide">
                               <div class="status" >
                                   <span id="traitee" class="' . (($etat === 'Traitée' || $etat === 'En cours de livraison') ? 'traitée' : '') . '">Traitée</span>
                               </div>
                           </div>
                           <div class="swiper-slide" style="width:30%;">
                               <div class="status">
                                   <span id="liv" class="' . ($etat === 'En cours de livraison' ? 'en-livraison' : '') . '">En cours de livraison</span>
                               </div>
                           </div>

                               </div>
                           </div>
                       </div>
                       

                       
                       <p> </p>
                       <div id="detailComdModal' . $commande["numCommande"] . '" class="modal fade">
                       <div class="modal-dialog">
                           <div class="modal-content">
                               
                                   <div class="modal-header">						
                                       <h4 class="modal-title">Liste des produits</h4>
                                       <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                   </div>
                                   <div class="modal-body">
                           <div style="display: flex; ">
                           <div class="main">' . $LC . '
                       ';
                                $etat = $commande['etat'];
                            } while ($commande = $allCommande->fetch(PDO::FETCH_ASSOC));
                        }

                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12 d-flex justify-content-center" style="margin-bottom: 40px !important;" id="history">
            <button type="button" class="button-19" role="button">
                <a href="#enCours" style="color: inherit; text-decoration: none;">Mes commandes en cours</a>
            </button>
        </div>
        <div id="historique">
            <div class="row">
                <div class="col-lg-12">
                    <h1>Historique des commandes</h1>
                    <div id="filter-container">
                        <form method="post" action="">
                            <button class="buttonNew" role="button" name="filterByTotal" style="background-color: #37D428 ;
    border-radius: 10%; border-color: #37D428; height: 45px;
    color: white;">Valider le filtre</button>
                            <label for="filter"></label>
                            <select id="filter" class="filter-dropdown" name="filtreChoix">
                                <option value="" disabled selected>Filtrer par</option>
                                <option value="dateCreation">Date de création</option>
                                <option value="dateLivraison">Date de livraison</option>
                                <option value="Total">Total</option>
                            </select>
                        </form>
                    </div>
                </div>


                <table class="styled-table">
                    <thead>
                        <tr>
                            <th>Référence</th>
                            <th>Date de création</th>
                            <th>Total en MAD</th>
                            <th>Date de livraison</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $commandeClient = [];

                        if (isset($_POST['filtreChoix'])) {
                            $commandeClient = $dao->getAll($_POST['filtreChoix'], $utilisateur->getId());
                        } else {
                            $commandeClient = $dao->getAll(null, $utilisateur->getId());
                        }

                        foreach ($commandeClient as $commandes) :
                            echo '<tr>
        <td>' . $commandes['numCommande'] . '</td>
        <td>' . $commandes['dateCreation'] . '</td>
        <td>' . $dao->Prix_Commande($commandes['numCommande']) . '</td>
        <td>' . $commandes['dateLivraison'] . '</td>
        <td><button type="button" class="btn btn-default btn-sm prev-slide"  data-toggle="modal" data-target="#detailComdModalTab' . $commandes["numCommande"] . '">
        Voir détails
    </button></td>
    </tr>';
                            $liste_Prod_ComTab = $dao->liste_Prod($commandes["numCommande"], array('Livrée'));
                            if (!empty($liste_Prod_ComTab) > 0) {
                                $LC1 = "";
                                while ($produit = $liste_Prod_ComTab->fetch(PDO::FETCH_ASSOC)) {

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

                            $total = $dao->Prix_Commande($commandes["numCommande"]);
                            $LC1 .= '<hr>
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
</div>  ';
                        endforeach;
                        echo '
                        <div id="detailComdModalTab' . $commandes["numCommande"] . '" class="modal fade">
<div class="modal-dialog">
    <div class="modal-content">
        
            <div class="modal-header">						
                <h4 class="modal-title">Liste des produits</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
    <div style="display: flex; ">
    <div class="main">' . $LC1 . '
    ';
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        </div>
    </section>
</body>


</html>