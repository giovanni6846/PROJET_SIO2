<?php

namespace App\Modele;

use App\Entity\Prix;

class Modele_Prix
{
    public static function search($type)
    {
        global $entityManager;
        $tarif = $entityManager->getRepository(Prix::class)->findBy(['designation' => $type]);;
        if ($tarif == null) {
            return False;
        } else {
            return $tarif;
        }
    }
}