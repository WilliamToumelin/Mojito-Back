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
     * @Route("/admin/cocktails", name="app_cocktail_list")
     */
    public function list(CocktailRepository $cocktailRepository, Request $request): Response
    {
        return $this->render('cocktail/list.html.twig', [
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
     * @Route("/admin/cocktail/ajouter", name="app_cocktail_add", methods={"GET", "POST"})
     */

    public function add(Request $request, CocktailRepository $cocktailRepository, UserRepository $userRepository, EntityManagerInterface $entityManager): Response
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
            $cocktail->setUser($userRepository->find(50));

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

            return $this->redirectToRoute('app_cocktail_list', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('cocktail/add.html.twig', [
            'form' => $form,
        ]);
    }
}

