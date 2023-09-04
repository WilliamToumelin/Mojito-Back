<?php

namespace App\Controller\Admin;

use App\Entity\Cocktail;
use App\Form\CocktailType;
use App\Repository\CocktailRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CocktailController extends AbstractController
{
    /**
     * Display all cocktails
     * @Route("/admin/cocktails", name="app_cocktail_index")
     */
    public function index(CocktailRepository $cocktailRepository, Request $request): Response
    {

        return $this->render('cocktail/index.html.twig', [
            'cocktails' => $cocktailRepository->paginatorForCocktailsList($request->query->getInt('page', 1)),
        ]);
    }

    /**
     * Display one cocktail 
     * @Route("/admin/cocktail/{id}", name="app_cocktail_show", requirements={"id"="\d+"})
     */
    public function show(CocktailRepository $cocktailRepository, Cocktail $cocktail): Response
    {
        $cocktail = $cocktailRepository->find($cocktail);
        return $this->render(
            'cocktail/show.html.twig',
            ['cocktail' => $cocktail]
        );
    }

    /**
     * add a cocktail 
     * @Route("/admin/cocktail/ajouter", name="app_cocktail_new", methods={"GET", "POST"})
     */

    public function new(Request $request, CocktailRepository $cocktailRepository, UserRepository $userRepository, EntityManagerInterface $entityManager): Response
    {
        $cocktail = new Cocktail();

        $form = $this->createForm(CocktailType::class, $cocktail);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // I get the list of CocktailUse entities 
            // then I associate the cocktail with each CocktailUse entity
            $cocktailUsesList = $cocktail->getCocktailUses();

            foreach ($cocktailUsesList as $key => $value) {
                $cocktailUsesList[$key]->setCocktail($cocktail);

                $entityManager->persist($cocktailUsesList[$key]);
            }

            //! TODO : The user will be the connected user to be retrieved.
            $cocktail->setUser($userRepository->find(20));

            // I set the rating to 0 because it's a new cocktail
            $cocktail->setRating(0);

            // tableau des étapes
            $stepList = $cocktail->getSteps();

            // for each step, then i set the step number, associate it with the cocktail entity and persist it

            foreach ($stepList as $key => $value) {
                $stepList[$key]->setNumberStep($key + 1);
                $stepList[$key]->setCocktail($cocktail);
                $entityManager->persist($stepList[$key]);
            }

            $cocktailRepository->add($cocktail, true);

            $this->addFlash("success", "Cocktail enregistré");

            return $this->redirectToRoute('app_cocktail_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('cocktail/new.html.twig', [
            'cocktail' => $cocktail,
            'form' => $form
        ]);
    }


    /**
     * edit a cocktail 
     * @Route("/admin/cocktail/modifier/{id}", name="app_cocktail_edit", methods={"GET", "POST"}, requirements={"id"="\d+"})
     */

    public function edit(Cocktail $cocktail, Request $request, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CocktailType::class, $cocktail);
        $error = '';


        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {

            // tableau des étapes
            $stepList = $cocktail->getSteps()->getValues();

             // tableau des ingredients
            $ingredientList = $cocktail->getcocktailUses()->getValues();


            if (count($stepList) >= 1 && (count($ingredientList) >= 1)) {
                // I get the list of CocktailUse entities 
                // then I associate the cocktail with each CocktailUse entity
                $cocktailUsesList = $cocktail->getCocktailUses();


                foreach ($cocktailUsesList as $key => $value) {
                    // dd( $cocktailUsesList[$key]);
                    $cocktailUsesList[$key]->setCocktail($cocktail);
                    $entityManager->persist($cocktailUsesList[$key]);
                }



                // for each step, then i set the step number, associate it with the cocktail entity and persist it
                if (count($stepList) !== null && $ingredientList !== null) {
                    foreach ($stepList as $key => $value) {
                        $stepList[$key]->setNumberStep($key + 1);
                        $stepList[$key]->setCocktail($cocktail);
                        $entityManager->persist($stepList[$key]);
                    }

                    $entityManager->flush();

                    $this->addFlash("success", "Cocktail mis à jour");

                    return $this->redirectToRoute('app_cocktail_index', ["id" => $cocktail->getId()]);
                }
            }

            $error = 'test';
        }

        return $this->renderForm('cocktail/edit.html.twig', [
            'form' => $form,
            'error' => $error,
        ]);
    }

    /**
     * @Route("/admin/cocktail/{id}", name="app_cocktail_delete", methods={"POST"})
     */
    public function delete(Request $request, Cocktail $cocktail, CocktailRepository $cocktailRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $cocktail->getId(), $request->request->get('_token'))) {
            $cocktailRepository->remove($cocktail, true);
        }

        return $this->redirectToRoute('app_cocktail_index', [], Response::HTTP_SEE_OTHER);
    }
}
