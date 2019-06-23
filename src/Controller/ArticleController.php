<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    /**
     * @Route("/article/{slug}", name="article_show")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showArticle($slug)
    {
        $comments = [
            'Я съел нормальный камень один раз. Это НЕ на вкус, как бекон!',
            'Woohoo! Я иду на полностью астероидную диету!',
            'Я тоже люблю бекон! Купи немного с моего сайта! bakinsomebacon.com',
        ];

        return $this->render('article/article.html.twig', [
            'title' => ucwords(str_replace('-', ' ', $slug)),
            'comments' => $comments,
        ]);
    }
}
