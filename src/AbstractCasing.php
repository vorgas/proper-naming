<?php

namespace Vorgas\ProperNaming;

abstract class AbstractCasing implements CasingInterface
{
    /** @var array Used to detect properly formatted input on edge cases */
    public array $assumptions = [];

    /** @var array Use the supplied capitalization for the given strings */
    public array $customs = [];

    /** @var array Force individual words into this casing */
    public array $forces = [];

    /** @var array Splits the string into words by these entries */
    public array $splitters = [];


    /**
     * Initializes the public arrays with values supplied by the child class
     */
    public function __construct()
    {
        $this->splitters = $this->initSplitters();
        $this->forces = $this->initForces();
        $this->assumptions = $this->initAssumptions();
        $this->customs = $this->initCustoms();
    }


    /**
     * Capitalize the given string to a Proper Name based on the casing rules
     *
     * @param string $string    The string to be capitalized
     * @param bool $ucfirst     Capitalize the first letter of the string
     * @return string
     *@see case()
     *
     */
    public function __invoke(string $string, bool $ucfirst = true): string
    {
        return $this->case($string, $ucfirst);
    }


    /**
     * Used by the child class to set up the assumptions property
     *
     * @see $assumptions is used to detect properly formatted input to help
     * resolve edge cases.
     * @link doc/Usage.md
     *
     * @return string[]
     */
    abstract protected function initAssumptions(): array;


    /**
     *  Used to set the initial value for the customs array
     *
     * @return string[]
     */
    abstract protected function initCustoms(): array;


    /**
     * Used by the child class to set the initial forces property
     *
     * A case-insensitive search is performed against these entries. If there
     * is a match, the entry from here is used, regardless of capitalization.
     * @see $forces
     * @link doc/Usage.md
     *
     * @return string[]
     */
    abstract protected function initForces(): array;


    /**
     * Used by the child class to set up the splitters property
     *
     * The first character following a listed delimiter will be upper-cased.
     * You should always put punctuation first, followed by properly cased
     * delimiters.
     * @see $splitters
     * @link doc/Usage.md
     *
     * @return string[]
     */
    abstract protected function initSplitters(): array;


    /**
     * Converts the string into Proper Names, based on the casing rules
     *
     * If the first word of a string is forced to lower case, the first letter
     * will still be upper case, unless $ucfirst is set to false.
     * @see $forces
     * @link doc/Usage.md
     *
     * @param string $string    The string to be converted to Proper Casing
     * @param bool $ucfirst     Force the first letter to be capital
     * @return string           Properly capitalized string
     */
    public function case(string $string, bool $ucfirst = true): string
    {
        $string = trim($string);

        // First check to see if a custom override. No sense in going through
        // the formatting loop if it's forced anyway.
        $custom = $this->isCustom($string);
        if ($custom !== false)
            return $this->customs[$custom];

        // Capitalize the words according to heuristics
        // Then, if it looks like properly formatted input, use that
        $properFormat = $this->properCasing($string);
        if ($this->assumeCorrectInput($string, $properFormat))
            return $string;

        // $string is not custom, and it wasn't properly formatted on input,
        // but now it is. The only thing remaining is whether to capitalize
        // the first letter before returning it.
        if ($ucfirst) return ucfirst($properFormat);
        return $properFormat;
    }


    /**
     * Tries to detect edge cases with properly capitalized input
     *
     * This deals with something like MacDonald and Macloud. If the entries are
     * 'John MacDonald' and 'Ian Macloud', it's quite probable this input is
     * intentional and correct. However, if it's JOHN MACDONALD, then go with
     * the default rules.
     *
     * @param string $original  The original string as supplied
     * @param string $proper    The string, after having casing rules applied
     * @return bool             Whether this appears to be proper input
     */
    private function assumeCorrectInput($original, $proper)
    {
        // General logic
        /* Split each string into an array, based on spaces
           Remove entries from $original that are matched in $proper
           For the remaining entries in $diff
             - If even one doesn't start with an assumption match, use $proper
             - If all of them start with an assumption match, use $original */

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
     * Returns the word capitalized as a Proper Name
     *
     * If $word has an entry in @see $forces[], then use that entry for the
     * capitalization. Otherwise, return $word with the first letter capped.
     *
     * @internal This does not change casing other than in $forces. This is so
     * mid-word capitalization because of delimiters will be applied.
     *
     * @param string $word      The word to check
     * @return mixed|string     The formatted word
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
     * Does a case-insensitive search for $word within @see $forces[]. If a
     * match is found, return the index. Otherwise, return false.
     *
     * @param string $word      The word to search for
     * @return false|int        Index in $forces[] if found. False if not.
     */
    private function forcedCasing($word)
    {
        $keys = array_map('strtolower', $this->forces);
        return array_search(strtolower($word), $keys);
    }


    /**
     * Case-insensitive search for a known name with custom casing
     *
     * If $string is found in @see $customs[], return the index of the match.
     * Otherwise, return false.
     *
     * @param string $string    The string to search for
     * @return false|integer    Index of the match in $customs[]. False if not.
     */
    public function isCustom(string $string): false|int
    {
        $map = array_map('strtolower', $this->customs);
        return array_search(strtolower($string), $map);
    }


    /**
     * Splits the strings into words, then applies capitalization rules to each.
     *
     * $string is split into words by the delimiters in @see $splitters[]. Each
     * word then has the casing rules applied. Then the words are reassembled,
     * and the string is split again by the next delimiter.
     *
     * @param string $string    The string to convert into a Proper Name
     * @return string           The Properly Cased string
     */
    private function properCasing($string)
    {
        $string = strtolower($string);
        foreach ($this->splitters as $delimiter)
        {
            // If $delimiter is not in the string, don't process the array.
            // This saves re-processing an already cased word
            // Unless $delimiter is a space (' '). Otherwise, single words
            // wouldn't get processed.
            if (!str_contains($string, $delimiter) && $delimiter != ' ')
                continue;
            $words = explode($delimiter, $string);

            // Apply the casing rules to each word then rejoin them.
            // Don't forget to apply the forced casing rules to the delimiter
            // This helps when dealing with weird names like L'Amour.
            $newwords = array_map([$this, 'casing'], $words);
            $string = join(
                $this->casing($delimiter),
                $newwords
            );
        }

        return $string;
    }
}
