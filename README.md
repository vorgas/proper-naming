# Proper Naming
An advanced and extensible proper name casing strategy

Turns MIKE HILL into Mike Hill, and ANGUS MACGUYVER into Angus MacGuyver. And if
somebody types in John MacDonald and Ian Macloud, it figures they know what they
are doing, and leaves the capitalization the way it was submitted.

With proper usage, it will not only turn angel d'arcy into Angel D'Arcy but
knows to leave well enough alone and make HELL'S BELLS into Hell's Bells.

Features At A Glance
--------------------
- Different strategies for people and places
- Adjustable in real time through public properties
- Force words to all upper or all lower case
- Detect properly formatted overrides on edge cases
- Callable objects for cleaner code

Installation
------------
From within your project...
```shell
# composer require vorgas/proper-naming:dev-main
```

Basic Usage
-----------
Just call the appropriate class with the string to case.
```php
use ProperNaming\PeopleCasing;
$ProperName = new PeopleCasing();
$ProperName('MIKE HILL'); # Mike Hill
$ProperName('rip van winkle'); # Rip van Winkle
$ProperName('van trapp'); # Van Trapp <-- A person's actual name
$ProperName('van trapp', false); # van Trapp <-- The family name
$ProperName('john smith iii'); # John Smith III
```

Casing Strategies
-----------------
 * [Proper Name](./doc/ProperName.md) - Basic Proper Name capitalization
 * [People Casing](./doc/PeopleCasing.md) - Some enhanced family name distinctions
 * [Business Casing](./doc/BusinessCasing.md) - Business name overrides and oddities
 * [City Casing](./doc/CityCasing.md) - Handles various city naming conventions
 * [US State Casing](./doc/USStateCasing.md) - Caps the 2-letter codes for states & territories
 * [Custom Casing](./doc/CustomCasing.md) - Roll your own custom rules and overrides

Other Topics
------------
 * [Advanced Usage](./doc/Usage.md)
 * [Known Issues](./doc/KnownIssues.md)
 * [Development](./doc/Development.md)

Acknowledgement
---------------
 * Derived from the script at
 * https://www.media-division.com/correct-name-capitalization-in-php/
 * Armand Niculescu - https://www.media-division.com/author/armand/

The logic behind the delimiter array was freaking genius. I also kept his 
original case force exceptions, but added some extras.


License
-------
Licensed under the MIT License - see the [License](./doc/License.md) for details