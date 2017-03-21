<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use FOS\UserBundle\Model\User as BaseUser;

/**
 * User
 *
 * @ORM\Table(name="fos_user")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 */
class User extends BaseUser
{

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\OneToMany(targetEntity="Site", mappedBy="user")
     */
    protected $sites;

    /**
     * @return mixed
     */
    public function getSites()
    {
        return $this->sites;
    }

    /**
     * @param mixed $sites
     */
    public function setSites($sites)
    {
        $this->sites = $sites;
    }

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=60, unique=true)
     */
//    protected $username;


    /**
     * @var string
     *
     * @ORM\Column(type="string", unique=true)
     */
    protected $googleID;

    /**
     * @return string
     */
    public function getGoogleID()
    {
        return $this->googleID;
    }

    /**
     * @param string $googleID
     */
    public function setGoogleID($googleID)
    {
        $this->googleID = $googleID;
    }
    /*
     * @ORM\Column(name="email', type="string", length=60, unique=true)
     */
 //   protected $email;

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255)
     */
//    protected $password;

    /**
     * @var int
     *
     * @ORM\Column(name="state", type="integer")
     */
    protected $state;

    /**
     * @ORM\Column(name="last_connection", type="datetime", nullable=true)
     */
    protected $lastConnection;

    /**
     * @ORM\OneToOne(targetEntity="Role")
     * @ORM\JoinColumn(name="roles", referencedColumnName="id")
     */
 //   protected $roles;

    /**
     * @return mixed
     */
    public function getRoles()
    {
        return array($this->roles->getName());
    }

    /**
     * @param mixed $role
     */
    public function setRoles(array $roles)
    {
        $this->roles = $roles;
    }

    public function getSalt()
    {
        // you *may* need a real salt depending on your encoder
        // see section on salt below
        return null;
    }

    public function eraseCredentials()
    {
    }

    /**
     * @return mixed
     */
    public function getLastConnection()
    {
        return $this->lastConnection;
    }

    /**
     * @param mixed $lastConnection
     */
    public function setLastConnection($lastConnection)
    {
        $this->lastConnection = $lastConnection;
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set username
     *
     * @param string $username
     *
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return User
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
     * Set state
     *
     * @param integer $state
     *
     * @return User
     */
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get state
     *
     * @return int
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Add site
     *
     * @param \AppBundle\Entity\Site $site
     *
     * @return User
     */
    public function addSite(\AppBundle\Entity\Site $site)
    {
        $this->sites[] = $site;

        return $this;
    }

    /**
     * Remove site
     *
     * @param \AppBundle\Entity\Site $site
     */
    public function removeSite(\AppBundle\Entity\Site $site)
    {
        $this->sites->removeElement($site);
    }
}
