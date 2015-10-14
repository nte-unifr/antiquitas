<?php

namespace NTE\AntiquitasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AntiquitasModulesOutils
 *
 * @ORM\Table(name="antiquitas_modules_outils_modules")
 * @ORM\Entity
 */
class AntiquitasModulesOutilsModules
{

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \NTE\AntiquitasBundle\Entity\AntiquitasModulesOutils
     *
     * @ORM\ManyToOne(targetEntity="NTE\AntiquitasBundle\Entity\AntiquitasModulesOutils")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_outil", referencedColumnName="id")
     * })
     */
    private $idOutil;

    /**
     * @var \NTE\AntiquitasBundle\Entity\AntiquitasModules
     *
     * @ORM\ManyToOne(targetEntity="NTE\AntiquitasBundle\Entity\AntiquitasModules")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_module", referencedColumnName="id")
     * })
     */
    private $idModule;


    public function __toString()
    {
        if ( $this->getIdOutil() ) {
            return (string)$this->id . ' ' . $this->getIdOutil()->getId() . ' ' . $this->getIdOutil()->getNom();
        } else {
            return (string)$this->id;
        }
    }


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idModule = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set idOutil
     *
     * @param \NTE\AntiquitasBundle\Entity\AntiquitasModulesOutils $idOutil
     * @return AntiquitasModulesOutilsModules
     */
    public function setIdOutil(\NTE\AntiquitasBundle\Entity\AntiquitasModulesOutils $idOutil = null)
    {
        $this->idOutil = $idOutil;
    
        return $this;
    }

    /**
     * Get idOutil
     *
     * @return \NTE\AntiquitasBundle\Entity\AntiquitasModulesOutils 
     */
    public function getIdOutil()
    {
        return $this->idOutil;
    }

    /**
     * Set idModule
     *
     * @param \NTE\AntiquitasBundle\Entity\AntiquitasModules $idModule
     * @return AntiquitasModulesOutilsModules
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
}
