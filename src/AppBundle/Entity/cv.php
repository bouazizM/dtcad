<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
/**
 * cv
 *
 * @ORM\Table(name="cv")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\cvRepository")
 */
class cv
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
     * @ORM\Column(name="lastname", type="string", length=255)
     */
    private $lastname;

    /**
     * @var string
     *
     * @ORM\Column(name="firstname", type="string", length=255)
     */
    private $firstname;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_naiss", type="date")
     */
    private $dateNaiss;

    /**
     * @var string
     *
     * @ORM\Column(name="addr", type="string", length=255)
     */
    private $addr;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=255)
     */
    private $phone;

    /**
     * @var int
     *
     * @ORM\Column(name="user_id", type="integer")
     */
    private $userId;


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
     * Set lastname
     *
     * @param string $lastname
     *
     * @return cv
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set firstname
     *
     * @param string $firstname
     *
     * @return cv
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set dateNaiss
     *
     * @param \DateTime $dateNaiss
     *
     * @return cv
     */
    public function setDateNaiss($dateNaiss)
    {
        $this->dateNaiss = $dateNaiss;

        return $this;
    }

    /**
     * Get dateNaiss
     *
     * @return \DateTime
     */
    public function getDateNaiss()
    {
        return $this->dateNaiss;
    }

    /**
     * Set addr
     *
     * @param string $addr
     *
     * @return cv
     */
    public function setAddr($addr)
    {
        $this->addr = $addr;

        return $this;
    }

    /**
     * Get addr
     *
     * @return string
     */
    public function getAddr()
    {
        return $this->addr;
    }

    /**
     * Set phone
     *
     * @param string $phone
     *
     * @return cv
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set userId
     *
     * @param integer $userId
     *
     * @return cv
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return int
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @return mixed
     */
    public function getParcours()
    {
        return $this->parcours;
    }

    /**
     * @param mixed $parcours
     */
    public function setParcours($parcours)
    {
        $this->parcours = $parcours;
    }

    /**
     * @var
     * @ORM\ManyToOne(targetEntity="parcour",inversedBy="cv")
     */
    private $parcours;


    public function __construct()
    {
        $this->parcours = new ArrayCollection();
    }

}

