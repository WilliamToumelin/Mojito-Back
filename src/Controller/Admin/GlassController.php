<?php

namespace App\Controller\Admin;

use App\Entity\Glass;
use App\Form\GlassType;
use App\Repository\GlassRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GlassController extends AbstractController
{
    /**
     * @Route("/admin/verres", name="app_glass_index", methods={"GET"})
     */
    public function index(GlassRepository $glassRepository): Response
    {
        return $this->render('glass/index.html.twig', [
            'glasses' => $glassRepository->findAll(),
        ]);
    }

    /**
     * @Route("/admin/verre/ajouter", name="app_glass_new", methods={"GET", "POST"})
     */
    public function new(Request $request, GlassRepository $glassRepository): Response
    {
        $glass = new Glass();
        $form = $this->createForm(GlassType::class, $glass);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $glassRepository->add($glass, true);

            return $this->redirectToRoute('app_glass_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('glass/new.html.twig', [
            'glass' => $glass,
            'form' => $form,
        ]);
    }


    /**
     * @Route("/admin/verre/{id}/modifier", name="app_glass_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Glass $glass, GlassRepository $glassRepository): Response
    {
        $form = $this->createForm(GlassType::class, $glass);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $glassRepository->add($glass, true);

            return $this->redirectToRoute('app_glass_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('glass/edit.html.twig', [
            'glass' => $glass,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/admin/verre/{id}/supprimer", name="app_glass_delete", methods={"POST"})
     */
    public function delete(Request $request, Glass $glass, GlassRepository $glassRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$glass->getId(), $request->request->get('_token'))) {
            $glassRepository->remove($glass, true);
        }

        return $this->redirectToRoute('app_glass_index', [], Response::HTTP_SEE_OTHER);
    }
}
