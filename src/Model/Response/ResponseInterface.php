<?php
namespace App\Model\Response;

interface ResponseInterface {
    public function asArray(): array;
}