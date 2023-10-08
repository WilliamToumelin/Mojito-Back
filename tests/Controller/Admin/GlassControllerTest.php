<?php

namespace App\Tests\Controller\Admin;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class GlassControllerTest extends WebTestCase
{
    const GOOD_GLASS =  [
        "glass[name]" => "ab",
    ];

    const BAD_GLASS =  [
        "glass[name]" => "a",
    ];

    public function testAddGlass(): void
    {
        $client = static::createClient();

        // I retrieve the userRepository
        $userRepository = static::getContainer()->get(UserRepository::class);

        // I retrieve a test user
        $testUser = $userRepository->findOneByEmail('williamM@gmail.com');

        //if the user has the admin role

        if (in_array('ROLE_ADMIN', $testUser->getRoles(), true)) {

            // I connect the test user
            $client->loginUser($testUser);
            
            // I simulate a request on the road /
            $crawler = $client->request('GET', '/admin/verre/ajouter');
            
            //I check that the minimum text length constraint prevents the form from being submitted, even if the form has not been filled in correctly.
            $client->submitForm("Valider", self::BAD_GLASS);
            $this->assertEquals(422, $client->getResponse()->getStatusCode());

            // I check that the delivery works when the form is filled in correctly
            $client->submitForm("Valider", self::GOOD_GLASS);
            $this->assertEquals(303, $client->getResponse()->getStatusCode());
        
            //if the user doesn't have the admin role
        } else {

            $crawler = $client->request('GET', '/');
            // If I get to the home page displaying all the cocktails, this means that the login worked.
            $this->assertSelectorTextContains('h1', 'Espace Admin - Connexion');
        }
    }
}
