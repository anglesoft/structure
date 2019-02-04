# Structure

## Motivation

While we wait for PHP to implement typed properties on classes, let's have fun finding ways to implement this language feature on our own!

## Installation

Install the Angle\Structure package via Composer:

```
composer require angle/structure
```

## Your First Struct

Structs are php classes that make the use of the ```Structure``` trait. The trait will take over the class constructor, so make shure you use it only for strong typing properties (which structs are for basically).

```php
<?php

namespace App\Structures;

use Angle\Structure\Structure;

class CarStruct
{
    use Structure;

    public $id = 0;
    public $model = '';
    public $mark = '';
    public $weight = 0.0;
    public $power = 0.0;
    public $createdAt = 'Carbon\Carbon';
    public $updatedAt = 'Carbon\Carbon';
}
```
