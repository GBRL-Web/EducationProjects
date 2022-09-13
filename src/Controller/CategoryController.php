<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CategoryController extends AbstractController
{
    /**
     * @Route("/create-category", name="create_category")
     */
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {

        $category = new Category();

        $form = $this->createForm(CategoryType::class, $category);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($category);
            $entityManager->flush();
        }

        return $this->render('category/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     *  JSON sender - handler
     * @Route("/api/send-category/", name="api_category_send")
     */

    public function sendcategoryData(Request $request, EntityManagerInterface $doctrine): Response
    {

        $categorys = $doctrine
            ->getRepository(Category::class)
            ->findAll();


        $data = [];

        foreach ($categorys as $category) {
            $data[] = [
                'id' => $category->getIdCategory(),
                'name' => $category->getName(),
            ];
        }

        $dataenc = json_encode($data);
        $response = new Response($dataenc, Response::HTTP_OK);

        return $response;
    }
}
