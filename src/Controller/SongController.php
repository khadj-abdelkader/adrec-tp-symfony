<?php

namespace App\Controller;

use App\Entity\Song;
use App\Form\SongType;
use App\Repository\SongRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/chanson")
 */
class SongController extends AbstractController
{
    /**
     * @Route("/", name="song_index", methods={"GET"})
     * @param Request $request
     * @param SongRepository $songRepository
     * @return Response
     */
    public function index(
        Request $request,
//        FilterBuilderUpdaterInterface $builderUpdater,
        SongRepository $songRepository
//        PaginatorInterface $paginator
    ): Response
    {
//        $qb = $songRepository->queryAll();

//        $filterForm = $this->createForm(CustomersCollectionFilterType::class, null, [
//            'method' => 'GET',
//        ]);
//
//        if ($request->query->has($filterForm->getName())) {
//            $filterForm->submit($request->query->get($filterForm->getName()));
//            $builderUpdater->addFilterConditions($filterForm, $qb);
//        }

//        Form builder :
//
//        $builder
//            ->add('lastName', TextFilterType::class, [
//                'condition_pattern' => FilterOperands::STRING_CONTAINS,
//            ])
//            ->add('firstName', TextFilterType::class, [
//                'condition_pattern' => FilterOperands::STRING_CONTAINS,
//            ])
//            ->add('email', TextFilterType::class, [
//                'condition_pattern' => FilterOperands::STRING_CONTAINS,
//            ])
//            ->add('phone', TextFilterType::class, [
//                'condition_pattern' => FilterOperands::STRING_CONTAINS,
//            ])
//        ;

//        $songs = $paginator->paginate($qb, $request->query->getInt('page', 1), 10);

        return $this->render('song/index.html.twig', [
            'songs' => $songRepository->findAll(),
//            'filters' => $filterForm->createView(),
        ]);
    }

    /**
     * @Route("/new", name="song_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $song = new Song();
        $form = $this->createForm(SongType::class, $song);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($song);
            $entityManager->flush();

            return $this->redirectToRoute('song_index');
        }

        return $this->render('song/new.html.twig', [
            'song' => $song,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="song_show", methods={"GET"})
     */
    public function show(Song $song): Response
    {
        return $this->render('song/show.html.twig', [
            'song' => $song,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="song_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Song $song): Response
    {
        $form = $this->createForm(SongType::class, $song);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('song_index');
        }

        return $this->render('song/edit.html.twig', [
            'song' => $song,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="song_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Song $song): Response
    {
        if ($this->isCsrfTokenValid('delete'.$song->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($song);
            $entityManager->flush();
        }

        return $this->redirectToRoute('song_index');
    }
}
