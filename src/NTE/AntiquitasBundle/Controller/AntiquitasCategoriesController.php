<?php

namespace NTE\AntiquitasBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use NTE\AntiquitasBundle\Entity\AntiquitasCategories;

/**
 * AntiquitasCategories controller.
 *
 * @Route("/categories")
 */
class AntiquitasCategoriesController extends Controller
{

    /**
     * Lists all AntiquitasCategories entities.
     *
     * @Route("/", name="categories")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('NTEAntiquitasBundle:AntiquitasCategories')->findBy(array(), array('position' => 'ASC'));

        $titre = $em->getRepository('NTEAntiquitasBundle:AntiquitasTextesSiteGlobal')->findOneBy(array('variable' => 'liste_modules_titre'));
        $locale = $this->getRequest()->getLocale();
        switch ( $locale ) {
            case 'de':
                $titre = $titre->getDe();
                break;
            case 'en':
                $titre = $titre->geten();
                break;
            case 'fr':
            default:
                $titre = $titre->getFr();
        }

        $intro = $em->getRepository('NTEAntiquitasBundle:AntiquitasTextesSiteGlobal')->findOneBy(array('variable' => 'liste_modules_introduction'));

        return array(
            'titre'     => $titre,
            'intro'     => $intro,
            'entities' => $entities,
        );
    }

    /**
     * Finds and displays a AntiquitasCategories entity.
     *
     * @Route("/{id}", name="categories_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('NTEAntiquitasBundle:AntiquitasCategories')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find AntiquitasCategories entity.');
        }

        return array(
            'titre'     => 'Catégorie ' . $entity->getNom(),
            'entity'      => $entity,
        );
    }
}
