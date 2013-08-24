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
    const QUALITY_DVDRIP = 'dvdrip';
    const QUALITY_HDRIP = 'hdrip';
    const QUALITY_BDRIP = 'bdrip';
    const QUALITY_720P = '720p';
    const QUALITY_1080P = '1080p';
    const QUALITY_DVD5 = 'dvd5';

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
     * @ORM\Column(name="quality", type="string", nullable=false, columnDefinition="ENUM('dvdrip', 'hdrip', 'bdrip', '720p', '1080p', 'dvd5')")
     */
    private $quality;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Actors", inversedBy="movie", cascade={"persist"})
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
     * @ORM\ManyToMany(targetEntity="Tags", inversedBy="movie", cascade={"persist"})
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

    /**
     * @param Tags $tag
     * @return $this
     */
    public function addNewTag(\Axioma\MainBundle\Entity\Tags $tag)
    {
        $tag->getMovie($this);

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
    public function addNewActor(\Axioma\MainBundle\Entity\Actors $actor)
    {
        $actor->getMovie($this);

        $this->actor[] = $actor;

        return $this;
    }

    public function getNewActor() {}

    /**
     * @param actors $actor
     */
    public function setNewActor(\Axioma\MainBundle\Entity\Actors $actor)
    {
        $this->addActor($actor);
    }

    /**
     * @param actors $actor
     */
    public function removeNewActor(\Axioma\MainBundle\Entity\Actors $actor)
    {
        $this->actor->removeElement($actor);
    }

    public static function getQualityList()
    {
        return array(
            self::QUALITY_DVDRIP => self::QUALITY_DVDRIP,
            self::QUALITY_HDRIP => self::QUALITY_HDRIP,
            self::QUALITY_BDRIP => self::QUALITY_BDRIP,
            self::QUALITY_720P => self::QUALITY_720P,
            self::QUALITY_1080P => self::QUALITY_1080P,
            self::QUALITY_DVD5 => self::QUALITY_DVD5
        );
    }
}