<?php

namespace App\Utils;

class Utilitaire {

    public static function JsonResponse(array $data, int $status = 200): void
    {
        header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: *');
        http_response_code($status);
        echo json_encode($data);
    }


    //fonction pour récupérer le body de la requête
    public static function getRequestBody(): bool|string
    {
        return file_get_contents('php://input');
    }

    /**
     * Méthode pour Supprimer les balises + les caractères spéciaux, suppression des espaces
     * @param string $value la chaine à nettoyer
     * @return string chaine néttoyer 
    */
    public static function sanitize(string $value) : string {
    
        return htmlspecialchars(strip_tags(trim($value)), ENT_NOQUOTES);
    }
}
