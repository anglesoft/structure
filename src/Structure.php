<?php

namespace Angle\Structure;

use InvalidArgumentException as Exception;
use ReflectionClass as Reflection;

trait Structure
{
    /**
     * Takes over the class constructor in order to validate
     * and assign the appropriate properties to the struct.
     *
     * @param array $properties
     */
    public function __construct(array $properties)
    {
        $class = self::class;
        $mirror = new Reflection($class);

        foreach ($mirror->getDefaultProperties() as $property => $default) {
            if (! in_array($property, array_keys($properties))) {
                throw new Exception("'{$property}' is missing on struct {$class}");
            }

            $value = $properties[$property];

            if ($this->isClass($default)) {
                $this->{$property} = is_object($value) ? $value : new $value;

                continue;
            }

            $expectedType = gettype($default);
            $inspect = $this->getInspectionMethod($expectedType);

            if (! $this->{$inspect}($value)) {
                throw new Exception("'{$property}' must be of type {$expectedType}.");
            } else {
                $this->{$property} = $value;
            }
        }
    }

    /**
     * Returns the appropriate inspection method.
     * @param  string $type
     * @return string $methodName
     */
    private function getInspectionMethod(string $type) : string
    {
        return 'is' . ucfirst($type);
    }

    /**
     * Checks if suspect may be a class.
     * @param  mixed $suspect
     * @return bool
     */
    private function isClass($suspect) : bool
    {
        return strpos($suspect, '\\') !== false || class_exists($suspect);
    }

    /**
     * Checks if suspect is of type string.
     * @param  mixed $suspect
     * @return bool
     */
    private function isString($suspect) : bool
    {
        return is_string($suspect);
    }

    /**
     * Checks if suspect is of type boolean.
     * @param  mixed $suspect
     * @return bool
     */
    private function isBoolean($suspect) : bool
    {
        return is_bool($suspect);
    }

    /**
     * Checks if suspect is of type integer.
     * @param  mixed $suspect
     * @return bool
     */
    private function isInteger($suspect) : bool
    {
        return is_int($suspect);
    }

    /**
     * Checks if suspect is of type double.
     * @param  mixed $suspect
     * @return bool
     */
    private function isDouble($suspect) : bool
    {
        return is_double($suspect);
    }
}
