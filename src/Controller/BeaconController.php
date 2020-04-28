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
    protected $entityManager;

    public function __construct(
        BeaconService $beaconService,
        EntityManagerInterface $entityManager
    ) {
        $this->beaconService = $beaconService;
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/detect", name="detect")
     */
    public function beaconDetect(
        Request $request
    ){

        $data = json_decode($request->getContent());
//        $data = [
//          'deviceAddress' => "FA:42:CD:E1:FF:B0",
//            'tableId' => 'Room 15'
//        ];
        $responseData = [ 'isStored' => false ];

        if ($this->beaconService->storeDetectSignal($data)) {
            $responseData = [ 'isStored' => true ];
        }

        return $this->json($responseData, $status = 200, $headers = [], $context = []);
    }

    /**
 * @Route("/connect", name="connect")
 */
    public function beaconConnect(
        Request $request
    ){

        $data = json_decode($request->getContent());
//        $data = [
//            'deviceAddress' => "FA:42:CD:E1:FF:B0",
//            'tableId' => 'Room 155'
//        ];
        $responseData = [ 'isStored' => false ];

        if ($this->beaconService->updateBeaconConnectionTime($data)) {
            $responseData = [ 'isStored' => true ];
        }

        return $this->json($responseData, $status = 200, $headers = [], $context = []);
    }

    /**
     * @Route("/disconnect", name="disconnect")
     */
    public function beaconDisconnect(
        Request $request
    ){

        $data = json_decode($request->getContent());
//        $data = [
//            'deviceAddress' => "FA:42:CD:E1:FF:B0",
//            'tableId' => 'Room 15'
//        ];
        dump($data);die;
        $responseData = [ 'isStored' => false ];

        if ($this->beaconService->updateBeaconDisconnectionTime($data)) {
            $responseData = [ 'isStored' => true ];
        }

        return $this->json($responseData, $status = 200, $headers = [], $context = []);
    }

    /**
     * @Route("/beacon", name="beacon")
     */
    public function beaconInfo(
        Request $request
    ){
        $data = $this->beaconService->getBeaconData($request->get('beaconAddress'));

        return $this->json(json_encode($data), $status = 200, $headers = [], $context = []);
    }
}