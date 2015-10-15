<?php

namespace NTE\AntiquitasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AntiquitasAuteurs
 *
 * @ORM\Table(name="antiquitas_auteurs")
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="AntiquitasAuteursRepository");
 */
class AntiquitasAuteurs
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
     * @ORM\Column(name="prenom", type="string", length=255, nullable=false)
     */
    private $prenom;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var AntiquitasModules
     *
     * @ORM\ManyToMany(targetEntity="AntiquitasModules", mappedBy="auteurs")
     */
    private $modules;


    public function __toString()
    {
        return (string)$this->prenom . " " . $this->nom;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->modules = new \Doctrine\Common\Collections\ArrayCollection();
    }


    /**
     * Set nom
     *
     * @param string $nom
     * @return AntiquitasAuteurs
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
     * Set prenom
     *
     * @param string $prenom
     * @return AntiquitasAuteurs
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
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
     * Add modules
     *
     * @param \NTE\AntiquitasBundle\Entity\AntiquitasModules $modules
     * @return AntiquitasAuteurs
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