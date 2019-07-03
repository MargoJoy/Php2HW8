<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Tag;
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
     * @Route("/article/{slug}", name="article_show")
     * @return \Symfony\Component\HttpFoundation\Response
     * @param $slug
     */
    public function showArticle(Article $article, SlackClient $slack)
    {
        if ($article->getSlug() === 'khaaaaaan') {
            $slack->sendMessage('Kahn', 'Ah, Kirk, my old friend...');
        }

//        $article->addTag($tags);
//
//        dd($tags);

        return $this->render('article/article.html.twig', [
            'article' => $article,

        ]);
    }


}
