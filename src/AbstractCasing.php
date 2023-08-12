<?php
/**
 * Derived from the script at
 * https://www.media-division.com/correct-name-capitalization-in-php/
 * Armand Niculescu - https://www.media-division.com/author/armand/
 *
 * - Packed into a class, with class advantages
 * - Organizational changes, made the code cleaner
 * - Add the ability to force delimiters to all upper case, etc
 * - Add the ability to detect edge cases for properly formatted input
 */


namespace Vorgas\ProperNaming;

abstract class AbstractCasing
{
    /** @var array Used to split words from the string */
    public array $splitters = [];

    /** @var array Force items into this formatting  */
    public array $forces = [];

    /**
     * If the original input, appears to be properly formatted, and
     * ONLY the part of the name that follows these entries is different,
     * then maintain the original formatting.
     *
     * For example:
     *  - If this array contains Mac
     *  - Angus MacGyver would stay Angus MacGyver
     *  - Norm Macdonald would stay Norm Macdonald
     *  - JASON MacMasters would become Jason Macmasters, because the Jason
     *     didn't match up
     */
    public array $assumptions = [];

    public function __construct()
    {
        $this->splitters = $this->splitters();
        $this->forces = $this->forces();
        $this->assumptions = $this->assumptions();
    }

    public function __invoke($string): string
    {
        return $this->format($string);
    }

    /**
     * Used to set the initial splitters property
     * @return array
     */
    abstract protected function splitters(): array;

    /**
     * Used to set the initial forces property
     * @return array
     */
    abstract protected function forces(): array;

    /**
     * Used to accept properly formatted names as intentional
     * @return array
     */
    abstract protected function assumptions(): array;

    /**
     * Converts the string into Proper Names, based on capitalization rules
     *
     * Tries to do a decent job of Proper Name capitalization. Can handle
     * substrings that are forced to be upper-cased or lower-cased, with
     * special delimiters.
     *
     * @param string $string    The string to be formatted
     * @return string
     */
    public function format($string): string
    {
        $string = trim($string);
        $properFormat = $this->properFormat($string);
        if ($this->assumeCorrectInput($string, $properFormat))
            return $string;

        return $properFormat;
    }

    private function assumeCorrectInput($original, $proper)
    {
        // Split each string into an array, based on spaces
        // Remove entries from $original that match the corresponding entry in $proper
        // For the remaining entries in $diff
        // - If even one doesn't start with an assumption match, use $proper
        // - If all of them start with an assumption match, use $original
        $diff = array_diff(
            explode(' ', $original),
            explode(' ', $proper)
        );

        foreach ($diff as $name) {
            $inAssumption = false;
            foreach ($this->assumptions as $key) {
                if (str_starts_with($name, $key)) {
                    $inAssumption = true;
                    break;
                }
            }

            if (! $inAssumption) return false;
        }

        return true;
    }

    /**
     * Returns either the word as all lowercase, initial cap, or all uppercase.
     *
     * If $word is in the $lcForces array, return it as all lowercase. If $word
     * is in the $ucForces array, return it as all uppercase. Otherwise, return
     * $ward with the first letter capitalized.
     *
     * @param string $word     A lowercase word
     * @return mixed|string
     */
    private function casing($word)
    {
        $forced = $this->forcedCasing($word);
        if ($forced !== false)
            return $this->forces[$forced];

        return ucfirst($word);
    }

    /**
     * Determines if $word has forced casing
     *
     * Does a case-insensitive search for $word within Casing::forces[]. If a
     * match is found, return the index. Otherwise, return false.
     *
     * @param string $word
     * @return false|int
     */
    private function forcedCasing($word)
    {
        $keys = array_map('strtolower', $this->forces);
        return array_search(strtolower($word), $keys);
    }


    /**
     * Does the basic initial caps, with the forced cases
     *
     * @param string $string
     * @return string
     */
    private function properFormat($string)
    {
        $string = strtolower($string);
        foreach ($this->splitters as $delimiter)
        {
//            if (!str_contains($delimiter, $string))
//                continue;

            $words = explode($delimiter, $string);
            $newwords = array_map([$this, 'casing'], $words);

            if (str_contains($delimiter, $string)) {
                $delimiter = $this->casing($delimiter);
            }

            $string = join(
                $this->casing($delimiter),
                $newwords
            );
        }

        return $string;
    }
}
