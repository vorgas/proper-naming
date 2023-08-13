<?php

namespace Vorgas\ProperNaming;

use PHPUnit\Framework\TestCase;
use Vorgas\ProperNaming\AbstractCasing;
use Vorgas\ProperNaming\CustomCasing;

class CustomCasingTest extends TestCase
{
    private ?AbstractCasing $casing;

    protected function setUp(): void
    {
        $this->casing = new CustomCasing();
    }

    protected function tearDown(): void
    {
        $this->casing = NULL;
    }

    public function testCustomCasingWord()
    {
        $custom = [
            'CustomCasingWord',
            'Custom PHRASE'
        ];

        $this->casing->customs = $custom;
        foreach ($custom as $value) {
            $this->assertEquals(
                $value,
                $this->casing->case(strtolower($value))
            );
            $this->assertEquals(
                $value,
                $this->casing->case(strtoupper($value))
            );
        }
    }

    public function testCustomWordSplitting()
    {
        $this->casing->splitters[] = '_';
        $this->assertEquals(
            'Snake_Case',
            $this->casing->case('snake_CASE'),
            'Custom Snake_Case failed'
        );
    }

    public function testScrewySplitterOrder()
    {
        $c = new CustomCasing();
        $c->splitters = ['de', ' '];
        $this->assertEquals(
            'Juan DeMarco',
            $c->case('juan demarco')
        );

        $c->splitters = [' ', 'de'];
        $this->assertNotEquals(
            'Juan DeMarco',
            $c->case('juan demarco')
        );
    }
}
