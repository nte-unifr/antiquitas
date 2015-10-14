<?php

namespace NTE\AntiquitasBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use NTE\AntiquitasBundle\Entity\AntiquitasNoticesNotes;

/**
 * AntiquitasNoticesNotes controller.
 *
 * @Route("/noticesnotes")
 */
class AntiquitasNoticesNotesController extends Controller
{

    /**
     * Lists all AntiquitasNoticesNotes entities.
     *
     * @Route("/", name="noticesnotes")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('NTEAntiquitasBundle:AntiquitasNoticesNotes')->findAll();

        return array(
            'titre'     => 'Notices Notes',
            'entities' => $entities,
        );
    }

    /**
     * Finds and displays a AntiquitasNoticesNotes entity.
     *
     * @Route("/{id}", name="noticesnotes_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('NTEAntiquitasBundle:AntiquitasNoticesNotes')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find AntiquitasNoticesNotes entity.');
        }

        return array(
            'titre'     => 'Notice Note ' . $entity->getNom(),
            'entity'      => $entity,
        );
    }
}
