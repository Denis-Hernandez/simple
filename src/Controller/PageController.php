<?php

namespace App\Controller;

use App\Entity\Usuario;
use App\Entity\Equipo;
use App\Entity\Gol;
use App\Entity\Jornada;
use App\Entity\Incidente;
use App\Form\UsuarioType;
use App\Form\EquipoType;
use App\Form\GolType;
use App\Form\JornadaType;
use App\Form\IncidenteType;
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

    #[Route('/equipo', name: 'equipo')]
    public function equipo(EntityManagerInterface $entityManager, Request $request): Response
    {
        $form = $this->createForm(EquipoType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $entityManager->persist($form->getData());
            $entityManager->flush();

            return $this->redirectToRoute('equipo');
        }

        $equipos = $entityManager->getRepository(Equipo::class)->findAll();
        return $this->render('equipo.html.twig',[
            //'usuarios' => $entityManager->getRepository(Usuario::class)->findAll()
            'equipos'  => $equipos,
            'form'      => $form->createView()
        ]);
    }

    #[Route('/gol', name: 'gol')]
    public function gol(EntityManagerInterface $entityManager, Request $request): Response
    {
        $form = $this->createForm(GolType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $entityManager->persist($form->getData());
            $entityManager->flush();

            return $this->redirectToRoute('gol');
        }

        $goles = $entityManager->getRepository(Gol::class)->findAll();
        return $this->render('gol.html.twig',[
            //'usuarios' => $entityManager->getRepository(Usuario::class)->findAll()
            'goles'  => $goles,
            'form'   => $form->createView()
        ]);
    }

    #[Route('/jornada', name: 'jornada')]
    public function jornada(EntityManagerInterface $entityManager, Request $request): Response
    {
        $form = $this->createForm(JornadaType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $entityManager->persist($form->getData());
            $entityManager->flush();

            return $this->redirectToRoute('jornada');
        }

        $jornadas = $entityManager->getRepository(Jornada::class)->findAll();
        return $this->render('jornada.html.twig',[
            //'usuarios' => $entityManager->getRepository(Usuario::class)->findAll()
            'jornadas'  => $jornadas,
            'form'      => $form->createView()
        ]);
    }

    #[Route('/incidente', name: 'incidente')]
    public function incidente(EntityManagerInterface $entityManager, Request $request): Response
    {
        $form = $this->createForm(IncidenteType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $entityManager->persist($form->getData());
            $entityManager->flush();

            return $this->redirectToRoute('incidente');
        }

        $incidentes = $entityManager->getRepository(Incidente::class)->findAll();
        return $this->render('incidente.html.twig',[
            //'usuarios' => $entityManager->getRepository(Usuario::class)->findAll()
            'incidentes'  => $incidentes,
            'form'      => $form->createView()
        ]);
    }
}