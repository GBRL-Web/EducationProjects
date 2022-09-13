<?php

namespace App\Controller;

use App\Entity\Size;
use App\Entity\Color;
use App\Entity\Product;
use App\Entity\Category;
use App\Form\ProductType;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\VarDumper\Cloner\Data;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProductController extends AbstractController
{

    /**
     *  JSON sender - handler
     * @Route("/api/product/search/{searchTerm}", name="api_product_search")
     */
    public function searchProduct(Request $request, EntityManagerInterface $entityManager, $searchTerm): Response
    {
        $query = $entityManager->createQuery("SELECT p FROM App:Product AS p WHERE LOWER(p.description) LIKE :search");
        $query->setParameter('search', '%' . $searchTerm . '%');
        $products = $query->getResult();

        $data = [];

        foreach ($products as $product) {
            $data[] = [
                'id' => $product->getIdProduct(),
                'price' => $product->getPrice(),
                'name' => $product->getName(),
                'description' => $product->getDescription(),
                'imglink' => $product->getImglink(),
            ];
        }
        $dataenc = json_encode($data);
        $response = new Response($dataenc, Response::HTTP_OK);
        return $response;
    }


    /**
     *  JSON sender - handler
     * @Route("/api/product/{id}", name="api_product_send")
     */
    public function readOneProduct(Request $request, EntityManagerInterface $entityManager, $id): Response
    {
        $req = $entityManager->getRepository(Product::class)->find($id);

        $data = [
            'id' => $req->getIdProduct(),
            'price' => $req->getPrice(),
            'name' => $req->getName(),
            'imglink' => $req->getImglink(),
            'description' => $req->getDescription(),
            'material' => $req->getMaterial(),
        ];

        $dataenc = json_encode($data);

        $response = new Response($dataenc, Response::HTTP_OK);
        return $response;
    }

    /**
     *  JSON sender - handler
     * @Route("/api/product/", name="api_products_send")
     */

    public function sendData(Request $request, EntityManagerInterface $doctrine): Response
    {

        $products = $doctrine
            ->getRepository(Product::class)
            ->findAll();

        $data = [];

        foreach ($products as $product) {
            $data[] = [
                'id' => $product->getIdProduct(),
                'name' => $product->getName(),
                'tag' => $product->getTag(),
                'price' => $product->getPrice(),
                'description' => $product->getDescription(),
                'imglink' => $product->getImglink(),
                'quantiy' => $product->getQuantity(),
                'weight' => $product->getWeight(),
                'material' => $product->getMaterial(),
                'brand' => $product->getBrand(),            ];
        }
        $dataenc = json_encode($data);
        $response = new Response($dataenc, Response::HTTP_OK);

        return $response;
    }

    /**
     * PHP listener
     * 
     * @Route("/add-product/", name="add-product")
     */
    public function postDataAddProduct(Request $request, EntityManagerInterface $em): Response
    {

        $data = json_decode($request->getContent());

        //$weight = $em->getRepository(Size::class)->find($data->weight);
        //$weight = $em->getRepository(Size::class)->find(1);

        //$temps = $weight->getName() ;
        //dd($temps);

        //return new JsonResponse($weight->getName() ,Response::HTTP_OK);


        //create product
        $newProduct = (new Product())
            ->setName($data->name)
            ->setBrand($data->brand)
            ->setDescription($data->description)
            ->setMaterial($data->material)
            ->setImglink($data->imglink)
            ->setPrice($data->price)
            ->setQuantity($data->quantity)
            ->setTag($data->tag)
            ->setWeight($data->weight);


        $idCategory = $data->category;

        $category = $em->getRepository(Category::class)->find($idCategory);

        //save product and push
        $em->persist($newProduct);
        $em->flush();

        $product = $em
            ->getRepository(Product::class)
            ->findBy([], ["idProduct" => "DESC"], 1);

        $current_product = $em->getRepository(Product::class)->find($product[0]->getIdProduct());

        $category->addIdProduct($current_product);
        $em->persist($category);
        $em->flush();

        $weight = $em->getRepository(Size::class)->find($data->weight);

        $weight->addIdProduct($current_product);
        $em->persist($weight);
        $em->flush();

        $color = $em->getRepository(Color::class)->find($data->color);

        $color->addIdProduct($current_product);
        $em->persist($color);
        $em->flush();

        return new JsonResponse(Response::HTTP_OK);
    }
}
