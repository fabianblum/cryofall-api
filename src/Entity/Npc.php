<?php
declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Npc
 *
 * @ORM\Table(name="npc")
 * @ORM\Entity(repositoryClass="App\Repository\NpcRepository")
 */
class Npc implements EntityInterface
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
     * @ORM\Column(name="ingame_id", type="bigint", nullable=true)
     */
    private $inGameId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="code", type="string", length=255, nullable=true)
     */
    private $code;

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getInGameId(): ?string
    {
        return $this->inGameId;
    }

    public function setInGameId(?string $inGameId): self
    {
        $this->inGameId = $inGameId;

        return $this;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(?string $code): self
    {
        $this->code = $code;

        return $this;
    }


}
