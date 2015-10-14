<?php

namespace NTE\AntiquitasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AntiquitasNoticesNotes
 *
 * @ORM\Table(name="antiquitas_notices_notes")
 * @ORM\Entity
 */
class AntiquitasNoticesNotes
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
     * @return AntiquitasNoticesNotes
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
     * @return AntiquitasNoticesNotes
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
     * @return AntiquitasNoticesNotes
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
     * Set statut
     *
     * @param integer $statut
     * @return AntiquitasNoticesNotes
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
     * @return AntiquitasNoticesNotes
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
     * @return AntiquitasNoticesNotes
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