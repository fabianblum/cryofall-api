<?php

namespace App\Model\Response;

use ReflectionClass;
use ReflectionProperty;

abstract class AbstractResponse
{
    public function asArray(): array
    {
        $reflect = new ReflectionClass($this);
        $props = $reflect->getProperties(ReflectionProperty::IS_PRIVATE);

        $ret = [];
        foreach ($props as $prop) {
            $ret[$prop->getName()] = $prop->getValue();
        }

        return $ret;
    }
}