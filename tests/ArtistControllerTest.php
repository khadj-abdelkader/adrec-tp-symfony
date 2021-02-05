<?php


namespace App\Tests;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Class ArtistControllerTest.php
 *
 * @author Kevin Tourret
 */
class ArtistControllerTest extends WebTestCase
{

    /**
     * Toutes les méthodes effectuant des tests doivent impérativement commencer par le mot clé : test
     * Sinon elles ne seront pas effectuées
     */
    public function testArtistIndex() {
        // Créer "virtuellement" votre site
        $client = static::createClient();
        // Je dis à mon site, d'accéder à l'url /artiste
        $client->request('GET', '/artiste/');
        // Check if the Response if successful, otherwise display the message
        // Les deux méthodes font la même chose, car un code de retour valant 200 est une réponse réussie
        $this->assertResponseStatusCodeSame(200, 'Error');
        $this->assertResponseIsSuccessful('Error');
    }

    public function testTitleArtistIndex() {
        // Créer "virtuellement" votre site
        $client = static::createClient();
        // Je dis à mon site, d'accéder à l'url /artiste
        $crawler = $client->request('GET', '/artiste/');

        $title = $crawler->filter('title')
            ->eq(0);

        $this->assertNotEmpty($title, 'Title not found');
        // Ici on vérifit depuis le title récupéré depuis le crawler, si sa valeur est bien Artist index
        $this->assertStringContainsString($title->text(),'Artist index', 'Title content not valid');
        // Ici on vérifit depuis un selecteur HTML si sa valeur est bien Artist index
        $this->assertSelectorTextContains('title', 'Artist index', 'Title content not valid');
    }

    public function testLinkCreateNewArtist() {
        // Créer "virtuellement" votre site
        $client = static::createClient();
        // Je dis à mon site, d'accéder à l'url /artiste
        $crawler = $client->request('GET', '/artiste/');

        $linkCreateNew = $crawler->filter('a[href="/artiste/new"]')
            ->eq(0)
            ->link();

        $this->assertNotEmpty($linkCreateNew, 'Link crerate new not found');
        // On vérifit que le lien est cliquable par le "client" et que la page sur laquelle on est redirigé existe
        $this->assertNotNull($client->click($linkCreateNew), 'Error while trying to access /artiste/new');
    }
}
