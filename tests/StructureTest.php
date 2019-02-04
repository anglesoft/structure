<?php

use PHPUnit\Framework\TestCase;
use Angle\Structure\Structure;
use InvalidArgumentException as Exception;

class Transaction
{
    use Structure;

    public $id = 0;
    public $hash = '';
    public $success = false;
    public $amount = 0.0;
    public $time = 'Carbon\Carbon';
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
            'time' => 'Angle\Time',
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
            'time' => 'Angle\Time',
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
            'time' => 'Angle\Time',
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
            'time' => 'Angle\Time',
        ]);
    }

    public function testInvalidPropClass()
    {
        $this->expectException(Error::class);

        $transaction = new Transaction([
            'id' => 0,
            'hash' => uniqid(),
            'success' => true,
            'amount' => 0.0,
            'time' => 'foo', // should be (object) Carbon\Carbon
        ]);
    }
}
