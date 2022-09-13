<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\Persistence\ManagerRegistry;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ViewUserController extends AbstractController
{

    /**
     * PHP listener
     * 
     * @Route("/user/{id}", name="user",  methods={"GET"})
     */
    public function getData(ManagerRegistry $doctrine, int $id)
    {
        //header("Access-Control-Allow-Origin: *");
        $user = $doctrine->getRepository(User::class)->find($id);

        // format birth date
        $date = $user->getBirthDate()->format('d-m-Y');

        // build request json
        $json = array('name' => $user->getname(), 'username' => $user->getusername(), 'email' => $user->getemail(), 'telephone' => $user->getTelephone(), 'BirthDate' => $date);

        $response = new JsonResponse($json);

        return $response;
    }
}
