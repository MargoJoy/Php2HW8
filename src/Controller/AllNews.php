<?php

namespace App\Controller;


use App\Entity\Article;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AllNews extends AbstractController
{
    /**
     * @Route("/news", name="app_news")
     */
    public function allNews(EntityManagerInterface $em)
    {
        $repository = $em->getRepository(Article::class);
        $articles = $repository->findAll();

        return $this->render('article/news.html.twig',
            ['articles' => $articles,
        ]);
    }

}