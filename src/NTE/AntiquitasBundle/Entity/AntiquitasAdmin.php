<?php

namespace NTE\AntiquitasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AntiquitasAdmin
 *
 * @ORM\Table(name="antiquitas_admin")
 * @ORM\Entity
 */
class AntiquitasAdmin
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
     * @var integer
     *
     * @ORM\Column(name="contenusite", type="integer", nullable=false)
     */
    private $contenusite;

    /**
     * @var \NTE\AntiquitasBundle\Entity\AntiquitasUtilisateurs
     *
     * @ORM\OneToOne(targetEntity="NTE\AntiquitasBundle\Entity\AntiquitasUtilisateurs")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_utilisateur", referencedColumnName="id", unique=true)
     * })
     */
    private $idUtilisateur;



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
     * Set contenusite
     *
     * @param integer $contenusite
     * @return AntiquitasAdmin
     */
    public function setContenusite($contenusite)
    {
        $this->contenusite = $contenusite;
    
        return $this;
    }

    /**
     * Get contenusite
     *
     * @return integer 
     */
    public function getContenusite()
    {
        return $this->contenusite;
    }

    /**
     * Set idUtilisateur
     *
     * @param \NTE\AntiquitasBundle\Entity\AntiquitasUtilisateurs $idUtilisateur
     * @return AntiquitasAdmin
     */
    public function setIdUtilisateur(\NTE\AntiquitasBundle\Entity\AntiquitasUtilisateurs $idUtilisateur = null)
    {
        $this->idUtilisateur = $idUtilisateur;
    
        return $this;
    }

    /**
     * Get idUtilisateur
     *
     * @return \NTE\AntiquitasBundle\Entity\AntiquitasUtilisateurs 
     */
    public function getIdUtilisateur()
    {
        return $this->idUtilisateur;
    }
}