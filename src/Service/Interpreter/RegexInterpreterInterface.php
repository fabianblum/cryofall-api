<?php
namespace App\Service\Interpreter;

use App\Entity\Server;

interface RegexInterpreterInterface {
    public function getRegex(): string;

    public function interpret(Server $server, string $line);
}