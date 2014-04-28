<?php
/**
 * Created by PhpStorm.
 * User: Nikoms
 * Date: 29/04/14
 * Time: 0:10
 */

namespace Acme\DemoBundle\Admin;


use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Validator\ErrorElement;

class PostAdmin extends Admin
{
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('title')
            ->add('body')

            // add custom action links
            ->add('_action', 'actions', array(
                    'actions' => array(
                        'show' => array(),
                        'edit' => array(),
                    )
                ))
        ;
    }
    protected function configureDatagridFilters(DatagridMapper $datagrid)
    {
        $datagrid
            ->add('title')
        ;
    }
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
//            ->add('author', 'sonata_type_model', array(), array('edit' => 'list'))
            ->add('title')
            ->add('body')
//            ->add('abstract', null, array('required' => false))

            // you can define help messages like this
            ->setHelps(array(
                    'title' => $this->trans('help_post_title')
                ));

    }
} 