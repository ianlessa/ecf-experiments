<?php

namespace Ecf\Price;

use Ecf\Base\ValueObjectInterface;
use Ecf\Exception\InvalidOperationException;

abstract class AbstractPrice implements ValueObjectInterface
{
    /**
     * @var int
     */
    protected $value;

    public function __construct($value)
    {
        $this->setValue($value);
    }

    /**
     * @return int
     */
    abstract public function getValue();

    /**
     * @param  int $value
     * @return AbstractPrice
     * @throws InvalidOperationException
     */
    protected function setValue($value)
    {
        $intValue = intval($value);
        if ($intValue < 0) {
            throw new InvalidOperationException();
        }

        $this->value = $intValue;
        return $this;
    }

    /**
     * @param AbstractPrice $valueObject
     *
     * @return boolean
     */
    public function equals(ValueObjectInterface $valueObject)
    {
        return
            is_a($valueObject, static::class) &&
            $this->getValue() === $valueObject->getValue();
    }
}
