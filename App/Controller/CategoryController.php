<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Utils\Utilitaire;

class CategoryController {

    private CategoryRepository $categoryRepository;

    public function __construct()
    {
        $this->categoryRepository = new CategoryRepository();
    }

    

}
