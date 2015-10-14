<?php

namespace NTE\AntiquitasBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use NTE\AntiquitasBundle\Entity\AntiquitasFiches;

/**
 * AntiquitasFiches controller.
 *
 * @Route("/fiches")
 */
class AntiquitasFichesController extends Controller
{

    /**
     * Lists all AntiquitasFiches entities.
     *
     * @Route("/", name="fiches")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('NTEAntiquitasBundle:AntiquitasFiches')->findAll();

        return array(
            'titre' => 'Fiches',
            'entities' => $entities,
        );
    }

    /**
     * Finds and displays a AntiquitasFiches entity.
     *
     * @Route("/{id}", name="fiches_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('NTEAntiquitasBundle:AntiquitasFiches')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find AntiquitasFiches entity.');
        }

        return array(
            'titre' => 'Fiche ' . $entity->getNom(),
            'entity'      => $entity,
        );
    }
}
