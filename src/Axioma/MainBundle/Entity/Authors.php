<?php

namespace Axioma\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Authors
 *
 * @ORM\Table(name="authors")
 * @Gedmo\TranslationEntity(class="Axioma\MainBundle\Entity\Translation\AuthorsTranslation")
 * @ORM\Entity
 */
class Authors
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
     *
     * @ORM\Column(name="name", type="string", length=45, nullable=false)
     * @Gedmo\Translatable
     */
    private $name;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Books", mappedBy="author")
     */
    private $book;

    /**
     * @ORM\OneToMany(
     *     targetEntity="Axioma\MainBundle\Entity\Translation\AuthorsTranslation",
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
     * @return Authors
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
     * @return Authors
     */
    public function addBook(\Axioma\MainBundle\Entity\Books $book)
    {
        $this->book[] = $book;
    
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