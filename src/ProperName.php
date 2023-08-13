<?php

namespace Vorgas\ProperNaming;

/**
 * General usage for casing Proper Names
 *
 * Handles most general cases for capitalizing proper names. Essentially
 * Capitalizes the first letter of each word, with a few common exceptions
 * found in some names.
 *
 * Words are split by space ( ), by dash(-), and by period (.)
 */
class ProperName extends AbstractCasing
{
   /**
     * @inheritDoc
     */
    protected function initAssumptions(): array
    {
        return [];
    }

    /**
     * @inheritDoc
     */
    protected function initCustoms(): array
    {
        return [];
    }

    /**
     * @inheritDoc
     */
    protected function initForces(): array
    {
        $eng = ['a', 'an', 'and', 'of', 'on', 'or', 'the'];
        $other = ['van', 'den', 'von', 'und', 'der', 'de', 'da', 'del'];
        $roman = ['I', 'II', 'III', 'IV', 'VI', 'VII', 'VIII', 'IX', 'X'];
        return array_merge($eng, $other, $roman);
    }

    /**
     * @inheritDoc
     */
    protected function initSplitters(): array
    {
        return [' ', '-', '.'];
    }
}
