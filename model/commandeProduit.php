<?php
class CommandeProduit{
    private $quantite;
    private $idProduit;
    private $numCommande;

    public function __construct($quantite,$idProduit,$numCommande)
    {
        $this->quantite = $quantite;
        $this->idProduit = $idProduit;
        $this->numCommande = $numCommande;
    }

    // Getters
    public function getQuantite()
    {
        return $this->quantite;
    }

    public function setQuantite()
    {
        $this->quantite = $quantite;
    }

    public function getIdProduit()
    {
        return $this->idProduit;
    }

    public function setIdProduit()
    {
        $this->idProduit = $idProduit;
    }

    public function getNumCommande()
    {
        return $this->numCommande;
    }

    public function setNumCommande()
    {
        $this->numCommande = $numCommande;
    }
}
