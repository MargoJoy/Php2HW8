<?php

namespace App\Controller;
//getSlug('avengers-endgame-'.rand(100, 999))

use App\Entity\Article;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleAdminController extends AbstractController
{
    /**
     * @Route("/admin/article/new")
     */
    public function new(EntityManagerInterface $em)
    {
        $article = new Article();
        $article->setTitle('Avengers Endgame')
            ->setSlug('avengers-endgame-'.rand(100, 999))
            ;

        $article->setAuthor('Имя Фамилия')
        ->setImageFilename('kosmosBlack.jpg');

        $em->persist($article);
        $em->flush();

        return new Response(sprintf('some text about  New Article id: #%d slug: %s',
            $article->getId(),
            $article->getSlug()
        ));

    }

}