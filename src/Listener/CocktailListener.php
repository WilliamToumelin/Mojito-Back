<?php 

namespace App\Listener;

use App\Entity\Cocktail;
use Symfony\Component\String\Slugger\SluggerInterface;

Class CocktailListener {

    private $slugger;
    
    public function __construct(SluggerInterface $slugger){
        // I inject symfony's slugger service
        $this->slugger = $slugger;
    }

    public function slugifyName(Cocktail $cocktail){

        // I slugify the name
        $cocktail->setSlug($this->slugger->slug($cocktail->getName()));

    }
}