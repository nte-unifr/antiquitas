<?php

namespace NTE\AntiquitasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AntiquitasTextesSiteGlobal
 *
 * @ORM\Table(name="antiquitas_textes_site_global")
 * @ORM\Entity
 */
class AntiquitasTextesSiteGlobal
{
    /**
     * @var string
     *
     * @ORM\Column(name="variable", type="string", length=255, nullable=false)
     */
    private $variable;

    /**
     * @var string
     *
     * @ORM\Column(name="fr", type="text", nullable=false)
     */
    private $fr;

    /**
     * @var string
     *
     * @ORM\Column(name="de", type="text", nullable=false)
     */
    private $de;

    /**
     * @var string
     *
     * @ORM\Column(name="en", type="text", nullable=false)
     */
    private $en;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;



    /**
     * Set variable
     *
     * @param string $variable
     * @return AntiquitasTextesSiteGlobal
     */
    public function setVariable($variable)
    {
        $this->variable = $variable;
    
        return $this;
    }

    /**
     * Get variable
     *
     * @return string 
     */
    public function getVariable()
    {
        return $this->variable;
    }

    /**
     * Set fr
     *
     * @param string $fr
     * @return AntiquitasTextesSiteGlobal
     */
    public function setFr($fr)
    {
        $this->fr = $fr;
    
        return $this;
    }

    /**
     * Get fr
     *
     * @return string 
     */
    public function getFr()
    {
        return $this->fr;
    }

    /**
     * Set de
     *
     * @param string $de
     * @return AntiquitasTextesSiteGlobal
     */
    public function setDe($de)
    {
        $this->de = $de;
    
        return $this;
    }

    /**
     * Get de
     *
     * @return string 
     */
    public function getDe()
    {
        return $this->de;
    }

    /**
     * Set en
     *
     * @param string $en
     * @return AntiquitasTextesSiteGlobal
     */
    public function setEn($en)
    {
        $this->en = $en;
    
        return $this;
    }

    /**
     * Get en
     *
     * @return string 
     */
    public function getEn()
    {
        return $this->en;
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