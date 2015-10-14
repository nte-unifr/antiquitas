<?php

namespace NTE\AntiquitasBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class AntiquitasNoticesTextesAdmin extends Admin
{
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('nom')
            ->add('idFiche', null, array('label' => 'Fiche'))
            ->add('description')
            ->add('contenu')
            ->add('idType', null, array('label' => 'Type'))
            ->add('statut')
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
            ->add('idFiche', 'sonata_type_model', array('label' => 'Fiche'))
            ->add('statut')
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
            ->add('idFiche', 'sonata_type_model', array('label' => 'Fiche'))
            ->add('description')
            ->add('contenu')
            ->add('idType', 'sonata_type_model', array('label' => 'Type'))
            ->add('statut')
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
            ->add('idFiche', null, array('label' => 'Fiche'))
            ->add('description')
            ->add('contenu')
            ->add('idType', null, array('label' => 'Type'))
            ->add('statut')
            ->add('position')
        ;
    }
}
