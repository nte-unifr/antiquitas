<?php

namespace NTE\AntiquitasBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     * @Template()
     */
    public function indexAction()
    {
        return $this->redirect($this->generateUrl('categories'));
    }

    /**
     * @Route("/book")
     * @Template()
     */
    public function bookAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('NTEAntiquitasBundle:AntiquitasCategories')->findBy(array(), array('position' => 'ASC'));

        $titre = $em->getRepository('NTEAntiquitasBundle:AntiquitasTextesSiteGlobal')->findOneBy(array('variable' => 'liste_modules_titre'));
        $locale = $this->getRequest()->getLocale();
        switch ( $locale ) {
            case 'de':
                $titre = $titre->getDe();
                break;
            case 'en':
                $titre = $titre->geten();
                break;
            case 'fr':
            default:
                $titre = $titre->getFr();
        }

        $intro = $em->getRepository('NTEAntiquitasBundle:AntiquitasTextesSiteGlobal')->findOneBy(array('variable' => 'liste_modules_introduction'));

        $modules = $em->getRepository('NTEAntiquitasBundle:AntiquitasModules')->findAll();

        $noticestextes = array();
        $noticesliens = array();
        $noticesimages = array();
        $noticesnotes = array();

        foreach ($modules as $module) {
            $id = $module->getId();
            $noticestextes_type4[$id] = $em->getRepository( 'NTEAntiquitasBundle:AntiquitasNoticesTextes' )->createQueryBuilder('n')
                               ->leftJoin('n.idFiche', 'f')
                               ->leftJoin('f.idChapitre', 'c')
                               ->leftJoin('c.idModule', 'm')
                               ->where('n.statut = 1 AND n.idType = 4')
                               ->andWhere('m.id = :module')
                                    ->setParameter('module', $id)
                               ->orderBy('n.nom', 'ASC')
                               ->getQuery()->getResult();

            $noticestextes_type5[$id] = $em->getRepository( 'NTEAntiquitasBundle:AntiquitasNoticesTextes' )->createQueryBuilder('n')
                               ->leftJoin('n.idFiche', 'f')
                               ->leftJoin('f.idChapitre', 'c')
                               ->leftJoin('c.idModule', 'm')
                               ->where('n.statut = 1 AND n.idType = 5')
                               ->andWhere('m.id = :module')
                                    ->setParameter('module', $id)
                               ->orderBy('n.nom', 'ASC')
                               ->getQuery()->getResult();

            $noticesimages[$id] = $em->getRepository( 'NTEAntiquitasBundle:AntiquitasNoticesImages' )->createQueryBuilder('n')
                               ->leftJoin('n.idFiche', 'f')
                               ->leftJoin('f.idChapitre', 'c')
                               ->leftJoin('c.idModule', 'm')
                               ->where('n.statut = 1')
                               ->andWhere('m.id = :module')
                                    ->setParameter('module', $id)
                               ->orderBy('f.idChapitre', 'ASC')
                               ->addOrderBy('n.nom', 'ASC')
                               ->getQuery()->getResult();

            $noticesliens[$id] = $em->getRepository( 'NTEAntiquitasBundle:AntiquitasNoticesLiens' )->createQueryBuilder('n')
                               ->leftJoin('n.idFiche', 'f')
                               ->leftJoin('f.idChapitre', 'c')
                               ->leftJoin('c.idModule', 'm')
                               ->where('n.statut = 1')
                               ->andWhere('m.id = :module')
                                    ->setParameter('module', $id)
                               ->orderBy('n.nom', 'ASC')
                               ->getQuery()->getResult();

            $noticesnotes[$id] = $em->getRepository( 'NTEAntiquitasBundle:AntiquitasNoticesNotes' )->createQueryBuilder('n')
                               ->leftJoin('n.idFiche', 'f')
                               ->leftJoin('f.idChapitre', 'c')
                               ->leftJoin('c.idModule', 'm')
                               ->where('n.statut = 1')
                               ->andWhere('m.id = :module')
                                    ->setParameter('module', $id)
                               ->orderBy('n.nom', 'ASC')
                               ->getQuery()->getResult();
        }

        return array(
            'titre'     => $titre,
            'intro'     => $intro,
            'entities' => $entities,
            'noticestextes_type4' => $noticestextes_type4,
            'noticestextes_type5' => $noticestextes_type5,
            'noticesliens'  => $noticesliens,
            'noticesimages' => $noticesimages,
            'noticesnotes'  => $noticesnotes,
        );
    }
}
