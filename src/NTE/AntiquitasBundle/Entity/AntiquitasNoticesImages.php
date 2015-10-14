<?php

namespace NTE\AntiquitasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AntiquitasNoticesImages
 *
 * @ORM\Table(name="antiquitas_notices_images")
 * @ORM\Entity
 */
class AntiquitasNoticesImages
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
     * @ORM\Column(name="description", type="string", length=255, nullable=true)
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
     * @ORM\Column(name="statut", type="integer", nullable=false)
     */
    private $statut;

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
     * @var \NTE\AntiquitasBundle\Entity\AntiquitasFiches
     *
     * @ORM\ManyToOne(targetEntity="NTE\AntiquitasBundle\Entity\AntiquitasFiches")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_fiche", referencedColumnName="id")
     * })
     */
    private $idFiche;

    /**
     * @var media
     *
     * @ORM\ManyToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media", cascade={"all"})
     */
    private $media;



    /**
     * Set nom
     *
     * @param string $nom
     * @return AntiquitasNoticesImages
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
     * @return AntiquitasNoticesImages
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
     * @return AntiquitasNoticesImages
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
     * @return AntiquitasNoticesImages
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
     * Set statut
     *
     * @param integer $statut
     * @return AntiquitasNoticesImages
     */
    public function setStatut($statut)
    {
        $this->statut = $statut;
    
        return $this;
    }

    /**
     * Get statut
     *
     * @return integer 
     */
    public function getStatut()
    {
        return $this->statut;
    }

    /**
     * Set position
     *
     * @param integer $position
     * @return AntiquitasNoticesImages
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
     * Set idFiche
     *
     * @param \NTE\AntiquitasBundle\Entity\AntiquitasFiches $idFiche
     * @return AntiquitasNoticesImages
     */
    public function setIdFiche(\NTE\AntiquitasBundle\Entity\AntiquitasFiches $idFiche = null)
    {
        $this->idFiche = $idFiche;
    
        return $this;
    }

    /**
     * Get idFiche
     *
     * @return \NTE\AntiquitasBundle\Entity\AntiquitasFiches 
     */
    public function getIdFiche()
    {
        return $this->idFiche;
    }

    /**
     * Set media
     *
     * @param \Application\Sonata\MediaBundle\Entity\Media $media
     * @return AntiquitasNoticesImages
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
