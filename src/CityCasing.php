<?php

namespace Vorgas\ProperNaming;

/**
 * Proper Name casing with some known exceptions for certain cities and towns
 */
class CityCasing extends AbstractCasing
{
    /**
     * @inheritDoc
     */
    protected function initAssumptions(): array
    {
        return ['Mac', 'Mc'];
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
        /**
         * Towns gathered from @link https://en.wikivoyage.org/wiki/Places_with_unusual_names
         * Come by Chance
         * Val-des-Sources
         * Bird-in-Hand
         * Butt of Lewis, Town of 1770
         * Truth or Consequences, New Mexico
         * Road to Nowhere
         */
        $known = ['by', 'des', 'in', 'of', 'or', 'to'];
        $likely = ['and', 'the', 'da', 'de'];

        return array_merge($known, $likely);
    }

    /**
     * @inheritDoc
     */
    protected function initSplitters(): array
    {
        return [' ', '-'];
    }
}
