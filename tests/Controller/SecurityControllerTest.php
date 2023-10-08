<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SecurityControllerTest extends WebTestCase
{
    public function testLogin(): void
    {
        $client = static::createClient();
        
        // I simulate a request on the road /
        $crawler = $client->request('GET', '/');

        // I check that I've reached the desired url without error
        $this->assertResponseIsSuccessful();

        // to make sure we're on the right road, I test for the presence of an h1 tag with content : Espace Admin - Connexion
        $this->assertSelectorTextContains('h1', 'Espace Admin - Connexion');

        // Check that I can log in via the login form
        $crawler = $client->submitForm("Se connecter", [
            "_username" => "williamM@gmail.com",
            "_password" => "williamM"
        ]);

        // I make sure I'm redirected to the right place
        $this->assertResponseRedirects();

        // I continue with the redirection
        $crawler = $client->followRedirect();

        // If I get to the home page displaying all the cocktails, this means that the login worked.
        $this->assertSelectorTextContains('h1', 'Les cocktails');
    }
}
