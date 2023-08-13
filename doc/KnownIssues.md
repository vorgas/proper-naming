# Known Issues

splitter[] contained in force[]
-------------------------------
If a $force contains a $splitter, it can result in some bizarre capitalization.
For example:
```php
$ProperName('del brown'); # Del Brown
$ProperName->splitter[] = 'de';
$ProperName('del brown'); # DeL Brown
```
This shouldn't occur by default, but if you add splitters manually, you may
run into this.

Multi-Word Forces
----------------------
There isn't yet an effective way to deal with multi-word forces. The behavior
will be mixed. If you need it, copy the BusinessCasing class, and put your
overrides in the Casing::custom[] property.


