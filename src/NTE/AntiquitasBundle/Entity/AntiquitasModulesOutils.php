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
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="NTE\AntiquitasBundle\Entity\AntiquitasModules", inversedBy="idOutil")
     * @ORM\JoinTable(name="antiquitas_modules_outils_modules",
     *   joinColumns={
     *     @ORM\JoinColumn(name="id_outil", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="id_module", referencedColumnName="id")
     *   }
     * )
     */
    private $idModule;


    public function __toString()
    {
        return (string)$this->id . ' - ' . $this->idType . ' - ' . $this->nom;
    }


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idModule = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Add idModule
     *
     * @param \NTE\AntiquitasBundle\Entity\AntiquitasModules $idModule
     * @return AntiquitasModulesOutils
     */
    public function addIdModule(\NTE\AntiquitasBundle\Entity\AntiquitasModules $idModule)
    {
        $this->idModule[] = $idModule;
    
        return $this;
    }

    /**
     * Remove idModule
     *
     * @param \NTE\AntiquitasBundle\Entity\AntiquitasModules $idModule
     */
    public function removeIdModule(\NTE\AntiquitasBundle\Entity\AntiquitasModules $idModule)
    {
        $this->idModule->removeElement($idModule);
    }

    /**
     * Get idModule
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getIdModule()
    {
        return $this->idModule;
    }
}
