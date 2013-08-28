<?php

namespace Axioma\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\ExecutionContextInterface;

/**
 * Books
 *
 * @ORM\Table(name="books")
 * @Gedmo\TranslationEntity(class="Axioma\MainBundle\Entity\Translation\BooksTranslation")
 * @ORM\Entity
 */
class Books
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
     * @ORM\Column(name="title", type="string", length=255, nullable=false)
     * @Gedmo\Translatable
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     * @Gedmo\Translatable
     */
    private $description;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Authors", inversedBy="book", cascade={"persist"})
     * @ORM\JoinTable(name="book_has_author",
     *   joinColumns={
     *     @ORM\JoinColumn(name="book_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="author_id", referencedColumnName="id")
     *   }
     * )
     */
    private $author;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Tags", inversedBy="book", cascade={"persist"})
     * @ORM\JoinTable(name="book_has_tag",
     *   joinColumns={
     *     @ORM\JoinColumn(name="book_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="tag_id", referencedColumnName="id")
     *   }
     * )
     */
    private $tag;

    /**
     * @ORM\OneToMany(
     *     targetEntity="Axioma\MainBundle\Entity\Translation\BooksTranslation",
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
        $this->author = new \Doctrine\Common\Collections\ArrayCollection();
        $this->tag = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set title
     *
     * @param string $title
     * @return Books
     */
    public function setTitle($title)
    {
        $this->title = $title;
    
        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Books
     */
    public function setDescription($description)
    {
        $this->description = $description;
    
        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Add author
     *
     * @param \Axioma\MainBundle\Entity\Authors $author
     * @return Books
     */
    public function addAuthor(\Axioma\MainBundle\Entity\Authors $author)
    {
        $this->author[] = $author;
    
        return $this;
    }

    /**
     * Remove author
     *
     * @param \Axioma\MainBundle\Entity\Authors $author
     */
    public function removeAuthor(\Axioma\MainBundle\Entity\Authors $author)
    {
        $this->author->removeElement($author);
    }

    /**
     * Get author
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Add tag
     *
     * @param \Axioma\MainBundle\Entity\Tags $tag
     * @return Books
     */
    public function addTag(\Axioma\MainBundle\Entity\Tags $tag)
    {
        $this->tag[] = $tag;
    
        return $this;
    }

    /**
     * Remove tag
     *
     * @param \Axioma\MainBundle\Entity\Tags $tag
     */
    public function removeTag(\Axioma\MainBundle\Entity\Tags $tag)
    {
        $this->tag->removeElement($tag);
    }

    /**
     * Get tag
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTag()
    {
        return $this->tag;
    }

    /**
     * @param Tags $tag
     * @return $this
     */
    public function addNewTag(\Axioma\MainBundle\Entity\Tags $tag)
    {
        $tag->getBook($this);

        $this->tag[] = $tag;

        return $this;
    }

    public function getNewTag() {}

    /**
     * @param Tags $tag
     */
    public function setNewTag(\Axioma\MainBundle\Entity\Tags $tag)
    {
        $this->addTag($tag);
    }

    /**
     * @param Tags $tag
     */
    public function removeNewTag(\Axioma\MainBundle\Entity\Tags $tag)
    {
        $this->tag->removeElement($tag);
    }

    /**
     * @param Authors $author
     * @return $this
     */
    public function addNewAuthor(\Axioma\MainBundle\Entity\Authors $author)
    {
        $author->getBook($this);

        $this->author[] = $author;

        return $this;
    }

    public function getNewAuthor() {}

    /**
     * @param Authors $author
     */
    public function setNewauthor(\Axioma\MainBundle\Entity\Authors $author)
    {
        $this->addauthor($author);
    }

    /**
     * @param Authors $author
     */
    public function removeNewAuthor(\Axioma\MainBundle\Entity\Authors $author)
    {
        $this->author->removeElement($author);
    }

    /**
     * Set translations
     *
     * @param ArrayCollection $translations
     * @return Books
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

    public function isRelatedObjectsValid(ExecutionContextInterface $context)
    {
        foreach ($this->getAuthor() as $author) {
            if ($author->getName() == '') {
                $context->addViolationAt('name', 'Author name can\'t be empty');
            }
        }

        foreach ($this->getTag() as $tag) {
            if ($tag->getName() == '') {
                $context->addViolationAt('name', 'Tag name can\'t be empty');
            }
        }
    }
}