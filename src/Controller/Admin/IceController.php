<?php

namespace App\Controller\Admin;

use App\Entity\Ice;
use App\Form\IceType;
use App\Repository\IceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class IceController extends AbstractController
{
    /**
     * @Route("/admin/glaces", name="app_ice_index", methods={"GET"})
     */
    public function index(IceRepository $iceRepository): Response
    {
        return $this->render('ice/index.html.twig', [
            'ices' => $iceRepository->findAll(),
        ]);
    }

    /**
     * @Route("/admin/glace/new", name="app_ice_new", methods={"GET", "POST"})
     */
    public function new(Request $request, IceRepository $iceRepository): Response
    {
        $ice = new Ice();
        $form = $this->createForm(IceType::class, $ice);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $iceRepository->add($ice, true);

            return $this->redirectToRoute('app_ice_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ice/new.html.twig', [
            'ice' => $ice,
            'form' => $form,
        ]);
    }


    /**
     * @Route("/admin/glace/{id}/edit", name="app_ice_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Ice $ice, IceRepository $iceRepository): Response
    {
        $form = $this->createForm(IceType::class, $ice);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $iceRepository->add($ice, true);

            return $this->redirectToRoute('app_ice_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ice/edit.html.twig', [
            'ice' => $ice,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/admin/glace/{id}", name="app_ice_delete", methods={"POST"})
     */
    public function delete(Request $request, Ice $ice, IceRepository $iceRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ice->getId(), $request->request->get('_token'))) {
            $iceRepository->remove($ice, true);
        }

        return $this->redirectToRoute('app_ice_index', [], Response::HTTP_SEE_OTHER);
    }
}
