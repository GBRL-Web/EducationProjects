<?php

namespace App\Controller;

use App\Entity\Size;
use App\Form\SizeType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SizeController extends AbstractController
{
    /**
     * @Route("/create-size", name="create_size")
     */
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $size = new Size();

        $form = $this->createForm(SizeType::class, $size);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($size);
            $entityManager->flush();
        }

        return $this->render('size/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * JSON sender - handler
     * @route("/api/size", name="api_size_send")
     */
    public function sendData(Request $request, EntityManagerInterface $doctrine): Response
    {

        $sizes = $doctrine
            ->getRepository(Size::class)
            ->findAll();

        
        $data = [];

        foreach ($sizes as $size) {
            $data[] = [
                'id' => $size->getIdSize(),
                'name' => $size->getName(),
            ];
        }

        $dataenc = json_encode($data);
        $response = new Response($dataenc, Response::HTTP_OK);

        return $response;
    }
}
