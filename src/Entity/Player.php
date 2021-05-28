<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Player
 *
 * @ORM\Table(name="player", uniqueConstraints={@ORM\UniqueConstraint(name="player_uid_uindex", columns={"uid"})})
 * @ORM\Entity
 */
class Player
{
    /**
     * @var int
     *
     * @ORM\Column(name="uid", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $uid;

    /**
     * @var string|null
     *
     * @ORM\Column(name="name", type="string", length=125, nullable=true)
     */
    private $name;

    public function getUid(): ?string
    {
        return $this->uid;
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


}
