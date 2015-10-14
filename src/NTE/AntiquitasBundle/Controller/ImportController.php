<?php

namespace NTE\AntiquitasBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Symfony\Component\HttpFoundation\Response;

/**
 * Import controller.
 *
 * @Route("/_import")
 */
class ImportController extends Controller
{

    /**
     *
     * @Route("/", name="import")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        return new Response('<html><body><h1>EXIT!</h1></body></html>');
        exit();

        $em = $this->getDoctrine()->getManager();

        // MODULES
        $modules = $em->getRepository('NTEAntiquitasBundle:AntiquitasModules')->findAll();

        foreach ($modules as $module) {
            $media = $em->getRepository('\Application\Sonata\MediaBundle\Entity\Media')->findOneBy(array('name' => $module->getBanniere()));
            if ($media) {
                $module->setMedia($media);
                $em->persist($module);
            }
        }
        $em->flush();

        // ACTIVITES
        $activites = $em->getRepository('NTEAntiquitasBundle:AntiquitasActivites')->findAll();

        foreach ($activites as $activite) {
            $media = $em->getRepository('\Application\Sonata\MediaBundle\Entity\Media')->findOneBy(array('name' => $activite->getVignette()));
            if ($media) {
                $activite->setMedia($media);
                $em->persist($activite);
            }
        }
        $em->flush();

        return new Response('<html><body><h1>Importation terminée!</h1></body></html>');
    }

    /**
     *
     * @Route("/biblio", name="import_biblio")
     * @Method("GET")
     * @Template()
     */
    public function biblioAction()
    {
        return new Response('<html><body><h1>EXIT!</h1></body></html>');
        exit();

        $em = $this->getDoctrine()->getManager();

#        // Bibliographie des modules
#        $biblios = $em->getRepository('NTEAntiquitasBundle:AntiquitasModulesBibliographies')->findAll();

        foreach ($biblios as $biblio) {
            $module = $em->getRepository('NTEAntiquitasBundle:AntiquitasModules')->find($biblio->getId());
            $module->setBibliographie($biblio->getContenu());
            $em->persist($module);
        }
        $em->flush();

        // Bibliographie des fiches
        $biblios = $em->getRepository('NTEAntiquitasBundle:AntiquitasFichesBibliographies')->findAll();

        foreach ($biblios as $biblio) {
            $fiche = $em->getRepository('NTEAntiquitasBundle:AntiquitasFiches')->find($biblio->getIdFiche());
            $fiche->setBibliographie($biblio->getContenu());
            $em->persist($fiche);
        }
        $em->flush();

        return new Response('<html><body><h1>Importation terminée!</h1></body></html>');
    }

    /**
     *
     * @Route("/noticesimages", name="import_noticesimages")
     * @Method("GET")
     * @Template()
     */
    public function noticesimagesAction()
    {
        return new Response('<html><body><h1>EXIT!</h1></body></html>');
        exit();

        $em = $this->getDoctrine()->getManager();

        // Notices Images
        $notices = $em->getRepository('NTEAntiquitasBundle:AntiquitasNoticesImages')->findAll();

        foreach ($notices as $notice) {
            $media = $em->getRepository('\Application\Sonata\MediaBundle\Entity\Media')->findOneBy(array('name' => $notice->getVignette()));
            if ($media) {
                $notice->setMedia($media);
                $em->persist($notice);
            }
        }
        $em->flush();

        return new Response('<html><body><h1>Importation des images Notices Images terminée!</h1></body></html>');
    }

}
