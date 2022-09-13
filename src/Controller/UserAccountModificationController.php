<?php

namespace App\Controller;


use DateTime;
use App\Entity\Role;
use App\Entity\User;
use Firebase\JWT\JWT;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Console\Event\ConsoleEvent;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserAccountModificationController extends AbstractController
{
    /**
     * @Route("api/user/account/getoken", name="api_app_user_get_token",  methods={"GET"})
     */
    public function getToken(Request $request, ManagerRegistry $doctrine, EntityManagerInterface $em, UserPasswordHasherInterface $userPasswordHasher): Response
    {

        $token = $request->headers->get('Authorization');
        $tokenParts = explode(".", $token);
        $tokenHeader = base64_decode($tokenParts[0]);
        $tokenPayload = base64_decode($tokenParts[1]);
        $jwtHeader = json_decode($tokenHeader);
        $jwtPayload = json_decode($tokenPayload);

        $current_user = $doctrine->getRepository(User::class)->findOneBy(
            [
                'email' => $jwtPayload->user
            ]
        );

        $user = [
            'id' => $current_user->getId(),
            'name' => $current_user->getName(),
            'username' =>  $current_user->getUsername(),
            'birth_date' => $current_user->getBirthDate(),
            'telephone' => $current_user->getTelephone(),
            'email' => $current_user->getEmail(),
            'password' => $current_user->getPassword(),
        ];

        return new JsonResponse($user);
    }

    /**
     * @Route("api/user/account/modification", name="api_app_user_account_modification",  methods={"POST", "GET"})
     */
    public function modificationAccount(Request $request, ManagerRegistry $doctrine, EntityManagerInterface $em): Response
    {

        $data = json_decode($request->getContent());


        $current_user = $doctrine->getRepository(User::class)->findOneBy(
            [
                'id' => $data->id
            ]
        );


        if (password_verify($data->password, $current_user->getPassword())) {

            $current_user
                ->setName($data->name)
                ->setUsername($data->username)
                ->setTelephone($data->phoneNumber)
                ->setEmail($data->email)
                ->setBirthDate(new DateTime($data->birthDate));



            $payload = [
                "user" => $current_user->getUserIdentifier(),
                "exp"  => (new \DateTime())->modify("+5 minutes")->getTimestamp(),
                'roles' => $current_user->getIdRole()->getName(),
                'is_active' => $current_user->getIsActive()
            ];
        }



        $jwt = JWT::encode(
            $payload,
            $this->getParameter('jwt_secret'),
            'HS256'
        );

        $em->persist($current_user);
        $em->flush();

        return $this->json([
            'id_token' => sprintf($jwt),
        ]);
    }
}
