<?php
/**
 * Created by PhpStorm.
 * User: Nikoms
 * Date: 15/02/14
 * Time: 16:42
 */

namespace Acme\DemoBundle\Rest\Controller;


use Acme\DemoBundle\Entity\Post;
use Acme\DemoBundle\Form\PostType;
use FOS\RestBundle\Controller\Annotations\View;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Util\Codes;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;


use FOS\RestBundle\Controller\Annotations\RouteResource;
use FOS\RestBundle\Controller\Annotations\Prefix;
use FOS\RestBundle\Controller\Annotations\NamePrefix;

/**
 * NamePrefix("api_")
 * Prefix("/api")
 * Pour ne pas écrire "getPostAction"
 * @RouteResource("Post")
 */
class PostController extends EmberController
{

    /**
     * @return string
     */
    protected function getRepositoryName()
    {
        return 'AcmeDemoBundle:Post';
    }

    protected function getEntity()
    {
        return new Post();
    }

    protected function getEntityForm()
    {
        return new PostType();
    }


}