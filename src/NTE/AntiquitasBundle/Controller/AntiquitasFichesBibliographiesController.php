<?php

namespace NTE\AntiquitasBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use NTE\AntiquitasBundle\Entity\AntiquitasFichesBibliographies;

/**
 * AntiquitasFichesBibliographies controller.
 *
 * @Route("/fichesbibliographies")
 */
class AntiquitasFichesBibliographiesController extends Controller
{

    /**
     * Lists all AntiquitasFichesBibliographies entities.
     *
     * @Route("/", name="fichesbibliographies")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('NTEAntiquitasBundle:AntiquitasFichesBibliographies')->findAll();

        return array(
            'titre'     => 'Bibliographie',
            'entities' => $entities,
        );
    }

    /**
     * Finds and displays a AntiquitasFichesBibliographies entity.
     *
     * @Route("/{id}", name="fichesbibliographies_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('NTEAntiquitasBundle:AntiquitasFichesBibliographies')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find AntiquitasFichesBibliographies entity.');
        }

        return array(
            'titre'     => 'Bibliographie de la fiche '.$entity->getIdFiche(),
            'entity'      => $entity,
        );
    }
}
