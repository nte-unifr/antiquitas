<?php

namespace NTE\AntiquitasBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use NTE\AntiquitasBundle\Entity\AntiquitasNoticesImages;

/**
 * AntiquitasNoticesImages controller.
 *
 * @Route("/noticesimages")
 */
class AntiquitasNoticesImagesController extends Controller
{

    /**
     * Lists all AntiquitasNoticesImages entities.
     *
     * @Route("/", name="noticesimages")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('NTEAntiquitasBundle:AntiquitasNoticesImages')->findAll();

        return array(
            'titre'     => 'Notices Images',
            'entities' => $entities,
        );
    }

    /**
     * Finds and displays a AntiquitasNoticesImages entity.
     *
     * @Route("/{id}", name="noticesimages_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('NTEAntiquitasBundle:AntiquitasNoticesImages')->findOneBy(array('id' => $id, 'statut' => 1));

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find AntiquitasNoticesImages entity.');
        }

        return array(
            'titre'     => 'Notice Image de la fiche ' . $entity->getIdFiche(),
            'entity'      => $entity,
        );
    }
}
