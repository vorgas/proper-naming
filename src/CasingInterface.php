<?php

namespace Vorgas\ProperNaming;

interface CasingInterface
{
    public function case(string $string, bool $ucfirst): string;
}
