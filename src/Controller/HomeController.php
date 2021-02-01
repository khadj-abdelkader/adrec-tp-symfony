<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class HomeController.php
 *
 * @author Kevin Tourret
 */
class HomeController extends AbstractController
{

    /**
     * @Route(path="/", name="home")
     * @return Response
     */
    public function home(): Response {
        return $this->render('base.html.twig');
    }

}
