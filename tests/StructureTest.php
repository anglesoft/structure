<?php

use Angle\Structure\Structure;
use Carbon\Carbon;
use InvalidArgumentException as Exception;
use PHPUnit\Framework\TestCase;

class Transaction
{
    use Structure;

    public $id = 0;
    public $hash = '';
    public $success = false;
    public $amount = 0.0;
    public $time = Carbon::class;
    public $optional;
}

final class StructureTest extends TestCase
{
    public function testConstructor()
    {
        $transaction = new Transaction([
            'id' => 0,
            'hash' => uniqid(),
            'success' => true,
            'amount' => 1.0,
            'time' => \Carbon\Carbon::now(),
            'optional' => null,
        ]);

        $this->assertTrue($transaction->success);
    }

    public function testMissingSingleProp()
    {
        $this->expectException(Exception::class);

        $transaction = new Transaction([
            // 'id' => 0,
            'hash' => uniqid(),
            'success' => true,
            'amount' => 1.0,
            'time' => \Carbon\Carbon::now(),
            'optional' => 'filled with some string'
        ]);
    }

    public function testMissingMultipleProps()
    {
        $this->expectException(Exception::class);

        $transaction = new Transaction([
            // 'id' => 0,
            // 'hash' => uniqid(),
            'success' => true,
            // 'amount' => 1.0,
            'time' => \Carbon\Carbon::now(),
        ]);
    }

    public function testInvalidPropInt()
    {
        $this->expectException(Exception::class);

        $transaction = new Transaction([
            'id' => 'string', // should be (int) 0
            'hash' => uniqid(),
            'success' => true,
            'amount' => 1.0,
            'time' => 'Carbon\Carbon',
        ]);
    }

    public function testInvalidPropString()
    {
        $this->expectException(Exception::class);

        $transaction = new Transaction([
            'id' => 0,
            'hash' => 0, // should be (string) ''
            'success' => true,
            'amount' => 1.0,
            'time' => 'Carbon\Carbon',
        ]);
    }

    public function testInvalidPropBoolean()
    {
        $this->expectException(Exception::class);

        $transaction = new Transaction([
            'id' => 0,
            'hash' => uniqid(),
            'success' => 'true', // should be (bool) true|false
            'amount' => 1.0,
            'time' => 'Carbon\Carbon',
        ]);
    }

    public function testInvalidPropDouble()
    {
        $this->expectException(Exception::class);

        $transaction = new Transaction([
            'id' => 0,
            'hash' => uniqid(),
            'success' => true,
            'amount' => '1.0', // should be (double) 0.0
            'time' => 'Carbon\Carbon',
        ]);
    }

    public function testInvalidPropClass()
    {
        $this->expectException(Exception::class);

        $transaction = new Transaction([
            'id' => 0,
            'hash' => uniqid(),
            'success' => true,
            'amount' => 0.0,
            'time' => 'foo', // should be (object) Carbon\Carbon
        ]);
    }

    public function testInvalidPropClassType()
    {
        $this->expectException(Exception::class);

        $transaction = new Transaction([
            'id' => 0,
            'hash' => uniqid(),
            'success' => true,
            'amount' => 0.0,
            'time' => 'stdClass', // should be (object) Carbon\Carbon
        ]);
    }
}
