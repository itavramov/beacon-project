<?php

namespace App\BeaconService;

use App\Entity\Beacon;
use App\Entity\BeaconData;
use App\Entity\Ping;
use Doctrine\ORM\EntityManagerInterface;
use Faker\Provider\DateTime;
use function Sodium\add;

class BeaconService
{
    protected $entityManager;

    public function __construct(
        EntityManagerInterface $entityManager
    ) {
        $this->entityManager = $entityManager;
    }

    public function storeDetectSignal($data)
    {
        $isStored = false;
        $ping = new Ping();

        $date = new \DateTime();
        $date->setTimezone(new \DateTimeZone('Europe/Amsterdam'));

        $ping
            ->setDeviceAddress($data['deviceAddress']);
        $ping
            ->setRoom($data['tabletID']);
        $ping
            ->setDetectTime($date);
        $ping
            ->setEquipment(
                $this->entityManager
                    ->getRepository(Beacon::class)
                    ->findBeaconEquipment($ping->getDeviceAddress())
                    ->getEquipment()
            );

        $this->entityManager->persist($ping);
        $this->entityManager->flush();

        if ($ping->getId()) {
            $isStored = true;
        }

        return $isStored;
    }

    public function updateBeaconConnectionTime($data)
    {
        $isUpdated = false;
        $date = new \DateTime();
        $date->setTimezone(new \DateTimeZone('Europe/Amsterdam'));

        $beacon = $this->entityManager
            ->getRepository(Beacon::class)
            ->findOneBy(
                [
                    'deviceAddress' => $data['deviceAddress']
                ]
            );

        if ($beacon) {
            $beacon->setConnectionTime(
                $date
            );

            $beacon->setDisconnectionTime(null);

            $beacon->
                setRoom(
                    $data['tabletID']
            );

            $isUpdated = true;
        }

        $this->entityManager->persist($beacon);
        $this->entityManager->flush();

        return $isUpdated;
    }

    public function updateBeaconDisconnectionTime($data)
    {
        $isUpdated = false;
        $date = new \DateTime();
        $date->setTimezone(new \DateTimeZone('Europe/Amsterdam'));

        $beacon = $this->entityManager
            ->getRepository(Beacon::class)
            ->findOneBy(
                [
                    'deviceAddress' => $data['deviceAddress']
                ]
            );

        if ($beacon) {
            $beacon->setDisconnectionTime(
                $date
            );

            $beacon->
            setRoom(
                $data['tabletID']
            );

            $isUpdated = true;
        }

        $this->entityManager->persist($beacon);
        $this->entityManager->flush();

        return $isUpdated;
    }

    public function getBeaconData($deviceAddress)
    {
        $data = [
            'status' => 'error'
        ];
        $beacon = $this->entityManager
            ->getRepository(Beacon::class)
            ->findOneBy(
                [
                    'deviceAddress' => $deviceAddress
                ]
            );

        if ($beacon) {
            $disconnectTime = $beacon->getDisconnectionTime();
            if (!$disconnectTime) {
                $disconnectTime = '-';
            }

            $data = [
                'equipment' => $beacon->getEquipment(),
                'connectTime' => $beacon->getConnectionTime(),
                'disconnectTime' => $disconnectTime,
                'room' => $beacon->getRoom(),
                'status' => 'ok'
            ];
        }

        return $data;
    }

    public function getLastDetect($deviceAddress)
    {
        $data = [
            'status' => 'error'
        ];
        $lastPing = $this->entityManager
            ->getRepository(Ping::class)
            ->findLastDetectByBeaconAddress($deviceAddress);

        if ($lastPing) {

            $data = [
                'equipment' => $lastPing[0]->getEquipment(),
                'detectTime' => $lastPing[0]->getDetectTime(),
                'room' => $lastPing[0]->getRoom(),
                'status' => 'ok'
            ];
        }

        return $data;
    }
}