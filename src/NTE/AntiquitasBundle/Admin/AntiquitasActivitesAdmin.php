<?php

namespace NTE\AntiquitasBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class AntiquitasActivitesAdmin extends Admin
{
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('nom')
            ->add('idChapitre', null, array('label' => 'Chapitre'))
            ->add('description')
            ->add('contenu')
            ->add('vignette')
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
            ->add('idChapitre', null, array('label' => 'Chapitre'))
            ->add('description')
            ->add('contenu')
            ->add('vignette')
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
            ->add('idChapitre', null, array('label' => 'Chapitre'))
            ->add('description', null, array('attr' => array('class' => 'ckeditor')))
            ->add('contenu', null, array('attr' => array('class' => 'ckeditor')))
            ->add('vignette', null, array('read_only' => true))
            ->add('media','sonata_type_model_list', array('required' => false))
            ->add('idType', null, array('label' => 'Type'))
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
            ->add('idChapitre', null, array('label' => 'Chapitre'))
            ->add('description')
            ->add('contenu')
            ->add('vignette')
            ->add('position')
        ;
    }
}
