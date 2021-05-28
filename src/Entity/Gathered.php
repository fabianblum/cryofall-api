<?php

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * Gathered
 *
 * @ORM\Table(name="gathered", indexes={@ORM\Index(name="gathered___player_fk", columns={"player_id"}), @ORM\Index(name="gathered___server_fk", columns={"server_id"})})
 * @ORM\Entity(repositoryClass="App\Repository\GatheredRepository")
 */
class Gathered implements EntityInterface
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
     * @ORM\Column(name="object_type", type="bigint", nullable=true)
     */
    private $objectType;

    /**
     * @var int
     *
     * @ORM\Column(name="amount", type="integer", nullable=false)
     */
    private $amount;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="datetime", type="datetime", nullable=false)
     */
    private $datetime;

    /**
     * @var Player
     *
     * @ORM\ManyToOne(targetEntity="Player")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="player_id", referencedColumnName="uid")
     * })
     */
    private $player;

    /**
     * @var Server
     *
     * @ORM\ManyToOne(targetEntity="Server")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="server_id", referencedColumnName="id")
     * })
     */
    private $server;

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getObjectType(): ?string
    {
        return $this->objectType;
    }

    public function setObjectType(?string $objectType): self
    {
        $this->objectType = $objectType;

        return $this;
    }

    public function getAmount(): ?int
    {
        return $this->amount;
    }

    public function setAmount(int $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function getDatetime(): ?\DateTimeInterface
    {
        return $this->datetime;
    }

    public function setDatetime(\DateTimeInterface $datetime): self
    {
        $this->datetime = $datetime;

        return $this;
    }

    public function getPlayer(): ?Player
    {
        return $this->player;
    }

    public function setPlayer(?Player $player): self
    {
        $this->player = $player;

        return $this;
    }

    public function getServer(): Server
    {
        return $this->server;
    }

    public function setServer(Server $server): self
    {
        $this->server = $server;

        return $this;
    }


}
