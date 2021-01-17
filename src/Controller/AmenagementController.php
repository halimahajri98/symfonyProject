<?php

namespace App\Controller;

use App\Entity\Amenagement;
use App\Form\AmenagementType;
use App\Repository\AmenagementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session;

/**
 * @Route("admin/amenagement")
 */
class AmenagementController extends AbstractController
{
    /**
     * @Route("/", name="amenagement_index", methods={"GET"})
     */
    public function index(AmenagementRepository $amenagementRepository): Response
    {
        return $this->render('amenagement/admin.html.twig', [
            'amenagements' => $amenagementRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="amenagement_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $amenagement = new Amenagement();
        $form = $this->createForm(AmenagementType::class, $amenagement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($amenagement);
            $entityManager->flush();
            $session = new Session(); 
            $session->getFlashBag()
            ->add('notice', 'Amenagement bien ajoutée');
            return $this->redirectToRoute('amenagement_index');
        }

        return $this->render('amenagement/new.html.twig', [
            'amenagement' => $amenagement,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="amenagement_show", methods={"GET"})
     */
    public function show(Amenagement $amenagement): Response
    {
        return $this->render('amenagement/show.html.twig', [
            'amenagement' => $amenagement,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="amenagement_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Amenagement $amenagement): Response
    {
        $form = $this->createForm(AmenagementType::class, $amenagement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('amenagement_index');
        }

        return $this->render('amenagement/edit.html.twig', [
            'amenagement' => $amenagement,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="amenagement_delete", methods={"DELETE"})
     */
    // public function delete($id){
    //     $em = $this->getDoctrine()->getManager();
    //     $item = $em->getRepository(Amenagement::class)
    //     ->find($id); 
    //     $em->remove($item);
    //     $em->flush(); 
    //     $session = new Session();  
    //     $session->getFlashBag()
    //     ->add('notice', "L'amenagement $id a été supprimé"); 
    //     return $this->redirectToRoute('amenagement_index');
    // }
    public function delete(Request $request, Amenagement $amenagement): Response
    {
        if ($this->isCsrfTokenValid('delete'.$amenagement->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($amenagement);
            $entityManager->flush();
        }

        return $this->redirectToRoute('amenagement_index');
    }
    
}
