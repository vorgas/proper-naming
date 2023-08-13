<?php

namespace Vorgas\ProperNaming;

use PHPUnit\Framework\TestCase;
use Vorgas\ProperNaming\AbstractCasing;
use Vorgas\ProperNaming\CityCasing;

class CityCasingTest extends TestCase
{
    private ?AbstractCasing $casing;

    protected function setUp(): void
    {
        $this->casing = new CityCasing();
    }

    protected function tearDown(): void
    {
        $this->casing = NULL;
    }

    public function testKnownTownNames()
    {
        $input = [
            'Come by Chance',
            'Val-des-Sources',
            'Bird-in-Hand',
            'Town of 1770',
            'Truth or Consequences',
            'Road to Nowhere'
        ];

        foreach ($input as $value) {
            $this->assertEquals(
                $value,
                $this->casing->case(strtolower($value)),
            );
            $this->assertEquals(
                $value,
                $this->casing->case(strtoupper($value)),
            );
        }
    }
}
