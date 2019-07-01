<?php

namespace App\Controller;

use App\Entity\Article;
use App\Service\SlackClient;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{

    private $isDebug;

    public function __construct(bool $isDebug)
    {
        $this->isDebug = $isDebug;
    }
    /**
     * @Route("/pages/{slug}", name="article_show")
     * @return \Symfony\Component\HttpFoundation\Response
     * @param $slug
     */
    public function showArticle(Article $article, SlackClient $slack)
    {
        if ($article->getSlug() === 'khaaaaaan') {
            $slack->sendMessage('Kahn', 'Ah, Kirk, my old friend...');
        }

        $comments = [
            'Я съел нормальный камень один раз. Это НЕ на вкус, как бекон!',
            'Woohoo! Я иду на полностью астероидную диету!',
            'Я тоже люблю бекон! Купи немного с моего сайта! bakinsomebacon.com',
        ];


        return $this->render('article/article.html.twig', [
            'pages' => $article,
            'comments' => $comments,
        ]);
    }


}
