<?php

namespace Ecf\Price;

class FixedDiscountPrice extends PriceDecorator
{
    /**
     * @return int
     */
    public function getValue()
    {
        return $this->price->getValue() - $this->value;
    }
}
