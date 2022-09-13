<?php

namespace App\Controller;

use Firebase\JWT\JWT;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class SecurityController extends AbstractController
{

    /**
     * @Route("/api/login", name="api_login", methods={"POST"})
     */
    public function login(Request $request, UserRepository $userRepository, UserPasswordHasherInterface $encoder)
    {

        $data = json_decode($request->getContent());

        $user = $userRepository->findOneBy([
            'email' => $data->username
        ]);

        if (!$user || !$encoder->isPasswordValid($user, $data->password)) {
            return $this->json([
                'message' => 'email or password is wrong.',
            ]);
        }

        $payload = [
            "user" => $user->getUserIdentifier(),
            "exp"  => (new \DateTime())->modify("+5 minutes")->getTimestamp(),
            'roles' => $user->getIdRole()->getName(),
            'is_active' => $user->getIsActive()
        ];


        $jwt = JWT::encode(
            $payload,
            $this->getParameter('jwt_secret'),
            'HS256'
        );
        return $this->json([
            'id_token' => sprintf($jwt),
        ]);
    }
}
