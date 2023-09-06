<?php

namespace App\Controller\Admin;

use App\Entity\Technical;
use App\Form\TechnicalType;
use App\Repository\TechnicalRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TechnicalController extends AbstractController
{
    /**
     * @Route("/admin/techniques", name="app_technical_index", methods={"GET"})
     */
    public function index(TechnicalRepository $technicalRepository): Response
    {
        return $this->render('technical/index.html.twig', [
            'technicals' => $technicalRepository->findAll(),
        ]);
    }

    /**
     * @Route("/admin/technique/ajouter", name="app_technical_new", methods={"GET", "POST"})
     */
    public function new(Request $request, TechnicalRepository $technicalRepository): Response
    {
        $technical = new Technical();
        $form = $this->createForm(TechnicalType::class, $technical);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $technicalRepository->add($technical, true);

            return $this->redirectToRoute('app_technical_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('technical/new.html.twig', [
            'technical' => $technical,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/admin/technique/{id}/modifier", name="app_technical_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Technical $technical, TechnicalRepository $technicalRepository): Response
    {
        $form = $this->createForm(TechnicalType::class, $technical);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $technicalRepository->add($technical, true);

            return $this->redirectToRoute('app_technical_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('technical/edit.html.twig', [
            'technical' => $technical,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/admin/technique/{id}/supprimer", name="app_technical_delete", methods={"POST"})
     */
    public function delete(Request $request, Technical $technical, TechnicalRepository $technicalRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$technical->getId(), $request->request->get('_token'))) {
            $technicalRepository->remove($technical, true);
        }

        return $this->redirectToRoute('app_technical_index', [], Response::HTTP_SEE_OTHER);
    }
}
