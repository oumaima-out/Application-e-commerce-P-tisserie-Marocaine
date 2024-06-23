<?php
include "../dao/daoUtilisateur.php";
$email1 = $_POST['email'];
$mdp1 = $_POST['mdp'];
$action = $_GET['action'];
$connexionVV = $_GET['connexionV'];

switch ($action) {
    case 'connexion':
        // Cas de connexion d'un client
        $con1 = new DaoUtilisateur();
        $utilisateur = $con1->findUtilisateur($email1, $mdp1);
        session_start();
        $_SESSION['utilisateur'] = $utilisateur;
        $_SESSION['id'] = $utilisateur->getId();
        $_SESSION['id'] = $utilisateur->getId();
        var_dump($_SESSION['id']);

        if ($utilisateur != null && $utilisateur->getRole() == 'responsable') {
            header("Location: ../adminhub/index.php");
            exit();
        } else if ($utilisateur != null && $utilisateur->getRole() == 'client') {
            if ($connexionVV == 'Vcommande') {
                header("Location: ../controller/controlleFacture.php");
                exit();
            } else {
                 header("Location: ../index.php"); 
                exit();
            }
        } else {
            header("Location: ../view/reconnexion.php");
        }
        break;

    case 'deconnexion':
        session_start();
        $con1 = new DaoUtilisateur();
        $utilisateur = $con1->findUtilisateur("", "");
        session_start();
        $_SESSION['utilisateur'] = $utilisateur;
        //session_reset();
        //session_destroy(); Supprime le tableau superglobal $_SESSION ==>> error dans la index.php (indefined key cin !!)
        header("Location: ../index.php");
        break;

    case 'create':
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $email = $_POST['email'];
        $tel = $_POST['tel'];
        $mdp = $_POST['mdp'];
        $genre = $_POST['genre'];
        $ville = $_POST['ville'];
        $role = "client";

        if (isset($nom, $prenom, $tel, $email, $mdp, $ville, $genre, $role)) {
            $dao = new DaoUtilisateur();
            $client = new Utilisateur($nom, $prenom, $email, $tel, $genre, $mdp, $ville, $role);
            $dao->save($client);
            if ($connexionVV == 'Vcommande') {
                header("Location: ../controller/controlleFacture.php");
                exit();
            } else  header('location: ../view/connexion.php');
        }
        break;

    case 'commander':
        session_start();

        // Vérifier si l'utilisateur est connecté
        if (isset($_SESSION['utilisateur'])) {
            // Utilisateur connecté, rediriger vers la page d'accueil
            header("Location: ../view/connexion.php");
            exit();
        } else {
            // Utilisateur non connecté, rediriger vers la page de connexion
            header("Location: ../view/connexion.php");
            exit();
        }
        break;
    // case 'deconnecterRespo':

    //     session_start(); // Assurez-vous que la session est démarrée

    //     if (isset($_SESSION['utilisateur'])) {
    //         // Détruisez la session
    //         session_unset();
    //         session_destroy();
    //     }


    //     // Redirigez l'utilisateur vers la page de connexion ou une autre page de votre choix
    //     header('Location: ../index.php');
    //     break;
}
