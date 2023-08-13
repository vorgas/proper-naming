# ProperName()
Genaral usage for casing Proper Names

Handles most general cases for capitalizing proper names. Essentially
capitalizes the first letter of each word, with a few common exceptions.

You should ONLY use this as a fallback if a more specific casing strategy
isn't available to suit your needs. [People](PeopleCasing.md), 
[Businesses](BusinessCasing.md), [Cities](CityCasing.md), and 
[States](USStateCasing.md) all provide better results in those cases.


Usage
-----
```php
$casing = new \Vorgas\ProperNaming\ProperName();
$casing('SOME STRING'); # Some String
```
See [Usage](Usage.md) for more advanced usage options

$assumptions[]
--------------
None

$customs[]
----------
None

$forces[]
---------
The following entries will be forced into lower case
 - (English Common) - 'a', 'an', 'and', 'of', 'on', 'or', 'the'
 - (Other Common) - 'van', 'den', 'von', 'und', 'der', 'de', 'da', 'del'
```php
$casing('RUE DE JAR'); # Rue de Jar
$casing('mary and joseph'); # Mary and Joseph
```
    
$splitters[]
------------
Splits words by the following
 - Space ( )
 - Dash (-)
 - Dot (.)