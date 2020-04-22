<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BeaconDataRepository")
 */
class BeaconData
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
    private $deviceId;

    /**
     * @ORM\Column(type="datetime")
     */
    private $connected;

    /**
     * @ORM\Column(type="datetime")
     */
    private $disconnected;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $beaconId;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $beaconRoom;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDeviceId(): ?string
    {
        return $this->deviceId;
    }

    public function setDeviceId(string $deviceId): self
    {
        $this->deviceId = $deviceId;

        return $this;
    }

    public function getConnected(): ?\DateTimeInterface
    {
        return $this->connected;
    }

    public function setConnected(\DateTimeInterface $connected): self
    {
        $this->connected = $connected;

        return $this;
    }

    public function getDisconnected(): ?\DateTimeInterface
    {
        return $this->disconnected;
    }

    public function setDisconnected(\DateTimeInterface $disconnected): self
    {
        $this->disconnected = $disconnected;

        return $this;
    }

    public function getBeaconId(): ?string
    {
        return $this->beaconId;
    }

    public function setBeaconId(string $beaconId): self
    {
        $this->beaconId = $beaconId;

        return $this;
    }

    public function getBeaconRoom(): ?string
    {
        return $this->beaconRoom;
    }

    public function setBeaconRoom(string $beaconRoom): self
    {
        $this->beaconRoom = $beaconRoom;

        return $this;
    }
}
