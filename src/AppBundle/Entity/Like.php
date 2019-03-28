<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * News
 *
 * @ORM\Table(name="likes")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\LikeRepository")
 */
class Like
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
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\News", inversedBy="likes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $news;

 
    /**
     * @ORM\ManyToOne(targetEntity="UtilisateurBundle\Entity\User", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    
    public function __construct(){
        $this->date = new \Datetime(); 
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
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Like
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set news
     *
     * @param \AppBundle\Entity\News $news
     *
     * @return Like
     */
    public function setNews(\AppBundle\Entity\News $news)
    {
        $this->news = $news;

        return $this;
    }

    /**
     * Get news
     *
     * @return \AppBundle\Entity\News
     */
    public function getNews()
    {
        return $this->news;
    }

    /**
     * Set user
     *
     * @param \UtilisateurBundle\Entity\User $user
     *
     * @return Like
     */
    public function setUser(\UtilisateurBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \UtilisateurBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
}
