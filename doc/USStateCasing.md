# USStateCasing()
Proper casing, with forced upper-case abbreviations for states & territories.

Usage
-----
```php
$casing = new \Vorgas\ProperNaming\USStateCasing();
$casing('al'); # AL
```
See [Usage](Usage.md) for more advanced usage options

$assumptions[]
--------------
none

$customs[]
----------
None

$forces[]
---------
The two letter abbreviations for all 50 US states, and several territories,
including the District Of Columbia (DC) will be forced.

For a full list see the file, or output the array
```php
print_r($casing->forces);
```
    
$splitters[]
------------
Splits words by the following
 * Space ( )
 * Dot (.)
