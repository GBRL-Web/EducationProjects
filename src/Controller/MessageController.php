<?php

namespace App\Controller;

use App\Entity\Message;
use App\Form\MessageType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MessageController extends AbstractController
{

    /**
     * PHP listener
     * 
     * @Route("/contact", name="contact")
     */
    public function index(Request $request, ManagerRegistry $doctrine)
    {
        $form = $this->createForm(MessageType::class);
        $form->handleRequest($request);
        $em = $doctrine->getManager();

        if ($form->isSubmitted() && $form->isValid()) {

            $contactFormData = $form->getData();
            $newMessage = (new Message())
                ->setName($contactFormData->getName())
                ->setEmail($contactFormData->getEmail())
                ->setMessage($contactFormData->getMessage());


            $em->persist($newMessage);
            $em->flush();

            return $this->redirectToRoute('contact');
        }

        return $this->render('contact/contact.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * JSON reciever - listener.
     * 
     * @Route("/api/message/new", name="api_new_message", methods={"POST", "GET"})
     */
    public function postData(Request $request, ManagerRegistry $doctrine)
    {
        // header("Access-Control-Allow-Origin: *");
        $data = json_decode($request->getContent());


        $em = $doctrine->getManager();
        $newMessage = (new Message())
            ->setName($data->name)
            ->setEmail($data->email)
            ->setMessage($data->message);
        $em->persist($newMessage);
        $em->flush();


        return new Response('Done.', Response::HTTP_OK);
    }
}
