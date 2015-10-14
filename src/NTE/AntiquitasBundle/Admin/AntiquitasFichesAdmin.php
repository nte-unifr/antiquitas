<?php

namespace NTE\AntiquitasBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class AntiquitasFichesAdmin extends Admin
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
            ->add('contenu')
            ->add('position')
            ->add('statut')
            ->add('bibliographie')
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
            ->add('position')
            ->add('statut')
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
            ->add('contenu', null, array('attr' => array('class' => 'ckeditor')))
            ->add('position')
            ->add('statut')
            ->add('bibliographie')
            ->add('biblio', null, array('read_only' => true, 'required' => false))
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
            ->add('contenu')
            ->add('position')
            ->add('statut')
            ->add('bibliographie')
        ;
    }
}
