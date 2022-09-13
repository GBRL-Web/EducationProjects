<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserDeleteController extends AbstractController
{
    /**
     * @Route("/api/account/delete", name="api_user_app_delete", methods={"GET"})
     */
    public function deleteUser(Request $request, ManagerRegistry $doctrine, EntityManagerInterface $em): Response
    {
        $user_id = $request->query->get('user_id');

        $current_user = $doctrine->getRepository(User::class)->findOneBy(
            [
                'id' => (int)$user_id
            ]
        );

        function getMail()
        {
            $comb = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
            $pass = array();
            $combLen = strlen($comb) - 1;
            for ($i = 0; $i < 8; $i++) {
                $n = rand(0, $combLen);
                $pass[] = $comb[$n];
            }
            return implode($pass);
        }

        $current_user->setName("******")
            ->setUsername("******")
            ->setTelephone("******")
            ->setEmail(getMail())
            ->setPassword("******")
            ->setIsActive(0);

        $em->persist($current_user);
        $em->flush();



        return new Response('Done.', Response::HTTP_OK);
    }
}
