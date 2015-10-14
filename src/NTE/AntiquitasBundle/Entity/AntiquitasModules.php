<?php

namespace NTE\AntiquitasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AntiquitasModules
 *
 * @ORM\Table(name="antiquitas_modules")
 * @ORM\Entity
 */
class AntiquitasModules
{
    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255, nullable=false)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="sources_introduction", type="text", nullable=true)
     */
    private $sourcesIntroduction;

    /**
     * @var string
     *
     * @ORM\Column(name="bibliographie_introduction", type="text", nullable=true)
     */
    private $bibliographieIntroduction;

    /**
     * @var string
     *
     * @ORM\Column(name="introduction_resume", type="text", nullable=true)
     */
    private $introductionResume;

    /**
     * @var string
     *
     * @ORM\Column(name="introduction", type="text", nullable=true)
     */
    private $introduction;

    /**
     * @var string
     *
     * @ORM\Column(name="conclusion_resume", type="text", nullable=true)
     */
    private $conclusionResume;

    /**
     * @var string
     *
     * @ORM\Column(name="conclusion", type="text", nullable=true)
     */
    private $conclusion;

    /**
     * @var string
     *
     * @ORM\Column(name="banniere", type="string", length=255, nullable=true)
     */
    private $banniere;

    /**
     * @var string
     *
     * @ORM\Column(name="langage", type="string", length=3, nullable=false)
     */
    private $langage;

    /**
     * @var integer
     *
     * @ORM\Column(name="position", type="integer", nullable=false)
     */
    private $position;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="NTE\AntiquitasBundle\Entity\AntiquitasModulesOutils", mappedBy="idModule")
     */
    private $idOutil;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="NTE\AntiquitasBundle\Entity\AntiquitasUtilisateurs", mappedBy="idModule")
     */
    private $idUtilisateur;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="NTE\AntiquitasBundle\Entity\AntiquitasAuteurs", mappedBy="idModule")
     */
    private $idAuteur;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="AntiquitasThemes")
     * @ORM\JoinTable(name="antiquitas_themes_modules",
     *     joinColumns={@ORM\JoinColumn(name="id_module", referencedColumnName="id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="id_theme", referencedColumnName="id")}
     * )
     */
    private $themes;

    /**
     * @ORM\OneToMany(targetEntity="AntiquitasChapitres", mappedBy="idModule")
     * @ORM\OrderBy({"position" = "ASC"})
     */
    protected $chapitres;

    /**
     * @var media
     *
     * @ORM\OneToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media", cascade={"all"})
     */
    private $media;

#    /**
#     * @var \Doctrine\Common\Collections\Collection
#     *
#     * @ORM\ManyToMany(targetEntity="AntiquitasModulesOutils")
#     * @ORM\JoinTable(name="antiquitas_modules_outils_modules",
#     *     joinColumns={@ORM\JoinColumn(name="id_module", referencedColumnName="id")},
#     *     inverseJoinColumns={@ORM\JoinColumn(name="id_outil", referencedColumnName="id")}
#     * )
#     */
#    private $outils;

    /**
     * @ORM\OneToMany(targetEntity="AntiquitasModulesOutilsModules", mappedBy="idModule", cascade={"persist"}, orphanRemoval=true)
     */
    private $outils;

    /**
     * @var string
     *
     * @ORM\Column(name="bibliographie", type="text", nullable=true)
     */
    private $bibliographie;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="AntiquitasAuteurs")
     * @ORM\JoinTable(name="antiquitas_auteurs_modules",
     *     joinColumns={@ORM\JoinColumn(name="id_module", referencedColumnName="id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="id_auteur", referencedColumnName="id")}
     * )
     */
    private $auteurs;


    public function __toString()
    {
        return (string)$this->nom;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idOutil = new \Doctrine\Common\Collections\ArrayCollection();
        $this->idUtilisateur = new \Doctrine\Common\Collections\ArrayCollection();
        $this->idAuteur = new \Doctrine\Common\Collections\ArrayCollection();
    }
    

    /**
     * Set nom
     *
     * @param string $nom
     * @return AntiquitasModules
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    
        return $this;
    }

    /**
     * Get nom
     *
     * @return string 
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set sourcesIntroduction
     *
     * @param string $sourcesIntroduction
     * @return AntiquitasModules
     */
    public function setSourcesIntroduction($sourcesIntroduction)
    {
        $this->sourcesIntroduction = $sourcesIntroduction;
    
        return $this;
    }

    /**
     * Get sourcesIntroduction
     *
     * @return string 
     */
    public function getSourcesIntroduction()
    {
        return $this->sourcesIntroduction;
    }

    /**
     * Set bibliographieIntroduction
     *
     * @param string $bibliographieIntroduction
     * @return AntiquitasModules
     */
    public function setBibliographieIntroduction($bibliographieIntroduction)
    {
        $this->bibliographieIntroduction = $bibliographieIntroduction;
    
        return $this;
    }

    /**
     * Get bibliographieIntroduction
     *
     * @return string 
     */
    public function getBibliographieIntroduction()
    {
        return $this->bibliographieIntroduction;
    }

    /**
     * Set introductionResume
     *
     * @param string $introductionResume
     * @return AntiquitasModules
     */
    public function setIntroductionResume($introductionResume)
    {
        $this->introductionResume = $introductionResume;
    
        return $this;
    }

    /**
     * Get introductionResume
     *
     * @return string 
     */
    public function getIntroductionResume()
    {
        return $this->introductionResume;
    }

    /**
     * Set introduction
     *
     * @param string $introduction
     * @return AntiquitasModules
     */
    public function setIntroduction($introduction)
    {
        $this->introduction = $introduction;
    
        return $this;
    }

    /**
     * Get introduction
     *
     * @return string 
     */
    public function getIntroduction()
    {
        return $this->introduction;
    }

    /**
     * Set conclusionResume
     *
     * @param string $conclusionResume
     * @return AntiquitasModules
     */
    public function setConclusionResume($conclusionResume)
    {
        $this->conclusionResume = $conclusionResume;
    
        return $this;
    }

    /**
     * Get conclusionResume
     *
     * @return string 
     */
    public function getConclusionResume()
    {
        return $this->conclusionResume;
    }

    /**
     * Set conclusion
     *
     * @param string $conclusion
     * @return AntiquitasModules
     */
    public function setConclusion($conclusion)
    {
        $this->conclusion = $conclusion;
    
        return $this;
    }

    /**
     * Get conclusion
     *
     * @return string 
     */
    public function getConclusion()
    {
        return $this->conclusion;
    }

    /**
     * Set banniere
     *
     * @param string $banniere
     * @return AntiquitasModules
     */
    public function setBanniere($banniere)
    {
        $this->banniere = $banniere;
    
        return $this;
    }

    /**
     * Get banniere
     *
     * @return string 
     */
    public function getBanniere()
    {
        return $this->banniere;
    }

    /**
     * Set langage
     *
     * @param string $langage
     * @return AntiquitasModules
     */
    public function setLangage($langage)
    {
        $this->langage = $langage;
    
        return $this;
    }

    /**
     * Get langage
     *
     * @return string 
     */
    public function getLangage()
    {
        return $this->langage;
    }

    /**
     * Set position
     *
     * @param integer $position
     * @return AntiquitasModules
     */
    public function setPosition($position)
    {
        $this->position = $position;
    
        return $this;
    }

    /**
     * Get position
     *
     * @return integer 
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Add idOutil
     *
     * @param \NTE\AntiquitasBundle\Entity\AntiquitasModulesOutils $idOutil
     * @return AntiquitasModules
     */
    public function addIdOutil(\NTE\AntiquitasBundle\Entity\AntiquitasModulesOutils $idOutil)
    {
        $this->idOutil[] = $idOutil;
    
        return $this;
    }

    /**
     * Remove idOutil
     *
     * @param \NTE\AntiquitasBundle\Entity\AntiquitasModulesOutils $idOutil
     */
    public function removeIdOutil(\NTE\AntiquitasBundle\Entity\AntiquitasModulesOutils $idOutil)
    {
        $this->idOutil->removeElement($idOutil);
    }

    /**
     * Get idOutil
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getIdOutil()
    {
        return $this->idOutil;
    }

    /**
     * Add idUtilisateur
     *
     * @param \NTE\AntiquitasBundle\Entity\AntiquitasUtilisateurs $idUtilisateur
     * @return AntiquitasModules
     */
    public function addIdUtilisateur(\NTE\AntiquitasBundle\Entity\AntiquitasUtilisateurs $idUtilisateur)
    {
        $this->idUtilisateur[] = $idUtilisateur;
    
        return $this;
    }

    /**
     * Remove idUtilisateur
     *
     * @param \NTE\AntiquitasBundle\Entity\AntiquitasUtilisateurs $idUtilisateur
     */
    public function removeIdUtilisateur(\NTE\AntiquitasBundle\Entity\AntiquitasUtilisateurs $idUtilisateur)
    {
        $this->idUtilisateur->removeElement($idUtilisateur);
    }

    /**
     * Get idUtilisateur
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getIdUtilisateur()
    {
        return $this->idUtilisateur;
    }

    /**
     * Add idAuteur
     *
     * @param \NTE\AntiquitasBundle\Entity\AntiquitasAuteurs $idAuteur
     * @return AntiquitasModules
     */
    public function addIdAuteur(\NTE\AntiquitasBundle\Entity\AntiquitasAuteurs $idAuteur)
    {
        $this->idAuteur[] = $idAuteur;
    
        return $this;
    }

    /**
     * Remove idAuteur
     *
     * @param \NTE\AntiquitasBundle\Entity\AntiquitasAuteurs $idAuteur
     */
    public function removeIdAuteur(\NTE\AntiquitasBundle\Entity\AntiquitasAuteurs $idAuteur)
    {
        $this->idAuteur->removeElement($idAuteur);
    }

    /**
     * Get idAuteur
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getIdAuteur()
    {
        return $this->idAuteur;
    }

    /**
     * Add themes
     *
     * @param \NTE\AntiquitasBundle\Entity\AntiquitasThemesModules $themes
     * @return AntiquitasModules
     */
    public function addTheme(\NTE\AntiquitasBundle\Entity\AntiquitasThemesModules $themes)
    {
        $this->themes[] = $themes;
    
        return $this;
    }

    /**
     * Remove themes
     *
     * @param \NTE\AntiquitasBundle\Entity\AntiquitasThemesModules $themes
     */
    public function removeTheme(\NTE\AntiquitasBundle\Entity\AntiquitasThemesModules $themes)
    {
        $this->themes->removeElement($themes);
    }

    /**
     * Get themes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getThemes()
    {
        return $this->themes;
    }

    /**
     * Add chapitres
     *
     * @param \NTE\AntiquitasBundle\Entity\AntiquitasChapitres $chapitres
     * @return AntiquitasModules
     */
    public function addChapitre(\NTE\AntiquitasBundle\Entity\AntiquitasChapitres $chapitres)
    {
        $this->chapitres[] = $chapitres;
    
        return $this;
    }

    /**
     * Remove chapitres
     *
     * @param \NTE\AntiquitasBundle\Entity\AntiquitasChapitres $chapitres
     */
    public function removeChapitre(\NTE\AntiquitasBundle\Entity\AntiquitasChapitres $chapitres)
    {
        $this->chapitres->removeElement($chapitres);
    }

    /**
     * Get chapitres
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getChapitres()
    {
        return $this->chapitres;
    }

    /**
     * Set media
     *
     * @param \Application\Sonata\MediaBundle\Entity\Media $media
     * @return AntiquitasModules
     */
    public function setMedia(\Application\Sonata\MediaBundle\Entity\Media $media = null)
    {
        $this->media = $media;
    
        return $this;
    }

    /**
     * Get media
     *
     * @return \Application\Sonata\MediaBundle\Entity\Media 
     */
    public function getMedia()
    {
        return $this->media;
    }

    /**
     * Add outils
     *
     * @param \NTE\AntiquitasBundle\Entity\AntiquitasModulesOutilsModules $outils
     * @return AntiquitasModules
     */
    public function addOutil(\NTE\AntiquitasBundle\Entity\AntiquitasModulesOutilsModules $outils)
    {
        $outils->setIdModule($this); # pour la collection dans le formulaire
        $this->outils[] = $outils;
    
        return $this;
    }

    /**
     * Remove outils
     *
     * @param \NTE\AntiquitasBundle\Entity\AntiquitasModulesOutilsModules $outils
     */
    public function removeOutil(\NTE\AntiquitasBundle\Entity\AntiquitasModulesOutilsModules $outils)
    {
        $this->outils->removeElement($outils);
    }

    /**
     * Get outils
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getOutils()
    {
        return $this->outils;
    }

    /**
     * Add auteurs
     *
     * @param \NTE\AntiquitasBundle\Entity\AntiquitasAuteurs $auteurs
     * @return AntiquitasModules
     */
    public function addAuteur(\NTE\AntiquitasBundle\Entity\AntiquitasAuteurs $auteurs)
    {
        $this->auteurs[] = $auteurs;
    
        return $this;
    }

    /**
     * Remove auteurs
     *
     * @param \NTE\AntiquitasBundle\Entity\AntiquitasAuteurs $auteurs
     */
    public function removeAuteur(\NTE\AntiquitasBundle\Entity\AntiquitasAuteurs $auteurs)
    {
        $this->auteurs->removeElement($auteurs);
    }

    /**
     * Get auteurs
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAuteurs()
    {
        return $this->auteurs;
    }

    /**
     * Set bibliographie
     *
     * @param string $bibliographie
     * @return AntiquitasModules
     */
    public function setBibliographie($bibliographie)
    {
        $this->bibliographie = $bibliographie;
    
        return $this;
    }

    /**
     * Get bibliographie
     *
     * @return string 
     */
    public function getBibliographie()
    {
        return $this->bibliographie;
    }
}
