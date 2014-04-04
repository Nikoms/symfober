<?php
/**
 * Created by PhpStorm.
 * User: Nikoms
 * Date: 4/04/14
 * Time: 0:58
 */

namespace Acme\DemoBundle\Routing;


use Doctrine\ORM\EntityManager;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\Config\Loader\LoaderResolverInterface;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

class ExtraLoader implements LoaderInterface
{
    private $loaded = false;
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /*
        $route = new Route(
            '/archive/{month}', // path
            array('controller' => 'showArchive'), // default values
            array('month' => '[0-9]{4}-[0-9]{2}', 'subdomain' => 'www|m'), // requirements
            array(), // options
            '{subdomain}.example.com', // host
            array(), // schemes
            array() // methods
        );
     *
     * */


    public function load($resource, $type = null)
    {
        if (true === $this->loaded) {
            throw new \RuntimeException('Do not add the "extra" loader twice');
        }

        $routes = new RouteCollection();
        $pages = $this->em->getRepository('AcmeDemoBundle:Page')->findAll();
        foreach ($pages as $page) {
            $path = '/' . $page->getSlug();
            $route = new Route($path, array(
                '_controller' => 'AcmeDemoBundle:DynamicPage:page',
            ));
            $routes->add('page_' . $page->getId(), $route);
        }

        $this->loaded = true;

        return $routes;
    }

    public function supports($resource, $type = null)
    {
        return 'extra' === $type;
    }

    public function getResolver()
    {
        // needed, but can be blank, unless you want to load other resources
        // and if you do, using the Loader base class is easier (see below)
    }

    public function setResolver(LoaderResolverInterface $resolver)
    {
        // same as above
    }
}