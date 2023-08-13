<?php

namespace Vorgas\ProperNaming;

/**
 * Proper casing, with forced upper-case abbreviations for states & territories
 */
class USStateCasing extends AbstractCasing
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
        // The state names are just for information. They don't do anything.
        $states = [
            'Alabama' => 'AL',
            'Alaska' => 'AK',
            'Arizona' => 'AZ',
            'Arkansas' => 'AR',
            'California' => 'CA',
            'Colorado' => 'CO',
            'Connecticut' => 'CT',
            'Delaware' => 'DE',
            'Florida' => 'FL',
            'Georgia' => 'GA',
            'Hawaii' => 'HI',
            'Idaho' => 'ID',
            'Illinois' => 'IL',
            'Indiana' => 'IN',
            'Iowa' => 'IA',
            'Kansas' => 'KS',
            'Kentucky' => 'KY',
            'Louisiana' => 'LA',
            'Maine' => 'ME',
            'Maryland' => 'MD',
            'Massachusetts' => 'MA',
            'Michigan' => 'MI',
            'Minnesota' => 'MN',
            'Mississippi' => 'MS',
            'Missouri' => 'MO',
            'Montana' => 'MT',
            'Nebraska' => 'NE',
            'Nevada' => 'NV',
            'New Hampshire' => 'NH',
            'New Jersey' => 'NJ',
            'New Mexico' => 'NM',
            'New York' => 'NY',
            'North Carolina' => 'NC',
            'North Dakota' => 'ND',
            'Ohio' => 'OH',
            'Oklahoma' => 'OK',
            'Oregon' => 'OR',
            'Pennsylvania' => 'PA',
            'Rhode Island' => 'RI',
            'South Carolina' => 'SC',
            'South Dakota' => 'SD',
            'Tennessee' => 'TN',
            'Texas' => 'TX',
            'Utah' => 'UT',
            'Vermont' => 'VT',
            'Virginia' => 'VA',
            'Washington' => 'WA',
            'West Virginia' => 'WV',
            'Wisconsin' => 'WI',
            'Wyoming' => 'WY',
        ];
        $territories = [
            'American Samoa' => 'AS',
            'District of Columbia' => 'DC',
            'Guam' => 'GU',
            'Northern Mariana Islands' => 'MP',
            'Puerto Rico' => 'PR',
            'Virgin Islands' => 'VI',
            'Marshall Islands' => 'MH',
            'Palau' => 'PW'
        ];
        $common = ['of'];
        return array_merge($states, $territories, $common);
    }

    /**
     * @inheritDoc
     */
    protected function initSplitters(): array
    {
        return [' ', '.'];
    }
}
