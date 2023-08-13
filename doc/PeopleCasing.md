# PeopleCasing()
Proper Name casing with some special handlers for common family names

In addition to the normal word splitters of " ", "." and "-", there is also
some splitters for unusual family names, such as "D'Arcy" or "McDonald".

Also includes some edge cases clean inputs, such as "d'Arcy" AND "D'Arcy"

Usage
-----
```php
$casing = new \Vorgas\ProperNaming\PeopleCasing();
$casing('SOME STRING'); # Some String
```
See [Usage](Usage.md) for more advanced usage options

$assumptions[]
--------------
If the string appears properly formatted on input, then whatever capitalization
follows these items will be preserved.
 * 'Mac', 'Mc', 'Le', 'La', "D'", "L'", "d'", "l'"
```php
$casing('John MacDonald'); # John MacDonald
$casing('John Macdonald'); # John Macdonald
$casing('JOHN MACDONALD'); # John MacDonald
```

$customs[]
----------
None

$forces[]
---------
The following entries will be forced into lower case. Except when they start
the string AND $ucfirst is not set to false.
 * (English Common) - 'a', 'an', 'and', 'of', 'on', 'or', 'the'
 * (Other Common) - 'van', 'den', 'von', 'und', 'der', 'de', 'da', 'del'
```php
$casing('rip van winkle'); # Rip Van Winkle
$casing('VAN WILDER'); # Van Wilder
$casing('VAN WILDER', false); # van Wilder
```
    
$splitters[]
------------
Splits words by the following
 * " ", ".", "'", "-", 'St.', 'Mc', 'Mac', 'De', 'Ms.'

Note that the apostrophe (') is a delimiter. So DON'T use this class for words
that are likely to be possessive, such as businesses, bands, etc. Otherwise,
you would end up with Hell'S Belles.