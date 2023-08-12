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

    public function testSimpleNameCasing()
    {
        $valid = 'Mike Hill';
        $input = [
            'lower' => 'mike hill',
            'upper' => 'MIKE HILL',
            'mixed' => 'mIke Hill'
        ];

        foreach ($input as $type => $value) {
            $this->assertEquals(
                $valid,
                $this->casing->format($value),
                "Failed to convert $value to $valid"
            );
        }
    }

    public function testLowerExceptions()
    {
        $valid = 'Mike van Hill';
        $input = [
            'lower' => 'mike van hill',
            'upper' => 'MIKE VAN HILL',
            'mixed' => 'mIke Van Hill'
        ];

        foreach ($input as $type => $value) {
            $this->assertEquals(
                $valid,
                $this->casing->format($value),
                "Failed to convert $value to $valid"
            );
        }
    }

    public function testAlwaysUpper()
    {
        $valid = 'Mike Hill III';
        $input = [
            'lower' => 'mike hill iii',
            'upper' => 'MIKE HILL III',
            'mixed' => 'mIke Hill iIi'
        ];

        foreach ($input as $type => $value) {
            $this->assertEquals(
                $valid,
                $this->casing->format($value),
                "Failed to convert $value to $valid"
            );
        }
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
                $this->casing->format($value),
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
                $this->casing->format($value),
                "Failed to convert $value to $valid"
            );
        }
    }

    public function testSingleName()
    {
        $valid = 'Mike';
        $input = [
            'lower' => 'mike',
            'upper' => 'MIKE',
            'mixed' => 'mIke'
        ];

        foreach ($input as $type => $value) {
            $this->assertEquals(
                $valid,
                $this->casing->format($value),
                "Failed to convert $value to $valid"
            );
        }
    }

    public function testForcedLowerAsFirstName()
    {
        $this->assertEquals(
            'Van Wildest',
            $this->casing->format('VAN WILDEST'),
            'With $forced not being specified, it should be Van'
        );

        $this->assertEquals(
            'van Wildest',
            $this->casing->format('VAN WILDEST', false),
            'With $forced being false, it shoud be van'
        );
    }

    public function testForcedLowerFirstNameButProperCasing()
    {
        $this->assertEquals(
            'van Wildest',
            $this->casing->format('van Wildest')
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
                $this->casing->format($value),
                "Failed to convert $value to $valid"
            );
        }
    }

    public function testMixedCapSingleName()
    {
        $this->assertEquals(
            'McDonald',
            $this->casing->format('MCDONALD')
        );

        $this->casing->forces[] = 'wHinY';
        $this->assertEquals(
            'wHinY Case',
            $this->casing->format('whiny case', false)
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
                $this->casing->format($name),
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
                $this->casing->format($value),
                "Failed to convert $value to $valid"
            );
        }

        $this->casing->splitters[] = 'de';
        $this->assertEquals(
            'DeL Brown',
            $this->casing->format('del BROWN')
        );
    }

    public function testCustomCasingWord()
    {
        $this->assertEquals(
            'CustomCasingWord',
            $this->casing->format('customcasingword')
        );
    }

    public function testCustomWordSplitting()
    {
        $this->casing->splitters[] = '_';
        $this->assertEquals(
            'Snake_Case',
            $this->casing->format('snake_CASE'),
            'Custom Snake_Case failed'
        );
    }

    public function testInvokableCall()
    {
        $c = new PeopleCasing();
        $this->assertIsCallable($c);
        $this->assertEquals(
            'Mike Hill',
            $c('MIKE HILL')
        );
        $this->assertEquals(
            'van Hook',
            $c('VAN HOOK', false)
        );
    }
}
