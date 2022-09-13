<?php

namespace App\Controller;

use DateTime;
use App\Entity\Role;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class RegistrationUserController extends AbstractController
{

    /**
     * JSON reciever - listener.
     * 
     * @Route("/api/user/new", name="api_new_user", methods={"POST", "GET"})
     */
    public function postData(Request $request, ManagerRegistry $doctrine, EntityManagerInterface $em, UserPasswordHasherInterface $userPasswordHasher)
    {
        //header("Access-Control-Allow-Origin: *");
        $data = json_decode($request->getContent());


        $role = $doctrine->getRepository(Role::class)->find(3);

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

        return new Response('Done.', Response::HTTP_OK);
    }
}
