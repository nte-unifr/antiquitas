<?php

namespace NTE\AntiquitasBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class AntiquitasChapitresAdmin extends Admin
{
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('nom')
            ->add('idModule', null, array('label' => 'Module'))
            ->add('theme')
            ->add('objectif')
            ->add('position')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->add('nom')
            ->add('idModule', null, array('label' => 'Module'))
            ->add('theme')
            ->add('objectif')
            ->add('position')
            ->add('_action', 'actions', array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
                    'delete' => array(),
                )
            ))
        ;
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('nom')
            ->add('idModule', null, array('label' => 'Module'))
            ->add('theme', null, array('attr' => array('class' => 'ckeditor')))
            ->add('objectif', null, array('attr' => array('class' => 'ckeditor')))
            ->add('position')
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('nom')
            ->add('idModule', null, array('label' => 'Module'))
            ->add('theme')
            ->add('objectif')
            ->add('position')
            ->with('Fiches')
                ->add('fiches')
            ->end()
            ->with('Activités')
                ->add('activites')
            ->end()
        ;
    }
}
