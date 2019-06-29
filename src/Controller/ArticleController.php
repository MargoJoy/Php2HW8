<?php

namespace App\Controller;

use App\Entity\Article;
use App\Service\MarkdownHelper;
use App\Service\SlackClient;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{

    private $isDebug;

    public function __construct(bool $isDebug)
    {
        //dump($isDebug);die;
        $this->isDebug = $isDebug;
    }
    /**
     * @Route("/article/{slug}", name="article_show")
     * @return \Symfony\Component\HttpFoundation\Response
     * @param $slug
     */
    public function showArticle($slug, SlackClient $slack, EntityManagerInterface $em)
    {
        if ($slug === 'khaaaaaan') {
            $slack->sendMessage('Kahn', 'Ah, Kirk, my old friend...');
        }
        /**
         * @var Article $article
         */
        $repository = $em->getRepository(Article::class);
        $article = $repository->findOneBy(['slug' => $slug]);
        if (!$article) {
            throw $this->createNotFoundException(sprintf('No article for slug "%s"', $slug));
        }

        $comments = [
            'Я съел нормальный камень один раз. Это НЕ на вкус, как бекон!',
            'Woohoo! Я иду на полностью астероидную диету!',
            'Я тоже люблю бекон! Купи немного с моего сайта! bakinsomebacon.com',
        ];


        return $this->render('article/article.html.twig', [
            'article' => $article,
            'comments' => $comments,
        ]);
    }
}
