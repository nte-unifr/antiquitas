<?php

namespace NTE\AntiquitasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AntiquitasCategories
 *
 * @ORM\Table(name="antiquitas_categories")
 * @ORM\Entity
 */
class AntiquitasCategories
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
     * @ORM\OneToMany(targetEntity="AntiquitasThemes", mappedBy="idCategorie")
     * @ORM\OrderBy({"position" = "ASC"})
     */
    protected $themes;


    public function __toString()
    {
        return (string)$this->nom;
    }



    /**
     * Set nom
     *
     * @param string $nom
     * @return AntiquitasCategories
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
     * @return AntiquitasCategories
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
     * Constructor
     */
    public function __construct()
    {
        $this->categories = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add themes
     *
     * @param \NTE\AntiquitasBundle\Entity\AntiquitasThemes $themes
     * @return AntiquitasCategories
     */
    public function addTheme(\NTE\AntiquitasBundle\Entity\AntiquitasThemes $themes)
    {
        $this->themes[] = $themes;
    
        return $this;
    }

    /**
     * Remove themes
     *
     * @param \NTE\AntiquitasBundle\Entity\AntiquitasThemes $themes
     */
    public function removeTheme(\NTE\AntiquitasBundle\Entity\AntiquitasThemes $themes)
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
}
