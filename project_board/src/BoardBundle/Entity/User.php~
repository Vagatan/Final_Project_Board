<?php
namespace BoardBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 * @ORM\HasLifecycleCallbacks()
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(name="first_name", type="string")
     */
    private $firstName;

    /**
     * @ORM\Column(name="last_name", type="string")
     */
    private $lastName;

    /**
     * @ORM\OneToMany(targetEntity="Advertisement", mappedBy="user")
     */
    private $advertisements;

    /**
     * @ORM\OneToMany(targetEntity="Comment", mappedBy="user")
     */
    private $comments;

    public function __construct()
    {
        parent::__construct();

    }

    /**
     * @ORM\PrePersist
     */
    public function prePersist() {
        $this->roles = array('ROLE_USER');
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param mixed $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param mixed $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }


    /**
     * Add advertisements
     *
     * @param \BoardBundle\Entity\Advertisement $advertisements
     * @return User
     */
    public function addAdvertisement(\BoardBundle\Entity\Advertisement $advertisements)
    {
        $this->advertisements[] = $advertisements;

        return $this;
    }

    /**
     * Remove advertisements
     *
     * @param \BoardBundle\Entity\Advertisement $advertisements
     */
    public function removeAdvertisement(\BoardBundle\Entity\Advertisement $advertisements)
    {
        $this->advertisements->removeElement($advertisements);
    }

    /**
     * Get advertisements
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAdvertisements()
    {
        return $this->advertisements;
    }

    /**
     * Add comments
     *
     * @param \BoardBundle\Entity\Comment $comments
     * @return User
     */
    public function addComment(\BoardBundle\Entity\Comment $comments)
    {
        $this->comments[] = $comments;

        return $this;
    }

    /**
     * Remove comments
     *
     * @param \BoardBundle\Entity\Comment $comments
     */
    public function removeComment(\BoardBundle\Entity\Comment $comments)
    {
        $this->comments->removeElement($comments);
    }

    /**
     * Get comments
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getComments()
    {
        return $this->comments;
    }
}
