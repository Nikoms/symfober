<?php
/**
 * Created by PhpStorm.
 * User: Nikoms
 * Date: 21/02/14
 * Time: 19:00
 */

namespace Acme\DemoBundle\Rest\Controller;


use Acme\DemoBundle\Entity\Post;
use Acme\DemoBundle\Form\PostType;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\View;
use FOS\RestBundle\Util\Codes;
use Symfony\Component\HttpFoundation\Request;

abstract class EmberController extends FOSRestController{
    /**
     * @return string
     */
    abstract protected function getRepositoryName();

    /**
     * @return mixed
     */
    abstract protected function getEntity();

    /**
     * @return mixed
     */
    abstract protected function getEntityForm();

    /**
     * @return mixed
     */
    private  function getRepository()
    {
        return $this->getEntityManager()->getRepository($this->getRepositoryName());
    }

    /**
     * @return \Doctrine\Common\Persistence\ObjectManager|object
     */
    private function getEntityManager()
    {
        return $this->getDoctrine()->getManager();
    }

    /**
     * Pour ne pas faire de $this->view et return $this->handleView
     * @View()
     */
    public function cgetAction()
    {
        return array(
            'entity' => $this->getRepository()->findAll()
        );
    }

    /**
     * DELETE
     * @View()
     */
    public function deleteAction($id)
    {
        $entity = $this->getRepository()->findOneById($id);
        //Pas nécessaire, si pas mis, on revient à la page précédente
        if (!is_object($entity)) {
            throw $this->createNotFoundException();
        }
        $em = $this->getEntityManager();
        $em->remove($entity);
        $em->flush();

        return $this->view(null, Codes::HTTP_NO_CONTENT);
    }


    /**
     * Pour ne pas faire de $this->view et return $this->handleView
     * @View()
     */
    public function getAction($id)
    {
        $entity = $this->getRepository()->findOneById($id);
        //Pas nécessaire, si pas mis, on revient à la page précédente
        if (!is_object($entity)) {
            throw $this->createNotFoundException();
        }
        return array('entity' => $entity);
    }

    /**
     * NEW
     * @View()
     */
    public function postAction(Request $request){
        $entity = $this->getEntity();
        $form = $this->createForm($this->getEntityForm(), $entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getEntityManager();
            $em->persist($entity);
            $em->flush();
            return array('entity' => $entity);
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
        $entity = $this->getRepository()->findOneById($id);
        //Pas nécessaire, si pas mis, on revient à la page précédente
        if (!is_object($entity)) {
            throw $this->createNotFoundException();
        }

        $form = $this->createForm($this->getEntityForm(), $entity, array('method' => 'PUT')); //Pas oublier le PUT!!
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->view(null, Codes::HTTP_NO_CONTENT);
        }

        return array(
            'form' => $form
        );

    }

} 