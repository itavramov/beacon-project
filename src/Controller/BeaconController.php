<?php


namespace App\Controller;


use App\BeaconService\BeaconService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class BeaconController extends AbstractController
{
    protected $beaconService;

    public function __construct(BeaconService $beaconService)
    {
        $this->beaconService = $beaconService;
    }

    /**
     * @Route("/beacon-hit", name="beacon-hit")
     */
    public function beaconConnect(
        Request $request,
        EntityManagerInterface $entityManager
    ){
        $data = [
            'device_id' => '3',
            'connected' => new \DateTime(),
            'disconnected' => new \DateTime(),
            'beacon_id' => '6',
            'beacon_room' => '1012'
        ];

        //$this->beaconService->storeBeaconHit($data);

        die;
    }
}