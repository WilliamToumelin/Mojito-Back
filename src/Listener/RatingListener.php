<?php
namespace App\Listener;

use App\Entity\Rating;
use Doctrine\ORM\EntityManagerInterface;

class RatingListener {


    // ! j'arrive ici que si une review est persisté
    public function updateCocktailRating(Rating $rating){
        // J'ai besoin du film, j'y accède grâce à la review
        $cocktail = $rating->getCocktail();

        // je veux additionner toutes les notes
        // j'initialise une variable à null
        $allRatings = null;

        // je parcours toutes les notes
        foreach ( $cocktail->getRatings() as $rating) {
            // ici j'additionne à chaque itération la note dans mes notes
            $allRatings += $rating->getRating();
        }


        // pour calculer une moyenne, il faut diviser le total de note par le nombre de notes
        $rating = $allRatings / count($cocktail->getRatings());

        // ici on set la note du film
        $cocktail->setRating(round($rating,1));

    }

}