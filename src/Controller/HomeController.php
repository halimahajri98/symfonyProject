<?php

namespace App\Controller;
use App\Controller\AmenagementController;
use App\Repository\AmenagementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;


class HomeController extends AbstractController
{
    /**
     * @Route("/", name="amenagement", methods={"GET"})
     */
    public function amenagement(AmenagementRepository $amenagementRepository): Response
    {
        return $this->render('amenagement/index.html.twig', [
            'amenagements' => $amenagementRepository->findAll(),
        ]);
    }
    
    //  /**
    //  * @Route("/amenagement/{id}", name="amenagement_show", methods={"GET"})
    //  */
    // public function show(Amenagement $amenagement): Response
    // {
    //     return $this->render('amenagement/show.html.twig', [
    //         'amenagement' => $amenagement,
    //     ]);
    // }

    // /**
    //  * @Route("/", name="home")
    //  */
    // public function index()
    // {
    //     return $this->render('home/index.html.twig', [
    //         'controller_name' => 'HomeController',
    //     ]);
    // }
}
