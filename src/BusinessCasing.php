<?php

namespace Vorgas\ProperNaming;

/**
 * General usage for casing business names
 *
 * In addition to normal capitalization rules it adds the following:
 *  - Splits on numbers for 7Eleven, Plan4Demand, etc
 *  - Adds LLC to an uppercase force
 *  - Includes a $custom array to override unusual business casings
 */
class BusinessCasing extends AbstractCasing
{
    /**
     * @inheritDoc
     */
    protected function initAssumptions(): array
    {
        return ['a', 'an', 'and', 'of', 'the', 'or'];
    }

    /**
     * @inheritDoc
     */
    protected function initCustoms(): array
    {
        // Some unusual business name spellings. Easier to force a custom
        // override than to process. Obviously, none of these businesses know
        // they are here, they don't endorse this package, etc.
        return [
            'BlackHawk Products',
            'BrickHouse Security',
            'BullGuard',
            "EBA's",
            'ElemenOPillows',
            'EnableIP',
            'FIDO Alliance',
            'GateKeeper Security',
            'Ideas2IT',
            'KEYper Systems',
            'LaserShield',
            'LiveWatch',
            'NestLabs',
            'ReliaQuest',
            'PrimaCARE',
            'SAGE Integration',
            'ShieldIT',
            'SmarkLabs',
            'UniVoIP',
            'VigilEASE',
            'WD-40',
            'WeDigTech'
        ];
    }

    /**
     * @inheritDoc
     */
    protected function initForces(): array
    {
        $lc = ['a', 'an', 'and', 'of', 'the', 'or'];
        $uc = ['LLC', 'EZ'];
        return array_merge($lc, $uc);
    }

    /**
     * @inheritDoc
     */
    protected function initSplitters(): array
    {
        return [
            ' ', '-', '.',
            '0', '1', '2', '3', '4', '5', '6', '7', '8', '9',
            '@'
        ];
    }
}
