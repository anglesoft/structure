# Structure

## Motivation

While we wait for typed properties to be implemented within PHP classes, let's have fun finding ways to implement this language feature on our own!

## Installation

Install the Angle\Structure package via Composer:

```
composer require angle/structure
```

## Your First Struct

Structs are php classes that make the use of the ```Structure``` trait. The trait will take over the class constructor, so make shure you use it only for strong typing properties (which structs are for basically).

```php
<?php

namespace App\Structs;

use Angle\Structure\Structure;

class CarStruct
{
    use Structure;

    public $id = 0;
    public $model = '';
    public $mark = '';
    public $range = 0;
    public $power = 0.0;
    public $createdAt = 'Carbon\Carbon';
}
```

To create the struct, simply instanciate a new object with an array of properties:

```php
<?php

use App\Structs\CarStruct;

$s = new CarStruct([
    'id' => 12,
    'model' => 'Model S',
    'mark' => 'Tesla',
    'range' => 315,
    'power' => 560,
    'createdAt' => Carbon::now(),
]);
```

If any of the parameters are not of expected value, the constructor will throw an error.

## Licence

MIT

Copyright © [Angle Software](https://angle.software)
