<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 019 19.06.19
 * Time: 14:54
 */

namespace App\Controller;



use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController
{
    /**
     * @Route("/")
     */
    public function homepage()
    {
        return new Response('OMG!:My first page already! WOOO!');
    }

    /**
     * @Route("/news/{slug}")
     */
    public function show($slug)
    {
        return new Response(sprintf('All about Endgame in article: "%s"', $slug));
    }

}