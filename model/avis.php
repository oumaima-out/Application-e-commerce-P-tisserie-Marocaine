<?php
class Avis
{
    private $contenu, $dateCreation, $id_Utilisateur, $id_Produit;

    public function __construct($contenu, $dateCreation, $id_Utilisateur, $id_Produit)
    {
        $this->contenu = $contenu;
        $this->dateCreation = $dateCreation;
        $this->id_Utilisateur = $id_Utilisateur;
        $this->id_Produit = $id_Produit;
    }

    /**
     * @return mixed
     */
    public function getContenu()
    {
        return $this->contenu;
    }
    /**
     * @param mixed $contenu
     */
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;
    }

     /**
     * @return mixed
     */
    public function getDateCreation()
    {
        return $this->dateCreation;
    }
    /**
     * @param mixed $dateCreation
     */
    public function setDateCreation($dateCreation)
    {
        $this->dateCreation = $dateCreation;
    }

    /**
     * @return mixed
     */
    public function getId_Utilisateur()
    {
        return $this->id_Utilisateur;
    }
    /**
     * @param mixed $id_Utilisateur
     */
    public function setId_Utilisateur($id_Utilisateur)
    {
        $this->id_Utilisateur = $id_Utilisateur;
    }

    /**
     * @return mixed
     */
    public function getId_Produit()
    {
        return $this->id_Produit;
    }
    /**
     * @param mixed $id_Produit
     */
    public function setId_Produit($id_Produit)
    {
        $this->id_Produit = $id_Produit;
    }

}