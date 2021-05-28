<?php
declare(strict_types=1);

namespace App\Service;

use App\Entity\IpGeo;
use App\Repository\IpGeoRepository;
use Doctrine\ORM\EntityManagerInterface;

class IpGeoService
{
    private EntityManagerInterface $objectManager;
    private IpGeoRepository $ipGeoRepository;


    public function __construct(IpGeoRepository $ipGeoRepository, EntityManagerInterface $objectManager)
    {
        $this->objectManager = $objectManager;
        $this->ipGeoRepository = $ipGeoRepository;
    }

    public function getByIp(string $ip): IpGeo
    {
        return $this->ipGeoRepository->findOneBy(['ip' => $ip]);
    }

    public function create(string $ip, string $city, string $continentCode, string $countryCode): IpGeo
    {
        $ipGeo = new IpGeo();
        $ipGeo->setIp($ip);
        $ipGeo->setCity($city);
        $ipGeo->setContinentCode($continentCode);
        $ipGeo->setCountryCode($countryCode);

        $this->objectManager->persist($ipGeo);
        $this->objectManager->flush();

        return $ipGeo;
    }
}