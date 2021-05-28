<?php

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * Kills
 *
 * @ORM\Table(name="kills", indexes={@ORM\Index(name="kills___killed_player_fk", columns={"killed_player_uid"}), @ORM\Index(name="kills___server_fk", columns={"server_id"}), @ORM\Index(name="kills___killed_npc_fk", columns={"killed_npc_id"}), @ORM\Index(name="kills___killer_player_fk", columns={"killer_player_uid"}), @ORM\Index(name="kills___killer_npc_fk", columns={"killer_npc_id"})})
 * @ORM\Entity
 */
class Kills
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
     * @var DateTime
     *
     * @ORM\Column(name="datetime", type="datetime", nullable=false, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $datetime = 'CURRENT_TIMESTAMP';

    /**
     * @var null|Npc
     *
     * @ORM\ManyToOne(targetEntity="Npc")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="killed_npc_id", referencedColumnName="id")
     * })
     */
    private $killedNpc;

    /**
     * @var null|Player
     *
     * @ORM\ManyToOne(targetEntity="Player")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="killed_player_uid", referencedColumnName="uid")
     * })
     */
    private $killedPlayerUid;

    /**
     * @var null|Npc
     *
     * @ORM\ManyToOne(targetEntity="Npc")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="killer_npc_id", referencedColumnName="id")
     * })
     */
    private $killerNpc;

    /**
     * @var null|Player
     *
     * @ORM\ManyToOne(targetEntity="Player")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="killer_player_uid", referencedColumnName="uid")
     * })
     */
    private $killerPlayerUid;

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

    public function getDatetime(): ?\DateTimeInterface
    {
        return $this->datetime;
    }

    public function setDatetime(\DateTimeInterface $datetime): self
    {
        $this->datetime = $datetime;

        return $this;
    }

    public function getKilledNpc(): ?Npc
    {
        return $this->killedNpc;
    }

    public function setKilledNpc(?Npc $killedNpc): self
    {
        $this->killedNpc = $killedNpc;

        return $this;
    }

    public function getKilledPlayerUid(): ?Player
    {
        return $this->killedPlayerUid;
    }

    public function setKilledPlayerUid(?Player $killedPlayerUid): self
    {
        $this->killedPlayerUid = $killedPlayerUid;

        return $this;
    }

    public function getKillerNpc(): ?Npc
    {
        return $this->killerNpc;
    }

    public function setKillerNpc(?Npc $killerNpc): self
    {
        $this->killerNpc = $killerNpc;

        return $this;
    }

    public function getKillerPlayerUid(): ?Player
    {
        return $this->killerPlayerUid;
    }

    public function setKillerPlayerUid(?Player $killerPlayerUid): self
    {
        $this->killerPlayerUid = $killerPlayerUid;

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
