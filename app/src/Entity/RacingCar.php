<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RacingCarRepository")
 */
class RacingCar extends Car
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected $id;


    /**
     * @ORM\Column(type="string")
     */
    protected $sponsors;

    /**
     * RacingCar constructor.
     * @param $id
     * @param $sponsors
     */
    public function __construct($id, $sponsors)
    {
        $this->id = $id;
        $this->sponsors = $sponsors;
    }

    /**
     * @return mixed
     */
    public function getGasoline()
    {
        return $this->gasoline;
    }

    /**
     * @param mixed $gasoline
     */
    public function setGasoline($gasoline)
    {
        $this->gasoline = $gasoline;
    }

    /**
     * @return mixed
     */
    public function getWheels()
    {
        return $this->wheels;
    }

    /**
     * @param mixed $wheels
     */
    public function setWheels($wheels)
    {
        $this->wheels = $wheels;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getSponsors()
    {
        return $this->sponsors;
    }

    /**
     * @param mixed $sponsors
     */
    public function setSponsors($sponsors)
    {
        $this->sponsors = $sponsors;
    }

}
