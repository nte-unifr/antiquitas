<?php

namespace NTE\AntiquitasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AntiquitasChapitres
 *
 * @ORM\Table(name="antiquitas_chapitres")
 * @ORM\Entity
 */
class AntiquitasChapitres
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
     * @ORM\Column(name="theme", type="text", nullable=false)
     */
    private $theme;

    /**
     * @var string
     *
     * @ORM\Column(name="objectif", type="text", nullable=false)
     */
    private $objectif;

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
     * @var \NTE\AntiquitasBundle\Entity\AntiquitasModules
     *
     * @ORM\ManyToOne(targetEntity="NTE\AntiquitasBundle\Entity\AntiquitasModules")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_module", referencedColumnName="id")
     * })
     */
    private $idModule;

    /**
     * @ORM\OneToMany(targetEntity="AntiquitasFiches", mappedBy="idChapitre")
     * @ORM\OrderBy({"position" = "ASC"})
     */
    protected $fiches;

    /**
     * @ORM\OneToMany(targetEntity="AntiquitasActivites", mappedBy="idChapitre")
     * @ORM\OrderBy({"position" = "ASC"})
     */
    protected $activites;

    public function __toString()
	{
	    return (string)$this->nom;
	}


    /**
     * Set nom
     *
     * @param string $nom
     * @return AntiquitasChapitres
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
     * Set theme
     *
     * @param string $theme
     * @return AntiquitasChapitres
     */
    public function setTheme($theme)
    {
        $this->theme = $theme;
    
        return $this;
    }

    /**
     * Get theme
     *
     * @return string 
     */
    public function getTheme()
    {
        return $this->theme;
    }

    /**
     * Set objectif
     *
     * @param string $objectif
     * @return AntiquitasChapitres
     */
    public function setObjectif($objectif)
    {
        $this->objectif = $objectif;
    
        return $this;
    }

    /**
     * Get objectif
     *
     * @return string 
     */
    public function getObjectif()
    {
        return $this->objectif;
    }

    /**
     * Set position
     *
     * @param integer $position
     * @return AntiquitasChapitres
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
     * Set idModule
     *
     * @param \NTE\AntiquitasBundle\Entity\AntiquitasModules $idModule
     * @return AntiquitasChapitres
     */
    public function setIdModule(\NTE\AntiquitasBundle\Entity\AntiquitasModules $idModule = null)
    {
        $this->idModule = $idModule;
    
        return $this;
    }

    /**
     * Get idModule
     *
     * @return \NTE\AntiquitasBundle\Entity\AntiquitasModules 
     */
    public function getIdModule()
    {
        return $this->idModule;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->fiches = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add fiches
     *
     * @param \NTE\AntiquitasBundle\Entity\AntiquitasFiches $fiches
     * @return AntiquitasChapitres
     */
    public function addFiche(\NTE\AntiquitasBundle\Entity\AntiquitasFiches $fiches)
    {
        $this->fiches[] = $fiches;
    
        return $this;
    }

    /**
     * Remove fiches
     *
     * @param \NTE\AntiquitasBundle\Entity\AntiquitasFiches $fiches
     */
    public function removeFiche(\NTE\AntiquitasBundle\Entity\AntiquitasFiches $fiches)
    {
        $this->fiches->removeElement($fiches);
    }

    /**
     * Get fiches
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getFiches()
    {
        return $this->fiches;
    }

    /**
     * Add activites
     *
     * @param \NTE\AntiquitasBundle\Entity\AntiquitasActivites $activites
     * @return AntiquitasChapitres
     */
    public function addActivite(\NTE\AntiquitasBundle\Entity\AntiquitasActivites $activites)
    {
        $this->activites[] = $activites;
    
        return $this;
    }

    /**
     * Remove activites
     *
     * @param \NTE\AntiquitasBundle\Entity\AntiquitasActivites $activites
     */
    public function removeActivite(\NTE\AntiquitasBundle\Entity\AntiquitasActivites $activites)
    {
        $this->activites->removeElement($activites);
    }

    /**
     * Get activites
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getActivites()
    {
        return $this->activites;
    }
}