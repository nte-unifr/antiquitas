<?php

namespace NTE\AntiquitasBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use NTE\AntiquitasBundle\Entity\AntiquitasActivites;

/**
 * AntiquitasActivites controller.
 *
 * @Route("/activites")
 */
class AntiquitasActivitesController extends Controller
{

    /**
     * Lists all AntiquitasActivites entities.
     *
     * @Route("/", name="activites")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('NTEAntiquitasBundle:AntiquitasActivites')->findAll();

        return array(
            'titre'     => 'Activités',
            'entities'  => $entities,
        );
    }

    /**
     * Finds and displays a AntiquitasActivites entity.
     *
     * @Route("/{id}", name="activites_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('NTEAntiquitasBundle:AntiquitasActivites')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find AntiquitasActivites entity.');
        }

        return array(
            'titre'     => 'Activité' . $entity->getNom(),
            'entity'    => $entity,
        );
    }
}
