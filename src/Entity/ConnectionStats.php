<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ConnectionStats
 *
 * @ORM\Table(name="connection_stats", indexes={@ORM\Index(name="connection_stats___player_fk", columns={"player_uid"}), @ORM\Index(name="connection_stats___ip_geo_fk", columns={"ip"})})
 * @ORM\Entity(repositoryClass="App\Repository\ConnectionStatsRepository")
 */
class ConnectionStats implements EntityInterface
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var int|null
     *
     * @ORM\Column(name="ping", type="integer", nullable=true)
     */
    private $ping;

    /**
     * @var int|null
     *
     * @ORM\Column(name="ping_avg", type="integer", nullable=true)
     */
    private $pingAvg;

    /**
     * @var int|null
     *
     * @ORM\Column(name="fluctuation", type="integer", nullable=true)
     */
    private $fluctuation;

    /**
     * @var int|null
     *
     * @ORM\Column(name="jitter", type="integer", nullable=true)
     */
    private $jitter;

    /**
     * @var IpGeo
     *
     * @ORM\ManyToOne(targetEntity="IpGeo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ip", referencedColumnName="ip")
     * })
     */
    private $ip;

    /**
     * @var Player
     *
     * @ORM\ManyToOne(targetEntity="Player")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="player_uid", referencedColumnName="uid")
     * })
     */
    private $playerUid;

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getPing(): ?int
    {
        return $this->ping;
    }

    public function setPing(?int $ping): self
    {
        $this->ping = $ping;

        return $this;
    }

    public function getPingAvg(): ?int
    {
        return $this->pingAvg;
    }

    public function setPingAvg(?int $pingAvg): self
    {
        $this->pingAvg = $pingAvg;

        return $this;
    }

    public function getFluctuation(): ?int
    {
        return $this->fluctuation;
    }

    public function setFluctuation(?int $fluctuation): self
    {
        $this->fluctuation = $fluctuation;

        return $this;
    }

    public function getJitter(): ?int
    {
        return $this->jitter;
    }

    public function setJitter(?int $jitter): self
    {
        $this->jitter = $jitter;

        return $this;
    }

    public function getIp(): ?IpGeo
    {
        return $this->ip;
    }

    public function setIp(?IpGeo $ip): self
    {
        $this->ip = $ip;

        return $this;
    }

    public function getPlayerUid(): ?Player
    {
        return $this->playerUid;
    }

    public function setPlayerUid(?Player $playerUid): self
    {
        $this->playerUid = $playerUid;

        return $this;
    }


}
