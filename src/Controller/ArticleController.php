<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    /**
     * @Route("/news/{slug}")
     * @param $slug
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function show($slug)
    {
        $comments = [
            'Я съел нормальный камень один раз. Это НЕ на вкус, как бекон!',
            'Woohoo! Я иду на полностью астероидную диету!',
            'Я тоже люблю бекон! Купи немного с моего сайта! bakinsomebacon.com',
        ];

        //dump($slug, $this);

        return $this->render('article/show.html.twig', [
            'title' => ucwords(str_replace('-', ' ', $slug)),
            'comments' => $comments,
        ]);
    }
}