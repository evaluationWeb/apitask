<?php

namespace App\Controller;

use App\Model\Category;
use App\Repository\CategoryRepository;
use App\Utils\Utilitaire;

class CategoryController {

    private CategoryRepository $categoryRepository;

    public function __construct()
    {
        $this->categoryRepository = new CategoryRepository();
    }

    public function getAllCategory() {
        //liste des categories
        $categories = $this->categoryRepository->findAllCategory();
        Utilitaire::JsonResponse($categories);
    }

    public function addCategory() {
        $reponse = "";
        $codeStatus = 0;
        //récupérer les informations
        $body = Utilitaire::getRequestBody();
        if ($body == '""') {
            $codeStatus = 400;
            $reponse = ["erreur" => "Le json est invalide"];
        } else {
            //transformer dans un format utilisable
            $json = json_decode($body);
            //nettoyer
            $name = Utilitaire::sanitize($json->name);
            $category = new Category();
            $category->setName($name);
            //tester si elle existe
            if ($this->categoryRepository->isCategoryByNameExist($category)) {
                $codeStatus = 400;
                $reponse = ["erreur" => "La categorie existe déja"];
            } else {
                $this->categoryRepository->saveCategory($category);
                $codeStatus = 201;
                $reponse = [$category];
            }
        }
        //retourner la réponse HTTP (json)
        Utilitaire::JsonResponse($reponse, $codeStatus);
        
    }
}
