<?php


namespace App\Controller;


use App\Entity\Beacon;
use App\Entity\Ping;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    protected $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/", name="index")
     */
    public function index() {

//        dump($this->entityManager->getRepository(Ping::class)->findLastDetectSignal());
//        die;

        return $this->render(
            'base.html.twig',
            [
                'lastPing' => $this->entityManager->getRepository(Ping::class)->findLastDetectSignal()[0],
                'pings' => $this->entityManager->getRepository(Ping::class)->findAll(),
                'beacons' => $this->entityManager->getRepository(Beacon::class)->findAll()
            ]
        );
    }
}