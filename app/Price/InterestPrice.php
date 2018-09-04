<?php

namespace Ecf\Price;

class InterestPrice extends PriceDecorator
{
    /**
     * @return int
     */
    public function getValue()
    {
        return $this->price->getValue() + $this->value;
    }
}
