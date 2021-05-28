<?php

namespace App\Service\Interpreter;

use App\Entity\EntityInterface;
use App\Entity\Server;

abstract class AbstractRegexInterpreter implements RegexInterpreterInterface
{
    public function interpret(Server $server, string $line)
    {
        $matches = null;
        if (!preg_match($this->getRegex(), $matches)) {
            return;
        }

        $entity = $this->buildEntity($matches);

        if (method_exists($entity, "setServer")) {
            $entity->setServer($server);
        }
    }

    abstract protected function buildEntity(iterable $matches): EntityInterface;
}