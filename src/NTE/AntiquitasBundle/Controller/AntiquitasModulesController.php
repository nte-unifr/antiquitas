<?php

namespace NTE\AntiquitasBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use NTE\AntiquitasBundle\Entity\AntiquitasModules;

/**
 * AntiquitasModules controller.
 *
 * @Route("/modules")
 */
class AntiquitasModulesController extends Controller
{

    /**
     * Lists all AntiquitasModules entities.
     *
     * @Route("/", name="modules")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        return $this->redirect($this->generateUrl('categories'));

#        $em = $this->getDoctrine()->getManager();

#        $entities = $em->getRepository('NTEAntiquitasBundle:AntiquitasModules')->findAll();

#        return array(
#            'titre'     => 'Modules',
#            'entities' => $entities,
#        );
    }

    /**
     * Finds and displays a AntiquitasModules entity.
     *
     * @Route("/{id}", name="modules_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('NTEAntiquitasBundle:AntiquitasModules')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Modules entity.');
        }

        $noticestextes = array();
        $noticesliens = array();
        $noticesimages = array();
        $noticesnotes = array();
        $noticesnotes = array();
        $activites = array();

        $noticestextes_type4 = $em->getRepository( 'NTEAntiquitasBundle:AntiquitasNoticesTextes' )->createQueryBuilder('n')
                           ->leftJoin('n.idFiche', 'f')
                           ->leftJoin('f.idChapitre', 'c')
                           ->leftJoin('c.idModule', 'm')
                           ->where('n.statut = 1 AND n.idType = 4')
                           ->andWhere('m.id = :module')
                                ->setParameter('module', $id)
                           ->orderBy('n.nom', 'ASC')
                           ->getQuery()->getResult();

        $noticestextes_type5 = $em->getRepository( 'NTEAntiquitasBundle:AntiquitasNoticesTextes' )->createQueryBuilder('n')
                           ->leftJoin('n.idFiche', 'f')
                           ->leftJoin('f.idChapitre', 'c')
                           ->leftJoin('c.idModule', 'm')
                           ->where('n.statut = 1 AND n.idType = 5')
                           ->andWhere('m.id = :module')
                                ->setParameter('module', $id)
                           ->orderBy('n.nom', 'ASC')
                           ->getQuery()->getResult();

        $activites = $em->getRepository( 'NTEAntiquitasBundle:AntiquitasNoticesActivites' )->createQueryBuilder('n')
                           ->leftJoin('n.idChapitre', 'c')
                           ->leftJoin('c.idModule', 'm')
                           ->where('n.idChapitre = c.id')
                           ->andWhere('m.id = :module')
                                ->setParameter('module', $id)
                           ->orderBy('n.nom', 'ASC')
                           ->getQuery()->getResult();

        $noticesimages = $em->getRepository( 'NTEAntiquitasBundle:AntiquitasNoticesImages' )->createQueryBuilder('n')
                           ->leftJoin('n.idFiche', 'f')
                           ->leftJoin('f.idChapitre', 'c')
                           ->leftJoin('c.idModule', 'm')
                           ->where('n.statut = 1')
                           ->andWhere('m.id = :module')
                                ->setParameter('module', $id)
                           ->orderBy('f.idChapitre', 'ASC')
                           ->addOrderBy('n.nom', 'ASC')
                           ->getQuery()->getResult();

        $noticesliens = $em->getRepository( 'NTEAntiquitasBundle:AntiquitasNoticesLiens' )->createQueryBuilder('n')
                           ->leftJoin('n.idFiche', 'f')
                           ->leftJoin('f.idChapitre', 'c')
                           ->leftJoin('c.idModule', 'm')
                           ->where('n.statut = 1')
                           ->andWhere('m.id = :module')
                                ->setParameter('module', $id)
                           ->orderBy('n.nom', 'ASC')
                           ->getQuery()->getResult();

        $noticesnotes = $em->getRepository( 'NTEAntiquitasBundle:AntiquitasNoticesNotes' )->createQueryBuilder('n')
                           ->leftJoin('n.idFiche', 'f')
                           ->leftJoin('f.idChapitre', 'c')
                           ->leftJoin('c.idModule', 'm')
                           ->where('n.statut = 1')
                           ->andWhere('m.id = :module')
                                ->setParameter('module', $id)
                           ->orderBy('n.nom', 'ASC')
                           ->getQuery()->getResult();

        return array(
            'titre'         => 'Module ' . $entity->getNom(),
            'entity'        => $entity,
            'noticestextes_type4' => $noticestextes_type4,
            'noticestextes_type5' => $noticestextes_type5,
            'activites'     => $activites,
            'noticesliens'  => $noticesliens,
            'noticesimages' => $noticesimages,
            'noticesnotes'  => $noticesnotes,
        );
    }
}
