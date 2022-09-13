<?php

namespace App\Controller;

use DateTime;
use App\Entity\Role;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use PhpParser\Node\Expr\Cast\Array_;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class RegistrationAdminController extends AbstractController
{

    /**
     * JSON reciever - listener.
     * 
     * @Route("/api/role/new", name="api_new_role", methods={"POST", "GET"})
     */
    public function postData(Request $request, ManagerRegistry $doctrine, EntityManagerInterface $em, UserPasswordHasherInterface $userPasswordHasher)
    {
        //header("Access-Control-Allow-Origin: *");
        $data = json_decode($request->getContent());


        $role = $doctrine->getRepository(Role::class)->find($data->id_role);

        $names  = $doctrine->getRepository(Role::class)->findAll();

        $roles = [];

        for ($i = 0; $i < count($names); $i++) {
            $roles[] =  $names[$i]->getName();
        }


        $newUser = (new User())
            ->setName($data->name)
            ->setUsername($data->username)
            ->setEmail($data->email)
            ->setTelephone($data->phoneNumber)
            ->setIdRole($role)
            ->setBirthDate(new DateTime($data->birthDate))
            ->setIsActive($data->is_active);

        $newUser->setPassword(
            $userPasswordHasher->hashPassword(
                $newUser,
                $data->password
            )
        );


        $em->persist($newUser);
        $em->flush();



        return new JsonResponse('Done.', Response::HTTP_OK);
    }


    /**
     * JSON reciever - listener.
     * 
     * @Route("/api/roles", name="api_roles", methods={"POST","GET"})
     */
    public function getRoles(Request $request, ManagerRegistry $doctrine): Response
    {

        $names  = $doctrine->getRepository(Role::class)->findAll();

        $roles = [];

        for ($i = 0; $i < count($names); $i++) {
            $roles[] =  $names[$i]->getName();
        }

        return new JsonResponse($roles);
    }
}
