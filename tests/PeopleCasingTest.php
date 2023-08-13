<?php

namespace Vorgas\tests;

use PHPUnit\Framework\TestCase;
use Vorgas\ProperNaming\AbstractCasing;
use Vorgas\ProperNaming\PeopleCasing;

class PeopleCasingTest extends TestCase
{
    private ?AbstractCasing $casing;

    protected function setUp(): void
    {
        $this->casing = new PeopleCasing();
    }

    protected function tearDown(): void
    {
        $this->casing = NULL;
    }


    public function testApostropheNames()
    {
        $valid = "Mike D'Hill";
        $input = [
            'lower' => "mike d'hill",
            'upper' => "MIKE D'HILL",
            'mixed' => "mIke D'hIll"
        ];

        foreach ($input as $type => $value) {
            $this->assertEquals(
                $valid,
                $this->casing->case($value),
                "Failed to convert $value to $valid"
            );
        }
    }

    public function testMcNames()
    {
        $valid = 'Mike McHill';
        $input = [
            'lower' => 'mike mchill',
            'upper' => 'MIKE MCHILL',
            'mixed' => 'mIke McHill'
        ];

        foreach ($input as $type => $value) {
            $this->assertEquals(
                $valid,
                $this->casing->case($value),
                "Failed to convert $value to $valid"
            );
        }
    }



    public function testForcedLowerFirstNameButProperCasing()
    {
        $this->assertEquals(
            'van Wildest',
            $this->casing->case('van Wildest')
        );
    }

    public function testSaints()
    {
        $valid = 'Mike St. Hill';
        $input = [
            'lower' => 'mike st. hill',
            'upper' => 'MIKE ST. HILL',
            'mixed' => 'Mike St. HiLL'
        ];

        foreach ($input as $type => $value) {
            $this->assertEquals(
                $valid,
                $this->casing->case($value),
                "Failed to convert $value to $valid"
            );
        }
    }

    public function testMixedCapSingleName()
    {
        $this->assertEquals(
            'McDonald',
            $this->casing->case('MCDONALD')
        );

        $this->casing->forces[] = 'wHinY';
        $this->assertEquals(
            'wHinY Case',
            $this->casing->case('whiny case', false)
        );
    }

    public function testProperlyFormattedInputIsKept()
    {
        $input = [
            "Mike MacHill",
            "Mike Machill",
            "Mike D'Arcy",
            "Mike d'Arcy"
        ];

        foreach ($input as $name) {
            $this->assertEquals(
                $name,
                $this->casing->case($name),
                "$name was not retained"
            );
        }
    }

    public function testSplittersInForces()
    {
        $valid = 'Del Brown';
        $input = [
            'lower' => 'del brown',
            'upper' => 'DEL BROWN',
            'mixed1' => 'DeL Brown',
            'mixed2' => 'DeL BROWN'
        ];

        foreach ($input as $type => $value) {
            $this->assertEquals(
                $valid,
                $this->casing->case($value),
                "Failed to convert $value to $valid"
            );
        }

        $this->casing->splitters[] = 'de';
        $this->assertEquals(
            'DeL Brown',
            $this->casing->case('del BROWN')
        );
    }
}
