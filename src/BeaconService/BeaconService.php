<?php

namespace App\BeaconService;

use App\Entity\BeaconData;
use Doctrine\ORM\EntityManagerInterface;

class BeaconService
{
    protected $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function storeBeaconHit($data)
    {
        $isStored = false;
        $beaconHit = $this->checkBeaconHitExists($data['beacon-hit-id']);

        //TODO Serializer for the json data
        //$data = \GuzzleHttp\json_decode($data);

        if (!$beaconHit) {
            $beaconHit = new BeaconData();
        }

        $beaconHit->setBeaconId($data['beacon_id']);
        $beaconHit->setConnected($data['connected']);
        $beaconHit->setDisconnected($data['disconnected']);
        $beaconHit->setDeviceId($data['device_id']);
        $beaconHit->setBeaconRoom($data['beacon_room']);

        $this->entityManager->persist($beaconHit);
        $this->entityManager->flush();

        if ($beaconHit->getId()) {
            $isStored = true;
        }

        return $isStored;
    }

    public function checkBeaconHitExists($beaconHitId)
    {
        $isAlreadyStored = false;

        $beaconHit = $this->entityManager
            ->getRepository(BeaconData::class)
            ->find($beaconHitId);

        return $beaconHit;
    }

    public function beaconDataNormilizer()
    {

    }
}