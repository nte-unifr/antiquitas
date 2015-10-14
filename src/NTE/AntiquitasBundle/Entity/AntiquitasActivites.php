<?php

namespace NTE\AntiquitasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AntiquitasActivites
 *
 * @ORM\Table(name="antiquitas_activites")
 * @ORM\Entity
 */
class AntiquitasActivites
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
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="contenu", type="text", nullable=true)
     */
    private $contenu;

    /**
     * @var string
     *
     * @ORM\Column(name="vignette", type="string", length=255, nullable=true)
     */
    private $vignette;

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
     * @var \NTE\AntiquitasBundle\Entity\AntiquitasTypes
     *
     * @ORM\ManyToOne(targetEntity="NTE\AntiquitasBundle\Entity\AntiquitasTypes")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_type", referencedColumnName="id")
     * })
     */
    private $idType;

    /**
     * @var \NTE\AntiquitasBundle\Entity\AntiquitasChapitres
     *
     * @ORM\ManyToOne(targetEntity="NTE\AntiquitasBundle\Entity\AntiquitasChapitres")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_chapitre", referencedColumnName="id")
     * })
     */
    private $idChapitre;

    /**
     * @var media
     *
     * @ORM\ManyToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media", cascade={"all"})
     */
    private $media;


    public function __toString()
    {
        return (string)$this->nom;
    }


    /**
     * Set nom
     *
     * @param string $nom
     * @return AntiquitasActivites
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
     * Set description
     *
     * @param string $description
     * @return AntiquitasActivites
     */
    public function setDescription($description)
    {
        $this->description = $description;
    
        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set contenu
     *
     * @param string $contenu
     * @return AntiquitasActivites
     */
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;
    
        return $this;
    }

    /**
     * Get contenu
     *
     * @return string 
     */
    public function getContenu()
    {
        return $this->contenu;
    }

    /**
     * Set vignette
     *
     * @param string $vignette
     * @return AntiquitasActivites
     */
    public function setVignette($vignette)
    {
        $this->vignette = $vignette;
    
        return $this;
    }

    /**
     * Get vignette
     *
     * @return string 
     */
    public function getVignette()
    {
        return $this->vignette;
    }

    /**
     * Set position
     *
     * @param integer $position
     * @return AntiquitasActivites
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
     * Set idType
     *
     * @param \NTE\AntiquitasBundle\Entity\AntiquitasTypes $idType
     * @return AntiquitasActivites
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
     * Set idChapitre
     *
     * @param \NTE\AntiquitasBundle\Entity\AntiquitasChapitres $idChapitre
     * @return AntiquitasActivites
     */
    public function setIdChapitre(\NTE\AntiquitasBundle\Entity\AntiquitasChapitres $idChapitre = null)
    {
        $this->idChapitre = $idChapitre;
    
        return $this;
    }

    /**
     * Get idChapitre
     *
     * @return \NTE\AntiquitasBundle\Entity\AntiquitasChapitres 
     */
    public function getIdChapitre()
    {
        return $this->idChapitre;
    }

    /**
     * Set media
     *
     * @param \Application\Sonata\MediaBundle\Entity\Media $media
     * @return AntiquitasActivites
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
}
