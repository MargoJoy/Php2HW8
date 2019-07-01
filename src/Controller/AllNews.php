<?php

namespace App\Controller;


use App\Entity\Article;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AllNews extends AbstractController
{
    /**
     * @Route("/news", name="app_news")
     */
    public function allNews(EntityManagerInterface $em, Request $request)
    {
        $q = $request->query->get('q');

        //dd($request);

        $repository = $em->getRepository(Article::class);
        $articles = $repository->findAllWithSearch($q);

        return $this->render('article/news.html.twig',
            ['articles' => $articles,
        ]);
    }

}