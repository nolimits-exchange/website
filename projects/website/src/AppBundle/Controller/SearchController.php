<?php

namespace Thepixeldeveloper\Nolimitsexchange\AppBundle\Controller;

use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\Pagerfanta;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Thepixeldeveloper\Nolimitsexchange\AppBundle\Form\Search;
use Thepixeldeveloper\Nolimitsexchange\AppBundle\Form\Type\SearchType;

class SearchController extends Controller
{
    /**
     * @Route("/search/categories.html", name="search_categories_partial")
     * @throws \Symfony\Component\OptionsResolver\Exception\InvalidOptionsException
     */
    public function searchCategoriesPartialAction(Request $request)
    {
        $search = new Search();

        $form = $this->createForm(SearchType::class, $search);
        $form->handleRequest($request);

        return $this->render('AppBundle:Search:categories_partial.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/search", name="search")
     * @Template
     *
     * @param Request $request
     *
     * @return array
     *
     * @throws \LogicException
     */
    public function indexAction(Request $request)
    {
        $search = new Search();
        $search->setDownloadsSort($request->query->get('downloads_sort'));
        $search->setRatingsSort($request->query->get('ratings_sort'));

        $form = $this->createForm(SearchType::class, $search);
        $form->handleRequest($request);
        
        $files = $this
            ->getDoctrine()
            ->getRepository('AppBundle:Search')
            ->search($search);

        $files = new DoctrineORMAdapter($files, false);

        $pager = (new Pagerfanta($files))
            ->setMaxPerPage(10)
            ->setCurrentPage($request->get('page', 1));

        return [
            'title'  => $this->get('translator')->trans('Search'),
            'files'  => $pager->getCurrentPageResults(),
            'form'   => $form->createView(),
            'pager'  => $pager,
        ];
    }
}
