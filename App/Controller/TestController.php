<?php

namespace App\Controller;

use App\Utils\Utilitaire;

class TestController {

    public function testJson() {
        $tab = ["nom" => "mithridate", "prenom" => "mathieu", "email" => "mathieum@adrar.fr"];
        Utilitaire::JsonResponse($tab);
    }
}
