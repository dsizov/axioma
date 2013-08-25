<?php

namespace Axioma\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Actors
 *
 * @ORM\Table(name="actors")
 * @Gedmo\TranslationEntity(class="Axioma\MainBundle\Entity\Translation\ActorsTranslation")
 * @ORM\Entity
 */
class Actors
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     * @Gedmo\Translatable
     */
    private $name;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Movies", mappedBy="actor")
     */
    private $movie;

    /**
     * @ORM\OneToMany(
     *     targetEntity="Axioma\MainBundle\Entity\Translation\ActorsTranslation",
     *  mappedBy="object",
     *  cascade={"persist", "remove"}
     * )
     * @Assert\Valid(deep = true)
     */
    private $translations;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->movie = new \Doctrine\Common\Collections\ArrayCollection();
        $this->translations = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set name
     *
     * @param string $name
     * @return Actors
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

    /**
     * Add movie
     *
     * @param \Axioma\MainBundle\Entity\Movies $movie
     * @return Actors
     */
    public function addMovie(\Axioma\MainBundle\Entity\Movies $movie)
    {
        $this->movie[] = $movie;
    
        return $this;
    }

    /**
     * Remove movie
     *
     * @param \Axioma\MainBundle\Entity\Movies $movie
     */
    public function removeMovie(\Axioma\MainBundle\Entity\Movies $movie)
    {
        $this->movie->removeElement($movie);
    }

    /**
     * Get movie
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMovie()
    {
        return $this->movie;
    }

    /**
     * Set translations
     *
     * @param ArrayCollection $translations
     * @return Authors
     */
    public function setTranslations($translations)
    {
        foreach ($translations as $translation) {
            $translation->setObject($this);
        }

        $this->translations = $translations;
        return $this;
    }

    /**
     * Get translations
     *
     * @return ArrayCollection
     */
    public function getTranslations()
    {
        return $this->translations;
    }
}