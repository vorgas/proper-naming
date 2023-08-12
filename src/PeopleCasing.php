<?php
/**
 * Derived from the script at
 * https://www.media-division.com/correct-name-capitalization-in-php/
 * Armand Niculescu - https://www.media-division.com/author/armand/
 *
 * - Packed into a class, with class advantages
 * - Organizational changes, made the code cleaner
 * - Add the ability to force delimiters to all upper case, etc
 */


namespace Vorgas\ProperNaming;

class PeopleCasing extends AbstractCasing
{
    protected function splitters(): array
    {
        return [' ', '-', "'", 'St.', 'Mc', 'De', 'Ms.'];
    }

    protected function forces(): array
    {
        $lc = ['the', 'van', 'den', 'von', 'und', 'der', 'de', 'da', 'of', 'and', 'del'];
        $uc = ['II', 'III', 'IV', 'VI', 'VII', 'VIII', 'IX', 'X'];
        $spec = ['SomeCustomCasingRule'];

        return array_merge($lc, $uc, $spec);
    }

    protected function assumptions(): array
    {
        return ['Mac', 'Mc', 'Le', 'La', "D'", "L'", "d'", "l'"];
    }
}
