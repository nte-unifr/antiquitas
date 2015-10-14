<?php

namespace NTE\AntiquitasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AntiquitasTraducteurs
 *
 * @ORM\Table(name="antiquitas_traducteurs")
 * @ORM\Entity
 */
class AntiquitasTraducteurs
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
     * Set nom
     *
     * @param string $nom
     * @return AntiquitasTraducteurs
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
     * @return AntiquitasTraducteurs
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
     * Set position
     *
     * @param integer $position
     * @return AntiquitasTraducteurs
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
     * @return AntiquitasTraducteurs
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