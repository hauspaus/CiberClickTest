<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AutomobileRepository")
 */
class Automobile
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
    protected $gasoline;


    public function turnOn()
    {
        return "the engine is running";
    }

    public function consumeGasoline()
    {
        $this->gasoline = $this->gasoline - 10;
    }
}
