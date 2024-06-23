<?php
class Produit
{
    private $id, $nom, $categorie, $image, $prix, $description, $ingredients, $allergie, $conservation;

    public function __construct($nom, $categorie, $image, $prix, $description, $ingredients, $allergie, $conservation)
    {
        $this->nom = $nom;
        $this->categorie = $categorie;
        $this->prix = $prix;
        $this->description = $description;
        $this->ingredients = $ingredients;
        $this->allergie = $allergie;
        $this->conservation = $conservation;
        $this->image = $image;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

     /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }
    /**
     * @param mixed $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * @return mixed
     */
    public function getCategorie()
    {
        return $this->categorie;
    }
    /**
     * @param mixed $categorie
     */
    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }
    /**
     * @param mixed $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * @return mixed
     */
    public function getPrix()
    {
        return $this->prix;
    }
    /**
     * @param mixed $prix
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }
    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }
        /**
     * @return mixed
     */
    public function getIngredients()
    {
        return $this->ingredients;
    }
    /**
     * @param mixed $ingredients
     */
    public function setIngredients($ingredients)
    {
        $this->ingredients = $ingredients;
    }
            /**
     * @return mixed
     */
    public function getAllergie()
    {
        return $this->allergie;
    }
    /**
     * @param mixed $allergie
     */
    public function setAllergie($allergie)
    {
        $this->allergie = $allergie;
    }
            /**
     * @return mixed
     */
    public function getConservation()
    {
        return $this->conservation;
    }
    /**
     * @param mixed $conservation
     */
    public function setConservation($conservation)
    {
        $this->conservation = $conservation;
    }
}