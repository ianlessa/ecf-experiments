<?php

namespace Ecf\Price;

class PercentDiscountPrice extends PriceDecorator
{
    /**
     * The value property on this object represent the tax in per-mille.
     * Ex.:
     * Original value = 1;
     * Tax value: 0.001
     * Percent: 0.1%
     *
     * Original value = 10;
     * Tax value: 0.01
     * Percent: 1%
     *
     * Original value = 100;
     * Tax value: 0.1
     * Percent: 10%
     *
     * Original value = 1000;
     * Tax value: 1.0
     * Percent: 100%
     */

    /**
     * @return int
     */
    public function getValue()
    {
        $originalValue = $this->price->getValue();
        $tax = $this->value / 1000;
        $amount = intval(ceil($originalValue * $tax));

        return $originalValue - $amount;
    }
}
