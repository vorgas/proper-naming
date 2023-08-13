<?php

namespace Vorgas\ProperNaming;

use PHPUnit\Framework\TestCase;
use Vorgas\ProperNaming\AbstractCasing;
use Vorgas\ProperNaming\ProperName;

class ProperNameTest extends TestCase
{
    private ?AbstractCasing $casing;

    protected function setUp(): void
    {
        $this->casing = new ProperName();
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
                $this->casing->case($value),
                "Failed to convert $value to $valid"
            );
        }
    }

    public function testForceCasing()
    {
        $input = [
            'Mike Hill III',
            'Rip van Winkle'
        ];

        foreach ($input as $valid) {
            $this->assertEquals(
                $valid,
                $this->casing->case(strtoupper($valid)),
            );

            $this->assertEquals(
                $valid,
                $this->casing->case(strtolower($valid)),
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
                $this->casing->case($value),
                "Failed to convert $value to $valid"
            );
        }
    }

    public function testForcedLowerAsFirstName()
    {
        $this->assertEquals(
            'Van Wildest',
            $this->casing->case('VAN WILDEST'),
            'With $forced not being specified, it should be Van'
        );

        $this->assertEquals(
            'van Wildest',
            $this->casing->case('VAN WILDEST', false),
            'With $forced being false, it shoud be van'
        );
    }

    public function testInvokableCall()
    {
        $c = new ProperName();
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
