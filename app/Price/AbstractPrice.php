<?php

namespace Ecf\Price;

use Ecf\Exception\InvalidOperationException;

abstract class AbstractPrice
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
        $_value = intval($value);
        if ($_value < 0) {
            throw new InvalidOperationException();
        }

        $this->value = $_value;
        return $this;
    }
}