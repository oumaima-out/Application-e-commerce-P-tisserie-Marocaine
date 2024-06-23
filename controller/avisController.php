<?php
include "../dao/daoAvis.php";
include "../model/avis.php";

$dao = new DaoAvis();
$avisByProduct = $dao->findAvisByProduit($_GET['id']);
$avisById = $dao->findAvis($_GET['id']);
$avisByUser = $dao->findAvisByUtilisateur($_GET['id']);
$allAvis = $dao->findAllAvis();

