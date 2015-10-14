<?php

namespace NTE\AntiquitasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AntiquitasNoticesLiens
 *
 * @ORM\Table(name="antiquitas_notices_liens")
 * @ORM\Entity
 */
class AntiquitasNoticesLiens
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
     * @ORM\Column(name="url", type="string", length=255, nullable=false)
     */
    private $url;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

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
     * Set nom
     *
     * @param string $nom
     * @return AntiquitasNoticesLiens
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
     * Set url
     *
     * @param string $url
     * @return AntiquitasNoticesLiens
     */
    public function setUrl($url)
    {
        $this->url = $url;
    
        return $this;
    }

    /**
     * Get url
     *
     * @return string 
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return AntiquitasNoticesLiens
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
     * Set statut
     *
     * @param integer $statut
     * @return AntiquitasNoticesLiens
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
     * @return AntiquitasNoticesLiens
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
     * @return AntiquitasNoticesLiens
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
}