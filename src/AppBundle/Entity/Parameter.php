<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Parameter
 *
 * @ORM\Table(name="parameter", uniqueConstraints={@ORM\UniqueConstraint(name="uniqueParam",columns={"name"} ) } )
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ParameterRepository")
 * @UniqueEntity("name")
 * @ORM\EntityListeners({"AppBundle\Listener\ParameterListener"})
 */
class Parameter
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=60)
     */
    private $name;

    /**
     * @ORM\Column(name="value", type="string", length=255,nullable=true)
     */
    private $value;

    /**
     * @ORM\Column(name="isImage", type="boolean")
     */
    private $isImage=false;

    /**
     * @return mixed
     */
    public function getIsImage()
    {
        return $this->isImage;
    }

    /**
     * @param mixed $isImage
     */
    public function setIsImage($isImage)
    {
        $this->isImage = $isImage;
    }


    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=255)
     */
    private $slug;

    /**
     * @return mixed
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @param mixed $slug
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    }

    /**
     * @ORM\Column(name="last_modification", type="datetime", length=255)
     */
    private $last_modification;

    /**
     * @return mixed
     */
    public function getLastModification()
    {
        return $this->last_modification;
    }

    /**
     * @param mixed $last_modification
     */
    public function setLastModification($last_modification)
    {
        $this->last_modification = $last_modification;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     */
    public function setValue($value)
    {
        $this->value = $value;
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
     * Set name
     *
     * @param string $name
     *
     * @return Parameter
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

}

