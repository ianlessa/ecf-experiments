<?php

namespace Ecf\Price;

use Ecf\Exception\InvalidOperationException;

class DiscountPrice extends PriceDecorator
{
    /**
     * @return int
     */
    public function getValue()
    {
        $value = $this->price->getValue() - $this->value;

        if ($value < 0) {
            throw new InvalidOperationException();
        }

        return $this->price->getValue() - $this->value;
    }
}
