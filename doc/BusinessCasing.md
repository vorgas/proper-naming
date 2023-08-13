# BusinessCasing()
Proper Name casing with some special handlers because businesses are clever.

Lots of word splitters, including digits, because they just can't help
themselves. No apostrophe, though. Businesses tend to be possessive :)

It also forces the common ending of LLC to upper case. And since EZ is almost 
always that way, it does that too.

Usage
-----
```php
$casing = new \Vorgas\ProperNaming\BusinessCasing();
$casing('plan4demand'); # Plan4Demand
```
See [Usage](Usage.md) for more advanced usage options

$assumptions[]
--------------
If the string appears properly formatted on input, then whatever capitalization
follows these items will be preserved.
* 'a', 'an', 'and', 'of', 'the', 'or'
```php
$casing('Remind Me Of You'); # Remind Me Of You
$casing('remind me of you'); # Remind Me of You
```

$customs[]
----------
There's a whole list of custom business names. You'll probably need to add more.
Send 'em here and I'll try to add them. To see the current list, view the code
or print the array.
```php
print_r($casing->customs);
```

$forces[]
---------
The following entries will be forced into the given capitalization
 * (lower) - 'a', 'an', 'and', 'of', 'the', 'or'
 * (upper) - LLC', 'EZ'
```php
$casing('My Company, llc'); # My Company, LLC
```
    
$splitters[]
------------
Splits words by the following
 * (common) - ' ', '-', '.'
 * (digits) - '1', '2', '3', '4', '5', '6', '7', '8', '9', '0'
 * (symbols) - '@'
