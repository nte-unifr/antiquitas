<?php

namespace NTE\AntiquitasBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use NTE\AntiquitasBundle\Entity\AntiquitasNoticesTextes;

/**
 * AntiquitasNoticesTextes controller.
 *
 * @Route("/noticestextes")
 */
class AntiquitasNoticesTextesController extends Controller
{

    /**
     * Lists all AntiquitasNoticesTextes entities.
     *
     * @Route("/", name="noticestextes")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('NTEAntiquitasBundle:AntiquitasNoticesTextes')->findAll();

        return array(
            'titre'     => 'Notices Textes',
            'entities' => $entities,
        );
    }

    /**
     * Finds and displays a AntiquitasNoticesTextes entity.
     *
     * @Route("/{id}", name="noticestextes_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('NTEAntiquitasBundle:AntiquitasNoticesTextes')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find AntiquitasNoticesTextes entity.');
        }

        return array(
            'titre'     => 'Notice Texte ' . $entity->getNom(),
            'entity'      => $entity,
        );
    }
}
