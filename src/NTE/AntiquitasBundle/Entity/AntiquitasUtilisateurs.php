<?php

namespace NTE\AntiquitasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AntiquitasUtilisateurs
 *
 * @ORM\Table(name="antiquitas_utilisateurs")
 * @ORM\Entity
 */
class AntiquitasUtilisateurs
{
    /**
     * @var string
     *
     * @ORM\Column(name="login", type="string", length=255, nullable=false)
     */
    private $login;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255, nullable=false)
     */
    private $password;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="NTE\AntiquitasBundle\Entity\AntiquitasModules", inversedBy="idUtilisateur")
     * @ORM\JoinTable(name="antiquitas_modules_acces",
     *   joinColumns={
     *     @ORM\JoinColumn(name="id_utilisateur", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="id_module", referencedColumnName="id")
     *   }
     * )
     */
    private $idModule;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idModule = new \Doctrine\Common\Collections\ArrayCollection();
    }
    

    /**
     * Set login
     *
     * @param string $login
     * @return AntiquitasUtilisateurs
     */
    public function setLogin($login)
    {
        $this->login = $login;
    
        return $this;
    }

    /**
     * Get login
     *
     * @return string 
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return AntiquitasUtilisateurs
     */
    public function setPassword($password)
    {
        $this->password = $password;
    
        return $this;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->password;
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
     * Add idModule
     *
     * @param \NTE\AntiquitasBundle\Entity\AntiquitasModules $idModule
     * @return AntiquitasUtilisateurs
     */
    public function addIdModule(\NTE\AntiquitasBundle\Entity\AntiquitasModules $idModule)
    {
        $this->idModule[] = $idModule;
    
        return $this;
    }

    /**
     * Remove idModule
     *
     * @param \NTE\AntiquitasBundle\Entity\AntiquitasModules $idModule
     */
    public function removeIdModule(\NTE\AntiquitasBundle\Entity\AntiquitasModules $idModule)
    {
        $this->idModule->removeElement($idModule);
    }

    /**
     * Get idModule
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getIdModule()
    {
        return $this->idModule;
    }
}