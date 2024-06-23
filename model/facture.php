<?php
class Facture{
    
    private $dateFacture;
    private $numCommande;
    public function __construct($dateFacture,$numCommande){
        $this->dateFacture=$dateFacture;
        $this->numCommande=$numCommande;
    }
    public function getdateFacture(){
        return $this->dateFacture;
    }
    public function getnumCommande(){
        return $this->numCommande;
    }

}
?>