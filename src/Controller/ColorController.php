<?php

namespace App\Controller;

use App\Entity\Color;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ColorController extends AbstractController
{
    /**
     * @Route("api/color", name="app_color")
     */
    public function sendData(ManagerRegistry $doctrine): Response
    {
        $colors = $doctrine->getRepository(Color::class)->findAll();

        $colorsname = [];

        // for ($i=0; $i < count($colors) ; $i++) { 
        //     $colorsname[] = $colors[$i]->getName() ;
        // }

        for ($i=0; $i < count($colors) ; $i++) { 
            $colorsname[] = [
                'id' => $colors[$i]->getIdColor(),
                'name' => $colors[$i]->getName()
            ];
            
        }
        
        
        return new JsonResponse($colorsname);
    }
}
