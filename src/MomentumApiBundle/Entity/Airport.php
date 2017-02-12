<?php

namespace MomentumApiBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Airport
 *
 * @ORM\Table(name="airport")
 * @ORM\Entity(repositoryClass="MomentumApiBundle\Repository\AirportRepository")
 */
class Airport
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=255, nullable=true)
     */
    private $city;

    /**
     * @var string
     *
     * @ORM\Column(name="country", type="string", length=255, nullable=true)
     */
    private $country;

    /**
     * @var string
     *
     * @ORM\Column(name="gka", type="string", length=6, nullable=true)
     */
    private $gka;

    /**
     * @var string
     *
     * @ORM\Column(name="ayga", type="string", length=6, nullable=true)
     */
    private $ayga;

    /**
     * @ORM\OneToMany(targetEntity="Flight", mappedBy="departureAirport")
     */
    private $departureFlight;

    /**
     * @ORM\OneToMany(targetEntity="Flight", mappedBy="destinationAirport")
     */
    private $destinationFlight;

    public function __construct()
    {
        $this->departureFlight = new ArrayCollection();
        $this->destinationFlight = new ArrayCollection();
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
     *
     * @return Airport
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
     * Set city
     *
     * @param string $city
     *
     * @return Airport
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set country
     *
     * @param string $country
     *
     * @return Airport
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set gka
     *
     * @param string $gka
     *
     * @return Airport
     */
    public function setGka($gka)
    {
        $this->gka = $gka;

        return $this;
    }

    /**
     * Get gka
     *
     * @return string
     */
    public function getGka()
    {
        return $this->gka;
    }

    /**
     * Set ayga
     *
     * @param string $ayga
     *
     * @return Airport
     */
    public function setAyga($ayga)
    {
        $this->ayga = $ayga;

        return $this;
    }

    /**
     * Get ayga
     *
     * @return string
     */
    public function getAyga()
    {
        return $this->ayga;
    }

    /**
     * Add departureFlight
     *
     * @param \MomentumApiBundle\Entity\Flight $departureFlight
     *
     * @return Airport
     */
    public function addDepartureFlight(\MomentumApiBundle\Entity\Flight $departureFlight)
    {
        $this->departureFlight[] = $departureFlight;

        return $this;
    }

    /**
     * Remove departureFlight
     *
     * @param \MomentumApiBundle\Entity\Flight $departureFlight
     */
    public function removeDepartureFlight(\MomentumApiBundle\Entity\Flight $departureFlight)
    {
        $this->departureFlight->removeElement($departureFlight);
    }

    /**
     * Get departureFlight
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDepartureFlight()
    {
        return $this->departureFlight;
    }

    /**
     * Add destinationFlight
     *
     * @param \MomentumApiBundle\Entity\Flight $destinationFlight
     *
     * @return Airport
     */
    public function addDestinationFlight(\MomentumApiBundle\Entity\Flight $destinationFlight)
    {
        $this->destinationFlight[] = $destinationFlight;

        return $this;
    }

    /**
     * Remove destinationFlight
     *
     * @param \MomentumApiBundle\Entity\Flight $destinationFlight
     */
    public function removeDestinationFlight(\MomentumApiBundle\Entity\Flight $destinationFlight)
    {
        $this->destinationFlight->removeElement($destinationFlight);
    }

    /**
     * Get destinationFlight
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDestinationFlight()
    {
        return $this->destinationFlight;
    }
}
