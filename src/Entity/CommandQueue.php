<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CommandQueue
 *
 * @ORM\Table(name="command_queue", uniqueConstraints={@ORM\UniqueConstraint(name="command_queue_id_uindex", columns={"id"})})
 * @ORM\Entity(repositoryClass="App\Repository\CommandQueueRepository")
 */
class CommandQueue implements EntityInterface
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
     * @var int
     *
     * @ORM\Column(name="server_id", type="bigint", nullable=false)
     */
    private $serverId;

    /**
     * @var string
     *
     * @ORM\Column(name="command", type="string", length=255, nullable=false)
     */
    private $command;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="datetime", nullable=false, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $created = 'CURRENT_TIMESTAMP';

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="executed", type="datetime", nullable=true)
     */
    private $executed;

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getServerId(): ?string
    {
        return $this->serverId;
    }

    public function setServerId(string $serverId): self
    {
        $this->serverId = $serverId;

        return $this;
    }

    public function getCommand(): ?string
    {
        return $this->command;
    }

    public function setCommand(string $command): self
    {
        $this->command = $command;

        return $this;
    }

    public function getCreated(): ?\DateTimeInterface
    {
        return $this->created;
    }

    public function setCreated(\DateTimeInterface $created): self
    {
        $this->created = $created;

        return $this;
    }

    public function getExecuted(): ?\DateTimeInterface
    {
        return $this->executed;
    }

    public function setExecuted(?\DateTimeInterface $executed): self
    {
        $this->executed = $executed;

        return $this;
    }


}
