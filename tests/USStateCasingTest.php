<?php

namespace Vorgas\ProperNaming;

use PHPUnit\Framework\TestCase;
use Vorgas\ProperNaming\AbstractCasing;
use Vorgas\ProperNaming\USStateCasing;

class USStateCasingTest extends TestCase
{
    private ?AbstractCasing $casing;

    protected function setUp(): void
    {
        $this->casing = new USStateCasing();
    }

    protected function tearDown(): void
    {
        $this->casing = NULL;
    }

    public function testKnownNames()
    {
        $input = [
            'District of Columbia',
            'Washington DC',
            'NM'
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
