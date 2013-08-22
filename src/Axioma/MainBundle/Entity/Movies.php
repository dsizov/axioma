<?php

namespace Axioma\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Movies
 *
 * @ORM\Table(name="movies")
 * @ORM\Entity
 */
class Movies
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
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="quality", type="string", nullable=false)
     */
    private $quality;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Actors", inversedBy="movie")
     * @ORM\JoinTable(name="movie_has_actor",
     *   joinColumns={
     *     @ORM\JoinColumn(name="movie_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="actor_id", referencedColumnName="id")
     *   }
     * )
     */
    private $actor;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Tags", inversedBy="movie")
     * @ORM\JoinTable(name="movie_has_tag",
     *   joinColumns={
     *     @ORM\JoinColumn(name="movie_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="tag_id", referencedColumnName="id")
     *   }
     * )
     */
    private $tag;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->actor = new \Doctrine\Common\Collections\ArrayCollection();
        $this->tag = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Movies
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
     * @return Movies
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
     * Set quality
     *
     * @param string $quality
     * @return Movies
     */
    public function setQuality($quality)
    {
        $this->quality = $quality;
    
        return $this;
    }

    /**
     * Get quality
     *
     * @return string 
     */
    public function getQuality()
    {
        return $this->quality;
    }

    /**
     * Add actor
     *
     * @param \Axioma\MainBundle\Entity\Actors $actor
     * @return Movies
     */
    public function addActor(\Axioma\MainBundle\Entity\Actors $actor)
    {
        $this->actor[] = $actor;
    
        return $this;
    }

    /**
     * Remove actor
     *
     * @param \Axioma\MainBundle\Entity\Actors $actor
     */
    public function removeActor(\Axioma\MainBundle\Entity\Actors $actor)
    {
        $this->actor->removeElement($actor);
    }

    /**
     * Get actor
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getActor()
    {
        return $this->actor;
    }

    /**
     * Add tag
     *
     * @param \Axioma\MainBundle\Entity\Tags $tag
     * @return Movies
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
}