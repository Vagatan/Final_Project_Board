<?php

namespace BoardBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Comment
 *
 * @ORM\Table(name="comment")
 * @ORM\Entity(repositoryClass="BoardBundle\Repository\CommentRepository")
 */
class Comment
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
     * @ORM\Column(name="comment", type="text")
     */
    private $comment;


    /**
     *  @ORM\ManyToOne(targetEntity="User", inversedBy="comments")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="Advertisement", inversedBy="comments")
     * @ORM\JoinColumn(name="advert_id", referencedColumnName="id")
     */
    private $advertisement;


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
     * Set comment
     *
     * @param string $comment
     * @return Comment
     */
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get comment
     *
     * @return string 
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set user
     *
     * @param \BoardBundle\Entity\User $user
     * @return Comment
     */
    public function setUser(\BoardBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \BoardBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set advertisement
     *
     * @param \BoardBundle\Entity\Advertisement $advertisement
     * @return Comment
     */
    public function setAdvertisement(\BoardBundle\Entity\Advertisement $advertisement = null)
    {
        $this->advertisement = $advertisement;

        return $this;
    }

    /**
     * Get advertisement
     *
     * @return \BoardBundle\Entity\Advertisement 
     */
    public function getAdvertisement()
    {
        return $this->advertisement;
    }
}
