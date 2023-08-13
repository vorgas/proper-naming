<?php

namespace Vorgas\ProperNaming;

/**
 * A bare-bones casing template. Basically forces Camel Case. And that's it.
 */
class CustomCasing extends AbstractCasing
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
        return [];
    }

    /**
     * @inheritDoc
     */
    protected function initSplitters(): array
    {
        return [' '];
    }
}
