<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PingRepository")
 */
class Ping
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
     * @ORM\Column(type="datetime")
     */
    private $detectTime;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $room;

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

    public function getDetectTime(): ?\DateTimeInterface
    {
        return $this->detectTime;
    }

    public function setDetectTime(\DateTimeInterface $detectTime): self
    {
        $this->detectTime = $detectTime;

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
}
