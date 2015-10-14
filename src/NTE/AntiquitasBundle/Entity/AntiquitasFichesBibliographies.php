<?php

namespace NTE\AntiquitasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AntiquitasFichesBibliographies
 *
 * @ORM\Table(name="antiquitas_fiches_bibliographies")
 * @ORM\Entity
 */
class AntiquitasFichesBibliographies
{
    /**
     * @var string
     *
     * @ORM\Column(name="contenu", type="text", nullable=true)
     */
    private $contenu;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="AntiquitasFiches")
     * @ORM\JoinColumn(name="id_fiche", referencedColumnName="id")
     */
    private $idFiche;


    public function __toString()
    {
        return (string)$this->contenu;
    }


    /**
     * Set contenu
     *
     * @param string $contenu
     * @return AntiquitasFichesBibliographies
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
     * @return AntiquitasFichesBibliographies
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
