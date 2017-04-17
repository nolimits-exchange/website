<?php

namespace Thepixeldeveloper\Nolimitsexchange\AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Thepixeldeveloper\Nolimitsexchange\AppBundle\Entity\File;
use Thepixeldeveloper\Sitemap\Output;
use Thepixeldeveloper\Sitemap\Url;
use Thepixeldeveloper\Sitemap\Urlset;

class SitemapController extends Controller
{
    /**
     * @Route("/sitemap.xml", name="sitemap_index")
     * @throws \Symfony\Component\Routing\Exception\InvalidParameterException
     * @throws \Symfony\Component\Routing\Exception\MissingMandatoryParametersException
     * @throws \Symfony\Component\Routing\Exception\RouteNotFoundException
     * @throws \InvalidArgumentException
     */
    public function indexAction(Request $request)
    {
        $coasters = new Urlset();

        $filesRepository = $this->get('doctrine')->getRepository('AppBundle:File')->findBy([
            'status' => File::PUBLISHED
        ]);

        $router = $this->get('router');

        foreach ($filesRepository as $item) {
            $url = new Url(
                $router->generate('coaster', [
                    'id'   => $item->getId(),
                    'slug' => $this->get('slugify')->slugify($item->getName())
                ])
            );

            $coasters->addUrl($url);
        }

        $output = new Output();

        return new Response($output->getOutput($coasters));
    }
}
