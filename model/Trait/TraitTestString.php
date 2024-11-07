<?php

namespace model\Trait;

trait TraitTestString
{
    protected function verifyString (?string $testThis) : bool {
        if (empty($testThis)) return false;
        return true;
    }
}