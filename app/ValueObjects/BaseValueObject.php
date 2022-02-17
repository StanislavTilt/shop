<?php


namespace App\ValueObjects;


use Exception;
use phpDocumentor\Reflection\Types\Static_;

abstract class BaseValueObject
{
    protected mixed $value;

    public function __construct(mixed $value)
    {
        $this->value = $value;
    }

    /**
     * @param BaseValueObject $object
     * @return bool
     */
    public function is(BaseValueObject $object): bool
    {
        if (!($object instanceof static) || $this->value !== $object->value) {
            return false;
        }

        return true;
    }

    /**
     * @return mixed
     */
    public function __toString()
    {
        return $this->value;
    }

    abstract public static function all(): array;
}
