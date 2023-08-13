# Basic Usage
Converts a string into Proper Names, based on capitalization rules.

 * casing::format(string $string, bool $ucfirst = true): string
    * $string - The string to be capitalized
    * $ucfirst - Force the first letter to be capitalized

```php
use ProperNaming\PeopleCasing;
$peopleCasing = new PeopleCasing();
$peopleCasing->case('MIKE HILL'); # Mike Hill
$peopleCasing->case('rip van winkle'); # Rip van Winkle
```

All casing classes are invokable, just you can just call the class variable
with a string.
```php
$peopleCasing('van trapp'); # Van Trapp <-- A person's actual name
$peopleCasing('van trapp', false); # van Trapp <-- The family name
$peopleCasing('john smith iii'); # John Smith III
```

# Advanced Usage
The class exposes 4 arrays as public properties that you can adjust.
* $assumptions[] - Use these to assume properly cased submissions
* $customs[] - Total output override
* $forces[] - Force these entries to be cased as listed
* $splitters[] - Treats anything around this as a word

$assumptions[]
--------------
If the original input appears to be properly capitalized, and ONLY the part of
the name that follows these entries is different, then maintain the orinigal 
casing.

Essentially, there is no way to determine casing strategies that is 100% accurate.
You can have Macalilly and MacDonough. This helps address those situations.

Basically, if it appears the string is properly capitalized, then just assume
they knew what they were doing on this weird edge case.
```php
$peopleCasing->assumptions[] = 'Dee';
echo $peopleCasing('Madison DeeLIGHT'); Madison DeeLIGHT
```

$customs[]
----------
An absolute override on the entire string. Before processing, the string is
compared to all entries in $customs[] (case-insensitive). If they match, use
the captilazation scheme in $customs and call it a day.
```php
$peopleCasing->customs[] = 'ceLEBrity CASing';
echo $peopleCasing('celebrity casing'); # ceLEBrity CASing
```
Notice that even though $ucfirst was not set to false, it didn't capitalize the
first word. $customs overrides everything.

$forces[]
---------
If a word matches an entry in $forces[] it uses the capitalization provided by
the $forces[] version.

Entries in $forces works on individual words during processing, whereas $customs
works on the entire string before processing.

```php
$peopleCasing->forces[] = 'pHp';
echo $peopleCasing('isnt php great'); # Isnt pHp Great
```

Note, the first word of the string will always be initial caps, even if it's
listed as lower case in $forces[]. Override this behavior by setting $ucfirst
to false.

This is because a name like 'Van' or 'Del' as a person's first name should be 
capitalized, but as a family name, it wouldn't be.
```php
$peopleCasing('rip van winkle'); # Rip van Winkle
$peopleCasing('van wilder'); # Van Wilder
$peopleCasing('van wilder', false); # van Wilder
```

$splitters[]
------------
The first letter following a splitter will be capitalized by default.

Strings are split into words, and then each word is processed to determine
capitalization. $splitters is how it knows what the words are.
```php
$peopleCasing->splitters[] = "_";
echo $peopleCasing('snake_case'); # Snake_Case
```
Splitters are case-sensitive. So when adding custom splitters, it's important
the casing condition. Each $splitter is applied in order, and the first is 
almost always a space.

So, if you add a custom splitter of 'handy' it won't catch an actual phrase
that starts with handy, because it would be Handy.
```php
$peopleCasing->splitters[] = 'handy';
echo $peopleCasing('my handydandy man'); #My Handydandy Man
$peopleCasing->splitters[] = 'Handy';
echo $peopleCasing('my handydandy man'); #My HandyDandy Man
```
