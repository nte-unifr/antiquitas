<?php

namespace NTE\AntiquitasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AntiquitasNoticesActivites
 *
 * @ORM\Table(name="antiquitas_notices_activites")
 * @ORM\Entity
 */
class AntiquitasNoticesActivites
{
    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=100, nullable=false)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @var integer
     *
     * @ORM\Column(name="page", type="integer", nullable=false)
     */
    private $page;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \NTE\AntiquitasBundle\Entity\AntiquitasActivites
     *
     * @ORM\ManyToOne(targetEntity="NTE\AntiquitasBundle\Entity\AntiquitasActivites")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_activite", referencedColumnName="id")
     * })
     */
    private $idActivite;

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
     * Set nom
     *
     * @param string $nom
     * @return AntiquitasNoticesActivites
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
     * @return AntiquitasNoticesActivites
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
     * Set page
     *
     * @param integer $page
     * @return AntiquitasNoticesActivites
     */
    public function setPage($page)
    {
        $this->page = $page;
    
        return $this;
    }

    /**
     * Get page
     *
     * @return integer 
     */
    public function getPage()
    {
        return $this->page;
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
     * Set idActivite
     *
     * @param \NTE\AntiquitasBundle\Entity\AntiquitasActivites $idActivite
     * @return AntiquitasNoticesActivites
     */
    public function setIdActivite(\NTE\AntiquitasBundle\Entity\AntiquitasActivites $idActivite = null)
    {
        $this->idActivite = $idActivite;
    
        return $this;
    }

    /**
     * Get idActivite
     *
     * @return \NTE\AntiquitasBundle\Entity\AntiquitasActivites 
     */
    public function getIdActivite()
    {
        return $this->idActivite;
    }

    /**
     * Set idChapitre
     *
     * @param \NTE\AntiquitasBundle\Entity\AntiquitasChapitres $idChapitre
     * @return AntiquitasNoticesActivites
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
}