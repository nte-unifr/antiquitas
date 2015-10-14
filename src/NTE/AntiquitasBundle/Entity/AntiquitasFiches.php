<?php

namespace NTE\AntiquitasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AntiquitasFiches
 *
 * @ORM\Table(name="antiquitas_fiches")
 * @ORM\Entity
 */
class AntiquitasFiches
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
     * @ORM\Column(name="contenu", type="text", nullable=true)
     */
    private $contenu;

    /**
     * @var integer
     *
     * @ORM\Column(name="position", type="integer", nullable=false)
     */
    private $position;

    /**
     * @var integer
     *
     * @ORM\Column(name="statut", type="integer", nullable=false)
     */
    private $statut;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

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
     * @ORM\OneToMany(targetEntity="AntiquitasNoticesTextes", mappedBy="idFiche")
     * @ORM\OrderBy({"position" = "ASC"})
     */
    protected $noticestextes;

    /**
     * @ORM\OneToMany(targetEntity="AntiquitasNoticesImages", mappedBy="idFiche")
     * @ORM\OrderBy({"position" = "ASC"})
     */
    protected $noticesimages;

    /**
     * @ORM\OneToMany(targetEntity="AntiquitasNoticesNotes", mappedBy="idFiche")
     * @ORM\OrderBy({"position" = "ASC"})
     */
    protected $noticesnotes;

    /**
     * @ORM\OneToMany(targetEntity="AntiquitasNoticesLiens", mappedBy="idFiche")
     * @ORM\OrderBy({"position" = "ASC"})
     */
    protected $noticesliens;

    /**
     * @ORM\OneToOne(targetEntity="AntiquitasFichesBibliographies", mappedBy="idFiche")
     */
    private $biblio;

    /**
     * @var string
     *
     * @ORM\Column(name="bibliographie", type="text", nullable=true)
     */
    private $bibliographie;


    public function __toString()
    {
        return (string)$this->nom;
    }



    /**
     * Set nom
     *
     * @param string $nom
     * @return AntiquitasFiches
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
     * Set contenu
     *
     * @param string $contenu
     * @return AntiquitasFiches
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
     * Set position
     *
     * @param integer $position
     * @return AntiquitasFiches
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
     * Set statut
     *
     * @param integer $statut
     * @return AntiquitasFiches
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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set idChapitre
     *
     * @param \NTE\AntiquitasBundle\Entity\AntiquitasChapitres $idChapitre
     * @return AntiquitasFiches
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
     * Constructor
     */
    public function __construct()
    {
        $this->noticetexte = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add noticestextes
     *
     * @param \NTE\AntiquitasBundle\Entity\AntiquitasNoticesTextes $noticestextes
     * @return AntiquitasFiches
     */
    public function addNoticestexte(\NTE\AntiquitasBundle\Entity\AntiquitasNoticesTextes $noticestextes)
    {
        $this->noticestextes[] = $noticestextes;
    
        return $this;
    }

    /**
     * Remove noticestextes
     *
     * @param \NTE\AntiquitasBundle\Entity\AntiquitasNoticesTextes $noticestextes
     */
    public function removeNoticestexte(\NTE\AntiquitasBundle\Entity\AntiquitasNoticesTextes $noticestextes)
    {
        $this->noticestextes->removeElement($noticestextes);
    }

    /**
     * Get noticestextes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getNoticestextes()
    {
        return $this->noticestextes;
    }

    /**
     * Add noticesimages
     *
     * @param \NTE\AntiquitasBundle\Entity\AntiquitasNoticesImages $noticesimages
     * @return AntiquitasFiches
     */
    public function addNoticesimage(\NTE\AntiquitasBundle\Entity\AntiquitasNoticesImages $noticesimages)
    {
        $this->noticesimages[] = $noticesimages;
    
        return $this;
    }

    /**
     * Remove noticesimages
     *
     * @param \NTE\AntiquitasBundle\Entity\AntiquitasNoticesImages $noticesimages
     */
    public function removeNoticesimage(\NTE\AntiquitasBundle\Entity\AntiquitasNoticesImages $noticesimages)
    {
        $this->noticesimages->removeElement($noticesimages);
    }

    /**
     * Get noticesimages
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getNoticesimages()
    {
        return $this->noticesimages;
    }

    /**
     * Add noticesnotes
     *
     * @param \NTE\AntiquitasBundle\Entity\AntiquitasNoticesNotes $noticesnotes
     * @return AntiquitasFiches
     */
    public function addNoticesnote(\NTE\AntiquitasBundle\Entity\AntiquitasNoticesNotes $noticesnotes)
    {
        $this->noticesnotes[] = $noticesnotes;
    
        return $this;
    }

    /**
     * Remove noticesnotes
     *
     * @param \NTE\AntiquitasBundle\Entity\AntiquitasNoticesNotes $noticesnotes
     */
    public function removeNoticesnote(\NTE\AntiquitasBundle\Entity\AntiquitasNoticesNotes $noticesnotes)
    {
        $this->noticesnotes->removeElement($noticesnotes);
    }

    /**
     * Get noticesnotes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getNoticesnotes()
    {
        return $this->noticesnotes;
    }

    /**
     * Add noticesliens
     *
     * @param \NTE\AntiquitasBundle\Entity\AntiquitasNoticesLiens $noticesliens
     * @return AntiquitasFiches
     */
    public function addNoticeslien(\NTE\AntiquitasBundle\Entity\AntiquitasNoticesLiens $noticesliens)
    {
        $this->noticesliens[] = $noticesliens;
    
        return $this;
    }

    /**
     * Remove noticesliens
     *
     * @param \NTE\AntiquitasBundle\Entity\AntiquitasNoticesLiens $noticesliens
     */
    public function removeNoticeslien(\NTE\AntiquitasBundle\Entity\AntiquitasNoticesLiens $noticesliens)
    {
        $this->noticesliens->removeElement($noticesliens);
    }

    /**
     * Get noticesliens
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getNoticesliens()
    {
        return $this->noticesliens;
    }

    /**
     * Set bibliographie
     *
     * @param string $bibliographie
     * @return AntiquitasFiches
     */
    public function setBibliographie($bibliographie)
    {
        $this->bibliographie = $bibliographie;
    
        return $this;
    }

    /**
     * Get bibliographie
     *
     * @return string 
     */
    public function getBibliographie()
    {
        return $this->bibliographie;
    }

    /**
     * Set biblio
     *
     * @param \NTE\AntiquitasBundle\Entity\AntiquitasFichesBibliographies $biblio
     * @return AntiquitasFiches
     */
    public function setBiblio(\NTE\AntiquitasBundle\Entity\AntiquitasFichesBibliographies $biblio = null)
    {
        $this->biblio = $biblio;
    
        return $this;
    }

    /**
     * Get biblio
     *
     * @return \NTE\AntiquitasBundle\Entity\AntiquitasFichesBibliographies 
     */
    public function getBiblio()
    {
        return $this->biblio;
    }
}