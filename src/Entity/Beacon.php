<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BeaconRepository")
 */
class Beacon
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $deviceAddress;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $connectionTime;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $disconnectionTime;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $room;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $equipment;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDeviceAddress(): ?string
    {
        return $this->deviceAddress;
    }

    public function setDeviceAddress(string $deviceAddress): self
    {
        $this->deviceAddress = $deviceAddress;

        return $this;
    }

    public function getConnectionTime(): ?\DateTimeInterface
    {
        return $this->connectionTime;
    }

    public function setConnectionTime(?\DateTimeInterface $connectionTime): self
    {
        $this->connectionTime = $connectionTime;

        return $this;
    }

    public function getDisconnectionTime(): ?\DateTimeInterface
    {
        return $this->disconnectionTime;
    }

    public function setDisconnectionTime(?\DateTimeInterface $disconnectionTime): self
    {
        $this->disconnectionTime = $disconnectionTime;

        return $this;
    }

    public function getRoom(): ?string
    {
        return $this->room;
    }

    public function setRoom(string $room): self
    {
        $this->room = $room;

        return $this;
    }

    public function getEquipment(): ?string
    {
        return $this->equipment;
    }

    public function setEquipment(string $equipment): self
    {
        $this->equipment = $equipment;

        return $this;
    }
}
