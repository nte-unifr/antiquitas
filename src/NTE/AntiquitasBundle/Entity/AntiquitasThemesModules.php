<?php

namespace NTE\AntiquitasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AntiquitasThemesModules
 *
 * @ORM\Table(name="antiquitas_themes_modules")
 * @ORM\Entity
 */
class AntiquitasThemesModules
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
     * @var \NTE\AntiquitasBundle\Entity\AntiquitasThemes
     *
     * @ORM\ManyToOne(targetEntity="NTE\AntiquitasBundle\Entity\AntiquitasThemes")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_theme", referencedColumnName="id")
     * })
     */
    private $idTheme;

    /**
     * @var \NTE\AntiquitasBundle\Entity\AntiquitasModules
     *
     * @ORM\ManyToOne(targetEntity="NTE\AntiquitasBundle\Entity\AntiquitasModules")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_module", referencedColumnName="id")
     * })
     */
    private $idModule;

    public function __toString()
    {
        return (string)($this->id);
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
     * Set idTheme
     *
     * @param \NTE\AntiquitasBundle\Entity\AntiquitasThemes $idTheme
     * @return AntiquitasThemesModules
     */
    public function setIdTheme(\NTE\AntiquitasBundle\Entity\AntiquitasThemes $idTheme = null)
    {
        $this->idTheme = $idTheme;
    
        return $this;
    }

    /**
     * Get idTheme
     *
     * @return \NTE\AntiquitasBundle\Entity\AntiquitasThemes 
     */
    public function getIdTheme()
    {
        return $this->idTheme;
    }

    /**
     * Set idModule
     *
     * @param \NTE\AntiquitasBundle\Entity\AntiquitasModules $idModule
     * @return AntiquitasThemesModules
     */
    public function setIdModule(\NTE\AntiquitasBundle\Entity\AntiquitasModules $idModule = null)
    {
        $this->idModule = $idModule;
    
        return $this;
    }

    /**
     * Get idModule
     *
     * @return \NTE\AntiquitasBundle\Entity\AntiquitasModules 
     */
    public function getIdModule()
    {
        return $this->idModule;
    }
}
