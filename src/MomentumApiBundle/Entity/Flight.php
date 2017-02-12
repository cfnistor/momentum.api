<?php

namespace MomentumApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Flight
 *
 * @ORM\Table(name="flight")
 * @ORM\Entity(repositoryClass="MomentumApiBundle\Repository\FlightRepository")
 */
class Flight
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
     * @var int
     *
     * @ORM\ManyToOne(targetEntity="Airport", inversedBy="departureFlight")
     * @ORM\JoinColumn(name="departure_airport_id", referencedColumnName="id")
     */
    private $departureAirport;

    /**
     * @var int
     *
     * @ORM\ManyToOne(targetEntity="Airport", inversedBy="destinationFlight")
     * @ORM\JoinColumn(name="destination_airport_id", referencedColumnName="id")
     */
    private $destinationAirport;

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
     * Set departureAirport
     *
     * @param \MomentumApiBundle\Entity\Airport $departureAirport
     *
     * @return Flight
     */
    public function setDepartureAirport(\MomentumApiBundle\Entity\Airport $departureAirport = null)
    {
        $this->departureAirport = $departureAirport;

        return $this;
    }

    /**
     * Get departureAirport
     *
     * @return \MomentumApiBundle\Entity\Airport
     */
    public function getDepartureAirport()
    {
        return $this->departureAirport;
    }

    /**
     * Set destinationAirport
     *
     * @param \MomentumApiBundle\Entity\Airport $destinationAirport
     *
     * @return Flight
     */
    public function setDestinationAirport(\MomentumApiBundle\Entity\Airport $destinationAirport = null)
    {
        $this->destinationAirport = $destinationAirport;

        return $this;
    }

    /**
     * Get destinationAirport
     *
     * @return \MomentumApiBundle\Entity\Airport
     */
    public function getDestinationAirport()
    {
        return $this->destinationAirport;
    }
}
