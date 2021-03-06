<?php

namespace Axioma\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Tags
 *
 * @ORM\Table(name="tags")
 * @Gedmo\TranslationEntity(class="Axioma\MainBundle\Entity\Translation\TagsTranslation")
 * @ORM\Entity
 */
class Tags
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
     * @ORM\Column(name="name", type="string", length=45, nullable=false)
     * @Gedmo\Translatable
     */
    private $name;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Books", mappedBy="tag")
     */
    private $book;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Movies", mappedBy="tag")
     */
    private $movie;

    /**
     * @ORM\OneToMany(
     *     targetEntity="Axioma\MainBundle\Entity\Translation\TagsTranslation",
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
        $this->book = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Tags
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
     * Add book
     *
     * @param \Axioma\MainBundle\Entity\Books $book
     * @return Tags
     */
    public function addBook(\Axioma\MainBundle\Entity\Books $book)
    {
        if (!$this->book->contains($book)) {
            $this->book[] = $book;
        }

        return $this;
    }

    /**
     * Remove book
     *
     * @param \Axioma\MainBundle\Entity\Books $book
     */
    public function removeBook(\Axioma\MainBundle\Entity\Books $book)
    {
        $this->book->removeElement($book);
    }

    /**
     * Get book
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getBook()
    {
        return $this->book;
    }

    /**
     * Add movie
     *
     * @param \Axioma\MainBundle\Entity\Movies $movie
     * @return Tags
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

    public function __toString()
    {
        return $this->getName();
    }

    /**
     * Set translations
     *
     * @param ArrayCollection $translations
     * @return Tags
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