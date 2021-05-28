<?php
declare(strict_types=1);

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * Server
 *
 * @ORM\Table(name="server", uniqueConstraints={@ORM\UniqueConstraint(name="server_guid_uindex", columns={"guid"})})
 * @ORM\Entity(repositoryClass="App\Repository\ServerRepository")
 */
class Server implements EntityInterface
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
     * @var string
     *
     * @ORM\Column(name="guid", type="string", length=200, nullable=false)
     */
    private $guid;

    /**
     * @var string|null
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @var int|null
     *
     * @ORM\Column(name="player_online", type="integer", nullable=true)
     */
    private $playerOnline;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="registered_since", type="datetime", nullable=false, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $registeredSince;

    public function __construct()
    {
        $this->registeredSince = new DateTime();
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getGuid(): ?string
    {
        return $this->guid;
    }

    public function setGuid(string $guid): self
    {
        $this->guid = $guid;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPlayerOnline(): ?int
    {
        return $this->playerOnline;
    }

    public function setPlayerOnline(?int $playerOnline): self
    {
        $this->playerOnline = $playerOnline;

        return $this;
    }

    public function getRegisteredSince(): ?\DateTimeInterface
    {
        return $this->registeredSince;
    }

    public function setRegisteredSince(\DateTimeInterface $registeredSince): self
    {
        $this->registeredSince = $registeredSince;

        return $this;
    }


}
