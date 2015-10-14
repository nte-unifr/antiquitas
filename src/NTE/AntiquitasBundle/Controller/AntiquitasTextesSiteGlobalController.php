<?php

namespace NTE\AntiquitasBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use NTE\AntiquitasBundle\Entity\AntiquitasTextesSiteGlobal;

/**
 * AntiquitasTextesSiteGlobal controller.
 *
 * @Route("/textes")
 */
class AntiquitasTextesSiteGlobalController extends Controller
{

    /**
     * Lists all AntiquitasTextesSiteGlobal entities.
     *
     * @Route("/", name="textes")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('NTEAntiquitasBundle:AntiquitasTextesSiteGlobal')->findAll();

        return array(
            'titre'     => 'Textes',
            'entities' => $entities,
        );
    }

    /**
     * Finds and displays a AntiquitasTextesSiteGlobal entity.
     *
     * @Route("/{id}", name="textes_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

#        $entity = $em->getRepository('NTEAntiquitasBundle:AntiquitasTextesSiteGlobal')->find($id);
        $entities = $em->getRepository('NTEAntiquitasBundle:AntiquitasTextesSiteGlobal')->createQueryBuilder('t')
                     ->where('t.variable LIKE :var AND t.variable NOT LIKE :var_titre')
                     ->setParameter('var', $id.'_%')
                     ->setParameter('var_titre', $id.'_titre')
                     ->getQuery()->getResult();
        $titres = $em->getRepository('NTEAntiquitasBundle:AntiquitasTextesSiteGlobal')->createQueryBuilder('t')
                     ->where('t.variable LIKE :var_titre')
                     ->setParameter('var_titre', $id.'_titre')
                     ->getQuery()->getResult();
        if ($titres) {
            $titre = $titres[0]->getFR();
        } else {
            $titre = $id;
        }

#print_r($titre);
#print_r("<hr>");
#print_r($entities);

        if (!$entities) {
            throw $this->createNotFoundException('Unable to find AntiquitasModules entity.');
        }

        return array(
            'titre'     => $titre,
            'entities'      => $entities,
        );
    }
}
