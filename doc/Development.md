# Development
To create your own class, use one of these two options

Copy ProperName.php
-------------------
The easiest thing to do is copy src/ProperName.php to src/MyCasing.php
* It's a simple casing strategy, and easily modifiable.
* The internal comments should give you what you need to know
* Don't forget to change the class name to MyCasing

Create Your Own Class
---------------------
To add your own class:
* Extend ProperNaming\AbstractCasing
* Add the following 3 methods, returning the appropriate array
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
You can also do some pre and post formatting work by adding 
```php
public function case($string, $ucfirst = true): string
{
    # Work on string before applying standard case rules
    
    parent::case($string, $ucfirst);
    
    # Work on string after applying standard case rules
}
```

Dealing With Lots Of Overrides
------------------------------
If you have a casing strategy that requires a lot of custom overrides, consider
using ProperNaming\BusinessCasing as a template.

It has a custom override feature built-in. Just replace the public property
Casing::custom[] with your own array. Each entry is a unique strategy.

This will help on multi-word comparisons.