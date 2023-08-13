# Development
If you find yourself passing lots of array changes at run time, you should
look into making your own class. You really have two options.

Copy Existing
-------------
The easiest thing to do is copy the base casing strategy you are using. 
* It's a simple casing strategy, and easily modifiable.
* The internal comments should give you what you need to know
* Don't forget to change the class name to MyCasing

Create Your Own Class
---------------------
To add your own class:
* Extend ProperNaming\AbstractCasing
* Add the following 4 methods, returning the appropriate array
  ```php
  abstract protected function assumptions(): array
  {
      return [];
  }
  
  abstract protected function customs(): array
  {
      return [];
  }
  
  abstract protected function forces(): array
  {
      return [];
  }
  
  abstract protected function splitters(): array 
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
