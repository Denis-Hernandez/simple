<?php

namespace App\Controller;

use App\Entity\Usuario;
use App\Form\UsuarioType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PageController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function home(EntityManagerInterface $entityManager, Request $request): Response
    {
        $form = $this->createForm(UsuarioType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $entityManager->persist($form->getData());
            $entityManager->flush();

            return $this->redirectToRoute('home');
        }

        $usuarios = $entityManager->getRepository(Usuario::class)->findBy([],['fecha_nac' => 'ASC']);
        return $this->render('home.html.twig',[
            //'usuarios' => $entityManager->getRepository(Usuario::class)->findAll()
            'usuarios'  => $usuarios,
            'form'      => $form->createView()
        ]);
    }
}