<?php
/**
 * Created by PhpStorm.
 * User: Nikoms
 * Date: 15/02/14
 * Time: 16:42
 */

namespace Acme\DemoBundle\Rest\Controller;


use Acme\DemoBundle\Entity\Page;
use Acme\DemoBundle\Form\PageType;
use FOS\RestBundle\Controller\Annotations as Rest;


use FOS\RestBundle\Controller\Annotations\RouteResource;
use FOS\RestBundle\Controller\Annotations\Prefix;
use FOS\RestBundle\Controller\Annotations\NamePrefix;

/**
 * NamePrefix("api_")
 * Prefix("/api")
 * Pour ne pas écrire "getPageAction"
 * @RouteResource("Page")
 */
class PageController extends EmberController
{

    /**
     * @return string
     */
    protected function getRepositoryName()
    {
        return 'AcmeDemoBundle:Page';
    }

    protected function getEntity()
    {
        return new Page();
    }

    protected function getEntityForm()
    {
        return new PageType();
    }


}