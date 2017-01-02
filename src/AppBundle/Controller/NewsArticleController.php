<?php

namespace Thepixeldeveloper\Nolimitsexchange\AppBundle\Controller;

use Pagerfanta\Adapter\DoctrineCollectionAdapter;
use Pagerfanta\Pagerfanta;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class NewsArticleController extends Controller
{
    /**
     * @Route("/news/{slug}/{id}", name="news_article")
     */
    public function indexAction(Request $request)
    {
        $article = $this->getDoctrine()->getRepository('AppBundle:News')->findOneBy(['id' => $request->get('id')]);

        if (!$article) {
            throw $this->createNotFoundException();
        }

        $pages = new DoctrineCollectionAdapter($article->getPages());

        try {
            $pager = (new Pagerfanta($pages))
                ->setMaxPerPage(1)
                ->setCurrentPage($request->get('page', 1));

            return $this->render('AppBundle:NewsArticle:index.html.twig', [
                'article' => $article,
                'pages'   => $pager->getCurrentPageResults(),
                'pager'   => $pager,
            ]);

        } catch (\Exception $e) {
            $this->get('logger')->addError($e->getMessage());
        }

        return new Response('', Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
