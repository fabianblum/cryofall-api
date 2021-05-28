<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * IpGeo
 *
 * @ORM\Table(name="ip_geo")
 * @ORM\Entity(repositoryClass="App\Repository\IpGeoRepository")
 */
class IpGeo implements EntityInterface
{
    /**
     * @var string
     *
     * @ORM\Column(name="ip", type="string", length=255, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $ip;

    /**
     * @var string|null
     *
     * @ORM\Column(name="city", type="string", length=255, nullable=true)
     */
    private $city;

    /**
     * @var string|null
     *
     * @ORM\Column(name="country_code", type="string", length=3, nullable=true)
     */
    private $countryCode;

    /**
     * @var string|null
     *
     * @ORM\Column(name="continent_code", type="string", length=16, nullable=true)
     */
    private $continentCode;

    public function getIp(): ?string
    {
        return $this->ip;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(?string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getCountryCode(): ?string
    {
        return $this->countryCode;
    }

    public function setCountryCode(?string $countryCode): self
    {
        $this->countryCode = $countryCode;

        return $this;
    }

    public function getContinentCode(): ?string
    {
        return $this->continentCode;
    }

    public function setContinentCode(?string $continentCode): self
    {
        $this->continentCode = $continentCode;

        return $this;
    }


}
