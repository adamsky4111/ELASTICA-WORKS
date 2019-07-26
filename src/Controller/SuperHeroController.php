<?php

namespace App\Controller;

use App\Form\SuperHeroType;
use Doctrine\DBAL\Schema\View;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use FOS\ElasticaBundle\Manager\RepositoryManagerInterface;
use App\Entity\SuperHero;
use App\Repository\SearchRepository\SuperHeroRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SuperHeroController extends AbstractController
{
    /**
     * @Route("/", name="superhero_search")
     *
     * @param RepositoryManagerInterface $manager
     * @param Request $request
     *
     * @return Response
     */
    public function searchSuperHero(RepositoryManagerInterface $manager, Request $request)
    {

        $superhero = new SuperHero();
        $form = $this->createForm(
            SuperHeroType::class, $superhero);
        $form->handleRequest($request);
        if($form->isSubmitted())
        {
            /** @var SuperHeroRepository $repository */
            $repository = $manager->getRepository(SuperHero::class);

            dd($superheroes = $repository->search($superhero->getName()));
         //   dd($superheroes);
            /** @var SuperHero $superhero */
//            foreach ($superheroes as $superhero) {
//                $data[] = [
//                    'name' => $superhero->getName(),
//                ];
//            }
         }
//            return new JsonResponse($data);
        return $this->render('user/index.html.twig', ['superhero' => $superhero,
            'form' => $form->createView(),]);
    }

    /**
     * @Route("/test")
     * @return Response
     * @throws \Exception
     */
    public function indexAction(Request $response)
    {


        return $this->render('user/index.html.twig', [
        ]);
    }
}