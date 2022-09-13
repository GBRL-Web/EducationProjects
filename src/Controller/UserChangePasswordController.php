<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


class UserChangePasswordController extends AbstractController
{
    /**
     * @Route("api/user/change/password", name="app_user_change_password")
     */
    public function changePassword(Request $request,  EntityManagerInterface $em, UserRepository $userRepository,  UserPasswordHasherInterface $userPasswordHasher): Response
    {
        $data = json_decode($request->getContent());

        $user = $userRepository->findOneBy([
            'email' => $data->email
        ]);

        if (password_verify($data->oldpassword, $user->getPassword())) {
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $data->password
                )
            );

            $em->persist($user);
            $em->flush();
            return new Response('Done.', Response::HTTP_OK);
        } else {
            return new Response('Done.', Response::HTTP_NOT_MODIFIED);
        }
    }
}
