<?php

namespace App\Controller;

use App\Entity\Artist;
use App\Form\ArtistType;
use App\Form\Filter\ArtistsFilterType;
use App\Repository\ArtistRepository;
use Knp\Component\Pager\PaginatorInterface;
use Lexik\Bundle\FormFilterBundle\Filter\FilterBuilderUpdaterInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/artiste")
 */
class ArtistController extends AbstractController
{

    /**
     * @var ArtistRepository $artistRepository
     */
    public ArtistRepository $artistRepository;

    /**
     * ArtistController constructor.
     * @param ArtistRepository $artistRepository
     */
    public function __construct(ArtistRepository $artistRepository)
    {
        $this->artistRepository = $artistRepository;
    }

    /**
     * @Route("/", name="artist_index", methods={"GET"})
     * @param Request $request
     * @param PaginatorInterface $paginator
     * @param FilterBuilderUpdaterInterface $builderUpdater
     * @return Response
     */
    public function index(
        Request $request,
        PaginatorInterface $paginator,
        FilterBuilderUpdaterInterface $builderUpdater
    ): Response
    {
        // KNP se base sur un QueryBuilder : on doit faire la requête permettant de le récupérer
        $artistsQb = $this->artistRepository->queryAll();

        // Création du formulaire des filtres, en methode GET uniquement
        $filterForm = $this->createForm(ArtistsFilterType::class, null, [
           'method' => 'GET',
        ]);

        // On vérifie que notre formulaire existe dans la requête HTTP
        if ($request->query->has($filterForm->getName())) {
            // S'il existe, on récupère sa soumission
            $filterForm->submit($request->query->get($filterForm->getName()));
            // Et on applique les filtres saisis par l'utilisateur via notre QB
            $builderUpdater->addFilterConditions($filterForm, $artistsQb);
        }

        // KNP va ajouter un paramètre à notre requête, de nom 'page', il faut le récupérer
        // pour gérer les changements de pages de l'utilisateur
        $artists = $paginator->paginate(
            $artistsQb,
            $request->query->getInt('page', 1),
            10
        );

        return $this->render('artist/index.html.twig', [
            'artists' => $artists,
            'filters' => $filterForm->createView(),
        ]);
    }

    /**
     * @Route("/new", name="artist_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $artist = new Artist();
        $form = $this->createForm(ArtistType::class, $artist);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($artist);
            $entityManager->flush();

            return $this->redirectToRoute('artist_index');
        }

        return $this->render('artist/new.html.twig', [
            'artist' => $artist,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="artist_show", methods={"GET"})
     */
    public function show(Artist $artist): Response
    {
        return $this->render('artist/show.html.twig', [
            'artist' => $artist,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="artist_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Artist $artist): Response
    {
        $form = $this->createForm(ArtistType::class, $artist);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('artist_index');
        }

        return $this->render('artist/edit.html.twig', [
            'artist' => $artist,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="artist_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Artist $artist): Response
    {
        if ($this->isCsrfTokenValid('delete'.$artist->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($artist);
            $entityManager->flush();
        }

        return $this->redirectToRoute('artist_index');
    }
}
