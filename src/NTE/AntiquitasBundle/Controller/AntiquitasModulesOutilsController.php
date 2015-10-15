<?php

namespace NTE\AntiquitasBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use NTE\AntiquitasBundle\Entity\AntiquitasModulesOutils;

/**
 * AntiquitasModulesOutils controller.
 *
 * @Route("/outils")
 */
class AntiquitasModulesOutilsController extends Controller
{

    /**
     * Lists all AntiquitasModulesOutils entities.
     *
     * @Route("/", name="outils")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('NTEAntiquitasBundle:AntiquitasModulesOutils')->findAll();

        return array(
            'titre'     => 'Outils',
            'entities' => $entities,
        );
    }

    /**
     * Finds and displays a AntiquitasModulesOutils entity.
     *
     * @Route("/{id}/{type}", name="outils_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id, $type)
    {
        $em = $this->getDoctrine()->getManager();

        $module = $em->getRepository('NTEAntiquitasBundle:AntiquitasModules')->findOneById($id);
        $typeEntity   = $em->getRepository('NTEAntiquitasBundle:AntiquitasTypes')->findOneByNom($type);
        $typeId = $typeEntity->getId();
        // $entities = $em->getRepository('NTEAntiquitasBundle:AntiquitasModulesOutils')->createQueryBuilder('m')
        //              ->leftJoin('m.idOutil', 'o')
        //              ->leftJoin('o.idType', 't')
        //              ->where('m.idModule = :module AND t.nom = :type')
        //              ->setParameter('module', $id)
        //              ->setParameter('type', $type)
        //              ->getQuery()->getResult();

        $queryText  = "SELECT o FROM NTEAntiquitasBundle:AntiquitasModulesOutils o ";
        $queryText .= "WHERE :module MEMBER OF o.idModule AND o.idType = :type";

        $query = $em->createQuery($queryText);
        $query->setParameter('module', $module);
        $query->setParameter('type', $typeId);

        $entities = $query->getResult();

        if (count($entities) > 0) {
            $titre = 'Outils du module ' . $id;
        } else {
            $titre = 'Outils du module ';
        }

        return array(
            'titre'     => $titre,
            'entities'  => $entities,
            'type'      => $type,
            'module'    => $module
        );
    }
}
