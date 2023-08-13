<?php

namespace Vorgas\ProperNaming;

use PHPUnit\Framework\TestCase;
use Vorgas\ProperNaming\AbstractCasing;
use Vorgas\ProperNaming\BusinessCasing;

class BusinessCasingTest extends TestCase
{
    private ?AbstractCasing $casing;

    protected function setUp(): void
    {
        $this->casing = new BusinessCasing();
    }

    protected function tearDown(): void
    {
        $this->casing = NULL;
    }

    public function testNumbersInNames()
    {
        $input = [
            '7Eleven',
            '9Yards Media',
            'Plan4Demand'
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

    public function testUpperCase()
    {
        $this->assertEquals(
            'My Business, LLC',
            $this->casing->case('my business, llc')
        );
    }

    public function testForcedCompanyNames()
    {
         $input = [
            'BlackHawk Products',
            'BullGuard',
            "EBA's",
            'ElemenOPillows',
            'EnableIP',
            'FIDO Alliance',
            'Ideas2IT',
            'KEYper Systems',
            'PrimaCARE',
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
