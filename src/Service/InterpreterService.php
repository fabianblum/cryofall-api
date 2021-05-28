<?php

namespace App\Service;

use App\Entity\Server;
use App\Service\Interpreter\AbstractRegexInterpreter;
use App\Service\Interpreter\RegexInterpreterInterface;

class InterpreterService
{
    /**
     * @return RegexInterpreterInterface[]
     */
    private function getInterpreters(): iterable
    {
        foreach (get_declared_classes() as $className) {
            if (in_array(AbstractRegexInterpreter::class, class_parents($className))) {
                yield new $className;
            }
        }
    }

    public function interpretLine(Server $server, string $line)
    {
        foreach ($this->getInterpreters() as $interpreter) {
            $interpreter->interpret($server, $line);
        }
    }
}