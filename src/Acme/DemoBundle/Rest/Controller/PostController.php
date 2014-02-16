<?php
/**
 * Created by PhpStorm.
 * User: Nikoms
 * Date: 15/02/14
 * Time: 16:42
 */

namespace Acme\DemoBundle\Rest\Controller;


use FOS\RestBundle\Controller\Annotations\View;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
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
class PostController extends FOSRestController
{

    /**
     * Pour ne pas faire de $this->view et return $this->handleView
     * @View()
     */
    public function cgetAction()
    {
        $em = $this->getDoctrine()->getManager();
        $posts = $em->getRepository('AcmeDemoBundle:Post')->findAll();

        return array(
            'entities' => $posts
        );
    }

    /**
     * Pour ne pas faire de $this->view et return $this->handleView
     * @View()
     */
    public function getAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $post = $em->getRepository('AcmeDemoBundle:Post')->findOneById($id);

        //Pas nécessaire, si pas mis, on revient à la page précédente
        if (!is_object($post)) {
            throw $this->createNotFoundException();
        }

        return array('entity' => $post);
    }

    /**
     * @View()
     */
    public function deleteAction($id)
    {
        echo 'ici';
        exit();
    }

}