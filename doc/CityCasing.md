# CityCasing()
Proper Name casing with some known exceptions for certain cities and towns

Towns gathered from @link https://en.wikivoyage.org/wiki/Places_with_unusual_names
 * Come by Chance
 * Val-des-Sources
 * Bird-in-Hand
 * Butt of Lewis, Town of 1770
 * Truth or Consequences
 * Road to Nowhere

Usage
-----
```php
$casing = new \Vorgas\ProperNaming\CityCasing();
$casing("HELL'S BELLS); # Hell's Bells (and yes it's a real place)
```
See [Usage](Usage.md) for more advanced usage options

$assumptions[]
--------------
If the string appears properly formatted on input, then whatever capitalization
follows these items will be preserved.
 * 'Mac', 'Mc'
```php
$casing('Macon'); # Macon
$casing('MACON'); # Macon
$casing('MacGillinty'); # MacGillinty
```

$customs[]
----------
None

$forces[]
---------
The following entries will be forced into lower case. Except when they start
the string AND $ucfirst is not set to false.
 * (Known) - 'by', 'des', 'in', 'of', 'or', 'to'
 * (Likely) - 'and', 'the', 'da', 'de'
```php
$casing('come by chance'); # Come by Chance
$casing('BIRD-IN-HAND'); # Bird-inHand
```
    
$splitters[]
------------
Splits words by the following
 * Space ( )
 * Dot (.)

Don't split by "Mc" or "Mac" because there's just too many places, like Macon
or Macomb.