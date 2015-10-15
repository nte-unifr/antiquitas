<?php

namespace NTE\AntiquitasBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class AntiquitasModulesAdmin extends Admin
{
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('nom')
            ->add('sourcesIntroduction')
            ->add('bibliographieIntroduction')
            ->add('introductionResume')
            ->add('introduction')
            ->add('conclusionResume')
            ->add('conclusion')
            ->add('langage')
            ->add('position')
            ->add('id')
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
            ->add('banniere')
            ->add('langage')
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
            ->with('Module')
                ->add('nom')
                ->add('sourcesIntroduction')
                ->add('bibliographie')
                ->add('bibliographieIntroduction', null, array('read_only' => true, 'help' => 'Ce champ est peut-être un doublon avec le champ Bibliographie, c\'est pourquoi il est en lecture seule, si ce n\'est pas le cas, avertir les admin ou le Centre NTE. A terme il sera supprimé...'))
                ->add('introductionResume')
                ->add('introduction')
                ->add('conclusionResume')
                ->add('conclusion')
                ->add('langage')
                ->add('position')
                ->add('banniere', null, array('read_only' => true, 'help' => 'Ici pour vérifié l\'importation des images. Il va être supprimé à terme. Utilisez le champ media ci-dessous. '))
                ->add('media', 'sonata_type_model_list', array('required' => false))
            ->end()
            ->with('Thèmes')
                ->add('themes', null, array('expanded' => true))
            ->end()
            ->with('Outils')
                ->add('outils', null, array('required' => false, 'expanded' => true))
            ->end()
            ->with('Auteurs')
                ->add('auteurs', null, array('expanded' => true))
            ->end()
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
            ->add('sourcesIntroduction')
            ->add('bibliographieIntroduction')
            ->add('introductionResume')
            ->add('introduction')
            ->add('conclusionResume')
            ->add('conclusion')
            ->add('langage')
            ->add('position')
            ->add('banniere')
            ->add('media')
            ->with('Thèmes')
                ->add('themes', null, array('expanded' => true))
            ->end()
            ->with('Chapitres')
                ->add('chapitres')
            ->end()
            ->with('Outils')
                ->add('outils')
            ->end()
        ;
    }
}
