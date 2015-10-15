<?php

namespace NTE\AntiquitasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AntiquitasThemes
 *
 * @ORM\Table(name="antiquitas_themes")
 * @ORM\Entity
 */
class AntiquitasThemes
{
    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255, nullable=false)
     */
    private $nom;

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
     * @var \NTE\AntiquitasBundle\Entity\AntiquitasCategories
     *
     * @ORM\ManyToOne(targetEntity="NTE\AntiquitasBundle\Entity\AntiquitasCategories")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_categorie", referencedColumnName="id")
     * })
     */
    private $idCategorie;

    /**
     * @var AntiquitasModules
     *
     * @ORM\ManyToMany(targetEntity="AntiquitasModules", mappedBy="themes")
     */
    private $modules;



    public function __toString()
    {
        return (string)$this->nom;
    }


    /**
     * Set nom
     *
     * @param string $nom
     * @return AntiquitasThemes
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
     * Set position
     *
     * @param integer $position
     * @return AntiquitasThemes
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
     * Set idCategorie
     *
     * @param \NTE\AntiquitasBundle\Entity\AntiquitasCategories $idCategorie
     * @return AntiquitasThemes
     */
    public function setIdCategorie(\NTE\AntiquitasBundle\Entity\AntiquitasCategories $idCategorie = null)
    {
        $this->idCategorie = $idCategorie;

        return $this;
    }

    /**
     * Get idCategorie
     *
     * @return \NTE\AntiquitasBundle\Entity\AntiquitasCategories
     */
    public function getIdCategorie()
    {
        return $this->idCategorie;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->modules = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add modules
     *
     * @param \NTE\AntiquitasBundle\Entity\AntiquitasModules $modules
     * @return AntiquitasThemes
     */
    public function addModule(\NTE\AntiquitasBundle\Entity\AntiquitasModules $modules)
    {
        $this->modules[] = $modules;
    
        return $this;
    }

    /**
     * Remove modules
     *
     * @param \NTE\AntiquitasBundle\Entity\AntiquitasModules $modules
     */
    public function removeModule(\NTE\AntiquitasBundle\Entity\AntiquitasModules $modules)
    {
        $this->modules->removeElement($modules);
    }

    /**
     * Get modules
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getModules()
    {
        return $this->modules;
    }
}