<?php

namespace Vorgas\ProperNaming;

/**
 * Proper Name casing with some special handlers for common family names
 *
 * In addition to the normal word splitters of " ", "." and "-", there is also
 * some splitters for unusual family names, such as "D'Arcy" or "McDonald".
 *
 * Also includes some edge cases clean inputs, such as "d'Arcy" AND "D'Arcy"
 */
class PeopleCasing extends ProperName
{
    /**
     * @inheritDoc
     */
    protected function initAssumptions(): array
    {
        return array_merge(
            ['Mac', 'Mc', 'Le', 'La', "D'", "L'", "d'", "l'"],
            parent::initAssumptions()
        );
    }

    /**
     * @inheritDoc
     */
    protected function initCustoms(): array
    {
        // Reduntant for now, but allows easy extension
        return parent::initCustoms();
    }

    /**
     * @inheritDoc
     */
    protected function initForces(): array
    {
        // Reduntant for now, but allows easy extension
        return parent::initForces();
    }

    /**
     * @inheritDoc
     */
    protected function initSplitters(): array
    {
        // Be careful when using array_merge with the splitters!!!
        /* The order is important, as delimiters are not case-insesitive
            when splitting. For example:
            - $splitters = [" ", "De"];
            - format("anna demarco"); # Anna DeMarco

            - $splitters = ["De", " "];
            - format("anna demarco"); # Anna Demarco

            It's better to just override it and be safe! */
        return [" ", ".", "'", "-", 'St.', 'Mc', 'Mac', 'De', 'Ms.'];
    }
}
