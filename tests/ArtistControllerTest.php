<?php


namespace App\Tests;


use App\Entity\Artist;
use App\Repository\ArtistRepository;
use Doctrine\ORM\QueryBuilder;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\DomCrawler\Crawler;

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

        $this->assertNotEmpty($linkCreateNew, 'Link create new not found');
        // On vérifit que le lien est cliquable par le "client" et que la page sur laquelle on est redirigé existe
        $this->assertNotNull($client->click($linkCreateNew), 'Error while trying to access /artiste/new');
    }

    public function testIndexFormFilter() {
        // Créer "virtuellement" votre site
        $client = static::createClient();
        // Je dis à mon site, d'accéder à l'url /artiste
        $crawler = $client->request('GET', '/artiste/');

        // On récupère le formulaire lié au bouton 'Filtrer'
        $form = $crawler->selectButton('Filtrer')->form();
        $form['artists_filter[beginningYear]'] = '1960';
        $crawler = $client->submit($form);
        $this->assertNotEmpty($crawler, 'On a pas ete redirige apres avoir soumis le form');
    }

    public function testShowArtist() {
        // Créer "virtuellement" votre site
        $client = static::createClient();
        // Je dis à mon site, d'accéder à l'url /artiste
        $crawler = $client->request('GET', '/artiste/');
        // Appel vers la fonction de récupération des artistes
        $artists = $this->getArtists();

        foreach ($artists as $artist) {
            /** @var Artist $artist */
            $urlArtist = '/artiste/' . $artist->getId();
            // On récupère un lien dont le href vaut le l'url du show artiste
            $link = $crawler->filter('a[href="' . $urlArtist . '"]')
                ->eq(0)
                ->link();
            // On vérifit si le lien existe
            $this->assertNotEmpty($link, 'Le lien vers le detail de l artiste n a pas ete trouve');
        }
    }

    public function getArtists() {
        // On récupère le repository des artistes
        $artistsRepository = static::$container->get(ArtistRepository::class);
        // On récupère les artistes de l'app et on les renvoit
        $qb = $artistsRepository->queryAll();
        /** @var QueryBuilder $qb */
        return $qb->setMaxResults('10')->getQuery()->getResult();
    }


}
