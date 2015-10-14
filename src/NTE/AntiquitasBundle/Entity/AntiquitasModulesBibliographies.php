<?php

namespace NTE\AntiquitasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AntiquitasModulesBibliographies
 *
 * @ORM\Table(name="antiquitas_modules_bibliographies")
 * @ORM\Entity
 */
class AntiquitasModulesBibliographies
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
     * Set contenu
     *
     * @param string $contenu
     * @return AntiquitasModulesBibliographies
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
}
