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
     * NEW
     * @View()
     */
    public function postAction(Request $request){
        $post = new Post();
        $form = $this->createForm(new PostType(), $post);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($post);
            $em->flush();

            return $this->redirectView(
                $this->generateUrl(
                    'api_get_post',
                    array('id' => $post->getId())
                ),
                Codes::HTTP_CREATED
            );
        }

        /*{"code":400,"message":"Validation Failed","errors":{"children":{"title":[],"body":{"errors":["This value should not be blank."]}}}}*/
        return array(
            'form' => $form,
        );
    }

    /**
     * Update
     * @View()
     */
    public function putAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $post = $em->getRepository('AcmeDemoBundle:Post')->findOneById($id);
        //Pas nécessaire, si pas mis, on revient à la page précédente
        if (!is_object($post)) {
            throw $this->createNotFoundException();
        }

        $form = $this->createForm(new PostType(), $post, array('method' => 'PUT')); //Pas oublier le PUT!!
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($post);
            $em->flush();

            return $this->view(null, Codes::HTTP_NO_CONTENT);
        }

        return array(
            'form' => $form
        );

    }

    /**
     * DELETE
     * @View()
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $post = $em->getRepository('AcmeDemoBundle:Post')->findOneById($id);
        return array('xxxx' => $post);
        return array('post' => $post);
        //Pas nécessaire, si pas mis, on revient à la page précédente
        if (!is_object($post)) {
            throw $this->createNotFoundException();
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($post);
        $em->flush();

        return $this->view(null, Codes::HTTP_NO_CONTENT);
    }

}