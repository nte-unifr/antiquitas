<?php

namespace NTE\AntiquitasBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use NTE\AntiquitasBundle\Entity\AntiquitasNoticesLiens;

/**
 * AntiquitasNoticesLiens controller.
 *
 * @Route("/noticesliens")
 */
class AntiquitasNoticesLiensController extends Controller
{

    /**
     * Lists all AntiquitasNoticesLiens entities.
     *
     * @Route("/", name="noticesliens")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('NTEAntiquitasBundle:AntiquitasNoticesLiens')->findAll();

        return array(
            'titre'     => 'Notices Liens',
            'entities' => $entities,
        );
    }

    /**
     * Finds and displays a AntiquitasNoticesLiens entity.
     *
     * @Route("/{id}", name="noticesliens_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('NTEAntiquitasBundle:AntiquitasNoticesLiens')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find AntiquitasNoticesLiens entity.');
        }

        return array(
            'titre'     => 'Notices Liens pour la fiche '.$entity->getIdFiche(),
            'entity'      => $entity,
        );
    }
}
