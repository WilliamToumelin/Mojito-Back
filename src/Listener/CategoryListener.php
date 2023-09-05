<?php 

namespace App\Listener;

use App\Entity\Category;
use Symfony\Component\String\Slugger\SluggerInterface;

Class CategoryListener {

    private $slugger;
    
    public function __construct(SluggerInterface $slugger){
        // I inject symfony's slugger service
        $this->slugger = $slugger;
    }

    public function slugifyName(Category $category){

        // I slugify the name
        $category->setSlug($this->slugger->slug($category->getName()));

    }
}