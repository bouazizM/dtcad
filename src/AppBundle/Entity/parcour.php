<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * parcour
 *
 * @ORM\Table(name="parcour")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\parcourRepository")
 */
class parcour
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
     * var string
     * @ORM\Column(name="titre", type ="string" , nullable=false)
     */
    private $titre ;

    /**
     * @return mixed
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * @param mixed $titre
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;
    }

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_debut", type="date")
     */
    private $date_debut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_fin", type="date")
     */
    private $dateFin;

    /**
     * @var string
     *
     * @ORM\Column(name="universite", type="string", length=255)
     */
    private $universite;

    /**
     * @var int
     *
     * @ORM\Column(name="cv_id", type="integer")
     */
    private $cvId;


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
     * @return \DateTime
     */
    public function getDateDebut()
    {
        return $this->date_debut;
    }

    /**
     * @param \DateTime $date_debut
     */
    public function setDateDebut($date_debut)
    {
        $this->date_debut = $date_debut;
    }




    /**
     * Set dateFin
     *
     * @param \DateTime $dateFin
     *
     * @return parcour
     */
    public function setDateFin($dateFin)
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    /**
     * Get dateFin
     *
     * @return \DateTime
     */
    public function getDateFin()
    {
        return $this->dateFin;
    }

    /**
     * Set universite
     *
     * @param string $universite
     *
     * @return parcour
     */
    public function setUniversite($universite)
    {
        $this->universite = $universite;

        return $this;
    }

    /**
     * Get universite
     *
     * @return string
     */
    public function getUniversite()
    {
        return $this->universite;
    }

    /**
     * Set cvId
     *
     * @param integer $cvId
     *
     * @return parcour
     */
    public function setCvId($cvId)
    {
        $this->cvId = $cvId;

        return $this;
    }

    /**
     * Get cvId
     *
     * @return int
     */
    public function getCvId()
    {
        return $this->cvId;
    }

    /**
     * @return mixed
     */
    public function getCv()
    {
        return $this->cv;
    }

    /**
     * @param mixed $cv
     */
    public function setCv($cv)
    {
        $this->cv = $cv;
    }

    /**
     * @var
     *@ORM\OneToMany(targetEntity="cv", mappedBy="parcours")
     */
    private $cv ;
}

