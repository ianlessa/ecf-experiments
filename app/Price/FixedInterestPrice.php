<?php

namespace Ecf\Price;

class FixedInterestPrice extends PriceDecorator
{
    /**
     * @return int
     */
    public function getValue()
    {
        return $this->price->getValue() + $this->value;
    }
}
