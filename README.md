# Proper Naming
An advanced and extensible proper naming strategy.

Features
--------
- Adjustable in real time through public properties
- Force words to all upper or all lower case
- Detect properly formatted overrides on edge cases
- Callable objects for cleaner code

Installation
------------
From within your project...
```shell
# composer require vorgas/proper-naming
```

Basic Usage
-----------
Just call the appropriate class with the string to format.
```php
use ProperNaming\PeopleCasing;
$ProperName = new PeopleCasing();
# All of these will echo 'Mike Hill'
echo $ProperName->format('MIKE HILL');
echo $ProperName('MIKE HILL');
echo $ProperName('mike hill');
echo $ProperName('mIKE hILl');
```
Also handles words that should all lower case
```php
echo $ProperName('MARIO VAN PEEBLES'); # Mario van Peebles
echo $ProperName('lacy del gallo'); # Lacy del Gallo
```

And it can force certain words to be upper cased
```php
echo $ProperName('edwardo genius iii'); # Edwardo Genius III
```

It can detect special prefixes
```php
echo $ProperName('don juan demarco'); # Don Juan DeMarco
echo $ProperName('MCDONALD'); # McDonald
```

And assume that a properly formatted name is probably intentional
```php
echo $ProperName('Mike MacDonald'): # Mike MacDonald
echo $ProperName('Mike Macdonald'); # Mike Macdonald
```
Advanced Usage
--------------
The class exposes 3 arrays as public properties that you can adjust.
 1: $splitters[] - Treats anything around this as a word
 2: $forces[] - Force these entries to be cased as listed
 3: $assumptions[] - Use these to assume properly cased submissions

$splitters[] example
```php
$ProperName->splitters[] = "_";
echo $ProperName('snake_case'); # Snake_Case
```

$forces[] example
```php
$ProperName->forces[] = 'wHinY';
echo $ProperName('whiny case'); # wHinY Case
```

$assumptions[] example
```php
$ProperName->assumptions[] = 'Dee';
echo $ProperName('Madison DeeLIGHT'); Madison DeeLIGHT
```

Development
-----------
To add your own class:
 - Extend ProperNaming\AbstractCasing
 - Add the following 3 methods, returning the appropriate array
   ```php
   abstract protected function splitters(): array 
   { 
       return [];
   }
   
   abstract protected function forces(): array
   {
       return [];
   }
   
   abstract protected function assumptions(): array
   {
       return [];
   }   
   ```
To Do
-----
* Add additional casing classes, such as cities or businesses

Acknowledgement
---------------
 * Derived from the script at
 * https://www.media-division.com/correct-name-capitalization-in-php/
 * Armand Niculescu - https://www.media-division.com/author/armand/

The logic behind the delimiter array was freaking genius. I also kept his 
original case force exceptions.