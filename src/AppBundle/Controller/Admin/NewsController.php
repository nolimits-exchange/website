<?php

namespace Thepixeldeveloper\Nolimitsexchange\AppBundle\Controller\Admin;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Thepixeldeveloper\Nolimitsexchange\AppBundle\Form\News;
use Thepixeldeveloper\Nolimitsexchange\AppBundle\Form\NewsContent;
use Thepixeldeveloper\Nolimitsexchange\AppBundle\Form\Type\NewsContentType;
use Thepixeldeveloper\Nolimitsexchange\AppBundle\Form\Type\NewsType;

class NewsController extends Controller
{
    /**
     * @Route("/admin/news/edit/{id}", name="admin_news_edit")
     * @Template()
     */
    public function editAction(Request $request)
    {
        $article = $this->get('doctrine')->getRepository('AppBundle:News')->findOneById($request->get('id'));

        $upload = new News();
        $upload->setName($article->getName());
        $upload->setSummary($article->getSummary());

        $form = $this->createForm(NewsType::class, $upload);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $article->setName($form->getData()->getName());
            $article->setSummary($form->getData()->getSummary());

            $this->get('doctrine.orm.entity_manager')->persist($article);
        }

        return [
            'article' => $article,
            'form'    => $form->createView(),
        ];
    }

    /**
     * @Route("/admin/news/edit/{id}/page", name="admin_news_edit_page")
     * @Template()
     */
    public function editPageAction(Request $request)
    {
        $page = $this->get('doctrine')->getRepository('AppBundle:NewsContents')->findOneById(
            $request->get('id')
        );

        $upload = new NewsContent();
        $upload->setName($page->getName());
        $upload->setContent($page->getContent());

        $form = $this->createForm(NewsContentType::class, $upload);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $page->setName($form->getData()->getName());
            $page->setContent($form->getData()->getContent());

            $this->get('doctrine.orm.entity_manager')->persist($page);
        }

        return [
            'page' => $page,
            'form' => $form->createView(),
        ];
    }
}
