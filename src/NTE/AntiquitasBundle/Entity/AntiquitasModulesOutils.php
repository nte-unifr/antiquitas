<?php

namespace NTE\AntiquitasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AntiquitasModulesOutils
 *
 * @ORM\Table(name="antiquitas_modules_outils")
 * @ORM\Entity
 */
class AntiquitasModulesOutils
{
    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255, nullable=false)
     */
    private $nom;

    /**
     * @var boolean
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \NTE\AntiquitasBundle\Entity\AntiquitasTypes
     *
     * @ORM\ManyToOne(targetEntity="NTE\AntiquitasBundle\Entity\AntiquitasTypes")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_type", referencedColumnName="id")
     * })
     */
    private $idType;

    /**
     * @var AntiquitasModules
     *
     * @ORM\ManyToMany(targetEntity="AntiquitasModules", mappedBy="outils")
     */
    private $modules;


    public function __toString()
    {
        return (string)$this->id . ' - ' . $this->idType . ' - ' . $this->nom;
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
     * @return AntiquitasModulesOutils
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
     * Get id
     *
     * @return boolean
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set idType
     *
     * @param \NTE\AntiquitasBundle\Entity\AntiquitasTypes $idType
     * @return AntiquitasModulesOutils
     */
    public function setIdType(\NTE\AntiquitasBundle\Entity\AntiquitasTypes $idType = null)
    {
        $this->idType = $idType;

        return $this;
    }

    /**
     * Get idType
     *
     * @return \NTE\AntiquitasBundle\Entity\AntiquitasTypes
     */
    public function getIdType()
    {
        return $this->idType;
    }

    /**
     * Add modules
     *
     * @param \NTE\AntiquitasBundle\Entity\AntiquitasModules $modules
     * @return AntiquitasModulesOutils
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
