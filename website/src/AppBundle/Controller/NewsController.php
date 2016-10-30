<?php

namespace Thepixeldeveloper\Nolimitsexchange\AppBundle\Controller;

use Doctrine\Common\Collections\ArrayCollection;
use Exception;
use Pagerfanta\Adapter\DoctrineCollectionAdapter;
use Pagerfanta\Pagerfanta;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Thepixeldeveloper\Nolimitsexchange\AppBundle\Entity\News;

class NewsController extends Controller
{
    /**
     * @Route("/news/categories.html", name="news_categories_partial")
     */
    public function newsCategoriesPartialAction()
    {
        return $this->render('AppBundle:News:categories_partial.html.twig', [
            'categories' => $this->getDoctrine()->getRepository('AppBundle:NewsCategory')->findAll(),
        ]);
    }

    /**
     * @Route("/news", name="news")
     * @Route("/news/{category}", name="news_category")
     *
     * @throws \Pagerfanta\Exception\LessThan1MaxPerPageException
     * @throws \Pagerfanta\Exception\NotIntegerMaxPerPageException
     * @throws \Pagerfanta\Exception\LessThan1CurrentPageException
     * @throws \Pagerfanta\Exception\NotIntegerCurrentPageException
     * @throws \Pagerfanta\Exception\OutOfRangeCurrentPageException
     * @throws \LogicException
     */
    public function newsAction(Request $request)
    {
        $category = $this->getDoctrine()->getRepository('AppBundle:NewsCategory')->findOneBy(['url' => $request->get('category', '')]);

        if (!$category) {
            throw $this->createNotFoundException();
        }

        if ($category->getName() === 'All') {
            $articles = new ArrayCollection(
                $this
                    ->getDoctrine()
                    ->getRepository('AppBundle:News')
                    ->findBy(['enabled' => true], ['dateAdded' => 'DESC'])
            );
        } else {
            $articles = $category
                ->getArticles()
                ->filter(function(News $news) {
                    return $news->getEnabled();
                });
        }

        $articles = new DoctrineCollectionAdapter($articles);

        $pager = (new Pagerfanta($articles))
            ->setMaxPerPage(10)
            ->setCurrentPage($request->get('page', 1));

        return $this->render('AppBundle:News:index.html.twig', [
            'articles' => $pager->getCurrentPageResults(),
            'category' => $category,
            'pager'    => $pager,
        ]);
    }
}
