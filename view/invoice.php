<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice Template</title>
     <!-- logo -->
     <link rel="icon" href="img/logo.png">
     
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">

    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">

    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/styleInvoice.css">
</head>
<body>
    <div class="card">
        <div class="container">

        <div class="page-header">
            <h2>Merci pour votre Commande</h2>
        </div>
            
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-md-offset-3 body-main">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-4">
                                    <img class="img" alt="Invoice Template" src="./img/logo.png" />
                                </div>
                                <div class="col-md-8 text-right">
                                    <h4 style="color: #F81D2D;"><strong>Patisserie HLOU'IN</strong></h4>
                                    <p>221, Baker Street</p>
                                    <p>0654324532</p>
                                    <p>giGirls@gmail.com</p>
                                </div>
                            </div>
                            <br />
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <h2>Facture</h2>
                                    <h5>04854654101</h5></br>
                                    <?php
                                       echo '<p>' . date('Y-m-d H:i:s') . '</p>'; 
                                    ?>
                                </div>
                            </div>
                            <br />
                            <div>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th><h5>Description</h5></th>
                                            <th><h5>Quantity</h5></th>
                                            <th><h5>Price</h5></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    
                                    <?php
session_start();

// Récupérer la 'facture' de la session
$facture = isset($_SESSION['facture']) ? $_SESSION['facture'] : null;

// Vérifier si $facture n'est pas null et est un tableau ou un objet
if ($facture !== null && (is_array($facture) || is_object($facture))) {
    $total = 0; // Initialiser la variable total à 0

    foreach ($facture as $commandeProduit) {
        echo '<tr>';
        echo '<td class="col-md-6">' . $commandeProduit->nom . '</td>';
        echo '<td class="col-md-3">' . $commandeProduit->quantite . '</td>';
        $sousTotal = $commandeProduit->quantite * $commandeProduit->prix;
        echo '<td class="col-md-3">' . $sousTotal . '</td>';
        echo '</tr>';
        
        // Accumuler le montant total
        $total += $sousTotal;
    }

    // Afficher le total
    echo '<tr style="color: #F81D2D;">';
    echo '<td class="text-right"><h4><strong>Total:</strong></h4></td>';
    echo '<td class="text-left"><h4><strong>' . $total . '</strong></h4></td>';
    echo '</tr>';

} else if ($facture == null) {
    echo "Error: \$facture is null.";
} else {
    echo " or not an array or object";
}

// Effacer la facture de la session après utilisation (facultatif)
unset($_SESSION['facture']);
?>


                                   

                                    </tbody>
                                </table>
                            </div>
                            <div>
                                <div class="col-md-12">
                                    
                                    <br />
                                    <p><b>Patisserie HLOU'IN</b></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
        <div class="col-md-12 text-center">
            <button class="btn btn-primary btn-print" onclick="printInvoice()">Imprimer la facture</button>
        </div>
    </div>
        </div>
    </div>
    
    <script>
        function printInvoice() {
            window.print();
        }
    </script>
</body>
</html>
