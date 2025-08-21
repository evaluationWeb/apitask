<?php

namespace App\Repository;

use App\Model\Category;
use App\Utils\Bdd;

class CategoryRepository {

    //Attribut
    private \PDO $connexion;

    //Constructeur
    public function __construct()
    {
        $this->connexion = (new Bdd)->connectBDD();
    }

    //Méthodes
    /**
     * Méthode qui ajoute un enregistrement en BDD
     * requête de MAJ insert
     * @param Category  l'objet à créer
     * @return Category
     */
    public function saveCategory(Category $category): Category
    {
        try {
            //Récupération de la valeur de name (category)
            $name = $category->getName();
            //Stocker la requête dans une variable
            $request = "INSERT INTO category(name) VALUES (?)";
            //1 préparer la requête
            $req = $this->connexion->prepare($request);
            //2 Bind les paramètres
            $req->bindParam(1, $name, \PDO::PARAM_STR);
            //3 executer la requête
            $req->execute();
            //récupération de l'id de la catégorie
            $id = $this->connexion->lastInsertId("category");
            
            $category->setIdCategory($id);
            
            return $category;

            //Capture des erreurs 
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }


    /**
     * Méthode qui retourne toutes les categories de la BDD
     * @return array Category tableau d'objet Category
     */
    public function findAllCategory(): array
    {
        try {
            $request = "SELECT c.id_category AS idCategory , c.name FROM category AS c";
            $req = $this->connexion->prepare($request);
            $req->execute();
            return $req->fetchAll(\PDO::FETCH_CLASS, Category::class);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    /**
     * Méthode qui retourne true si la category existe en BDD
     * @return bool true si existe / false si n'existe pas
     */
    public function isCategoryByNameExist(Category $category): bool
    {
        try {
            $name = $category->getName();
            //Ecrire la requête SQL
            $request = "SELECT c.id_category FROM category AS c WHERE c.name = ?";
            //préparer la requête
            $req = $this->connexion->prepare($request);
            //assigner le paramètre
            $req->bindParam(1, $name, \PDO::PARAM_STR);
            //exécuter la requête
            $req->execute();
            //récupérer le resultat
            $data = $req->fetch(\PDO::FETCH_ASSOC);
            //Test si l'enrgistrement est vide
            if (empty($data)) {
                return false;
            }
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}
