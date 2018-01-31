<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CarRepository")
 */
class Car extends Automobile
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
    protected $wheels;

    /**
     * Car constructor.
     * @param $id
     * @param $wheels
     */
    public function __construct($id, $wheels)
    {
        $this->id = $id;
        $this->wheels = $wheels;
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


}
