<?php

namespace NTE\AntiquitasBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class AntiquitasNoticesActivitesAdmin extends Admin
{
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('nom')
            ->add('idActivite', null, array('label' => 'Activité'))
            ->add('idChapitre', null, array('label' => 'Chapitre'))
            ->add('description')
            ->add('page')
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
            ->add('idActivite', 'sonata_type_model', array('label' => 'Activité'))
            ->add('idChapitre', 'sonata_type_model', array('label' => 'Chapitre'))
            ->add('page')
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
            ->add('idActivite', 'sonata_type_model', array('label' => 'Activité'))
            ->add('idChapitre', 'sonata_type_model', array('label' => 'Chapitre'))
            ->add('description')
            ->add('page')
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
            ->add('idActivite', 'sonata_type_model', array('label' => 'Activité'))
            ->add('idChapitre', 'sonata_type_model', array('label' => 'Chapitre'))
            ->add('description')
            ->add('page')
        ;
    }
}
