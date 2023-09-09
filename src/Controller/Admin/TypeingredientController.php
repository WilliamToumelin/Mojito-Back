<?php

namespace App\Controller\Admin;

use App\Entity\TypeIngredient;
use App\Form\TypeIngredientType;
use App\Repository\TypeIngredientRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TypeingredientController extends AbstractController
{
    /**
     * @Route("/admin/type-ingredients", name="app_typeingredient_index", methods={"GET"})
     */
    public function index(TypeIngredientRepository $typeingredientRepository): Response
    {
        return $this->render('typeingredient/index.html.twig', [
            'typeingredients' => $typeingredientRepository->findAllOrderByName(),
        ]);
    }

    /**
     * @Route("/admin/type-ingredient/ajouter", name="app_typeingredient_new", methods={"GET", "POST"})
     */
    public function new(Request $request, TypeIngredientRepository $typeingredientRepository): Response
    {
        $typeingredient = new TypeIngredient();
        $form = $this->createForm(TypeIngredientType::class, $typeingredient);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $typeingredientRepository->add($typeingredient, true);

            return $this->redirectToRoute('app_typeingredient_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('typeingredient/new.html.twig', [
            'typeingredient' => $typeingredient,
            'form' => $form,
        ]);
    }


    /**
     * @Route("/admin/type-ingredient/{id}/modifier", name="app_typeingredient_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, TypeIngredient $typeingredient, TypeIngredientRepository $typeingredientRepository): Response
    {
        $form = $this->createForm(TypeIngredientType::class, $typeingredient);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $typeingredientRepository->add($typeingredient, true);

            return $this->redirectToRoute('app_typeingredient_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('typeingredient/edit.html.twig', [
            'typeingredient' => $typeingredient,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/admin/type-ingredient/{id}/supprimer", name="app_typeingredient_delete", methods={"POST"})
     */
    public function delete(Request $request, TypeIngredient $typeingredient, TypeIngredientRepository $typeingredientRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$typeingredient->getId(), $request->request->get('_token'))) {
            $typeingredientRepository->remove($typeingredient, true);
        }

        return $this->redirectToRoute('app_typeingredient_index', [], Response::HTTP_SEE_OTHER);
    }
}
